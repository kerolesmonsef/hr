<?php

namespace App\Http\Resources;
use App\Models\Salary_setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsResource extends JsonResource
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
            'delays-0'            => $this->getEmployeeDelays(0 , 15),
            'delays-16'           => $this->getEmployeeDelays(16 , 30),
            'delays-31'           => $this->getEmployeeDelays(31 , 60),
            'delays-61'           => $this->getEmployeeDelays(61 , null),
            'total-delays'        => $this->getEmployeeDelays(0 , 15) + $this->getEmployeeDelays(16 , 30) +$this->getEmployeeDelays(31 , 60) +$this->getEmployeeDelays(61 , null),
            'overtime-0'          => $this->getEmployeeOverTimes(0 , 15),
            'overtime-16'         => $this->getEmployeeOverTimes(16 , 30),
            'overtime-31'         => $this->getEmployeeOverTimes(31 , 60),
            'overtime-61'         => $this->getEmployeeOverTimes(61 , null),
            'total-overtime'      => $this->getEmployeeOverTimes(0 , 15) + $this->getEmployeeOverTimes(16 , 30) +$this->getEmployeeOverTimes(31 , 60) +$this->getEmployeeOverTimes(61 , null),
            'sick'                => collect(json_decode($this->absence($this->id)))->where('type','S')->count(),
            'permission'          => collect(json_decode($this->absence($this->id)))->where('type','A')->count(),
            'non-permission'      => collect(json_decode($this->absence($this->id)))->where('type','X')->count(),
            'total-absent'        => collect(json_decode($this->absence($this->id)))->whereIn('type',['S','A','X'])->count(),
            'workdays'            => $this->workdays($this->id),
            'vacations'           => collect(json_decode($this->absence($this->id)))->where('type','V')->count(),
        ];
    }
}
