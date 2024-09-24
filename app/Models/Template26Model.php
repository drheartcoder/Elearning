<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template26Model extends Model
{
    protected $table    = 'template_26';
    protected $fillable = ['program_id','lesson_id','question','question_1_text','question_1_option1','question_1_option2','question_1_option3','question_1_answer','question_2_text','question_2_option1','question_2_option2','question_2_option3','question_2_answer','question_3_text','question_3_option1','question_3_option2','question_3_option3','question_3_answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
