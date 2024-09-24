<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    protected $table    = 'gallery';
 
    protected $fillable = [ 'name' ];
}
