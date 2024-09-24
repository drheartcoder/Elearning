<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template18Model extends Model
{
    protected $table    = 'template_18';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_1_text','question_1_answer','question_1_answer_position','question_2_file','question_2_text','question_2_answer','question_2_answer_position','question_3_file','question_3_text','question_3_answer','question_3_answer_position','question_4_file','question_4_text','question_4_answer','question_4_answer_position','question_5_file','question_5_text','question_5_answer','question_5_answer_position','question_6_file','question_6_text','question_6_answer','question_6_answer_position','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
