<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview50Model extends Model
{
    protected $table    = 'template_preview_50';
    protected $fillable = ['program_id','lesson_id','question','question_1','question_2','option_1','option_2','option_3','option_4','answer','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}