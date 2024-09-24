<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriberModel extends Model
{
    protected $table = 'newsletter_subscriber';
    protected $fillable = ['user_id', 'user_type', 'is_active', 'subscription_date'];

	public function user_details()
    {
        return $this->belongsTo('App\Models\UsersModel', 'user_id', 'id');
    }
}
