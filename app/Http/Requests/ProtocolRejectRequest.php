<?php

namespace App\Http\Requests;

use App\Models\Enums\ProtocolStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProtocolRejectRequest extends FormRequest
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
            'protocol_id' => "required|exists:protocols,id",
            'rejected_at' => "required|date",
            'rejected_by' => "required|exists:users,id",
            'rejected_comment' => "required|string",
            'protocol_status_id' => "required|exists:protocol_statuses,id",
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'protocol_status_id' => ProtocolStatusEnum::REJECTED->value,
            'rejected_at' => now(),
            'rejected_by' => Auth::id()
        ]);
    }
}
