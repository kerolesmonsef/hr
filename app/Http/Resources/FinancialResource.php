<?php

namespace App\Http\Resources;
use App\Models\Salary_setting;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialResource extends JsonResource
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
            'employee_salary'      => $this->salary,
            'payment_type'         => $this->payment_type,
            'insurance_number'     => $this->insurance_number,
            'policy_number'        => $this->policy_number,
            'insurance_startdate'  => $this->insurance_startdate,
            'cost'                 => $this->cost,
        ];
    }
}
