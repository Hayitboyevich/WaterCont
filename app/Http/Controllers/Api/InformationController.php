<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CounterInfoResource;
use App\Http\Resources\DebitResource;
use App\Http\Resources\ProtocolTypeResource;
use App\Http\Resources\SMZResource;
use App\Http\Resources\WellStatusResource;
use App\Models\BuildingType;
use App\Models\Consumer;
use App\Models\CounterInfo;
use App\Models\Debit;
use App\Models\Measure;
use App\Models\Organization;
use App\Models\ProtocolType;
use App\Models\SMZ;
use App\Models\StandartNorm;
use App\Models\WellStatus;
use Illuminate\Http\JsonResponse;

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

    public function getOrganizations(): JsonResponse
    {
        $organizations = Organization::query()->select('id', 'name')->get();
        return $this->sendSuccess($organizations, 'Organizations');
    }

    public function getMeasures(): JsonResponse
    {
        $measures = Measure::query()->select('id', 'name')->get();
        return $this->sendSuccess($measures, 'Measures');
    }
    public function getStandardNorms(): JsonResponse
    {
        $standardNorms = StandartNorm::query()->select('id', 'name')->get();
        return $this->sendSuccess($standardNorms, 'Standard Norm');
    }

    public function getConsumer(): JsonResponse
    {
        $consumers = Consumer::query()->select('id', 'name')->get();
        return $this->sendSuccess($consumers, 'Consumers');
    }

    public function getBuildingTypes(): JsonResponse
    {
        $types = BuildingType::query()->select('id', 'name')->get();
        return $this->sendSuccess($types, 'Building Types');
    }

}
