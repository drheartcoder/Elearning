<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslationModel extends Model
{
    protected $table    = 'email_template_translation';
    protected $fillable = ['email_template_id','template_name','template_subject', 'template_html', 'locale'];
}