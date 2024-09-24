<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template6Model extends Model
{
    protected $table = 'template_6';
    protected $fillable = ['program_id','lesson_id','question','question_file','option1','option2','answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
