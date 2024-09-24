<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredentialModel extends Model
{
 	protected $table	= 'api_details';
	protected $fillable = [
							'mailchimp_api_key',
							'mailchimp_list_id'
						  ];
}
