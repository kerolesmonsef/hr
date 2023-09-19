<?php

namespace App\Http\Resources;

use App\Models\Employee;
use App\Models\LoanOption;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentRequestResource extends JsonResource
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
            'title' => $this->requestTitle,
            'type' => $this->type,
            'types' => ChildRequestResource::collection($this->childs),
            'loan_options' => $this->type == 'loan' ? LoanOption::where('created_by' , auth()->user()->creatorId())->get() : null,
            'replacement_employees' => $this->type == 'leave' ? EmployeeReplacementResource::collection( Employee::select('name','id','name_ar')->where('id','!=',auth()->user()->employee->id)->where('department_id' , auth()->user()->employee->department_id)->get()): [],
        ];
    }
}
