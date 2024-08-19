<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ViolatorTypeResource;
use App\Models\ViolatorType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ViolatorTypeController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            if (\request('id'))
            {
                $type = ViolatorType::query()->findOrFail(\request('id'));
                return $this->sendSuccess(ViolatorTypeResource::make($type), 'Violator type retrieved successfully.');
            }
            $types = ViolatorType::all();
            return $this->sendSuccess(ViolatorTypeResource::collection($types), 'Violator types retrieved successfully.');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
}
