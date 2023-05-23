<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Hotel extends JsonResource
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
            'tenphong' => $this->name,
            'diachi' => $this->address,
            'dienthoai' => $this->phone,
            'image' => $this->image,
            'email' => $this->email,
            'starnumber' => $this->star_number,
            'description' => $this->description,
            'service' => $this->services,
            'images' => $this->images,
            'rooms' => $this->rooms,
            'typerooms' => $this->typerooms,
                
        ];
    }
}
