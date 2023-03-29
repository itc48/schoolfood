<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSchoolRequest extends FormRequest {
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
            'title' => 'required|string|between:3,255|unique:App\Models\School,title',
            'address' => 'required|string|between:3,255',
            'district_id' => 'nullable|int|exists:App\Models\District,id',
            'latitude' => 'nullable|string|max:9',
            'longitude' => 'nullable|string|max:9',

            'name' => 'nullable|string|unique:App\Models\User,name',
            'password' => 'nullable|required_with:name|string',
        ];
    }
}
