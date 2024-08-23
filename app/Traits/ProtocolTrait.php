<?php

namespace App\Traits;

use App\Models\Protocol;

trait ProtocolTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($protocol) {
            $lastProtocol = Protocol::orderBy('protocol_number', 'desc')->first();
            $lastNumber = $lastProtocol ? $lastProtocol->protocol_number : 99999;

            $protocol->protocol_number = $lastNumber + 1;
        });
    }
}
