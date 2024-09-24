<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponsModel extends Model
{
    protected $table = "coupons";
    protected $fillable = [
							'coupon_code',
							'title',
							'created_by',
							'owner',
							'discount_amount',
							'start_date',
							'end_date',
							'coupon_option',
							'status',
							'reward_type_for_referral',
							'reward_amount',
							'validity_extension',
							'coupen_usage_count'
    					 ];



	function coupon_code_owner_details()
	{
		return $this->hasOne('App\Models\UsersModel','pin','coupon_code');
	}

}
