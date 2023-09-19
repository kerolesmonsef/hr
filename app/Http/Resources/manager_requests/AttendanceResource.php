<?php

namespace App\Http\Resources\manager_requests;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return [
            'name'=>app()->isLocale('en')?$this->employee->name:$this->employee->name_ar,
            'date'=>$this->date,
            'clock_in'=>$this->clock_in,
            'clock_out'=>$this->clock_out,
            'status'=>$this->status,
       ];
    }
}
