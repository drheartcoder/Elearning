<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class WireTransfereedRequestModel extends Model
{
    protected $table    = 'wire_transfereed_request';
    protected $fillable = [
    						'user_id',
    						'requested_date',
                            'plan_id',
                            'payment_status',
                            'created_at',
    						'updated_at'
    					  ];   

   	public function user_details()
    {
        return $this->belongsTo('App\Models\UsersModel', 'user_id', 'id');
    } 
    public function plan_details()
    {
        return $this->belongsTo('App\Models\SubscriptionPlanModel','plan_id','id');
    }
    public function transaction_details()
    {
        return $this->belongsTo('App\Models\TransactionsModel','plan_id','id');
    }
    
}

