<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string',
            'role_id' => 'int|exists:App\Models\UserRole,id',
            'district_id' => 'nullable|int|exists:App\Models\District,id',
            'school_uuid' => 'nullable|string|exists:App\Models\School,uuid',
        ];
    }
}
