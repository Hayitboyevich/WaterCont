<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['name'] = $user->name;
                return $this->sendSuccess($success, 'User logged in successfully.');
            }
            else{
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
            }
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
}
