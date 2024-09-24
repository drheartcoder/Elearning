<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
   protected $table = "notifications"; 
   protected $fillable = [
   					'from_user_id',
   					'to_user_id',
   					'message',
   					'url',
   					'is_read',
   					'type'
   			   ];
}
