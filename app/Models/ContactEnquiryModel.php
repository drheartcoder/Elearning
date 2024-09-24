<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiryModel extends Model
{
    protected $table      = 'contact_enquiry';
    protected $primaryKey = 'id';
    protected $fillable   = ['first_name','last_name','phone_code','mobile','email','subject','message','is_read_status'];
    public function phone_code_details()
    {
        return $this->hasOne('App\Models\CountryPhoneCodeModel','id','phone_code');
    }
}
