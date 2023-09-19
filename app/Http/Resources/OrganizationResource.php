<?php

namespace App\Http\Resources;
use App\Models\Salary_setting;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $locale   = $request->header('Accept-Language') == 'ar' ? '_ar' : '';
        return [
            'jobtitle'=> $this->jobtitle['name'.$locale],
            'jobtype'=> $this->jobtype['name'.$locale],
            'join_data'=> $this->Join_date_gregorian,
            'branch'=> $this->branch['name'.$locale],
            'direct_manager'=> $this->directManager != null ? $this->directManager['name'.$locale] : null,
            'shift'=> $this->shifts != null ? $this->shifts['name'.$locale]: null,
            'department' =>$this->department != null ? $this->department['name'.$locale] : null,
            'id' => auth()->user()->employeeIdFormat($this->id),
            'email'=>$this->email,
            'permissions' => $this->permissions->count() . ' ' . __('Permissions'),
            'leaves'=>$this->leaves->count() .' ' . __('Days'),
            'shift' => 'Marketing',

        ];
    }
}
