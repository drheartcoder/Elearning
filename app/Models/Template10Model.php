<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template10Model extends Model
{
    protected $table    = 'template_10';
    protected $fillable = ['program_id','lesson_id','question_file','question','question_text','option1','option2','answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
