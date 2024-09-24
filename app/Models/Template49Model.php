<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template49Model extends Model
{
    protected $table = 'template_49';
    protected $fillable = ['program_id','lesson_id','question','question_1','option_1','option_2','option_3','option_4','answer','horn','duration'];

    public function lessonData()
    {
    	return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
    }
}
