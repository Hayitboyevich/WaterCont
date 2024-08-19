<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProtocolConfirmRequest;
use App\Http\Requests\ProtocolEditRequest;
use App\Http\Requests\ProtocolRejectRequest;
use App\Http\Requests\ProtocolRequest;
use App\Http\Resources\ProtocolResource;
use App\Models\Enums\ProtocolStatusEnum;
use App\Models\Protocol;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProtocolController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            if (\request('id')) {
                $protocol = Protocol::query()->findOrFail(request('id'));
                return $this->sendSuccess(ProtocolResource::make($protocol), 'Protocol retrieved successfully.');
            }

            $protocols = Protocol::all();
            return $this->sendSuccess(ProtocolResource::collection($protocols), 'Protocols retrieved successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function create(ProtocolRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $protocolData = $request->except('images');
            $protocol = Protocol::query()->create($protocolData);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('protocols', 'public');
                    $protocol->images()->create([
                        'url' => $imagePath,
                    ]);
                }
            }
            DB::commit();

            return $this->sendSuccess(ProtocolResource::make($protocol), 'Protocol created successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendError($exception->getMessage());
        }
    }

    public function reject(ProtocolRejectRequest $request): JsonResponse
    {
        try {
            $protocol = Protocol::query()->findOrFail($request->protocol_id)
                ->update([
                    'protocol_status_id' => $request->protocol_status_id,
                    'rejected_at' => $request->rejected_at,
                    'rejected_by' => $request->rejected_by,
                    'rejected_comment' => $request->rejected_comment
                ]);
            return $this->sendSuccess(ProtocolResource::make($protocol), 'Protocol rejected successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function confirm(): JsonResponse
    {
        try {
            $protocol = Protocol::query()
                ->findOrFail(request('protocol_id'))
                ->update([
                    'protocol_status_id' => ProtocolStatusEnum::ACCEPTED->value,
                    'accepted_at' => Carbon::now()
                ]);

            return $this->sendSuccess(ProtocolResource::make($protocol), 'Protocol confirmed successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function edit(ProtocolEditRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            Protocol::query()
                ->findOrFail($request->protocol_id)
                ->update($request->only([
                    'region_id',
                    'district_id',
                    'protocol_status_id',
                    'address',
                    'long',
                    'lat',
                    'object_name',
                    'violation_id',
                    'repression_id',
                    'amount',
                    'fixed_date',
                    'user_id',
                    'user_position',
                    'violator_type_id',
                    'violator_pinfl',
                    'violator_name',
                    'violator_phone',
                    'assignee_name',
                    'inspector_name',
                    'comment'
                ]));

            $protocol = Protocol::query()->find($request->protocol_id);

            if ($request->hasFile('images')) {
                $protocol->images()->delete();
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('protocols', 'public');
                    $protocol->images()->create([
                        'url' => $imagePath,
                    ]);
                }
            }

            $protocol->log()->create([
                'user_id' => Auth::id(),
                'protocol_id' => $protocol->id,
                'protocol_status_id' => $request->protocol_status_id
            ]);

            DB::commit();
            return $this->sendSuccess([], 'Protokol muvaffaqiyatli yangilandi.');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendError($exception->getMessage());
        }
    }
}
