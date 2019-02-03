<?php

namespace App\Http\Resources\v1;

use App\State;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class User extends JsonResource
{
    public $token;

    public function __construct($resource , $token)
    {
        $this->token = $token;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $state = DB::table('states')
            ->where('user_id','=',$this->id)->first();

        $city= DB::table('cities')
            ->where('state_id','=',$state->id)->first();

        return [
            'id' => $this->id,
            'firstname' => $this->firstname ,
            'lastname' => $this->lastname ,
            'mobile' => $this->mobile ,
            'latitude' => $this->latitude ,
            'longitude' => $this->longitude ,
            'credit' => $this->credit ,
            'is_seller' => $this->is_seller ,
            'avatar' => $this->avatar ,
            'isBan' => $this->isBan ,
            'address' => $this->address ,
            'state' => $state->name,
            'city' =>$city->name,
            'password' => $this->password ,
            'api_token' => $this->token ,
        ];
//        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }

}
