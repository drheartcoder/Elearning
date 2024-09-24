<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template31Model extends Model
{
    protected $table    = 'template_31';
    protected $fillable = ['program_id','lesson_id','question','question_1','answer','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
