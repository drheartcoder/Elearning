<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview38Model extends Model
{
    protected $table    = 'template_preview_38';
    protected $fillable = ['program_id','lesson_id','question','question_file','question_1','answer_1','question_2','answer_2','question_3','answer_3','question_4','answer_4','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
