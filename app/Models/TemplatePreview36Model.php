<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview36Model extends Model
{
    protected $table    = 'template_preview_36';
    protected $fillable = ['program_id','lesson_id','question','question_1_file','question_2_file','answer','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
