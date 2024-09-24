<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template3Model extends Model
{
   protected $table = 'template_3';
   protected $fillable = ['program_id','lesson_id','question','question_1_file','question_1_text','question_2_file','question_2_text','answer','horn','duration'];

   public function lessonData()
   {
   		return $this->belongsTo('App\Models\LessonModel', 'lesson_id', 'id');
   }
}
