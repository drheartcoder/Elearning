<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanModel extends Model
{
    use Translatable;
    protected $table = 'subscription_plan';
    
    /* Translatable Config */
    public $translationModel      = 'App\Models\SubscriptionPlanTranslationModel';
    public $translationForeignKey = 'subscription_plan_id';
    public $translatedAttributes  = ['name','details','locale'];
    protected $fillable           = [
                                        'id',
                                        'slug',
                                        'price',
                                        'validity',
                                        'scrash_price1',
                                        'scrash_price2',
                                        'per_day_price',
                                        'status'
                                    ];

    public function subscription_plan_translation()
    {
        return $this->hasMany('App\Models\SubscriptionPlanTranslationModel','subscription_plan_id','id');
    }

    public function delete()
    {
        $this->translations()->delete();
        return parent::delete();
    }
}
