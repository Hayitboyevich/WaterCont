<?php

namespace App\Traits;

use App\Models\Protocol;

trait ProtocolTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($protocol) {
            $lastProtocol = Protocol::query()->orderBy('protocol_number', 'desc')->first();
            $lastNumber = $lastProtocol ? $lastProtocol->protocol_number : 99999;

            $protocol->protocol_number = $lastNumber + 1;
        });
    }

    public function scopeSearchByNumber($query, $searchTerm)
    {
        return $query->where('protocol_number', 'like', '%' . $searchTerm . '%');
    }
    public function scopeSearchByPinfl($query, $searchTerm)
    {
        return $query->where('violator_pinfl', 'like', '%' . $searchTerm . '%');
    }

    public function scopeSearchByStatus($query, $searchTerm)
    {
        return $query->where('protocol_status_id', $searchTerm);
    }

}
