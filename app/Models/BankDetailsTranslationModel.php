<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetailsTranslationModel extends Model
{
    protected $table = "bank_details_translation";

    protected $fillable = [
							'locale',
							'bank_details_id',
							'account_holder_name',
							'bank_name',
							'branch',
							'note'
    					  ];
    					  
}
