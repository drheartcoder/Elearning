<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryPhoneCodeModel extends Model
{
 	protected $table	= 'country_phone_codes';
	protected $fillable = [
							'iso',
							'name',
							'nicename',
							'iso3',
							'numcode',
							'phonecode'
						  ];
}
