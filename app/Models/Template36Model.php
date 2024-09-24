<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template36Model extends Model
{
    protected $table    = 'template_36';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_2_file','answer','horn','duration'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
