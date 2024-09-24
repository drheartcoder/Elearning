<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemModel extends Model
{
 	protected $table	= 'redeem';
	protected $fillable = [
							'user_id',
							'coupon_id',
							'redeem_amount'
						  ];
}
