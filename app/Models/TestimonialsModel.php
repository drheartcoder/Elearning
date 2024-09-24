<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Dimsav\Translatable\Translatable;

class TestimonialsModel extends Model
{
	use Translatable;
    protected $table = "testimonials";
    public $translationModel      = 'App\Models\TestimonialsTranslationModel';
    public $translationForeignKey = 'testimonials_id';
    public $translatedAttributes  = ['title','message'];
    protected $fillable = [
							'image',
							'status'
    					 ];
                         

	public function testimonial_translation()
    {
        return $this->hasMany('App\Models\TestimonialsTranslationModel','testimonials_id','id');
    }    					 

}
