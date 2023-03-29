<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardDateValue extends JsonResource
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
                'values'
            ],
            'data' => parent::toArray($request)
        ];
    }
}
