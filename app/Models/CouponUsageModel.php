<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponUsageModel extends Model
{
    protected $table = "coupon_usage";
    protected $fillable = [
							'coupon_id',
							'user_id',
							'created_by',
							'reward_type_for_referral',
							'reward_amount',
							'validity_extension',
							'per_unit_conversion_rate',
							'conversion_reward_amount',
							'from_currency',
							'to_currency',
							'discount_amount',
							'created_at',
							'updated_at'
    					 ];
}
