<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManagerAttendanceResource extends JsonResource
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
            'employee'        => $this->employee ? $this->employee->name : 'N/A',
            'date'            => $this['date'],
            'activity_status' => 0,
            'title'           => 'Attended',
            'time_in'         => $this['clock_in'],
            'time_out'        => $this['clock_out'],
            'description'     => $this['delay_reason'],
        ];
    }

}
