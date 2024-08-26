<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProtocolConfirmRequest;
use App\Http\Requests\ProtocolEditRequest;
use App\Http\Requests\ProtocolRejectRequest;
use App\Http\Requests\ProtocolRequest;
use App\Http\Resources\ProtocolLogResource;
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
            $protocolId = request('id');
            $user = Auth::user();
            if ($protocolId) {
                $protocol = Protocol::query()->findOrFail($protocolId);
                return $this->sendSuccess(new ProtocolResource($protocol), 'Protocol retrieved successfully.');
            }

            $protocols = Protocol::query()
                ->when($user->isInspector(), function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
                ->when($user->isRegionalInspection(), function ($query) use ($user) {
                    return $query->where('region_id', $user->region_id);
                })
            ->when(request('status'), function ($query)  {
                return $query->where('protocol_status_id', request('status'));
            })
            ->when(request('search_protocol_number'), function ($query)  {
                $query->searchByNumber(request('search_protocol_number'));
            })
            ->when(request('search_violator_pinfl'), function ($query)  {
                $query->searchByPinfl(request('search_violator_pinfl'));
            })
            ->when(request('search_status'), function ($query)  {
                $query->searchByStatus(request('search_status'));
            });


            $data = $protocols->paginate(request('per_page', 10));

            if ($data->isEmpty()) {
                return $this->sendSuccess([],"Protocols not found.");
            }

            return $this->sendSuccess(ProtocolResource::collection($data), 'Protocols retrieved successfully.', pagination($data));

        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function create(ProtocolRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $protocol = Protocol::query()->create($request->except('images'));
            if ($request->hasFile('images')) {
                $this->storeImages($protocol, $request->file('images'));
            }
            $protocol->logs()->create([
                'user_id' => Auth::id(),
                'protocol_id' => $protocol->id,
                'protocol_status_id' => $request->protocol_status_id,
            ]);
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
            $protocol = Protocol::query()->findOrFail($request->protocol_id);
            $protocol->update($request->only([
                'protocol_status_id',
                'rejected_at',
                'rejected_by',
                'rejected_comment'
            ]));

            $protocol->logs()->create([
                'user_id' => Auth::id(),
                'protocol_id' => $protocol->id,
                'protocol_status_id' => $request->protocol_status_id,
                'comment' => $request->rejected_comment
            ]);
            return $this->sendSuccess(ProtocolResource::make($protocol), 'Protocol rejected successfully.');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function confirm(): JsonResponse
    {
        try {
            $protocol = Protocol::query()->findOrFail(request('protocol_id'));
            $protocol->update([
                'protocol_status_id' => ProtocolStatusEnum::ACCEPTED->value,
                'accepted_at' => now(),
            ]);

            $protocol->logs()->create([
                'user_id' => Auth::id(),
                'protocol_id' => $protocol->id,
                'protocol_status_id' => ProtocolStatusEnum::ACCEPTED->value,
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
            $protocol = Protocol::query()->findOrFail($request->protocol_id);

            $protocol->update($request->only([
                'region_id', 'district_id', 'protocol_status_id', 'address', 'long', 'lat',
                'object_name', 'violation_id', 'repression_id', 'amount', 'fixed_date',
                'user_id', 'user_position', 'violator_type_id', 'violator_pinfl', 'violator_name',
                'violator_phone', 'assignee_name', 'inspector_name', 'comment'
            ]));

            if ($request->hasFile('images')) {
                $protocol->images()->delete();
                $this->storeImages($protocol, $request->file('images'));
            }

            $protocol->logs()->create([
                'user_id' => Auth::id(),
                'protocol_id' => $protocol->id,
                'protocol_status_id' => $request->protocol_status_id,
            ]);

            DB::commit();
            return $this->sendSuccess([], 'Protokol muvaffaqiyatli yangilandi.');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendError($exception->getMessage());
        }
    }

    public function logs(): JsonResponse
    {
        try {
            $protocol = Protocol::query()->findOrFail(request('protocol_id'));
            return $this->sendSuccess(ProtocolLogResource::collection($protocol->logs), 'Protocol logs retrieved successfully.');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }

    private function storeImages(Protocol $protocol, $images)
    {
        foreach ($images as $image) {
            $imagePath = $image->store('protocols', 'public');
            $protocol->images()->create(['url' => $imagePath]);
        }
    }
}
