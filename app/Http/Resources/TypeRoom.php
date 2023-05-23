<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeRoom extends JsonResource
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
            'categoryName' => $this->name,
            'price' => $this->price,
            'area' => $this->area,
            'numberOfPeople' => $this->number_of_people,
            'numberOfBed' => $this->number_of_bed,
            'rooms' => $this->rooms,

        ];
    }
}
