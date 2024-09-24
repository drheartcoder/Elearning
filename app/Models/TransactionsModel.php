<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsModel extends Model
{
    protected $table    = 'transactions';
    protected $fillable = [
                            'transaction_id',
                            'uniq_id',
                            'user_id',
                            'plan_id',
                            'wire_transfer_id',
                            'status',
                            'amount',
                            'invoice',
                            'child_limit',
                            'expiry_date',
                            'extension_date',
                            'per_unit_conversion_rate',
                            'total_converted_amount',
                            'transaction_date',
                            'coupon_id',
                            'coupon_usage_id',
                            'payment_via',
                            'payment_status',
                            'total_price_cny_amount',
                            'payment_note'
                          ];

    public function plan_data()
    {
        return $this->hasOne('App\Models\SubscriptionPlanModel','id','plan_id');
    }

    public function user_data()
    {
        return $this->hasOne('App\Models\UsersModel','id','user_id');
    }

    public function coupon_data()
    {
        return $this->hasOne('App\Models\CouponsModel','id','coupon_id');
    }
}
