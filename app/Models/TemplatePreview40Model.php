<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview40Model extends Model
{
    protected $table    = 'template_preview_40';
    protected $fillable = ['program_id','lesson_id','question','question1_1','question1_2','answer_1','question2_1','question2_2','answer_2','question3_1','question3_2','answer_3','question4_1','question4_2','answer_4','question5_1','question5_2','answer_5','question6_1','question6_2','answer_6','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
