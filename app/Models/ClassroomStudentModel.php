<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomStudentModel extends Model
{
    protected $table              = "classroom_student";
    protected $fillable           = [
										'classroom_id',
                                        'teacher_id',
                                        'student_id',
                                        'is_active'
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

    public function subject_parent_data()
    {
        return $this->hasOne('App\Models\StudentDetailsModel','student_id','student_id');
    }

    public function subject_details()
    {
        return $this->hasOne('App\Models\SubjectModel','id','subject_id');
    }

    public function program_details()
    {
        return $this->hasOne('App\Models\ProgramModel','id','program_id');
    }

    public function teacher_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','teacher_id');
    }

    public function student_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','student_id');
    }

    public function class_data()
    {
        return $this->hasOne('App\Models\ClassroomsModel','id','classroom_id');
    }

    public function student_program_data()
    {
        return $this->hasMany('App\Models\StudentProgramsModel','student_id','student_id');
    }

    public function share_class_data()
    {
        return $this->hasMany('App\Models\ShareClassModel','from_teacher_id','teacher_id');
    }

}
