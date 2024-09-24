<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginHistoryModel extends Model
{
 	protected $table	= 'user_login_history';
	protected $fillable = [
							'user_id',
							'login_date',
							'start_time',
							'end_time',
							'total_time',
							'time_in_seconds'
						  ];		

	public function classroom_details()
    {
        return $this->hasOne('App\Models\ClassroomStudentModel','id','user_id');
    }					  
}
