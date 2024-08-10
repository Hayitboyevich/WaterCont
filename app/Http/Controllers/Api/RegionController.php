<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DistrictResource;
use App\Http\Resources\RegionResource;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\JsonResponse;

class RegionController extends BaseController
{
    public function getRegions(): JsonResponse
    {
        try {
            return $this->sendSuccess(RegionResource::collection(Region::all()), 'All regions');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }

    public function getDistricts(): JsonResponse
    {
        try {
            if (request()->has('region_id')) {
                $region = Region::query()->findOrFail(request('region_id'));
                return $this->sendSuccess(DistrictResource::collection($region->districts), 'District list');
            }

            if (request()->has('district_id')) {
                $district = District::query()->findOrFail(request('district_id'));
                return $this->sendSuccess(DistrictResource::make($district), 'All regions');
            }

            return $this->sendError('No district found', 'No region found');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }
}
