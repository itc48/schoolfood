<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardPositiveNegativeSchools extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'labels' => [
                'schools',
                'uuid',
                'negative',
                'positive',
                'count'
            ],
            'data' => parent::toArray($request)
        ];
    }
}
