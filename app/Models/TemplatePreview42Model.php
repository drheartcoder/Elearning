<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview42Model extends Model
{
    protected $table    = 'template_preview_42';
    protected $fillable = ['program_id','lesson_id','question','question1','answer1','question2','answer2','question3','answer3','question4','answer4','question5','answer5','question6','answer6','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}