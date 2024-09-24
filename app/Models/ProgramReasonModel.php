<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramReasonModel extends Model
{
    protected $table    = 'program_reason';
    protected $fillable = ['user_id','program_id','reason'];

    public function userData()
    {
    	return $this->belongsTo('App\Models\UsersModel', 'user_id', 'id');
    }
}
