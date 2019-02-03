<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreparingProduct extends Model
{
    protected $fillable=[
        'product_id' , 'preparing_id'
    ];
}
