<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\SmsMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $this->verifyCode($request->phone, $request->code);
            $user = User::query()->wherePhone($request->phone)->first();
            if ($user)
            {
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['name'] = $user->name;
                return $this->sendSuccess($success, 'User logged in successfully.');
            }
            else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
            }
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
    public function verifyCode($phone, $code)
    {
        $smsCode = SmsMessage::where('phone', $phone)
            ->orderBy('sent_at', 'desc')
            ->first();

        if ($smsCode) {
            $time = Carbon::parse($smsCode->sent_at);
            $validUntil = $time->addMinutes(2);

            if (Carbon::now()->lt($validUntil)) {
                if ($smsCode->code == $code) {
                    $smsCode->update(['status' =>false]);
                    return true;
                } else {
                    throw new \Exception('Invalid code');
                }
            } else {
                throw new \Exception('Code expired');
            }
        }
        throw new \Exception('Code not valid');
    }

}
