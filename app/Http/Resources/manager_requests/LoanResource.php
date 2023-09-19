<?php

namespace App\Http\Resources\manager_requests;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'amount'=>$this->amount,
            'reason'=>$this->reason,
            'title'=>$this->loan_option_item->name,
       ];
    }
}
