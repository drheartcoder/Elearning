<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ShareClassModel extends Model
{
    protected $table    = 'share_class';
    protected $fillable = [
    						'from_teacher_id',
    						'to_teacher',
                            'classroom_id',
                            'to_teacher_id',
                            'status',
                            'created_at',
    						'updated_at'
    					  ];    
    
    public function share_class_data()
    {
        return $this->hasOne('App\Models\ClassroomStudentModel','teacher_id','from_teacher_id');
    }

    public function class_data()
    {
        return $this->hasOne('App\Models\ClassroomsModel','id','classroom_id');
    }

    public function share_from_user()
    {
        return $this->hasOne('App\Models\UsersModel','id','from_teacher_id');
    }

    public function share_to_user()
    {
        return $this->hasOne('App\Models\UsersModel','id','to_teacher_id');
    }

}

