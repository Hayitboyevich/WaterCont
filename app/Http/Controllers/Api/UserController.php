<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Enums\RoleEnum;
use App\Models\Region;
use App\Models\SmsMessage;
use App\Models\User;
use App\Services\SendMessage;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function __construct(protected UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            if (\request('region_id')) {
                $users = User::query()
                    ->where('region_id', \request('region_id'))
                    ->whereIn('role_id', [RoleEnum::REGIONAL_INSPECTION, RoleEnum::INSPECTOR])
                    ->get();
                return $this->sendSuccess(UserResource::collection($users), 'Users retrieved successfully.');
            }
            if (\request('operator')) {
                $users = User::query()->where('role_id', RoleEnum::OPERATOR)->get();
                return $this->sendSuccess(UserResource::collection($users), 'Users retrieved successfully.');
            }
            return $this->sendSuccess([], 'Users retrieved successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function create(UserRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'phone' => $request->input('phone'),
                'position' => $request->input('position'),
                'pinfl' => $request->input('pinfl'),
                'role_id' => $request->input('role_id'),
                'region_id' => $request->input('region_id'),
                'password' => Hash::make($request->input('phone')),
            ]);

            return $this->sendSuccess(new UserResource($user), 'User created successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function sendSms(SmsRequest $request): JsonResponse
    {
        try {
            $rand = rand(100000, 999999);
            $message = "Kirish kodi: " . $rand;

            $sendMessage = new SendMessage($request->phone, $message);
            $response = $sendMessage->sendSms();

            if ($response) {
                SmsMessage::query()
                    ->wherePhone($request->phone)
                    ->update(['status' => false]);

                SmsMessage::query()->create([
                    'phone' => $request->phone,
                    'code' => $rand,
                    'status' => true,
                    'sent_at' => now(),
                ]);
            }
            return $this->sendSuccess([], 'Successfully send sms.');

        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function regionUsers(): JsonResponse
    {
        try {
            $region = Region::query()->findOrFail(request('region_id'));

            if (!$region) throw new \Exception('Region not found');

            $users = User::query()->where('region_id', $region->id)->get();

            return $this->sendSuccess(UserResource::collection($users), 'Users retrieved successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }


    public function delete(): JsonResponse
    {
        try {
            $user = User::query()->findOrFail(request('id'));
            $user->phone = null;
            $user->pinfl = null;
            $user->status = false;
            $user->save();

            $user->delete();
            return $this->sendSuccess([], 'User deleted successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function profile(): JsonResponse
    {
        try {
            $user = Auth::user();
            return $this->sendSuccess(new UserResource($user), 'User retrieved successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function getUserData(): JsonResponse
    {
        try {
            $data = [];
            $meta = $this->userService->getProfile(request('pinfl'));
            $data[] = [
                'name' => $meta['result']['name'],
                'middle_name' => $meta['result']['partonimic'],
                'last_name' => $meta['result']['surname'],
                'pinfl' => $meta['result']['pnfl'],
                'department_name' => $meta['result']['positions'][0]['dep_name'],
                'organization_name' => $meta['result']['positions'][0]['org'],
                'position' => $meta['result']['positions'][0]['position'],
            ];
            return $this->sendSuccess($data, 'User data  get successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }
}
