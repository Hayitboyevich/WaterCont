<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UserService
{
    public function getToken()
    {
        $result = Http::withHeaders([
            'Authorization' => config('app.egov.token')
        ])
            ->timeout(15)
            ->post("https://apimgw.egov.uz:9444/oauth2/token?grant_type=password&username=" . config('app.egov.username') . "&password=" . config('app.egov.password'))
            ->json();
        return $result["access_token"];
    }

    public function getProfile(int $pinfl)
    {
        try {
            $token = self::getToken();
            $position = Http::withToken($token)
                ->timeout(15)
                ->post("https://apimgw.egov.uz:8243/labour/service/citizen/current/v1", [
                    'pin' => $pinfl
                ]);
            return $position->json();
        } catch (\Exception $exception) {
            return null;
        }
    }
}
