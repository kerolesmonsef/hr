<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arr = [
            'id'            => $this->id,
            'title'         => $this['title'],
            'date'          => $this['date'],
            'date_string'   => $this->date->format('d M'),
            'time'          => $this['time'],
            'users_join'    =>  $this->employees->take(3)->map(function($employee){
                return [
                    'avatar' => $employee->user?->avatar_image,
                ];
            }),
            // 'total_users_join'  =>  $this->when( $this->employees->count() > 3,$this->employees->count() - 3),
            'total_users_join'  =>  $this->employees->count(),
            'duration' => $this->duration,
            'location'=> $this->location,
            'persons' => $this->persons,
            'about' => $this->note,
        ];

        if(auth()->user()){
            $arr['status'] = $this->current_employee?->status;
        }

        return $arr;
    }
}
