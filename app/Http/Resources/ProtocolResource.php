<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProtocolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'protocol_name' => $this->protocol_name,
            'protocol_number' => $this->protocol_number,
            'region' => RegionResource::make($this->region),
            'district' => DistrictResource::make($this->district),
            'protocol_status' => ProtocolStatusResource::make($this->status),
            'address' => $this->address,
            'long' => $this->long,
            'lat' => $this->lat,
            'object_name' => $this->object_name,
            'violation' => ViolationResource::make($this->violation),
            'repression' => RepressionResource::make($this->repression),
            'amount' => $this->amount,
            'fixed_date' => $this->fixed_date,
            'user' => UserResource::make($this->user),
            'user_position' => $this->user_position,
            'violator_type' => ViolatorTypeResource::make($this->violatorType),
            'violator_pinfl' => $this->violator_pinfl,
            'violator_name' => $this->violator_name,
            'violator_phone' => $this->violator_phone,
            'assignee_name' => $this->assignee_name,
            'inspector_name' => $this->inspector_name,
            'comment' => $this->comment,
            'rejected_comment' => $this->rejected_comment,
            'rejected_by' => $this->rejected_by,
            'rejected_at' => $this->rejected_at,
            'accepted_at' => $this->accepted_at,
            'created_at' => $this->created_at,
            'images' => ImageResource::collection($this->images),
        ];
    }
}
