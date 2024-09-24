<?php

namespace App\Http\Middleware\Front;

use App\Models\SiteSettingModel;
use App\Models\NotificationsModel;
use App\Models\TransactionsModel;
use App\Models\UserLoginHistoryModel;
use App\Models\GlobalSettingModel;
use App\Models\StudentDetailsModel;
use Closure;
use Sentinel;
use Request;
use Session;
use Auth;

class UsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      /*Do not change any code in this section */
      $arr_user_details = [];
      $this->auth       = Auth::user();
      /*dd($this->auth->id);*/
      $profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
      $profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
      $default_image_public_img_path = url('/').config('app.project.img_path.default_image');

      view()->share('profile_image_base_img_path',$profile_image_base_img_path);
      view()->share('profile_image_public_img_path',$profile_image_public_img_path);
      view()->share('default_image_public_img_path',$default_image_public_img_path);

      if($this->auth)
      { 
        $segment = \Request::segment(1);
        $user_id = isset($this->auth->id)?$this->auth->id:'';

        $subscription_plan_status = $this->check_plan_expired_or_not($user_id);
        view()->share('subscription_plan_status',$subscription_plan_status);
        
        $is_plan_purchased = $this->check_plan_is_purchased($user_id);
        view()->share('plan_purchased_status',$is_plan_purchased);

        $is_user_request_wire_transfer = check_request_for_wire_transfer($user_id);
        view()->share('is_user_request_wire_transfer',$is_user_request_wire_transfer);

        $check_global_add_child_limit_status = $this->check_global_add_child_limit_status($user_id);
        view()->share('global_add_child_limit_status',$check_global_add_child_limit_status);

        if($this->auth['user_type'] != $segment)
        {
          Session::flash('error', 'Your account found in system, but selected user type was wrong.');
          Auth::logout();
          return redirect(url('/').'/signin');
        }

        if($this->auth['is_active'] == 'active')
        {
            $arr_user_details = $this->auth;
            view()->share('arr_user_details',$arr_user_details);

            $obj_user_login=[];
            $current_date   = date('Y-m-d');                       
            $obj_user_login = UserLoginHistoryModel::where('user_id','=',$user_id)
                                                          ->whereDate('login_date','=',$current_date)
                                                          ->where('time_in_seconds','>=','10800')
                                                          ->join('users','users.id','=','user_login_history.user_id')
                                                          ->where('users.user_type','student')
                                                          ->first();

     
            return $next($request);
        }
        else if($this->auth['is_active'] == 'block')
        {
          Session::flash('error', 'Your account is temporarily blocked, Please contact admin for more details.');
          $segment = \Request::segment(1);
          Auth::logout();
          return redirect(url('/').'/signin');
        }
        else
        {
          Session::flash('error', 'Something went wrong, Please contact admin for more details.');
          $segment = \Request::segment(1);
          Auth::logout();
          return redirect(url('/').'/signin');
        }
      }
      else
      { 
        $segment = \Request::segment(1);
        Auth::logout();
        return redirect(url('/').'/signin');
      }


      
    }
    public function check_plan_expired_or_not($user_id)
    {
        $is_plan_expired = false;
        $arr_transaction = [];
        $check_is_exist  = 0;

        $check_is_exist   = TransactionsModel::where('user_id','=',$user_id)
                                          ->where('status','=','active')
                                          ->orderBy('id','desc')
                                          ->count();
        if($check_is_exist<=0)
        {
          $obj_transaction = TransactionsModel::where('user_id','=',$user_id)
                                            ->whereDate('extension_date','<=',date('Y-m-d'))
                                            ->whereDate('extension_date','<>',0000-00-00)
                                            ->orderBy('id','desc')
                                            ->first();
                              
          if($obj_transaction)
          {
            $is_plan_expired = true; 
          }
        }
        return $is_plan_expired;
    }
    public function check_plan_is_purchased($user_id)
    {
        $is_plan_purchased  = check_user_payment($user_id);
        return $is_plan_purchased;
    }

    public function check_global_add_child_limit_status($user_id)
    {
        $global_student_limit = $parent_child_count = 0;
        $obj_global = false;
        $arr_global = [];

        $parent_child_count = StudentDetailsModel::where('parent_id',$user_id)->count();

        $arr_global =  GlobalSettingModel::first();

        if(isset($arr_global) && count($arr_global)>0)
        {
          $arr_global = $arr_global->toArray();
          $global_student_limit = $arr_global['child_limit']; 
          if($parent_child_count<$global_student_limit)
          {
            return true;
          }
        }
        return false;
    }
  }
