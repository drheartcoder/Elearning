<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramTranslationModel extends Model
{
    protected $table    = 'program_translation';
    protected $fillable = 	[
								'program_id',
								'locale',
								'name',
								'description'
                            ];
}
