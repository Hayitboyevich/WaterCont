<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ViolationResource;
use App\Models\Violation;
use Illuminate\Http\JsonResponse;

class ViolationController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            if (\request('id'))
            {
                $type = Violation::query()->findOrFail(\request('id'));
                return $this->sendSuccess(ViolationResource::make($type), 'Violation retrieved successfully.');
            }
            $types = Violation::all();
            return $this->sendSuccess(ViolationResource::collection($types), 'Violations retrieved successfully.');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
}
