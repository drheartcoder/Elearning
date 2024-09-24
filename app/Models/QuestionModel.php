<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class QuestionModel extends Model
{
	use Translatable;
    protected $table              = "question";
    public $translationModel      = 'App\Models\QuestionTranslationModel';
    public $translationForeignKey = 'question_id';
    public $translatedAttributes  = ['title', 'description'];
    protected $fillable           = [
                                        'unique_id',
                                        'slug',
										'subject_id',
										'grade_id',
                                        'template_id',
                                        'status',
										'is_approved'
									];

    public function question_translation()
    {
        return $this->hasMany('App\Models\QuestionTranslationModel','question_id','id');
    }

    public function subject_translation()
    {
        return $this->hasMany('App\Models\SubjectTranslationModel','subject_id','subject_id');
    }

    public function grade_translation()
    {
        return $this->hasMany('App\Models\GradeTranslationModel','grade_id','grade_id');
    } 

    public function template_details()
    {
        return $this->hasOne('App\Models\TemplateModel','id','template_id');
    }                                    

}
