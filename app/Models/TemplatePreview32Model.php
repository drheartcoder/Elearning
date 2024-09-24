<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview32Model extends Model
{
    protected $table    = 'template_preview_32';
    protected $fillable = ['program_id','lesson_id','question','question_1','answer','horn','duration','created_by'];
    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
