<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class ProgramQuestionModel extends Model
{
    protected $table              = "program_question";
    protected $fillable           = [
                                        'program_id',
                                        'template_id',
                                        'lesson_id',
                                        'question_id'
									];

    public function template_details()
    {
        return $this->hasOne('App\Models\TemplateModel','id','template_id');
    }                                    
    public function programData()
    {
        return $this->belongsTo('App\Models\ProgramModel', 'program_id', 'id');
    }
    public function lessonData()
    {
        return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
