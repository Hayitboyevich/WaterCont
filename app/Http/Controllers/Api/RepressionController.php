<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RepressionResource;
use App\Models\Repression;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class RepressionController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            if (\request('id'))
            {
                $type = Repression::query()->findOrFail(\request('id'));
                return $this->sendSuccess(RepressionResource::make($type), 'Repression  retrieved successfully.');
            }
            $types = Repression::query()
                ->when(request('type'), function ($query) {
                $query->where('protocol_type_id', request('type'));
            })->get();
            return $this->sendSuccess(RepressionResource::collection($types), 'Repressions  retrieved successfully.');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
}
