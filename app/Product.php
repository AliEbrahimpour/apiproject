<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'Seller_id' ,'icon', 'product_name' , 'product_secription' , 'price' ,
        'discount' , 'privilege' , 'buying_count' , 'inventory'  , 'pake_price'
    ];
}
