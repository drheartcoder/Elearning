<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetailsModel extends Model
{
    protected $table = 'contact_address';

    protected $fillable = 
    [   
   	 'status'
    ];

    public function address_translation()
    {
    	return $this->hasMany('App\Models\ContactAddressTranslationModel', 'contact_address_id', 'id');
    }
}
