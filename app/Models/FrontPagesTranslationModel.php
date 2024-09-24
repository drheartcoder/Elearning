<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPagesTranslationModel extends Model
{
    protected $table = 'front_pages_translation'; 
    protected $fillable 			= 	[	
    										'id',
    										'front_page_id',
    										'locale',
                                            'page_title',
    										'page_description',
    										'meta_keyword',
    										'meta_title',
    										'meta_description'
                                        ];
}
