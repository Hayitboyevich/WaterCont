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
            'long' => 'required|numeric',
            'lat' => 'required|numeric',
            'object_name' => 'required|string',
            'address' => 'required|string',
            'violation_id' => 'required|exists:violations,id',
            'repression_id' => 'required|exists:repressions,id',
            'amount' => 'required|numeric',
            'fixed_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'user_position' => 'required|string',
            'violator_type_id' => 'required|exists:violator_types,id',
            'violator_pinfl' => [
                'sometimes',
                'integer',
                function ($attribute, $value, $fail) {
                    $length = strlen($value);
                    if (!in_array($length, [9, 14])) {
                        $fail("The $attribute must be 9 or 14 digits.");
                    }
                },
            ],
            'violator_name' => 'required|string',
            'violator_phone' => 'required|regex:/^998\d{9}$/',
            'violator_address' => 'required|string',
            'assignee_name' => 'sometimes|string',
            'inspector_name' => 'sometimes|string',
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
