<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id'         => $this->id,
            'body'       => $this['body'.$locale],
            'created_at' => date('F d, Y', strtotime($this->created_at)),
        ];
    }

}
