<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template29Model extends Model
{
    protected $table    = 'template_29';
    protected $fillable = ['program_id','lesson_id','question','question_1','question_2','question_3','question_4','question_5','answer','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
