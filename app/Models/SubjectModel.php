<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use SoftDeletes;
    use Translatable;
    protected $table              = 'subject';
    /* Translatable Config */
    public $translationModel      = 'App\Models\SubjectTranslationModel';
    public $translationForeignKey = 'subject_id';
    public $translatedAttributes  = ['name'];
    protected $fillable           = [
										'id',
                                        'subject_slug',
                                        'status'
                                    ];

    public function subject_traslation()
    {
        return $this->hasMany('App\Models\SubjectTranslationModel','subject_id','id');
    }
    public function subjectTranslationData()
    {
        return $this->hasMany('App\Models\SubjectTranslationModel','subject_id','id');
    }

    /*public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }*/
}
