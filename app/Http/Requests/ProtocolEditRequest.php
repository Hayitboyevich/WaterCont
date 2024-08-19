<?php

namespace App\Http\Requests;

use App\Models\Enums\ProtocolStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProtocolEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'protocol_id' => 'required|integer|exists:protocols,id',
            'region_id' => 'sometimes|exists:regions,id',
            'district_id' => 'sometimes|exists:districts,id',
            'protocol_status_id' => 'sometimes|exists:protocol_statuses,id',
            'address' => 'sometimes|string',
            'long' => 'sometimes|numeric',
            'lat' => 'sometimes|numeric',
            'object_name' => 'sometimes|string',
            'violation_id' => 'sometimes|exists:violations,id',
            'repression_id' => 'sometimes|exists:repressions,id',
            'amount' => 'sometimes|numeric',
            'fixed_date' => 'sometimes|date',
            'user_id' => 'sometimes|exists:users,id',
            'user_position' => 'sometimes|string',
            'violator_type_id' => 'sometimes|exists:violator_types,id',
            'violator_pinfl' => 'sometimes|integer|digits:14',
            'violator_name' => 'sometimes|string',
            'violator_phone' => 'sometimes|regex:/^998\d{9}$/',
            'assignee_name' => 'sometimes|string',
            'inspector_name' => 'sometimes|string',
            'comment' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'protocol_status_id' => ProtocolStatusEnum::RETURNED->value,
        ]);
    }
}
