<?php

namespace App\Http\Resources\Landpage;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutCardResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => url('storage/' . $this->image),
        ];
    }
}
