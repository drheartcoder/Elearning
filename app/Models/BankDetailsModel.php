<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetailsModel extends Model
{
    protected $table = "bank_details";

    protected $fillable = [
							'account_number',
							'ifsc_code',
							'swift_code',
    					  ];

  	public function bank_translation()
    {
    	return $this->hasMany('App\Models\BankDetailsTranslationModel', 'bank_details_id', 'id');
    }
    					  
}
