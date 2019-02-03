<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class Seller extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'certificate' => url('/upload/images/seller/'.$this->certificate),
            'meli_cart' => $this->meli_cart,
            'meli_num' => $this->meli_num,
            'bank_id' => $this->bank_id,
            'bank_cart_num' => $this->bank_cart_num,
            'shaba_num' => $this->shaba_num,
            'shop_name' => $this->shop_name,
            'income' => $this->income,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'created_at' => date($this->created_at),
            'updated_at' => date($this->updated_at),
        ];
//        return parent::toArray($request);
    }
}
