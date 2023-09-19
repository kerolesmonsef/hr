<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return array_merge(parent::toArray($request), [
            'employees' => EmployeeResource::collection($this->employees),
            'created_by'    =>  $this->creator->employee ?  $this->creator->employee->name  :  $this->creator->name ,
            // 'activity_logs' => TaskActivityLogResource::collection($this->activityLogs)
        ]);
    }
}
