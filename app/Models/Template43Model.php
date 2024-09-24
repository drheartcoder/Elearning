<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template43Model extends Model
{
    protected $table    = 'template_43';
    protected $fillable = ['program_id','lesson_id','question','question_file','question_1','answer_1','question_2','answer_2','question_3','answer_3','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
