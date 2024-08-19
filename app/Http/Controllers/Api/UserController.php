<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\SmsMessage;
use App\Models\User;
use App\Services\SendMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            $users = User::all();
            return $this->sendSuccess(UserResource::collection($users), 'Users retrieved successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function create(UserRequest $request): JsonResponse
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->middle_name = $request->input('middle_name');
            $user->phone = $request->input('phone');
            $user->position = $request->input('position');
            $user->pinfl = $request->input('pinfl');
            $user->role_id = $request->input('role_id');
            $user->region_id = $request->input('region_id');
            $user->password = Hash::make($request->input('phone'));
            $user->save();
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
                SmsMessage::query()->wherePhone($request->phone)->update(['status' => false]);

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
}
