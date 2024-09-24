<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview27Model extends Model
{
    protected $table    = 'template_preview_27';
    protected $fillable = ['program_id','lesson_id','question','question_1','answer_1','question_2','answer_2','question_3','answer_3','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
