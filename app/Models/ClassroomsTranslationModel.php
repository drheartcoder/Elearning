<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomsTranslationModel extends Model
{
    protected $table    = 'classroom_translation';
    protected $fillable = 	[
								'classroom_id',
								'locale',
								'name'
                            ];
}
