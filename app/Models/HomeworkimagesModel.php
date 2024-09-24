<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeworkimagesModel extends Model
{
    protected $table    = 'homework_image';
    protected $fillable = ['homework_id','file','homework_name','homework_slug'];

    public function homeworkData()
    {
        return $this->belongsTo('App\Models\HomeworkModel', 'homework_id', 'id');
    }
}
