<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template14Model extends Model
{
    protected $table = 'template_14';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','answer1','question_2_file','answer2','question_3_file','answer3','question_4_file','answer4','question_5_file','answer5','question_6_file','answer6','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
