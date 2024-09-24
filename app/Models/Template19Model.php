<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template19Model extends Model
{
    protected $table    = 'template_19';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_1_answer','question_2_file','question_2_answer','question_3_file','question_3_answer','question_4_file','question_4_answer','question_5_file','question_5_answer','question_6_file','question_6_answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
