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
            'address' => 'required|string',
            'long' => 'required|numeric',
            'lat' => 'required|numeric',
            'object_name' => 'required|string',
            'violation_id' => 'required|exists:violations,id',
            'repression_id' => 'required|exists:repressions,id',
            'amount' => 'required|numeric',
            'fixed_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'user_position' => 'required|string',
            'violator_type_id' => 'required|exists:violator_types,id',
            'violator_pinfl' => 'required|integer|digits:14',
            'violator_name' => 'required|string',
            'violator_phone' => 'required|regex:/^998\d{9}$/',
            'assignee_name' => 'required|string',
            'inspector_name' => 'required|string',
            'comment' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'protocol_status_id' => ProtocolStatusEnum::NEW->value,
        ]);
    }
}
