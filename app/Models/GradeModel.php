<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GradeModel extends Model
{
    use SoftDeletes;
    use Translatable;
    protected $table = 'grade'; 
    /* Translatable Config */
    public $translationModel      = 'App\Models\GradeTranslationModel';
    public $translationForeignKey = 'grade_id';
    public $translatedAttributes  = ['name'];
    protected $fillable 			= 	[	
    										'id',
                                            'subject',
                                            'status'
                                        ];
    
    public function gradeTraslationData()
    {
        return $this->hasMany('App\Models\GradeTranslationModel', 'grade_id', 'id');
    }
    public function grade_traslation()
    {
        return $this->hasMany('App\Models\GradeTranslationModel','grade_id','id');
    }

    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}
