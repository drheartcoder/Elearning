<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template9Model extends Model
{
    protected $table = 'template_9';
    protected $fillable = ['program_id','lesson_id','question','question_text','option1','option2','option3','option4','answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
