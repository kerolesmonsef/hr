<?php

namespace App\Http\Resources;

use App\Models\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Offer
 */


class OfferResource extends JsonResource
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
        $arr['promocode_is_url'] = is_url($this->promocode);
        return $arr;

    }
}
