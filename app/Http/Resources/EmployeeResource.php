<?php

namespace App\Http\Resources;

use App\Models\Attendance;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'name_ar' => $this->name_ar,
            'is_active' => $this->is_active,
            'type' => $this->user->type,
            'job' => $this->jobtitle?->name,
            'avatar' => $this->user?->avatar_image,
            'profile' => $this->login_image ? asset('storage/' . $this->login_image) : null,
            'created_at' => $this->created_at,
            'last_login_at' => '',
            'is_manger' => $this->isManager(),
            'is_active_notification'=>$this->on_off_notification
        ];

    }
}
