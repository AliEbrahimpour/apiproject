<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preparing extends Model
{
    protected $fillable=[
        'user_id' , 'amount' , 'for_time' , 'Paid', 'Posted' ,
        'delivery_address' , 'is_rezerv' , 'status'  , 'withPake','price_pike'
    ];
}
