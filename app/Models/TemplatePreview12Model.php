<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview12Model extends Model
{
    protected $table = 'template_preview_12';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','answer1','question_2_file','answer2','horn','duration','created_by'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
