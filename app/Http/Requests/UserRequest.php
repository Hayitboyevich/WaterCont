<?php

namespace App\Http\Requests;

use App\Models\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isManager();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|regex:/^998\d{9}$/|unique:users,phone',
            'position' => 'required|string|max:255',
            'pinfl' => 'required|integer|digits:14|unique:users,pinfl',
            'role_id' => 'required|integer|exists:roles,id',
            'region_id' => 'required|integer|exists:regions,id',
        ];

        if ($this->input('role_id') == RoleEnum::OPERATOR->value) {
            $rules['region_id'] = 'nullable|integer|exists:regions,id';
        }

        return $rules;

    }
}
