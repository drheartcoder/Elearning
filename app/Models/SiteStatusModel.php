<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteStatusModel extends Model
{
    protected $table = 'site_status';

    protected $fillable = 
    [
    'site_name',
    'site_address',
    'site_contact_number',
    'site_status',
    'site_video',
    'meta_desc',
    'meta_keyword',
    'site_email_address',
    'fb_url',
    'twitter_url',
    'google_plus_url',
    'linkedin_url',
    'youtube_url',
    'lat',
    'lon',
    'currency_rate',
    'transaction_charges',
    'gst',
    'product_return_days',
    'apple_url',
    'google_play_url',
    'acrobat_url',
    'chrome_url'
    ];
}
