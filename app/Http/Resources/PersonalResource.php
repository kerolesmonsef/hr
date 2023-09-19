<?php

namespace App\Http\Resources;
use App\Models\Salary_setting;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalResource extends JsonResource
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
        $religion_arr = [
            '1' => __('Muslim'),
            '2' => __('Christian'),
            '0' => __('Other')
        ];
        $social_status=[
            '1' => __('Married'),
            '2' => __('Single'),
        ];
        return [
            'employee_id'          => $this->id,
            'employee_code'        => auth()->user()->employeeIdFormat($this->employee_id),
            'employee_name'        => $this->name,
            'nationality'          => $this->nationality ? $this->nationality['name'.$locale] : null,
            'email'                => $this->email,
            'phone'                => $this->phone,
            'gender'               => $this->gender,
            'social_status'        => $religion_arr [$this->social_status],
            'religion'             => $social_status [$this->religion],
            'dob'                  => $this->dob,
            'department'           => $this->department ? $this->department['name'.$locale] : null,
            'designation'          => $this->designation ? $this->designation['name'.$locale] : null,
            'address'              => $this->address,
            'qualification'        => $this->qualification != null ?  $this->qualification->degree : null,
        ];
    }
}
