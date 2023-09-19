<?php

namespace App\Http\Resources;

use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin News
 */
class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr =  parent::toArray($request);

        $arr['imageUrl'] = $this->getImageUrl();
        $arr['logoUrl'] = $this->getLogoUrl();

        return $arr;
    }
}
