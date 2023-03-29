<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest {
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
            'title' => 'required|string|between:3,255',
            'address' => 'required|string|between:3,255',
            'district_id' => 'nullable|int|exists:App\Models\District,id',
            'latitude' => 'nullable|string|size:9',
            'longitude' => 'nullable|string|size:9',
        ];
    }
}
