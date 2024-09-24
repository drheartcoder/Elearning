<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTranslationModel extends Model
{
    use SoftDeletes;
    protected $table    = 'subject_translation';
    protected $fillable = 	[	
								'id',
								'subject_id',
								'locale',
								'name'
                            ];
}
