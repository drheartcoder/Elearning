<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview37Model extends Model
{
    protected $table    = 'template_preview_37';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','digit1_1','operator1','digit1_2','answer1','question_2_file','digit2_1','operator2','digit2_2','answer2','question_3_file','digit3_1','operator3','digit3_2','answer3','question_4_file','digit4_1','operator4','digit4_2','answer4','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
