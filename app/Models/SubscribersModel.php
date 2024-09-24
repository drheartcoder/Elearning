<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SubscribersModel extends Model
{
   
    protected $table = "subscribers";

    protected $fillable = ['email','status'];

    
}
