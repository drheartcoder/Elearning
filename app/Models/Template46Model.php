<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template46Model extends Model
{
    protected $table    = 'template_46';
    protected $fillable = ['program_id','lesson_id','question','question_file','question_1','answer_1','question_2','answer_2','question_3','answer_3','question_4','answer_4','question_5','answer_5','question_6','answer_6','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
