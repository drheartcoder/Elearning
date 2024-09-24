<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateModel extends Model
{
    protected $table = 'certificate';

    protected $fillable = 
    [
    'template_name',
    'template_from',
    'template_subject',
    'template_variables',
    'template_from_mail',
    'template_html',
    'locale'
    ];
}
