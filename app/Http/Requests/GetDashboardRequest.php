<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetDashboardRequest extends FormRequest {
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
            'school_uuid' => 'nullable|uuid|exists:App\Models\School,uuid',
            'start' => 'required|date|before:stop',
            'stop' => 'required|date|after:start',
        ];
    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
