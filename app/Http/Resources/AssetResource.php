<?php

namespace App\Http\Resources;
use App\Models\Salary_setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return  parent::toArray([]);
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'purchase_date'   => $this->purchase_date,
            'supported_date'  => $this->supported_date,
            'amount'          => $this->amount,
            'description'     => $this->description,
            'serial_number'   => $this->serial_number,
            'status'          => $this->status,
            'type'            => $this->type
        ];
    }
}
