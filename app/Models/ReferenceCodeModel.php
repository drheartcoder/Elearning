<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceCodeModel extends Model
{
    protected $table    = 'reference_code';
    protected $fillable =
    [
        'validity_extension',
        'reward_amount',
        'reference_reward_type',
        'discount_amount',
        'coupen_type',
        'start_date',
        'end_date'
    ];
}
