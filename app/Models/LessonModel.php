<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonModel extends Model
{
    protected $table = 'lesson';
    protected $fillable = ['name','program_id'];

    public function programData()
    {
    	return $this->belongsTo('App\Models\ProgramModel', 'program_id', 'id');
    }
}
