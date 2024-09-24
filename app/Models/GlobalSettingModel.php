<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSettingModel extends Model
{
    protected $table    = 'global_setting';
    protected $fillable =
                            [
                                'child_limit',
                                'daily_lesson_limit',
                                'daily_homework_limit',
                                'daily_textbook_limit'
                            ];
}
