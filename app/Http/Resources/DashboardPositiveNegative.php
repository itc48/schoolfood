<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardPositiveNegative extends JsonResource
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
                'dates',
                'negative',
                'positive',
                'count'
            ],
            'data' => parent::toArray($request)
        ];
    }
}
