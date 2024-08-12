<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            if (request('id')) {
                $role = Role::query()->findOrFail(request('id'));
                return $this->sendSuccess(RoleResource::make($role), 'Role retrieved successfully.');
            }
            $roles = Role::all();
            return $this->sendSuccess(RoleResource::collection($roles), 'Roles retrieved successfully.');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }
}
