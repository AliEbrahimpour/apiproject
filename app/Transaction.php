<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
        'user_id' , 'preparing_id' , 'amount' , 'type'
    ];
}
