<?php

namespace App\Http\Resources;

use App\Models\Organization;
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
            'user' => $this->user ?  UserResource::make($this->user) : null,
            'user_position' => $this->user_position,
            'violator_type' => ViolatorTypeResource::make($this->violatorType),
            'violator_pinfl' => $this->violator_pinfl,
            'violator_name' => $this->violator_name,
            'violator_phone' => $this->violator_phone,
            'violator_address' => $this->violator_address,
            'assignee_name' => $this->assignee_name,
            'inspector_name' => $this->inspector_name,
            'wells' => WellResource::collection($this->wells),
            'protocol_type' => ProtocolTypeResource::make($this->protocolType),
            'crash_diameter' => $this->crash_diameter,
            'crash_hour' => $this->crash_hour,
            'crash_participants_count' => $this->crash_participants_count,
            'crash_technic_count' => $this->crash_technic_count,
            'consumer' => ConsumerResource::make($this->consumer),
            'building_type' => BuildingTypeResource::make($this->buildingType),
            'organization' => OrganizationResource::make($this->organization),
            'measure' => MeasureResource::make($this->measure),
            'standart_norm' => StandartNormResource::make($this->standartNorm),
            'laboratory_report' => $this->laboratory_report,
            'laboratory_report_indicator' => $this->laboratory_report_indicator,
            'technical_specifications' => $this->technical_specifications,
            'billing' => $this->billing,
            'contract_information' => $this->contract_information,
            'contract_requirements' => $this->contract_requirements,
            'billing_subscriber' => $this->billing_subscriber,
            'technical_requirements' => $this->technical_requirements,
            'comment' => $this->comment,
            'rejected_comment' => $this->rejected_comment,
            'rejected_by' => $this->rejected_by,
            'rejected_at' => $this->rejected_at,
            'accepted_at' => $this->accepted_at,
            'created_at' =>  $this->created_at->timezone('Asia/Tashkent')->toDateTimeString(),
            'images' => ImageResource::collection($this->images),
        ];
    }
}
