<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Dimsav\Translatable\Translatable;

class FrontPagesModel extends Model
{
	use Translatable;
    protected $table = "front_pages";
    public $translationModel      = 'App\Models\FrontPagesTranslationModel';
    public $translationForeignKey = 'front_page_id';
    public $translatedAttributes  = ['title', 'description', 'meta_keyword', 'meta_title', 'meta_description', 'locale'];
    protected $fillable = [
							'page_title',
							'page_description',
                            'page_slug',
							'banner_image',
							'status',
                            'order'
    					 ];
    					 
    /*public function translations()
    {
    	return $this->hasOne('App\Models\FrontPagesTranslationModel','id','front_page_id');
    }*/
}
