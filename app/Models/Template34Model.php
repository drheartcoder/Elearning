<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template34Model extends Model
{
    protected $table    = 'template_34';
    protected $fillable = ['program_id','lesson_id','question','question_file','digit1_1','operator1','digit1_2','answer1','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
