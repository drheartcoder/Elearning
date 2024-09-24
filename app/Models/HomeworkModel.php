<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeworkModel extends Model
{
    protected $table              = "homework";
    protected $fillable           = [
                                        'program_id',
                                        'lesson_id',
                                        'name',
                                        'slug',
                                        'subject_id',
                                        'grade_id',
                                        'status'
									];

    public function programData()
    {
        return $this->belongsTo('App\Models\ProgramModel', 'program_id', 'id');
    }
    public function lessonData()
    {
        return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
    public function subjectData()
    {
        return $this->belongsTo('App\Models\SubjectModel', 'subject_id', 'id');
    }
    public function gradeData()
    {
        return $this->belongsTo('App\Models\GradeModel', 'grade_id', 'id');
    }
    public function homeworkImagesData()
    {
        return $this->hasMany('App\Models\HomeworkimagesModel', 'homework_id', 'id');
    }
    public function program_assign_by()
    {
        return $this->hasMany('App\Models\StudentProgramsModel', 'program_id', 'program_id');
    }
    public function program_assign()
    {
        return $this->hasMany('App\Models\StudentProgramQuestionModel', 'program_id', 'program_id');
    }

    /*StudentProgramsModel*/
}
