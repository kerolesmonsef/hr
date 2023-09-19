<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManagerHolidayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */

    public function toArray($request)
    {
        return [
            'date'            => $this['date'],
            'activity_status' => 5,
            'title'           => 'Holiday',
            'time_in'         => null,
            'time_out'        => null,
            'description'     => $this->occasion,
        ];
    }

}
