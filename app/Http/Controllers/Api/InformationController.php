<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CounterInfoResource;
use App\Http\Resources\DebitResource;
use App\Http\Resources\ProtocolTypeResource;
use App\Http\Resources\SMZResource;
use App\Http\Resources\WellStatusResource;
use App\Models\CounterInfo;
use App\Models\Debit;
use App\Models\ProtocolType;
use App\Models\SMZ;
use App\Models\WellStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class InformationController extends BaseController
{
    public function getWellStatus(): JsonResponse
    {
        return $this->sendSuccess(WellStatusResource::collection(WellStatus::all()), 'Well Status');
    }

    public function getCounterInfo(): JsonResponse
    {
        return $this->sendSuccess(CounterInfoResource::collection(CounterInfo::all()), 'Counter Info');
    }
    public function getProtocolType(): JsonResponse
    {
        return $this->sendSuccess(ProtocolTypeResource::collection(ProtocolType::all()), 'Protocol Type');
    }

    public function getSMZ(): JsonResponse
    {
        return $this->sendSuccess(SMZResource::collection(SMZ::all()), 'SMZ');
    }

    public function getDebit(): JsonResponse
    {
        return $this->sendSuccess(DebitResource::collection(Debit::all()), 'Debit');
    }
}
