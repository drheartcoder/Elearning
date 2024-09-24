<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactAddressTranslationModel extends Model
{
    protected $table = 'contact_address_translation';

    protected $fillable = 
    [   
    	'contact_address_id','address','locale'
    ];
}
