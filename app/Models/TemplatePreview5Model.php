<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePreview5Model extends Model
{
    protected $table    = 'template_preview_5';
    protected $fillable = ['program_id','lesson_id','file_type','file','question','option1','option2','answer','horn','duration','created_by'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
