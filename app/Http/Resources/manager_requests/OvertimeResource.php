<?php

namespace App\Http\Resources\manager_requests;

use Illuminate\Http\Resources\Json\JsonResource;

class OvertimeResource extends JsonResource
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
            'start'=>$this->from,
            'end'=>$this->to,
            'date'=>$this->date,
            'reason'=>$this->reason,
       ];
    }
}
