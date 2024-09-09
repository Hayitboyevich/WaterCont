<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProtocolLogResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'protocol_id' => $this->protocol_id,
            'status' => ProtocolStatusResource::make($this->status),
            'comment' => $this->comment,
            'changed_at' => $this->changed_at

        ];
    }
}
