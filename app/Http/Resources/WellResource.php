<?php

namespace App\Http\Resources;

use App\Models\WellStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'protocol_id' => $this->id,
            'object_name' => $this->object_name,
            'well_status_id' => WellStatusResource::make($this->status),
            'technical_passport' => $this->technical_passport,
            'license' => $this->license,
            'counter_info_id' => CounterInfoResource::make($this->counterInfo),
            'chlorination_device' => $this->chlorination_device,
            'bactericidal_device' => $this->bactericidal_device,
            'other_device' => $this->other_device,
            'not_device' => $this->not_device,
            'smz_id' => SMZResource::make($this->smz),
            'debit_id' => DebitResource::make($this->debit),
            'repression_id' => RepressionResource::make($this->repression),
            'amount' => $this->amount,
            'fixed_date' => $this->fixed_date,
            'images' => null
        ];
    }
}