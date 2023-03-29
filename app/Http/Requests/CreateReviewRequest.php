<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest {
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
//            'uuid' => 'uuid|exists:App\Models\School,uuid',
            'text' => 'nullable|string|between:0,500',
//            'file' => 'nullable|image64:jpeg,jpg,png,',
            'fingerprint' => 'required|string|between:1,255',
            'score' => 'required|int|between:-1,1',
        ];
    }


}

