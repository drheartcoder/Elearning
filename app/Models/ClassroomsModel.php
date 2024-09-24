<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*use \Dimsav\Translatable\Translatable;*/
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomsModel extends Model
{
	use SoftDeletes;
    
    protected $table              = "classroom";
    /*public $translationModel      = 'App\Models\ClassroomsTranslationModel';
    public $translationForeignKey = 'classroom_id';
    public $translatedAttributes  = ['name'];*/
    protected $fillable           = [
										'class_enrollment_code',
                                        'name',
                                        'slug',
                                        'subject_id',
										'grade_id',
										'teacher_id',
                                        'program_id',
                                        'start_date',
                                        'end_date',
										'status',
                                        'is_transfer',
                                        'transfer_id'
									];
   
	public function grade_data()
    {
        return $this->hasOne('App\Models\GradeTranslationModel','grade_id','grade_id');
    }

    public function grade_details()
    {
        return $this->hasOne('App\Models\GradeModel','id','grade_id');
    }

    public function subject_data()
    {
        return $this->hasOne('App\Models\SubjectTranslationModel','subject_id','subject_id');
    }

    public function subject_details()
    {
        return $this->hasOne('App\Models\SubjectModel','id','subject_id');
    }

    public function program_details()
    {
        return $this->hasOne('App\Models\ProgramModel','id','program_id');
    }

    public function user_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','teacher_id');
    }

    public function class_student_data()
    {
        return $this->hasMany('App\Models\ClassroomStudentModel','classroom_id','id');
    }

    public function student_program_question()
    {
        return $this->hasMany('App\Models\StudentProgramQuestionModel','program_id','program_id');
    }

    public function share_class()
    {
        return $this->hasMany('App\Models\ShareClassModel','to_teacher_id','teacher_id');
    }

    public function share_class_data()
    {
        return $this->hasOne('App\Models\ShareClassModel','classroom_id','id');
    }

    public function transfer_user_details()
    {
        return $this->hasOne('App\Models\UsersModel','id','transfer_id');
    }
}
