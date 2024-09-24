<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template2Model extends Model
{
    protected $table = 'template_2';
    protected $fillable = ['program_id','lesson_id','file_type','file','question','question_text','answer_position','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
