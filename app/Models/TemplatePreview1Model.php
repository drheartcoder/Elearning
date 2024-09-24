<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview1Model extends Model
{
    protected $table = 'template_preview_1';
    protected $fillable = ['program_id','lesson_id','file_type','file','question','question_text','horn','duration','created_by'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
