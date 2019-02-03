<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable=[
        'user_id' , 'certificate' , 'meli_cart' , 'meli_num' , 'bank_id' ,
        'bank_cart_num' , 'shaba_num' , 'shop_name' , 'income'  , 'state_id' , 'city_id'
    ];


}
