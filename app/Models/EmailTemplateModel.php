<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class EmailTemplateModel extends Model
{
	use Translatable;

    protected $table              = 'email_template';
    public $translationModel      = 'App\Models\EmailTemplateTranslationModel';
    public $translationForeignKey = 'email_template_id';
    public $translatedAttributes  = [
                                      'email_template_id',
                                      'template_name',
                                      'template_subject',
                                      'template_html'
                                    ];

    protected $fillable = [
                            'template_from',
                            'template_from_mail',
                            'template_variables'
                          ];

    public function template_details()
    {
        return $this->hasMany('App\Models\EmailTemplateTranslationModel','email_template_id','id');
    }                      
}
