<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview39Model extends Model
{
    protected $table    = 'template_preview_39';
    protected $fillable = ['program_id','lesson_id','question','digit1_1','operator1','digit1_2','answer1','digit2_1','operator2','digit2_2','answer2','digit3_1','operator3','digit3_2','answer3','digit4_1','operator4','digit4_2','answer4','digit5_1','operator5','digit5_2','answer5','digit6_1','operator6','digit6_2','answer6','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
