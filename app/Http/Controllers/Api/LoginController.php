<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Models\SmsMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $this->verifyCode($request->phone, $request->code);

            $user = User::query()->wherePhone($request->phone)->first();

            if (!$user) {
                return $this->sendError('Foydalanuvchi topilmadi.', code: Response::HTTP_UNAUTHORIZED);
            }

            $token = $user->createToken('AuthToken')->accessToken;

            $success['name'] = $user->name;
            $success['token'] = $token;
            return $this->sendSuccess($success, 'Foydalanuvchi muvaffaqiyatli tizimga kirdi');

        } catch (ValidationException $exception) {
            return $this->sendError($exception->getMessage(), code: Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(), code: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function verifyCode($phone, $code)
    {

        $smsCode = SmsMessage::query()
            ->wherePhone($phone)
            ->where('status', true)
            ->orderByDesc('sent_at')
            ->first();

        if (!$smsCode) {
            throw ValidationException::withMessages([
                'code' => ['SMS kodi topilmadi yoki allaqachon ishlatilgan.']
            ]);
        }

        if ($smsCode->code != $code) {
            throw ValidationException::withMessages([
                'code' => ['Kiritilgan SMS kodi noto‘g‘ri.']
            ]);
        }

        if (Carbon::parse($smsCode->sent_at)->addMinutes(2)->isPast()) {
            throw ValidationException::withMessages([
                'code' => ['SMS kodi muddati tugagan.']
            ]);
        }

        $smsCode->update(['status' => false]);
    }
}
