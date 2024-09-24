<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CurrencyRateModel extends Model
{
    protected $table = 'currency_rate';
    protected $fillable           = [
                                        'from_currency_id',
                                        'from_currency_code',
                                        'to_currency_id',
                                        'to_currency_code',
                                        'rate'
                                    ];
}
