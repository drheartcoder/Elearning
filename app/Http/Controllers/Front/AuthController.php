<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\EmailService;
use App\Common\Services\MailchimpService;
use App\Common\Services\NewsletterService;
use App\Common\Services\SMSService;
use App\Common\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\UsersModel;
use App\Models\EmailTemplateModel;
use App\Models\StudentDetailsModel;
use App\Models\SubscriptionPlanModel;
use App\Models\ClassroomStudentModel;
use App\Models\ReferenceCodeModel;
use App\Models\TransactionsModel;
use App\Models\CouponsModel;
use App\Models\CouponUsageModel;
use App\Models\ClassroomsModel;
use App\Models\ShareClassModel;
use App\Models\CurrencyRateModel;
use App\Models\UserLoginHistoryModel;

use Socialize;
use Validator;
use Response;
use Session;
use Config;
use Auth;
use Hash;
use App;
use DateTime;
use Mail;

class AuthController extends Controller
{
  public function __construct(
                                EmailService        $email_service,
                                SMSService          $sms_service,
                                MailchimpService    $mailchimp_service,
                                NewsletterService    $newsletter_service,
                                NotificationService $notification_service,
                                UserLoginHistoryModel $user_login_history
                              )
  {

    $this->BaseModel             = new UsersModel();
    $this->UsersModel            = new UsersModel();
    $this->SubscriptionPlanModel = new SubscriptionPlanModel();
    $this->EmailTemplateModel    = new EmailTemplateModel();
    $this->StudentDetailsModel   = new StudentDetailsModel();
    $this->ClassroomStudentModel = new ClassroomStudentModel();
    $this->ReferenceCodeModel    = new ReferenceCodeModel();
    $this->TransactionsModel     = new TransactionsModel();

    $this->CouponsModel          = new CouponsModel();
    $this->CouponUsageModel      = new CouponUsageModel();
    $this->ClassroomsModel       = new ClassroomsModel();
    $this->ShareClassModel       = new ShareClassModel();
    $this->ClassroomStudentModel = new ClassroomStudentModel();
    $this->CurrencyRateModel     = new CurrencyRateModel();
    $this->UserLoginHistoryModel = $user_login_history;

    $this->EmailService          = $email_service;
    $this->SMSService            = $sms_service;
    $this->NotificationService   = $notification_service;
    $this->MailchimpService      = $mailchimp_service;
    $this->NewsletterService     = $newsletter_service;
    $this->auth                  = auth()->guard('users');
    
    Config::set("auth.defaults.passwords","users");

  }

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function Signin()
  {
    $data['pageTitle']     = trans('auth.Sign_in');
    $data['middleContent'] = 'auth.signin';    

    return view('front.layout.master')->with($data);
  }

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ProcessSignin(Request $request)
  {
    $arr_rules                 = array();
    $status                    = $can_login  = $login_with_teacher = false;
    $parent_id                 = 0;
    $remember_me               = "";

    $arr_rules['users']        = "required";
    $arr_rules['email_mobile'] = "required";

    if(is_numeric($email_mobile = $request->input('email_mobile')))
    {
      $login_with = 'contact';
      $arr_rules['email_mobile'] = "required|numeric";
    }
    else
    {
      $login_with = 'email';
      $arr_rules['email_mobile'] = "required|email";
    }

    if($request->input('users') == 'student')
    {
      $arr_rules['pin'] = "required|numeric";
    }
    else
    {
      $arr_rules['password'] = "required";
    }

    $validator = validator::make($request->all() , $arr_rules);
    if ($validator->fails())
    {
      Session::flash('error', 'Need that.');
      return back()->withErrors($validator)->withInput();
    }

    $email_mobile = $request->input('email_mobile');
    $password     = $request->input('password');
    $remember_me  = $request->input('remember_me');
    $user_type    = $request->input('users');
    $pin          = $request->input('pin');

    $obj_user    = $this->BaseModel->where('user_type', $user_type)
                                   ->where(function($query) use($user_type, $pin, $email_mobile, $login_with) {
                                      if($user_type == 'student' && $pin != null)
                                      {
                                        $query->where('pin', $pin);
                                      }
                                      else
                                      {
                                        $query->where($login_with, $email_mobile);
                                      }
                                    })
                                   ->first();
    if($obj_user)
    {
      $user_id = isset($obj_user->id)?$obj_user->id:'';
      if($user_type == 'student' && $pin != null)
      {
          // get parent details for verification
          $obj_student = $this->StudentDetailsModel->select('id', 'student_id', 'parent_id')
                                                   ->where('student_id', $obj_user->id)
                                                   ->first();

          if($obj_student)
          {
            $arr_student = $obj_student->toArray();
            $parent_id   = $arr_student['parent_id'];
          }
          if($this->check_parent_purchased_plan($parent_id)==false)
          {
              Session::flash('error', trans('student.payment_plan_pending'));
              return redirect()->back();
          }

/*          $obj_transaction = TransactionsModel::where('user_id','=',$parent_id)
                                            ->where('status','=','active')
                                            ->where('payment_status','=','unpaid')
                                            ->orderBy('id','desc')
                                            ->first();

           if($obj_transaction)
           {
              Session::flash('error', trans('student.payment_plan_pending'));
              return redirect()->back();
           }*/


           if($this->check_plan_expired($parent_id)==true)
           {
              Session::flash('error', trans('student.plan_expiry_message'));
              return redirect()->back();
           }
          // verify parent email or mobile for login
          if($parent_id != 0)
          {
            $obj_parent_data = $this->BaseModel->select('id', 'user_type', $login_with)
                                               ->where('id', $parent_id)
                                               ->where('user_type', 'parent')
                                               ->where($login_with, $email_mobile)
                                               ->count();
            
            // verified parent email or mobile for login
            if($obj_parent_data > 0)
            {
              $can_login = true;
            }
            else
            {
              $login_with_teacher = true;
            }
          }
          else
          {
            Session::flash('error', trans('student.parent_err_login_message'));
            return redirect()->back();
          }
          // try teacher email or mobile for login
         
          // use teacher email or mobile for login
          if($login_with_teacher == true)
          {
              // get student all assign class teacher data for login
              $obj_classroom_student = $this->ClassroomStudentModel->select('teacher_id', 'student_id')
                                                                   ->where('student_id', $obj_user->id)
                                                                   ->distinct('teacher_id')
                                                                   ->get();
              if($obj_classroom_student)
              {
                $arr_classroom_student = $obj_classroom_student->toArray();

                // verify teacher email or mobile for login
                foreach($arr_classroom_student as $teacher_data)
                {
                  $obj_teacher_data = $this->BaseModel->select('id', 'user_type', $login_with)
                                                      ->where('id', $teacher_data['teacher_id'])
                                                      ->where('user_type', 'teacher')
                                                      ->where($login_with, $email_mobile)
                                                      ->count();
                  
                  // verified techer email or mobile for login
                  if($obj_teacher_data)
                  {
                    $can_login = true;
                  }
                }
              }
          }
      }
      else
      {
          $db_password = $obj_user->password;
          if(Hash::check($password, $db_password)) 
          {
             $can_login = true;
          }
      }

      if($can_login == true)
      {
        if(isset($obj_user->is_active) && $obj_user->is_active == 'block')
        {
          Session::flash('error', trans('teacher.error_account_block'));
          return redirect()->back();
        }
        elseif (isset($obj_user->is_verify) && $obj_user->is_verify == 'no')
        {
          Session::flash('error', trans('teacher.error_account_verified'));
          return redirect()->back();
        }
        elseif(isset($email_mobile) && is_numeric($email_mobile))
        {
          if(isset($obj_user->is_mobile_verify) && $obj_user->is_mobile_verify=='no')
          {
            Session::flash('error', trans('auth.error_account_verified'));
            return redirect()->back();
          }
        }
        Auth::login($obj_user);
        // if($this->is_plan_purchased($user_id)==false)
        // {
        //     if(Session::get('membership')!=null && Session::get('membership.plan_id')!='' && isset($obj_user->user_type) && $obj_user->user_type=='parent')
        //     {
        //         $enc_plan_id  = base64_encode(Session::get('membership.plan_id'));
        //         $redirect_url = url('/payment/checkout/'.$enc_plan_id);
        //         return redirect($redirect_url);
                
        //     }
        // }
        if(Session::get('membership')!=null && Session::get('membership.plan_id')!='' && isset($obj_user->user_type) && $obj_user->user_type=='parent')
        {
                $enc_plan_id  = base64_encode(Session::get('membership.plan_id'));
                $redirect_url = url('/payment/checkout/'.$enc_plan_id);
                return redirect($redirect_url);
                
        }
        if($this->is_plan_purchased($user_id)==4)
        {
            $redirect_url = url('/parent/dashboard');  
            return redirect($redirect_url);
        }
        $this->manage_user_login($user_id,'signin');
        if ($remember_me != 'on' || $remember_me == null)
        {
          setcookie("remember_me_email", "");
          setcookie("remember_me_token", "");
          setcookie("remember_me_pin_token", "");
          setcookie("is_checked", "");
        }
        else
        {
          setcookie('remember_me_email', $email_mobile);
          if($user_type == 'student'){
            setcookie('remember_me_pin_token', encrypt($pin));
          }
          else{
            setcookie('remember_me_token', encrypt($password));
          }
          setcookie('is_checked','yes');
        }

        $return_url = Session::get('return_url');
        if (isset($return_url) && $return_url != '')
        {
          Session::forget('return_url');
          return redirect(url($return_url));
        }
        return redirect(url('/') . '/' . $user_type . '/dashboard');
      }
      else
      {
        setcookie("remember_me_email", "");
        Session::flash('error', trans('teacher.Invalid_login_credential'));
        return redirect()->back();
      }
    }
    else
    {
      setcookie("remember_me_email", "");
      Session::flash('error', trans('teacher.Invalid_login_credential'));
      return redirect()->back();
    }

    return redirect()->back();
  }
  public function check_parent_purchased_plan($user_id)
  {
        $is_plan_purchased = false;
        $check_is_exist  = TransactionsModel::where('user_id','=',$user_id)
                                          ->where('payment_status','=','paid')
                                          ->where('status','=','active')
                                          ->orderBy('id','desc')
                                          ->count();
        if($check_is_exist>0)
        {
          $is_plan_purchased = true;
        }
        return $is_plan_purchased;
  }
  public function check_plan_expired($user_id)
  {
        $is_plan_expired = false;
        $check_is_exist  = 0;
        $check_is_exist  = TransactionsModel::where('user_id','=',$user_id)
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
                              
  }
  public function is_plan_purchased($user_id)
  {
    $is_plan_purchased = false;
    $obj_transaction = $this->TransactionsModel->where('user_id','=',$user_id)->where('status','=','active')
                                              ->first();
    if($obj_transaction)
    {
      $is_plan_purchased = isset($obj_transaction->plan_id)?$obj_transaction->plan_id:'';
    }
    return $is_plan_purchased;
  }
  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function Signup()
  {
    $data['pageTitle']     = trans('auth.Sign_Up');
    $data['middleContent'] = 'auth.signup';

    return view('front.layout.master')->with($data);
  }


  // Check enrollment code by Jai Thakare
  public function CheckEnrollmentCode(Request $request)
  {
    $data = [];
    $enrollment = $request->input('enrollment'); 
    
    $data = $this->BaseModel->where('enrollment_code', $enrollment)->first();
    
    if(count($data)==0)
    {
      return 'error';
    }
    else
    {
      return 'success';
    }
  }

  // Check enrollment code by Jai Thakare
  public function CheckCoupenCode(Request $request)
  {
    $user_id  = 0;
    $arr_data = $arr_plan_details = $arr_converted_data = []; 
    $reference_settings_arr = $check_uses = $arr_json = [];
    $discount_amount = $total_amount_to_paid_in_usd   = $total_amount_to_paid = '';
    $coupon_code     = $request->input('coupon_code'); 
    $from_currency_code = 'CNY'; $to_currency_code = 'USD';
    if(Auth::check()!=false)
    {
        $user_id = Auth::user()->id; 
    }
    else
    {
        $user_id = base64_decode(Session::get('membership.userid'));
    }
    if(isset($user_id) && $user_id!="")
    {
        $user_arr         = getUserDetails(base64_decode(Session::get('membership.userid')));
        $arr_plan_details = getPlanDetails(Session::get('membership.plan_id'));
    
        $obj_data = $this->CouponsModel->where('coupon_code', $coupon_code)
                                     ->where('status', '1')
                                     ->where('created_by','<>',$user_id)
                                     ->whereRaw('? between start_date and end_date',[date('Y-m-d')])
                                     ->with(['coupon_code_owner_details'=>function($q){
                                        $q->select('id','pin')->where('is_active', 'active')->where('deleted_at', null);
                                     }])                                                                          
                                     ->first();  
        $plan_price         = isset($arr_plan_details['price'])?$arr_plan_details['price']:'';
        //$arr_converted_data = convert_price($from_currency_code,$to_currency_code,$plan_price);
        if(isset($obj_data) && count($obj_data)>0)
        {
          $arr_data         = $obj_data->toArray();
        }
        if(isset($arr_data) && sizeof($arr_data)>0)
        {

          if($this->check_coupen_validity($arr_data)==false)
          {
             $arr_json['status'] = 'expired';
             return json_encode($arr_json);
          }

          $discount_amount    = isset($arr_data['discount_amount'])?$arr_data['discount_amount']:'';

          if($plan_price>=$discount_amount)
          {
            $total_amount_to_paid = $plan_price-$discount_amount;
          }
          else
          {
            $total_amount_to_paid = 0;
          }

          $arr_converted_data   = convert_price($from_currency_code,$to_currency_code,$total_amount_to_paid);
          $reward_amount        = isset($arr_data['reward_amount'])?$arr_data['reward_amount']:'';

          $arr_json['status']                = 'valid';
          $arr_json['per_currency_rate']     = $arr_converted_data['per_currency_rate'];  

          $arr_plan_converted_data   = convert_price($from_currency_code,$to_currency_code,$plan_price);
          $converted_symbol          = isset($arr_plan_converted_data['to_currency_symbol'])?$arr_plan_converted_data['to_currency_symbol']:''; 
        
          $from_currency_symbol  = isset($arr_plan_converted_data['from_currency_symbol'])?$arr_plan_converted_data['from_currency_symbol']:''; 

          $arr_json                          = $arr_data;
          $arr_json['status']                = 'valid';
          $arr_json['discount_amount']       = $discount_amount;
          $arr_json['reward_amount']         = $reward_amount;
          $arr_json['owner']                 = isset($arr_data['coupon_code_owner_details']['id'])?$arr_data['coupon_code_owner_details']['id']:'';
          $arr_json['setting_type']          = isset($arr_data['reference_reward_type'])?$arr_data['reference_reward_type']:'';               
          $arr_json['validity_extension']    = isset($arr_data['validity_extension'])?$arr_data['validity_extension']:'';           
          $arr_json['total_price']                      = $total_amount_to_paid;                       
          $arr_json['total_price_cny_amount']           = $total_amount_to_paid;  
          $arr_json['converted_total_price']            = $arr_converted_data['converted_amount'];            
          $arr_json['without_symbol_per_currency_rate'] = $arr_converted_data['per_currency_rate'];
          $arr_json['is_apply_coupen']                  = 'no';
          $arr_json['per_currency_rate']                = $arr_plan_converted_data['per_currency_rate']; 
          $arr_json['final_converted_rate']             = $arr_plan_converted_data['converted_amount'];  
          $arr_json['from_currency_symbol']             = $from_currency_symbol;  
          $arr_json['to_currency_symbol']               = $converted_symbol;  
          $arr_json['from_currency']                    = isset($arr_plan_converted_data['from_currency'])?$arr_plan_converted_data['from_currency']:''; 
          $arr_json['to_currency']                      = isset($arr_plan_converted_data['to_currency'])?$arr_plan_converted_data['to_currency']:'';  


          /*Session::put('membership.coupon_code',$coupon_code); 
          Session::put('membership.converted_total_price',isset($arr_converted_data['converted_amount'])?$arr_converted_data['converted_amount']:''); 
          Session::put('membership.per_unit_conversion_rate',isset($arr_plan_converted_data['per_currency_rate'])?$arr_plan_converted_data['per_currency_rate']:''); 
          Session::put('membership.coupon_code_owner_id',isset($arr_data['coupon_code_owner_details']['id'])?$arr_data['coupon_code_owner_details']['id']:''); 
          Session::put('membership.from_currency',isset($arr_plan_converted_data['from_currency'])?$arr_plan_converted_data['from_currency']:''); 
          Session::put('membership.to_currency',isset($arr_plan_converted_data['to_currency'])?$arr_plan_converted_data['to_currency']:''); */

        }
        else
        {
          $arr_json['status'] = 'invalid';
        }
    }
    else
    {
       $arr_json['status'] = 'invalid';
    }
    return json_encode($arr_json);

    
  }
  public function check_coupen_validity($arr_data)
  {
    $flag = true;
    if(isset($arr_data) && sizeof($arr_data)>0)
    {
      $coupen_use_count = $this->CouponUsageModel->where('coupon_id',$arr_data['id'])
                                                   ->count();  
      if(isset($arr_data['owner']) && $arr_data['owner']=='admin')
      {
        if($coupen_use_count>=$arr_data['coupon_option'])
        {
          $flag=false;
        }
      }
    }
    else
    {
      $flag =false;
    }
    return $flag;
  }


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function DuplicateEmail(Request $request)
  {
    $email = $request->input('email');
    /*$num   = $this->BaseModel->where('email', $email)->withTrashed()->count();*/
    $num   = $this->BaseModel->where('email', $email);

    if( Auth::user() )
    {
      $num = $num->where('id','!=',Auth::user()->id);
    }

    $num = $num->count();

    if($num > 0)
    {
        return Response::json('error');
    }
    else
    {
        return Response::json('success');
    }

  } // end DuplicateEmail



  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function DuplicateMobile(Request $request)
  {
    $mobile = $request->input('mobile');
    /*$num   = $this->BaseModel->where('contact', $mobile)->withTrashed()->count();*/
    $num = $this->UsersModel->where('contact', $mobile);

    if( Auth::user() )
    {
      $num = $num->where('id','!=',Auth::user()->id);
    }

    $num = $num->count();

    if($num > 0)
    {
        return Response::json('error');
    }
    else
    {
        return Response::json('success');
    }

  } // end DuplicateMobile


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  function ProcessShareClass($class_enrollment_code=false,$userid=false,$email=false)
  {
    $user_details = [];
    if($class_enrollment_code!=false && $userid!=false && $email!=false)
    {
      $class_data = $this->ClassroomsModel->where('class_enrollment_code',$class_enrollment_code)->first();                
      $check_email_exist = $this->UsersModel->where('email',$email)->where('user_type','teacher')->first();                
      if(isset($check_email_exist) && count($check_email_exist)>0)
      {
        $check_already_share = $this->ShareClassModel->where('to_teacher',$email)->where('to_teacher_id','0')->where('classroom_id',$class_data['id'])->first();        
        if(isset($check_already_share) && count($check_already_share)>0)
        { 
          if($check_already_share['from_teacher_id']!=$userid)
          {
            $obj_share_info = $this->ClassroomStudentModel->where('classroom_id',$class_data['id'])->where('teacher_id',$check_already_share['from_teacher_id'])->get();
            
            $user_details = getUserDetails($check_already_share['from_teacher_id']);             
            
            if($obj_share_info)
            {
              $share_info = $obj_share_info->toArray();              

              foreach ($share_info as $key => $value) 
              {
                $insert_arr['classroom_id'] = $value['classroom_id'];
                $insert_arr['student_id']   = $value['student_id'];
                $insert_arr['teacher_id']   = $check_email_exist['id'];
                $this->ClassroomStudentModel->create($insert_arr);
              }

              $arr_noti['message']      = ucwords($user_details['first_name'].' '.$user_details['last_name']).' has shared '.ucfirst($class_data['name']).' class successfully.';
              $arr_noti['from_user_id'] = $check_already_share['from_teacher_id'];
              $arr_noti['to_user_id']   = $userid;
              $arr_noti['url']          = "/teacher/dashboard";
              $arr_noti['is_read']      = "0";
              $status                   = $this->NotificationService->send_notification($arr_noti);
              $this->ShareClassModel->where(['to_teacher' => $email,'from_teacher_id' => $check_already_share['from_teacher_id'],'classroom_id' => $class_data['id']])->update(['to_teacher_id'=>$userid]);               
              //dd('success');
              return true;

            } else { 
              $arr_noti['message']      = 'Problem occured while sharing class';
              $arr_noti['from_user_id'] = $check_already_share['from_teacher_id'];
              $arr_noti['to_user_id']   = $userid;
              $arr_noti['url']          = "/teacher/dashboard";
              $arr_noti['is_read']      = "0";
              $status                   = $this->NotificationService->send_notification($arr_noti);
             
              return false; 
            }
          } else { 
              $arr_noti['message']      = 'Problem occured while sharing class';
              $arr_noti['from_user_id'] = $check_already_share['from_teacher_id'];
              $arr_noti['to_user_id']   = $userid;
              $arr_noti['url']          = "/teacher/dashboard";
              $arr_noti['is_read']      = "0";
              $status                   = $this->NotificationService->send_notification($arr_noti);

              return false; 
            }  
        } else {  return false;  }          
      } else {  return false; }
    } else { return false; }
  }

  function ProcessTranferClass($class_enrollment_code=false,$userid=false,$email=false)
  {
    $user_details = [];
    if($class_enrollment_code!=false && $userid!=false && $email!=false)
    {
        $class_data = $this->ClassroomsModel->where('class_enrollment_code',$class_enrollment_code)->first();       

        $check_email_exist = $this->UsersModel->where('email',$email)->where('user_type','teacher')->first();                

        if(isset($check_email_exist) && count($check_email_exist)>0)
        {               
          $user_details = getUserDetails($class_data['teacher_id']);             
          if($class_data['transfer_id']!=null)
          {
              $arr_noti['message']      = 'Problem occured while transfring class';
              $arr_noti['from_user_id'] = $class_data['teacher_id'];
              $arr_noti['to_user_id']   = $userid;
              $arr_noti['url']          = "/teacher/dashboard";
              $arr_noti['is_read']      = "0";
              $status                   = $this->NotificationService->send_notification($arr_noti);
              return false;
          }
          else    
          {
              $class_data->update(['is_transfer' => 'yes','transfer_id' => $check_email_exist['id']]);

              $new_class_data = $this->ClassroomsModel->create([
                                                              'teacher_id'            => $check_email_exist['id'],
                                                              'is_transfer'           => 'no',
                                                              'transfer_id'           => null,
                                                              'class_enrollment_code' => GenerateEnrollmentCode(),
                                                              'status'                => '1',
                                                              'name'                  => $class_data['name'],
                                                              'slug'                  => $class_data['slug'],
                                                              'subject_id'            => $class_data['subject_id'],
                                                              'grade_id'              => $class_data['grade_id'],
                                                              'start_date'            => $class_data['start_date'],
                                                              'end_date'              => $class_data['end_date'],
                                                              'program_id'            => $class_data['program_id'],
                                                          ]);          
              

              $obj_share_info = $this->ClassroomStudentModel->where('classroom_id',$class_data['id'])->where('teacher_id',$class_data['teacher_id'])->get();
              if($obj_share_info)
              {
                  $share_info = $obj_share_info->toArray(); 

                  foreach ($share_info as $key => $value) 
                  {
                      $insert_arr['classroom_id'] = $new_class_data['id'];
                      $insert_arr['student_id']   = $value['student_id'];
                      $insert_arr['teacher_id']   = $check_email_exist['id'];


                      $this->ClassroomStudentModel->create($insert_arr);
                  }

                  $arr_noti['message']      = ucwords($user_details['first_name'].' '.$user_details['last_name']).' has transfered '.ucfirst($class_data['name']).' class successfully.';
                  $arr_noti['from_user_id'] = $class_data['teacher_id'];
                  $arr_noti['to_user_id']   = $check_email_exist['id'];
                  $arr_noti['url']          = "/teacher/dashboard";
                  $arr_noti['is_read']      = "0";
                  $status                   = $this->NotificationService->send_notification($arr_noti);

                  $this->ClassroomStudentModel->where('classroom_id',$class_data['id'])->where('teacher_id',$class_data['teacher_id'])->delete();
                  return true;
              } else { 
                $arr_noti['message']      = 'Problem occured while transfring class';
                $arr_noti['from_user_id'] = $class_data['teacher_id'];
                $arr_noti['to_user_id']   = $userid;
                $arr_noti['url']          = "/teacher/dashboard";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);
                return false; }
           }
      } else { return false; }
    } else { return false; } 
  }


  public function SignupStore(Request $request)
  {
    $refernce_code = $url = '';
    $arr_user    = $form_data = $arr_rules = array(); $is_user_exits = 0; $check_reference_code=[];
    $arr_session = $arr_memebership = $arr_mail_data = [];
    $arr_rules['users']             = "required";
    $arr_rules['first_name']        = "required|Max:60";
    $arr_rules['last_name']         = "required|Max:60";
    $arr_rules['email']             = "required|email";
    $arr_rules['mobile']            = "required|min:8|max:16";
    $arr_rules['password']          = "required|min:6|max:16";
    $arr_rules['confirm_password']  = "required|same:password";
    $arr_rules['iagree']            = "required";

    $form_data = $request->all();
    $validator = Validator::make($request->all() , $arr_rules);
    if ($validator->fails()) {      
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if($request->input('enrollment')!='') {
        $get_student_details = $this->BaseModel->where('enrollment_code',$request->input('enrollment'))->first();
        if(count($get_student_details)==0) 
        {
          Session::flash('error','Invalid enrollment code');
          return redirect()->back()->withInput();
        }        
    }
    
    $is_user_exits = $this->BaseModel->where('email', $form_data['email'])->where('deleted_at','=',null)->count();

    if ($is_user_exits > 0) {
        Session::flash('error', trans('teacher.Email_already_registered'));
        return redirect()->back()->withInput();
    }

    if($form_data['users']=='parent' || $form_data['users']=='enroll')
    {
      $user_type =  'parent';
    } 
    else
    {
      $user_type =  $form_data['users'];
      $arr_user['pin']  = RandomPin();//if teacher generate it
    }
    $remember_token                   = md5(uniqid(rand() , true));
    $arr_user['user_type']            = $user_type;
    $arr_user['first_name']           = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
    $arr_user['last_name']            = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
    $arr_user['email']                = isset($form_data['email']) ? $form_data['email'] : '';
    $arr_user['contact']              = isset($form_data['mobile']) ? $form_data['mobile'] : '';
    $arr_user['password']             = isset($form_data['password']) ? bcrypt($form_data['password']) : '';    
    $arr_user['is_active']            = 'active';
    $arr_user['is_verify']            = 'no';
    $arr_user['is_email_verify']      = 'no';
    $arr_user['is_active_membership'] = 'no';
    $arr_user['remember_token']       = $remember_token;
    $arr_user['phone_code']           = isset($form_data['phone_code'])?$form_data['phone_code']:'';  
    //$arr_user['reference_user_id']    = isset($check_reference_code['id']) ? $check_reference_code['id'] : '';
    $is_user_registered = $this->BaseModel->create($arr_user);
    if($is_user_registered) 
    {
        $id  = $is_user_registered->id;

        // Newsletter subscribers
        $status = $this->NewsletterService->subscribe($is_user_registered['id'], $form_data['users']);
       
        //Enrollment code signup
        if($request->input('enrollment')!='')
        {
            $get_student_details = $this->BaseModel->where('enrollment_code',$request->input('enrollment'))
                                                  ->first();
            if(count($get_student_details)==0) 
            {
              Session::flash('error',trans('teacher.Invalid_enrollment_code'));
              return redirect()->back()->withInput();
            }
            else
            {
              $student_id   = $get_student_details['id'];
              $student_data = $this->StudentDetailsModel->where('student_id',$student_id)->first();
              if(isset($student_data) && count($student_data)>0)
              {
                $student_data->update(['parent_id'=>$id]);
              }
            }
        }

        // Share or Transfer class signup
        $class_enrollment_code = '';
        if($request->input('classcode')!='' && $request->input('classcode')!=null)
        {
          $class_enrollment_code = base64_decode($request->input('classcode'));
          $process_type          = $request->input('process_type');
          
          if($process_type=='share')
          {
            $this->ProcessShareClass($class_enrollment_code,$id,$form_data['email']);
          }
          if($process_type=='transfer')      
          {
            $this->ProcessTranferClass($class_enrollment_code,$id,$form_data['email']);
          }
        }
        //set membership session if user come from pricing plan
        if($form_data['users'] == 'parent' || $form_data['users']=='enroll') 
        {
            if (Session::get('membership')!=null && Session::get('membership.plan_id')!='' && Session::get('membership.plan_id')!=null) 
            {
                $arr_session = Session::get('membership');
                if(!empty(Session::get('membership.social'))) 
                {
                    $social  = Session::get('membership.social');
                } 
                else 
                {
                    $social  = 'no';
                }

                $arr_memebership = [
                    'plan_id'   => $arr_session['plan_id'],
                    'userid'    => base64_encode($id),
                    'usertoken' => $remember_token,
                    'social'    => $social
                ];
                Session::put('membership',$arr_memebership);         

            } 
        } 
        if(isset($form_data['users']) && $form_data['users']=='parent' && Session::get('membership.plan_id')!=null)
        {
            $plan_id  = Session::get('membership.plan_id');
            $activation_url = '<a target="_blank" href=" '.url('/') . '/user/verify_account/' . base64_encode($id) . '/' . $remember_token.'/'.base64_encode($plan_id).'">Verify Account</a><br/>';
        } 
        else
        {
            $activation_url = '<a target="_blank" href=" '.url('/') . '/user/verify_account/' . base64_encode($id) . '/' . $remember_token.'">Verify Account</a><br/>';
        }
        // Send activation email
        $arr_built_content = [
              'NAME'           => isset($form_data['first_name'])?$form_data['first_name']:'',
              'ACTIVATION_URL' => $activation_url,
              'PROJECT_NAME'   => config('app.project.name'),
          ];
          $arr_mail_data['email_template_id'] = '1';
          $arr_mail_data['arr_built_content'] = $arr_built_content;
          $arr_mail_data['user']              = [
                                                  'email'      => $form_data['email'],
                                                  'first_name' => $form_data['first_name']
                                                ];
          $email_status  = $this->EmailService->send_mail($arr_mail_data);

          // Store notification for admin
          if(isset($form_data['users']) && $form_data['users']=='parent')
          {
              $url = '/admin/users/parent';
          }
          else
          {
              $url = '/admin/users/teacher';
          }
          $arr_noti['message']      = $form_data['first_name'].' '.$form_data['last_name'].' has successfully registered as a '.$form_data['users'];
          $arr_noti['from_user_id'] = $id;
          $arr_noti['to_user_id']   = 1;
          $arr_noti['url']          = $url;
          $arr_noti['is_read']      = "0";
          $status                   = $this->NotificationService->send_notification($arr_noti);
          
          if(isset($form_data['users']) && $form_data['users']=='teacher')
          {
            $pin = isset($arr_user['pin'])?$arr_user['pin']:'';
            $arr_coupen = $arr_coupon_info = [];
            $arr_coupen['pin']          = $pin;
            $arr_coupen['user_id']      = $id;
            $arr_coupen['type']         = 'TEACHER';
            $arr_coupen['first_name']   = $form_data['first_name'];
            $arr_coupen['last_name']    = $form_data['last_name'];
            $this->storeCouponDetails($arr_coupen);
            $arr_coupon_info            = $this->get_coupon_info();
            $this->EmailService->send_refer_email($arr_user,$pin,$arr_coupon_info);
          }

          Session::flash('success', trans('teacher.registration_success_message'));
          return redirect(url('/signin'));

    } 
    else 
    {
      Session::flash('error', trans('teacher.registration_error_message'));
      return redirect()->back()->withInput();
    }
  }
  public function get_coupon_info()
  {
      $arr_ref_details = [];
      $obj_ref_data    = $this->ReferenceCodeModel->where('coupen_type','=','TEACHER')->first();
      if($obj_ref_data)
      {
        $arr_ref_details = $obj_ref_data->toArray();
      }
      return $arr_ref_details;
  }
  public function storeCouponDetails($arr_data)
  {
      $extension  = '';
      $user_type  = isset($arr_data['type'])?$arr_data['type']:'TEACHER';
      $reference_settings_arr  = $this->ReferenceCodeModel
                                                 ->where('coupen_type','=',$user_type)
                                                 ->first();

    if($reference_settings_arr)
    {
        if($reference_settings_arr['reference_reward_type']=='both')
        {
          $extension = 'Extension of '.$reference_settings_arr['validity_extension'].' months and Incentive of '.$reference_settings_arr['reward_amount'];
        }
        elseif($reference_settings_arr['reference_reward_type']=='validity_extension')
        {
          $extension = 'Extension of '.$reference_settings_arr['validity_extension'].' months';
        }
        else
        {
          $extension = 'Incentive of '.$reference_settings_arr['reward_amount'];
        }
         
        $insert_array = [   'created_by'               => isset($arr_data['id'])?$arr_data['id']:'',
                            'coupon_code'              => isset($arr_data['pin'])?$arr_data['pin']:'',
                            'status'                   => '1',
                            'title'                    => $extension,
                            'reward_type_for_referral' => isset($reference_settings_arr['reference_reward_type'])?$reference_settings_arr['reference_reward_type']:'',
                            'reward_amount'            => isset($reference_settings_arr['reward_amount'])?$reference_settings_arr['reward_amount']:'',
                            'validity_extension'       => isset($reference_settings_arr['validity_extension'])?$reference_settings_arr['validity_extension']:'',
                            'discount_amount'          => isset($reference_settings_arr['discount_amount'])?$reference_settings_arr['discount_amount']:'',
                            'start_date'               => isset($reference_settings_arr['start_date'])?$reference_settings_arr['start_date']:'',
                            'end_date'               => isset($reference_settings_arr['end_date'])?$reference_settings_arr['end_date']:'',
                            'coupen_type'             => $user_type,
                            'owner'                   => $arr_data['first_name'].' '.$arr_data['last_name']];
        $this->CouponsModel->insert($insert_array);   
    }
    return true;
  }


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 17/07/2018
  | Output    : 
  */

  public function SignupOTP($enc_id = false)
  {
    if(isset($enc_id) && !empty($enc_id))
    {
      $data['userid'] = $enc_id;
    }

    $data['pageTitle']     = trans('auth.Verify_OTP');
    $data['middleContent'] = 'auth.signup_otp';

    return view('front.layout.master')->with($data);
  } // end SignupOTP



  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 17/07/2018
  | Output    : 
  */

  public function SignupOTPProcess(Request $request)
  {
      $arr_user = $form_data = $arr_rules = array();

      $arr_rules['signup_otp'] = "required|numeric";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data = $request->all();
      $user_id   = isset($form_data['user_id']) ? base64_decode($form_data['user_id']) : '';
      $otp       = isset($form_data['signup_otp']) ? $form_data['signup_otp'] : '';

      $obj_user = $this->BaseModel->where('id', $user_id)->where('password_reset_code', $otp)->first();
      if (count($obj_user) > 0)
      {
          $arr_user = $obj_user->toArray();

          $arr_data['is_mobile_verify']    = 'yes';
          $arr_data['password_reset_code'] = null;
          $updateCode                      = $this->BaseModel->where('id', $user_id)->update($arr_data);

          Session::flash('success', trans('teacher.verification_complete_success'));
          return redirect(url('/signin'));
      }
      else
      {
        Session::flash('error', trans('teacher.You_have_entered_wrong_OTP'));
        return redirect()->back();
      }

  } // end SignupOTPProcess



  /*public function Pricing(Request $request)
  {
    $pricing_arr = []; $enc_id = $token = '';

    $enc_id = $request->input('enc_id');
    $token  = $request->input('token');

    $pricing_obj = $this->SubscriptionPlanModel->with(['subscription_plan_translation'=>function($q){
      $q->where('locale', App::getLocale());
    }])->get();

    if(isset($pricing_obj) && count($pricing_obj)>0)
    {
      $pricing_arr = $pricing_obj->toArray();
    }
    
    $data['pageTitle']     = 'Pricing';
    $data['middleContent'] = 'pricing';
    $data['pricingData']   = $pricing_arr;
    $data['userid']        = $enc_id;
    $data['usertoken']     = $token;

    return view('front.layout.master')->with($data);
  }*/


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function VerifyAccount($enc_user_id, $remember_token,$enc_plan_id=false)
  {

    $update_status = $check_verification_token = $redirect_url='';
    $user_id       = base64_decode($enc_user_id);
    $obj_user      = $this->BaseModel->where('id', $user_id)->first();
    if (isset($obj_user->is_verify) && $obj_user->is_verify == 'yes')
    {
      Session::flash('error', 'Your account is already verified.');
      return redirect(url('/signin'));
    }
    else
    {
      $check_verification_token = $obj_user->where('remember_token','=',$remember_token)->first();
      if ($check_verification_token)
      {
        $update_status = $check_verification_token->update(['is_verify' => 'yes', 'remember_token' => null]);
      }
    }
    if($update_status)
    {
          if(isset($obj_user->user_type) && $obj_user->user_type=='parent')
          {
            
              if(isset($enc_plan_id) && $enc_plan_id!=false)
              {
                 $plan_id      = base64_decode($enc_plan_id);
                 $session = array(
                                  'plan_id'   => $plan_id,
                                  'userid'    => $enc_user_id,
                                  'usertoken' => $remember_token,
                                  );
                Session::put('membership',$session);
                Session::flash('success', trans('teacher.Account_verified_successfully'));
                $redirect_url = url('/payment/checkout/'.$enc_plan_id);
              }
              else
              {
                  Session::flash('success', trans('teacher.verification_message_with_price'));
                  $redirect_url = url('/pricing?enc_id='.$enc_user_id.'&remember_token='.$remember_token);
              }
          }
          elseif(isset($obj_user->user_type) && $obj_user->user_type=='teacher')
          {
             Session::flash('success', trans('teacher.verification_message'));
             $redirect_url = url('/').'/signin';
          }
          else
          {
              $redirect_url = url('/').'/signin';
          }
    }
    else
    {
      $redirect_url = url('/').'/signin';
      Session::flash('error', trans('teacher.Error_occured_account_verification'));
    }
    return redirect($redirect_url);
  }

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function Logout()
  {
    if(!empty(Auth::user()))
    {
      $user_id      = Auth::user()->id;
      $this->manage_user_login($user_id,'signout');
    }
    Auth::logout();
    $lang = Session::get('locale'); 
    Session::flush();
    Session::put('locale',$lang);
    return redirect(url('/') . '/signin');
  }

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPassword()
  {
    $data['pageTitle']     = trans('auth.Forget_Password');
    $data['middleContent'] = 'auth.forget_password';

    return view('front.layout.master')->with($data);
  } // end ForgetPassword

  

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ProcessForgetPassword(Request $request)
  {
    $arr_user = $form_data = $arr_rules = array();
    
    $email_mobile = $request->input('email_mobile');

    if(is_numeric($email_mobile))
    {
      $forget_with = 'contact';
      $arr_rules['email_mobile'] = "required|numeric";
    }
    else
    {
      $forget_with = 'email';
      $arr_rules['email_mobile'] = "required|email";
    }

    $validator = Validator::make($request->all() , $arr_rules);
    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator)->withInput();
    }


    $arr_user = $this->BaseModel->where($forget_with, $email_mobile)->first();

    if($arr_user)
    {
        $check_user = $arr_user->toArray();

        if($check_user['is_active'] == 'active' )
        {

          // for mobile
          if(is_numeric($email_mobile))
          {
            $arr_data['password_reset_code'] = GenerateOTP();
            $updateCode                      = $this->BaseModel->where('id',$check_user['id'])->update($arr_data);

            return redirect(url('/forget-password/otp'));
          }

          // for email
          else
          {
              $arr_data['password_reset_code']    = str_random(16);
              $updateCode                         = $this->BaseModel->where('id',$check_user['id'])->update($arr_data);

              $user_name                          = $check_user['first_name'];
              $user_details                       = [
                                                      'first_name' => $check_user['first_name'],
                                                      'email'      => $check_user['email']
                                                    ];

              $arr_built_content                  = [
                                                      'NAME'         => $user_name,
                                                      'RESET_LINK'   => url('/reset-password').'/'.base64_encode($check_user['id']).'/'.base64_encode($arr_data['password_reset_code']),
                                                      'PROJECT_NAME' => config('app.project.name')
                                                    ];

              $arr_mail_data                      = [];
              $arr_mail_data['email_template_id'] = '2';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $user_details;

              $email_status = $this->EmailService->send_mail($arr_mail_data);
              //Mail::queue(new SendMailable($arr_mail_data));

              Session::flash('success',trans('teacher.reset_password_link_send_success'));
              return redirect()->back();
          }

        }
        else
        {
          Session::flash('error', trans('teacher.error_account_block'));
          return redirect()->back();
        }
    }
    else
    {
        Session::flash('error', trans('teacher.Account_with_email_does_not_exists'));
        return redirect()->back();
    }

  } // end ProcessForgetPassword



  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPasswordOTP()
  {
    $data['pageTitle']     = trans('auth.Verify_OTP');
    $data['middleContent'] = 'auth.otp';

    return view('front.layout.master')->with($data);
  } // end ForgetPasswordOTP



  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPasswordOTPProcess(Request $request)
  {
      $arr_user = $form_data = $arr_rules = array();

      $arr_rules['forget_password_otp'] = "required|numeric";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data = $request->all();
      $otp       = isset($form_data['forget_password_otp']) ? $form_data['forget_password_otp'] : '';

      $obj_user = $this->BaseModel->where('password_reset_code', $otp)->first();
      if (count($obj_user) > 0)
      {
          $arr_user = $obj_user->toArray();

          $data['enc_id']         = isset($arr_user['id']) ? base64_encode($arr_user['id']) : '';
          $data['enc_reset_code'] = isset($arr_user['password_reset_code']) ? base64_encode($arr_user['password_reset_code']) : '';
          $data['pageTitle']      = 'Reset Password';
          $data['middleContent']  = 'auth.reset_password';

          return view('front.layout.master')->with($data);
      }
      else
      {
        Session::flash('error', trans('teacher.You_have_entered_wrong_OTP'));
        return redirect()->back();
      }

  } // end ForgetPasswordOTPProcess


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ResetPassword($enc_id, $enc_reset_code)
  {
    if( $enc_id != '' && $enc_reset_code != '' )
    {
      $user_id    = base64_decode($enc_id);
      $reset_code = base64_decode($enc_reset_code);

      $user_cnt   = $this->BaseModel->where('id', $user_id)->where('password_reset_code', $reset_code)->get()->count();

      if(isset($user_cnt) && $user_cnt > 0)
      {
        $data['enc_id']         = $enc_id;
        $data['enc_reset_code'] = $enc_reset_code;
        $data['pageTitle']      = 'Reset Password';
        $data['middleContent']  = 'auth.reset_password';

        return view('front.layout.master')->with($data);
      }
      else
      {
        Session::flash('error',trans('teacher.Password_link_expired'));
      }
    }
    else
    {
      Session::flash('error', trans('teacher.Invalid_reset_password_link'));
    }
    return redirect(url('signin'));
  } // end ResetPassword


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ProcessResetPassword(Request $request)
  {
      $arr_user = $form_data = $arr_rules = array();

      $arr_rules['password']         = "required|min:6|max:16";
      $arr_rules['confirm_password'] = "required|same:password";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data                       = $request->all();

      $user_id                         = isset($form_data['enc_id']) ? base64_decode($form_data['enc_id']) : '';
      $reset_code                      = isset($form_data['enc_reset_code']) ? base64_decode($form_data['enc_reset_code']) : '';

      $arr_user['is_verify']           = 'yes';
      $arr_user['password']            = isset($form_data['password']) ? bcrypt($form_data['password']) : '';
      $arr_user['password_reset_code'] = '';

      $is_user_update = $this->BaseModel->where('id', $user_id)->where('password_reset_code', $reset_code)->update($arr_user);
      if ($is_user_update)
      {
        // Store notification for user
        $arr_noti['message']      = 'Your password was successfully reset.';
        $arr_noti['from_user_id'] = 1;
        $arr_noti['to_user_id']   = $user_id;
        $arr_noti['url']          = "";
        $arr_noti['is_read']      = "0";
        $status                   = $this->NotificationService->send_notification($arr_noti);

        Session::flash('success', trans('teacher.Your_password_was_successfully_reset'));
        return redirect(url('/signin'));
      }
      else
      {
        Session::flash('error', trans('teacher.Problem_occured_while_resetting_password'));
        return redirect()->back();
      }

  } // end ProcessResetPassword


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPin()
  {
    $data['pageTitle']     = trans('auth.Forgot_Pin');
    $data['middleContent'] = 'auth.forget_pin';

    return view('front.layout.master')->with($data);
  } // end ForgetPin


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPinProcess(Request $request)
  {
    $arr_user = $form_data = $arr_rules = array();
    
    $email_mobile = $request->input('email_mobile');

    if(is_numeric($email_mobile))
    {
      $forget_with = 'contact';
      $arr_rules['email_mobile'] = "required|numeric";
    }
    else
    {
      $forget_with = 'email';
      $arr_rules['email_mobile'] = "required|email";
    }

    $validator = Validator::make($request->all() , $arr_rules);
    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator)->withInput();
    }


    $arr_user = $this->BaseModel->where($forget_with, $email_mobile)->first();

    if($arr_user)
    {
        $check_user = $arr_user->toArray();
        if($check_user['user_type']=='parent')
        {
          if($check_user['is_active'] == 'active')
          {
              $studentDetails = $this->StudentDetailsModel->whereHas('student_data')
                                                          ->with(['student_data'=>function($query){
                                                              $query->select('id','first_name','last_name','pin');
                                                          }])
                                                          ->where('added_by',$check_user['id'])
                                                          ->get()->toArray();
              
              if(isset($studentDetails) && count($studentDetails)<=0){
                  Session::flash('error',trans('No student is added yet.'));
                  return redirect()->back();
              }
              // for mobile
              if(is_numeric($email_mobile))
              {
                //Write here code for sending sms to parent contact number
                Session::flash('success',trans('teacher.SMS_has_been_sent_on_your_number_for_PIN'));
                return redirect()->back();
              }
              // for email
              else
              {
                  $studentPIN = '';
                  if(count($studentDetails)>0)
                  {
                      $studentPIN .= '<table border="2">';
                        $studentPIN .= '<tr><td>Name</td><td>PIN</td></tr>';

                      foreach($studentDetails as $students)
                      {
                        $studentPIN .= '<tr>';
                        $studentPIN .= '<td>'.$students['student_data']['first_name'].' '.$students['student_data']['last_name'].'</td>';
                        $studentPIN .= '<td>'.$students['student_data']['pin'].'</td><br/>';
                        $studentPIN .= '</tr>';
                      }
                      $studentPIN .= '</table>';

                      $arr_built_content = [
                                              'NAME'           => $check_user['first_name'],
                                              'STUDENTPIN'     => $studentPIN,
                                              'PROJECT_NAME'   => config('app.project.name')
                                           ];

                      $arr_mail_data                      = [];
                      $arr_mail_data['email_template_id'] = '3';
                      $arr_mail_data['arr_built_content'] = $arr_built_content;
                      $arr_mail_data['user']              = [
                                                              'email'      => $check_user['email'],
                                                              'first_name' => $check_user['first_name']
                                                            ];
                      $email_status  = $this->EmailService->send_mail($arr_mail_data);
                  }
                  Session::flash('success',trans('teacher.email_has_sent_to_you_with_your_students'));
                  return redirect()->back();
              }
            }
          else
          {
            Session::flash('error', trans('teacher.error_account_block'));
            return redirect()->back();
          }
        }
        else
        {
          Session::flash('error', trans('teacher.Please_enter_parent_email_to_get_PIN'));
          return redirect()->back();
        }
        
    }
    else
    {
        Session::flash('error', trans('teacher.Account_with_email_does_not_exists'));
        return redirect()->back();
    }

  } // end ForgetPinProcess



  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPinOTP($enc_id = false)
  {
    if(isset($enc_id) && !empty($enc_id))
    {
      $data['userid'] = $enc_id;
    }

    $data['pageTitle']     = trans('auth.Verify_OTP');
    $data['middleContent'] = 'auth.forget_pin_otp';

    return view('front.layout.master')->with($data);
  } // end ForgetPinOTP


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 29/06/2018
  | Output    : Success or Error
  */

  public function ForgetPinOTPProcess(Request $request)
  {
      $arr_user = $form_data = $arr_rules = array();

      $arr_rules['forget_password_otp'] = "required|numeric";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data = $request->all();
      $otp       = isset($form_data['forget_password_otp']) ? $form_data['forget_password_otp'] : '';

      $obj_user = $this->BaseModel->where('password_reset_code', $otp)->first();
      if (count($obj_user) > 0)
      {
          $arr_user = $obj_user->toArray();

          $data['enc_id']         = isset($arr_user['id']) ? base64_encode($arr_user['id']) : '';
          $data['enc_reset_code'] = isset($arr_user['password_reset_code']) ? base64_encode($arr_user['password_reset_code']) : '';
          $data['pageTitle']      = trans('auth.Reset_Password');
          $data['middleContent']  = 'auth.reset_password';

          return view('front.layout.master')->with($data);
      }
      else
      {
        Session::flash('error', trans('teacher.You_have_entered_wrong_OTP'));
        return redirect()->back();
      }

  } // end ForgetPinOTPProcess


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 
  | Output    : 
  */

  public function SocialLogin($social = false, $type = false)
  {
      if(!empty($social) && $social != '' && !empty($type) && $type != '' && $type != 'student')
      {
          Session::put('user_type', $type);
          return Socialize::driver($social)->redirect();
      }
      else if(!empty($social) && $social != '' && !empty($type) && $type != '' && $type == 'student')
      {
          Session::flash('error', trans('teacher.Student_cant_use_social_signin'));
          return redirect()->back();
      }
      else
      {
          Session::flash('error',trans('parent.something_went_wrong'));
          return redirect()->back();
      }
  } // end SocialLogin


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 
  | Output    : 
  */

  public function Callback($social)
  {
     
    try 
    {
      $userSocial = Socialize::driver($social)->user();   

    } catch (Exception $e) {
        Session::flash('error', trans('teacher.Error_while_social_login'));
        return redirect(url('/signin'));
    }

    if (str_word_count($userSocial->name) > 1) {
        $user_name  = explode(' ',trim($userSocial->name));
        $first_name = $user_name[0];
        $last_name  = $user_name[1];
    } else {
        $first_name = $userSocial->name;
        $last_name  = '';
    }

    $user_email = $userSocial->email;
    $user_type  = Session::get('user_type');

    $user       = $this->UsersModel->where(['email' => $user_email])->first();

    if($user) 
    {
       if (isset($user->is_active) && $user->is_active == 'block') {
            
            Session::flash('error', trans('teacher.error_account_block'));
            return redirect(url('/signin'));

        } else if (isset($user->is_verify) && $user->is_verify == 'no') {
            
            Session::flash('error', trans('teacher.error_account_verified'));
            return redirect(url('/signin'));

        } else if($user->user_type != $user_type) {
            
            Session::flash('error', trans('teacher.our_account_found_in_system'));
            return redirect(url('/signin'));
            
        }
        Auth::login($user);
        Session::flash('success','You have been login successfully.');
        return redirect(url('/') . '/' . $user_type . '/dashboard');
    } 
    else 
    {
        $remember_token                   = md5(uniqid(rand() , true));
        $arr_user['user_type']            = isset($user_type) ? $user_type : '';
        $arr_user['first_name']           = isset($first_name) ? ucfirst($first_name) : '';
        $arr_user['last_name']            = isset($last_name) ? ucfirst($last_name) : '';
        $arr_user['email']                = isset($user_email) ? $user_email : '';
        $arr_user['contact']              = null;
        $arr_user['password']             = null;
        $arr_user['pin']                  = RandomPin();
        $arr_user['is_active']            = 'active';
        $arr_user['is_verify']            = 'yes';
        $arr_user['is_social']            = 'yes';
        $arr_user['social_via']           = isset($social) && !empty($social) ? $social : '';
        $arr_user['is_email_verify']      = 'yes';
        $arr_user['is_active_membership'] = 'no';
        $arr_user['remember_token']       = $remember_token;

        $is_user_registered = $this->BaseModel->create($arr_user);
        if ($is_user_registered) 
        {
           //$status = $this->MailchimpService->subscribe($user_email);
            //$status = $this->NewsletterService->subscribe($is_user_registered['id'], $user_type);
            $redirect_url = '';
            if($user_type=='parent') 
            {
              $redirect_url = '/admin/users/parent';
            }
            else
            {
              $redirect_url = '/admin/users/teacher';
            }
            
            $id     = $is_user_registered->id;
            $arr_noti['message']      = $first_name.' '.$last_name.' has successfully completed registration for '.$user_type;
            $arr_noti['from_user_id'] = $id;
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = $redirect_url;
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

              if($user_type == 'parent') 
              {
                    if(Session::get('membership') != null && Session::get('membership.plan_id') != '' && Session::get('membership.plan_id') != null) 
                     {
                          $session_arr = Session::get('membership');

                          $val = [
                              'plan_id'   => $session_arr['plan_id'],
                              'userid'    => base64_encode($id),
                              'usertoken' => $remember_token,
                              'social'    => 'yes'
                          ];

                          Session::put('membership',$val);                      
                          return redirect(url('/pricing?enc_id='.base64_encode($id).'&token='.$remember_token.'&url=success'));

                      }
                      else 
                      {
                          $val = ['social'    => 'yes'];
                          Session::put('membership',$val);
                          return redirect(url('/pricing?enc_id='.base64_encode($id).'&token='.$remember_token));
                      }
                } 
                else 
                {
                    $user_data = $this->BaseModel->where('id', $id)->where('user_type', $user_type)->first();
                    Auth::login($user_data);
                    return redirect(url('/') . '/' . $user_type . '/dashboard');
                }
          }
          else 
          {
            Session::flash('error', trans('parent.something_went_wrong'));
            return redirect(url('/signin'));
          }
            
    } 
            
          
  }
      /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 
  | Output    : 
  */

  public function ResendOTP()
  {
    $data['pageTitle']     = trans('auth.Resend_OTP');
    $data['middleContent'] = 'auth.resend_otp';

    return view('front.layout.master')->with($data);
  } // end ResendOTP


  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 
  | Output    : 
  */

  public function RequestResendOTP(Request $request)
  {
      $form_data = $arr_rules = array();

      $arr_rules['resend_mobile'] = "required|numeric";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
          Session::flash('error', trans('parent.All_fields_are_required'));
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data = $request->all();
      $mobile    = isset($form_data['resend_mobile']) ? $form_data['resend_mobile'] : '';

      $arr_data['password_reset_code'] = GenerateOTP();
      $updateCode                      = $this->UsersModel->where('contact', $mobile)->update($arr_data);

      if($updateCode)
      {
          $message = 'Your mobile number verification OTP : '.$arr_data['password_reset_code'];
          $this->SMSService->send_SMS($message, $mobile);

          Session::put('verify_mobile', $mobile);

          return redirect( url('/resend-otp/process') );
      }
      else
      {
          Session::flash('error', trans('teacher.User_with_mobile_does_not_exists'));
          return redirect()->back();
      }
  } // end RequestResendOTP


  public function ProcessResendOTP()
  {
      $data['pageTitle']     = trans('auth.OTP_Verification');
      $data['middleContent'] = 'auth.process_resend_otp';

      return view('front.layout.master')->with($data);
  } // end ProcessResendOTP

  /*
  | Function  :
  | Author    : Deepak Arvind Salunke
  | Date      : 
  | Output    : 
  */

  public function ChangeResendOTP(Request $request)
  {
      $form_data = $arr_rules = array();

      $arr_rules['verify_otp'] = "required|numeric";

      $validator = Validator::make($request->all() , $arr_rules);
      if ($validator->fails())
      {
          Session::flash('error', trans('parent.All_fields_are_required'));
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $form_data = $request->all();
      $otp       = isset($form_data['verify_otp']) ? $form_data['verify_otp'] : '';
      $mobile    = Session::get('verify_mobile');

      $count = $this->UsersModel->where('contact', $mobile)->where('password_reset_code', $otp)->count();
      if($count > 0)
      { 
          $arr_user['is_mobile_verify']    = 'yes';
          $arr_user['password_reset_code'] = null;
          $this->UsersModel->where('contact', $mobile)->where('password_reset_code', $otp)->update($arr_user);

          Session::flash('success', trans('teacher.verification_complete_success'));
          return redirect( url('/resend-otp') );
      }
      else
      {
          Session::flash('error', trans('teacher.You_have_entered_wrong_OTP'));
          return redirect()->back();
      }

  } 
  public function manage_user_login($user_id,$type=false)
  {
       $status = '';
       $arr_time_data  = [];
       $current_date   = date('Y-m-d');
       $current_time   = date('H:i:s');
       $obj_user_login =  $this->UserLoginHistoryModel->where('user_id','=',$user_id)
                                                      ->whereDate('login_date','=',$current_date)->first();
       if($obj_user_login)
       {
          $end_time   = isset($obj_user_login->end_time)?$obj_user_login->end_time:'';
          $start_time = isset($obj_user_login->start_time)?$obj_user_login->start_time:'';
          $total_time = isset($obj_user_login->total_time)?$obj_user_login->total_time:'';
        
          if(isset($type) && $type=='signout')
          {
            $time_diff = gmdate("H:i:s",strtotime($current_time)-strtotime($start_time));
            if($total_time!=null)
            {
                
                $secs              = strtotime($time_diff)-strtotime("00:00:00");
                $total_system_time = date("H:i:s",strtotime($total_time)+$secs);

            }
            else
            {
               $total_system_time = $time_diff;
            }
    
            $status     = $obj_user_login->update(['end_time'=>$current_time,'total_time'=>$total_system_time]);
          }
          else if(isset($type) && $type=='signin')
          {
            $status     = $obj_user_login->update(['start_time'=>$current_time]);
          }
         
       }
       else
       {
          $arr_time_data['user_id']    = $user_id;
          $arr_time_data['login_date'] = $current_date;
          $arr_time_data['start_time'] = $current_time;

          $status = $this->UserLoginHistoryModel->create($arr_time_data);

       }
       return $status; 
  }
}
