<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template45Model extends Model
{
    protected $table    = 'template_45';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question1_1','answer1_1','question1_2','answer1_2','question1_3','answer1_3','question_2_file','question2_1','answer2_1','question2_2','answer2_2','question2_3','answer2_3','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
