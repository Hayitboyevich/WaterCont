<?php

namespace App\Services;


use App\Models\SmsMessage;
use Illuminate\Support\Facades\Http;

class SendMessage
{
    public function __construct( protected ?int $phone , protected string $message){}
    public function sendSms()
    {
//        dd(config('services.sms_provider.login'), config('services.sms_provider.password'), config('services.sms_provider.nickname'));
        $data = [
            'login' => config('services.sms_provider.login'),
            'password' => config('services.sms_provider.password'),
            'nickname' => config('services.sms_provider.nickname'),
            'data' => json_encode([[
                'phone' => $this->phone,
                'text' => $this->message
            ]])
        ];

        $url = config('services.sms_provider.url');
        $response = Http::post($url, $data);
        if ($response->failed())
        {
            throw new \Exception('Server Error');
        }

        return $response->successful();
    }

}
