<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template16Model extends Model
{
    protected $table = 'template_16';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_1_text','answer1','question_2_file','question_2_text','answer2','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
