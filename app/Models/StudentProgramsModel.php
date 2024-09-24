<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgramsModel extends Model
{
    protected $table = 'student_programs';

    protected $fillable = 
    [
        'student_id',
        'program_id',
        'created_by',
        'assigned_by',
        'created_at',
        'updated_at'
    ];


    public function program_details()
    {
        return $this->hasOne('App\Models\ProgramModel','id','program_id');
    }

    public function student_details()
    {
        return $this->hasOne('App\Models\UsersModel','id','student_id');
    }

    public function user_details()
    {
        return $this->hasOne('App\Models\UsersModel','id','created_by');
    }
}
