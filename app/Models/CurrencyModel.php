<?php

namespace App\Models;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CurrencyModel extends Model
{
    protected $table = 'currency';
    protected $fillable           = [
                                        'id',
                                        'name',
                                        'slug',
                                        'code',
                                        'html_code',
                                        'status'
                                    ];
}
