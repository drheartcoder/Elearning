<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview35Model extends Model
{
    protected $table    = 'template_preview_35';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_2_file','question_3_file','question_4_file','question_5_file','digit1_1','operator1','digit1_2','answer1','answer1Position','digit2_1','operator2','digit2_2','answer2','answer2Position','digit3_1','operator3','digit3_2','answer3','answer3Position','digit4_1','operator4','digit4_2','answer4','answer4Position','digit5_1','operator5','digit5_2','answer5','answer5Position','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
