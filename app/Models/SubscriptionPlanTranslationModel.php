<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanTranslationModel extends Model
{
    protected $table = 'subscription_plan_translation'; 
    protected $fillable 			= 	[	
    										'id',
    										'subscription_plan_id',
    										'locale',
                                            'name',
                                            'details'
                                        ];
}
