<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class TextbookModel extends Model
{
    protected $table              = "textbook";
    protected $fillable           = [
                                        'program_id',
                                        'lesson_id',
                                        'name',
                                        'slug',
                                        'subject_id',
                                        'grade_id',
                                        'status'
									];

    public function subjectData()
    {
        return $this->belongsTo('App\Models\SubjectModel', 'subject_id', 'id');
    }
    public function gradeData()
    {
        return $this->belongsTo('App\Models\GradeModel', 'grade_id', 'id');
    }
    public function textbookImagesData()
    {
        return $this->hasMany('App\Models\TextbookimagesModel', 'textbook_id', 'id');
    }
    public function program_assign()
    {
        return $this->hasMany('App\Models\StudentProgramsModel', 'program_id', 'program_id');
    }
}