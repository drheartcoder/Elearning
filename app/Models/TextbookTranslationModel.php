<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookTranslationModel extends Model
{
    protected $table    = 'textbook_translation';
    protected $fillable = 	[
								'textbook_id',
								'locale',
								'name'
                            ];
}
