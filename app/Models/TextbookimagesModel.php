<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookimagesModel extends Model
{
    protected $table    = 'textbook_image';
    protected $fillable = ['textbook_id','file'];

    public function textbookData()
    {
        return $this->belongsTo('App\Models\TextbookModel', 'textbook_id', 'id');
    }
}