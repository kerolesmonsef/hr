<?php

namespace App\Http\Resources\manager_requests;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>app()->isLocale('en')?$this->employee->name:$this->employee->name_ar,
            'date'=>$this->date,
            'reason'=>$this->reason,
            'start'=>$this->start,
            'end'=>$this->end,
       ];
    }
}
