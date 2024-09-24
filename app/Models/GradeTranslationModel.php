<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeTranslationModel extends Model
{
    protected $table = 'grade_translation'; 
    protected $fillable 			= 	[	
    										'id',
    										'grade_id',
    										'locale',
                                            'name'
                                        ];

}
