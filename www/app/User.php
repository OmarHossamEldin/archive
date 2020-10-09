<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $guarded=[];

    protected $hidden = [
        'password'
    ];
    
   
}
