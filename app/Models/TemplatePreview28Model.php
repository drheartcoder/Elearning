<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview28Model extends Model
{
    protected $table    = 'template_preview_28';
    protected $fillable = ['program_id','lesson_id','question','question_1','answer_1','question_2','answer_2','question_3','answer_3','question_4','answer_4','question_5','answer_5','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
