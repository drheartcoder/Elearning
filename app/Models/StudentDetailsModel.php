<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDetailsModel extends Model
{
    use SoftDeletes;

    protected $table    = 'student_details';
    protected $fillable = [
    						'student_id',
    						'parent_id',
                            'added_by',
    						'subject_id',
                            'grade_id'
    					  ];

    public function user_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','student_id');
    }

    public function added_by_user()
    {
        return $this->hasOne('App\Models\UsersModel','id','added_by');
    }

    public function student_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','student_id');
    }   

    public function subject_data()
    {
        return $this->hasOne('App\Models\SubjectModel','id','subject_id');
    }
    public function subject_trans()
    {
        return $this->hasOne('App\Models\SubjectTranslationModel','subject_id','subject_id');
    }

    public function grade_data()
    {
        return $this->hasOne('App\Models\GradeModel','id','grade_id');
    }
    public function grade_trans()
    {
        return $this->hasOne('App\Models\GradeTranslationModel','grade_id','grade_id');
    }

    public function parent_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','parent_id');
    }
}
