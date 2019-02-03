<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivilegeAndComment extends Model
{
    protected $fillable =[
        'user_id' , 'product_id' , 'comment' , 'privilege'
    ];

}
