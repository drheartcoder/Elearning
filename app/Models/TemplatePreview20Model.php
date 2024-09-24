<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview20Model extends Model
{
    protected $table    = 'template_preview_20';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_1_option1','question_1_option2','question_1_option3','question_1_answer','question_2_file','question_2_option1','question_2_option2','question_2_option3','question_2_answer','horn','duration','created_by'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
