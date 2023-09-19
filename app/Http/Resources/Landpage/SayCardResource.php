<?php

namespace App\Http\Resources\Landpage;

use Illuminate\Http\Resources\Json\JsonResource;

class SayCardResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => url('storage/' . $this->image),
            'date' => date('d F Y', strtotime($this->created_at)),
        ];
    }
}
