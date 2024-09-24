<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsTableModel extends Model
{
    protected $table    = 'points_table';
    protected $fillable = ['type','a+','a','b','b+','c','d'];
}
