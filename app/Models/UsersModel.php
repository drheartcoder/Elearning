<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UsersModel extends Model  implements AuthenticatableContract,
                                           AuthorizableContract,
                                           CanResetPasswordContract
{
    protected $hidden = array('password', 'remember_token');
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, SoftDeletes;

    protected $table    = 'users';
    protected $fillable = [
    						'user_type',
    						'first_name',
                            'last_name',
    						'user_name',
    						'email',
    						'password',
    						'password_reset_code',
                            'contact',
    						'fax_number',
                            'gender',
    						'address',
                            'city',
                            'state',
                            'country',
                            'post_code',
                            'lat',    
                            'lang',
                            'pin',
                            'permissions',
                            'reporting_to',
                            'preferred_language',
    						'remember_token',
    						'profile_image',
                            'is_active_membership',
                            'is_social',
                            'social_via',
                            'is_active',
                            'is_verify',
                            'is_mobile_verify',
                            'reference_code',
                            'reference_user_id',
                            'insentive_amount',
                            'total_incentive_amount',
                            'phone_code'
    					  ];

    public function classes_data()
    {
        return $this->hasMany('App\Models\ClassroomStudentModel','student_id','id');
    }

    public function reporting_to_details()
    {
        return $this->hasOne('App\Models\UsersModel','id','reporting_to');
    }

    public function student_details()
    {
        return $this->hasOne('App\Models\StudentDetailsModel','student_id','id');
    }

    public function transaction_details()
    {
        return $this->hasOne('App\Models\TransactionsModel','user_id','id')->orderBy('id','desc');
    }
    public function phone_code_details()
    {
        return $this->hasOne('App\Models\CountryPhoneCodeModel','id','phone_code');
    }
}
