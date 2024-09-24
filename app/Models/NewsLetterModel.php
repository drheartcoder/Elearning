<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NewsLetterModel extends Model
{	
    protected $table = 'newsletters';
    protected $fillable = ['title','user_type','message','broadcast_date','status'];
}