<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialsTranslationModel extends Model
{
     protected $table = 'testimonials_translation'; 
    protected $fillable 			= 	[	
    										'testimonials_id',
    										'locale',
    										'title',
    										'message'
                                        ];
}
