<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview33Model extends Model
{
    protected $table    = 'template_preview_33';
    protected $fillable = ['program_id','lesson_id','question','digit1_1','operator1','digit1_2','answer1','digit2_1','operator2','digit2_2','answer2','digit3_1','operator3','digit3_2','answer3','digit4_1','operator4','digit4_2','answer4','digit5_1','operator5','digit5_2','answer5','digit6_1','operator6','digit6_2','answer6','digit7_1','operator7','digit7_2','answer7','digit8_1','operator8','digit8_2','answer8','digit9_1','operator9','digit9_2','answer9','digit10_1','operator10','digit10_2','answer10','digit11_1','operator11','digit11_2','answer11','digit12_1','operator12','digit12_2','answer12','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
