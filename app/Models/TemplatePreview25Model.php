<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview25Model extends Model
{
    protected $table    = 'template_preview_25';
    protected $fillable = ['program_id','lesson_id','question','question_1','question_1_file','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
