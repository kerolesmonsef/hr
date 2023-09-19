<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskActivityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //    return parent::toArray($request);

        $data =  array_merge(parent::toArray($request), [
            'employee_id'          =>  $this->employee_id,
            'employee_name'        =>  $this->user->employee ? $this->user->employee->name :  $this->user->name,
            'comment_text'         =>   $this->user->employee ? $this->user->employee->name :  $this->user->name .  __(' added this card to ')  . __('task_status_' . $this->description)
        ]);
        unset($data['user']);
        return $data;
    }
}
