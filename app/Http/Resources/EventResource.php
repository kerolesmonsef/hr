<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class EventResource extends JsonResource
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
            'id'             => $this['id'],
            "title"          => $this['title'],
            "start_date"     => $this['start_date'],
            "end_date"       => $this['end_date'],
            "start_time"     => $this['start_time'],
            "end_time"       => $this['end_date'],
            'duration'       => $this['start_date'] .' '. $this['start_time'] . ' - '. $this['end_date'] .' '. $this['end_time'],
            "lectures"       => $this['lectures'],
            'location'       => $this['location'],
            'about'          => $this['about'],
            'users_join'    =>  $this->employees->take(3)->map(function($employee){
                return [
                    'avatar' => $employee->user?->avatar_image,
                ];
            }),
            'total_users_join'  =>  $this->employees->count(),
            'is_joined' => $this->employees->contains(auth()->user()->employee->id) ? 1 : 0,
            'photo' => $this->photo_path,
        ];
    }
}
