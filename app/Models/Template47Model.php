<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template47Model extends Model
{
    protected $table    = 'template_47';
    protected $fillable = ['program_id','lesson_id','question','question_text','answer','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}