<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\SMSService;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;

use Validator;
use Session;
use Auth;
use Hash;
use Response;

class AccountSettingController extends Controller
{
    public function __construct(
                                LanguageService     $language_service,
                                UsersModel          $users_model,
                                NotificationService $notification_service,
                                SMSService          $sms_service
                            )
    {
        $this->arr_view_data                 = [];
        $this->module_title                  = "Account Setting";

        $this->LanguageService               = $language_service;
        $this->UsersModel                    = $users_model;
        $this->NotificationService           = $notification_service;
        $this->SMSService                    = $sms_service;

        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }


    /*
    | Function  : Get user data
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Show user data
    */

    public function MyProfile()
    {
        $data['user_data']                     = Auth::user();
        $data['arr_lang']                      = $this->LanguageService->get_all_language();
        $data['profile_image_base_img_path']   = $this->profile_image_base_img_path;
        $data['profile_image_public_img_path'] = $this->profile_image_public_img_path;

        $data['user_type']                     = 'parent';
        $data['parentTitle']                   = trans('parent.Dashboard');
        $data['pageTitle']                     = trans('parent.Account_Setting');
        $data['subPageTitle']                  = trans('parent.My_Profile');
        $data['subPageTitle1']                 = trans('parent.Change_Password');
        $data['middleContent']                 = 'parent.account-setting.my-profile';

        return view('front.layout.master')->with($data);
    } // end MyProfile


    /*
    | Function  : Get user data
    | Author    : Deepak Arvind Salunke
    | Date      : 03/07/2018
    | Output    : Show user data
    */

    public function UpdateProfile(Request $request)
    {
        $arr_rules                       = array();
        $arr_rules['first_name']         = "required";
        $arr_rules['last_name']          = "required";
        //$arr_rules['mobile']             = "required|min:7|max:16";
        $arr_rules['address']            = "required|max:255";
        $arr_rules['gender']             = "required";
        $arr_rules['preferred_language'] = "required";

        $file_name = "";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $old_image = $request->input('oldimage');
        
        if($request->hasFile('profile_image'))
        {
            $file_name = $request->input('profile_image');
            $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('profile_image')->move($this->profile_image_base_img_path , $file_name);
                if($isUpload)
                {
                    if ($old_image != "" && $old_image != null) 
                    {
                        if (file_exists($this->profile_image_base_img_path.$old_image))
                        {
                            @unlink($this->profile_image_base_img_path.$old_image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error',trans('auth.Invalid_File_type'));
                return redirect()->back();
            }
        }
        else
        {
            $file_name = $old_image;
        }

        if($request->has('cam_image') && ($request->input('cam_image')!='' && $request->input('cam_image')!=null))
        {
            $file_obj   = $request->input('cam_image');
            $file_obj   = str_replace('data:image/jpeg;base64,', '', $file_obj);
            $file_obj   = str_replace(' ', '+', $file_obj);
            $file       = base64_decode($file_obj);
            $file_name  = sha1(uniqid().uniqid()).'.jpeg';
            $file_place = $this->profile_image_base_img_path.$file_name;
            $isUpload   = file_put_contents($file_place, $file);
            if($isUpload)
            {
                if ($old_image != "" && $old_image != null) 
                {
                    if (file_exists($this->profile_image_base_img_path.$old_image))
                    {
                        @unlink($this->profile_image_base_img_path.$old_image);
                    }
                }
            }
        }

        $user_details = "";
        $user_details = Auth::user();
       
        if(isset($user_details->id) && !empty($user_details->id))
        {
            $user_id = $user_details->id;
        }
        else
        {
            $user_id = 0;
        }

        $arr_data['profile_image']      = $file_name;
        $arr_data['first_name']         = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']          = trim(ucfirst(strtolower($request->input('last_name'))));
        //$arr_data['contact']            = trim($request->input('mobile'));
        $arr_data['address']            = trim($request->input('address'));
        $arr_data['gender']             = trim($request->input('gender',''));
        $arr_data['preferred_language'] = trim($request->input('preferred_language',''));
        $arr_data['phone_code']         = trim($request->input('phone_code',''));
        $obj_data = $this->UsersModel->where('user_type', 'parent')->where('id',$user_id)->update($arr_data);
        if($obj_data)
        {
            // Store notification for parent
            $arr_noti['message']      = trans('parent.Profile_updated_successfully');
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $user_id;
            $arr_noti['url']          = "/parent/account-setting/my-profile";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success',trans('parent.Profile_updated_successfully'));
        }
        else
        {
            Session::flash('error',trans('parent.Problem_occurred_updating_profile'));
        }
      
        return redirect()->back();

    } // end UpdateProfile

    /*
    | Function  : Parent Change Password
    | Author    : Deepak Arvind Salunke
    | Date      : 03/07/2018
    | Output    : Show Page
    */

    public function ChangePassword()
    {
        $data['pageTitle']                     = trans('parent.Change_Password');
        $data['middleContent']                 = 'parent.account-setting.change-password';
        $data['user_type']                     = 'parent';
        $data['parentTitle']                   = trans('parent.Dashboard');
        return view('front.layout.master')->with($data);
    } // end ChangePassword


    /*
    | Function  : Parent Update Password
    | Author    : Deepak Arvind Salunke
    | Date      : 03/07/2018
    | Output    : Success or Error
    */

    public function UpdatePassword(Request $request)
    {
        $arr_rules                         = array();
        $arr_rules['current_password']     = "required|min:6|max:16";
        $arr_rules['new_password']         = "required|min:6|max:16";
        $arr_rules['confirm_new_password'] = "required|min:6|max:16";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $current_password = trim($request->input('current_password'));
        $new_password     = trim($request->input('new_password'));

        if(Hash::check($current_password, Auth::user()->password)) 
        {
            $arr_user['password'] = isset($new_password) && !empty($new_password) ? bcrypt($new_password) : '';

            $user_id = Auth::user()->id;
            $update = $this->UsersModel->where('id', $user_id)->update($arr_user);

            if($update)
            {
                // Store notification for parent
                $arr_noti['message']      = trans('parent.Password_change_successfully');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $user_id;
                $arr_noti['url']          = "/parent/account-setting/my-profile";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                Session::flash('success',trans('parent.Password_change_successfully'));
                Auth::logout();
                return redirect(url('/') . '/signin');
            }
            else
            {
                Session::flash('error',trans('parent.Error_occured_password_change'));

            }
        }
        else
        {
            Session::flash('error',trans('parent.Password_not_match'));

        }
        return redirect()->back();

    } // end UpdatePassword

    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Success or Error
    */

    public function RequestOTP(Request $request)
    {
        $result              = '';
        $arr_rules           = $arr_data = $arr_json = array();
        $arr_rules['mobile'] = "required|min:7|max:16";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            return $result = 'error';
        }
        $user_id        = Auth::user()->id;
        $form_data      = $request->all();
        $phone_code_id  = isset($form_data['phone_code'])?$form_data['phone_code']:'';
        $mobile_number  = isset($form_data['mobile'])?$form_data['mobile']:'';
        $arr_phone_code = get_country_code_details($phone_code_id);
        $phone_code     = isset($arr_phone_code['phonecode'])?$arr_phone_code['phonecode']:'';
        $otp_code       = GenerateOTP();
        $user_data      = Auth::user();

        if(isset($user_data->contact) && $user_data->contact!="" && $user_data->contact==$mobile_number)
        {
            Session::flash('error', trans('parent.Can_not_sent_on_same_number'));
            $arr_json['status'] = 'already_verified';
            return response()->json($arr_json);
        }
        $arr_data['password_reset_code'] = $otp_code;
        $updateCode                      = $this->UsersModel->where('id', $user_id)->update($arr_data);
        Session::put('new_mobile',$mobile_number);
        Session::put('phone_code_id',$phone_code_id);

        $message       = 'Otp for your mobile verification is : '.$otp_code;
        $status        = $this->SMSService->send_SMS($message,$phone_code.$mobile_number);
        if($status)
        {
             Session::flash('success', trans('parent.OTP_Sent_Success_Msg'));
        }
        else
        {
            Session::flash('error', trans('parent.OTP_Sent_Error_Msg'));
        }
        redirect(url('/parent/account-setting/otp_verify'));
      

    } // end RequestOTP


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Success or Error
    */

    public function VerifyOTP()
    {
        $data['pageTitle']     = trans('parent.Change_Password');
        $data['middleContent'] = 'parent.account-setting.otp';

        return view('front.layout.master')->with($data);

    } // end VerifyOTP


    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Success or Error
    */

    public function ProcessVerifyOTP(Request $request)
    {
        $arr_rules                = array();
        $arr_rules['confirm_otp'] = "required|min:5|max:6";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_are_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id     = Auth::user()->id;
        $form_data   = $request->all();

        $confirm_otp = isset($form_data['confirm_otp']) && !empty($form_data['confirm_otp']) ? $form_data['confirm_otp'] : '';

        $count = $this->UsersModel->where('id', $user_id)->where('password_reset_code', $confirm_otp)->count();
        if($count > 0)
        {
            $arr_data['password_reset_code'] = null;
            $arr_data['contact']             = Session::get('new_mobile');
            $arr_data['phone_code']          = Session::get('phone_code_id');
            $arr_data['is_mobile_verify']    = 'yes';
            $this->UsersModel->where('id', $user_id)->update($arr_data);

            Session::flash('success', trans('parent.Mobile_change_success'));
            return redirect( url('/parent/account-setting/my-profile') );
        }
        else
        {
            Session::flash('error',trans('parent.Incorrect_OTP_entered'));
            return redirect()->back();
        }

    } // end ProcessVerifyOTP
}
