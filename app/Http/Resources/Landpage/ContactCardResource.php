<?php

namespace App\Http\Resources\Landpage;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'value' => $this->title,
            'image' => url('storage/' . $this->image),
        ];
    }
}
