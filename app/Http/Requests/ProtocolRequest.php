<?php

namespace App\Http\Requests;

use App\Models\Enums\ProtocolStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProtocolRequest extends FormRequest
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
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
            'protocol_status_id' => 'required|exists:protocol_statuses,id',
            'protocol_type_id' => 'required|exists:protocol_types,id',
            'long' => 'sometimes|nullable|numeric',
            'lat' => 'sometimes|nullable|numeric',
            'object_name' => 'required_if:protocol_type_id,1|nullable|string',
            'address' => 'sometimes|nullable|string',
            'violation_id' => 'required_if:protocol_type_id,1|nullable|exists:violations,id',
            'repression_id' => 'required_if:protocol_type_id,1|nullable|exists:repressions,id',
            'amount' => 'required_if:protocol_type_id,1|nullable|numeric',
            'fixed_date' => 'required_if:protocol_type_id,1|date',
            'user_id' => 'sometimes|nullable|exists:users,id',
            'user_position' => 'sometimes|nullable|string',
            'violator_type_id' => 'sometimes|nullable|exists:violator_types,id',
            'violator_pinfl' => [
                'sometimes',
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $length = strlen($value);
                    if (!in_array($length, [9, 14])) {
                        $fail("The $attribute must be 9 or 14 digits.");
                    }
                },
            ],
            'violator_name' => 'sometimes|nullable|string',
            'violator_phone' => 'sometimes|nullable|regex:/^998\d{9}$/',
            'violator_address' => 'sometimes|nullable|string',
            'assignee_name' => 'sometimes|nullable|string',
            'inspector_name' => 'sometimes|nullable|string',
            'comment' => 'sometimes|nullable|string',
            'crash_diameter' => 'sometimes|nullable|string',
            'crash_hour' => 'sometimes|nullable|string',
            'crash_participants_count' => 'sometimes|nullable|string',
            'crash_technic_count' => 'sometimes|nullable|string',
            'images.*' => 'sometimes|array',
            'wells' => 'sometimes|array',
            'consumer_id' => 'required_if:protocol_type_id,4|exists:consumers,id',
            'building_type_id' => 'required_if:protocol_type_id,4|exists:building_types,id',
            'organization_id' => 'required_if:protocol_type_id,4|exists:organizations,id',
            'measure_id' => 'required_if:protocol_type_id,4|exists:measures,id',
            'standart_norm_id' => 'required_if:protocol_type_id,4|exists:standart_norms,id',
            'laboratory_report_indicator' => 'required_if:protocol_type_id,4|string',
            'laboratory_report' => 'required_if:protocol_type_id,4|in:true,false,1,0',
            'technical_specifications' => 'sometimes|nullable|in:true,false,1,0',
            'billing' => 'sometimes|nullable|in:true,false,1,0',
            'contract_information' => 'sometimes|nullable|in:true,false,1,0',
            'contract_requirements' => 'sometimes|nullable|in:true,false,1,0',
            'billing_subscriber' => 'sometimes|nullable|in:true,false,1,0',
            'technical_requirements' => 'sometimes|nullable|in:true,false,1,0',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'protocol_status_id' => ProtocolStatusEnum::NEW->value,
        ]);
    }
}
