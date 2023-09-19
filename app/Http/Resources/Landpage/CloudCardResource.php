<?php

namespace App\Http\Resources\Landpage;

use Illuminate\Http\Resources\Json\JsonResource;

class CloudCardResource extends JsonResource
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
            'number' => $this->number,
            'description' => $this->description,
            'image' => url('storage/' . $this->image),
        ];
    }
}
