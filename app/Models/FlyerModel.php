<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlyerModel extends Model
{
    protected $table = 'flyer';

    protected $fillable = 
    [
    'template_id',
    'template_name',
    'template_from',
    'template_subject',
    'template_variables',
    'template_from_mail',
    'template_html',
    'locale'
    ];
}
