<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslationModel extends Model
{
    protected $table    = 'question_translation';
    protected $fillable = 	[
								'question_id',
								'locale',
								'title',
								'description'
                            ];
}
