<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template5Model extends Model
{
    protected $table    = 'template_5';
    protected $fillable = ['program_id','lesson_id','file_type','file','question','option1','option2','answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
