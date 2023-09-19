<?php

namespace App\Http\Resources\Landpage;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => url('storage/' . $this->image),
            'metaTitle' => $this->metaTitle,
            'metaDescription' => $this->metaDescription,
            'metaKey' => $this->metaKey,
            'metaTag' => $this->metaTag,
            'date' => date('d F Y', strtotime($this->created_at)),
        ];
    }
}
