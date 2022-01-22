<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'type' => $this->type,
            'availability' => $this->availability,
            'needing_repair' => $this->needing_repair,
            'durability' => $this->durability,
            'max_durability' => $this->max_durability,
            'mileage' => $this->mileage,
            'price' => $this->price,
            'minimum_rent_period' => $this->minimum_rent_period
        ];
    }
}
