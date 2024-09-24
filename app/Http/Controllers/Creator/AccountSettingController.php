<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UsersModel;

use Validator;
use Session;
use Hash;

class AccountSettingController extends Controller
{
    function __construct(
                            UsersModel    $users_model
                        )
    {     
        $this->auth                          = auth()->guard('creator');   
        $this->module_title                  = "Account Setting";
        $this->module_url_path               = url('/').'/'.config('app.project.creator_panel_slug').'/account_setting';
        $this->module_view_folder            = "creator.account_setting";
        $this->module_icon                   = "fa fa-gear";
        $this->creator_panel_slug            = config('app.project.creator_panel_slug');
        $this->UsersModel                    = $users_model;
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    /*
    | Name : Deepak Bari 
    | Function : Show Account setting form.
    | Date : 14-04-2018
    */

    public function index()
    {
        $arr_user_details  = $arr_bank_details = [];
        $obj_user_details  = login_user_details('creator');

        if($obj_user_details)
        {
           $arr_user_details = $obj_user_details->toArray();    
        }
               
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/program-creator/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        $this->arr_view_data['arr_user_details']   = $arr_user_details;
        
        $this->arr_view_data['creator_panel_slug']    = $this->creator_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function update(Request $request)
    {
        $arr_rules = array();
        
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required"; 
        $arr_rules['contact']               = "required|min:7|max:16";
        $arr_rules['address']               = "required|max:255";
        $arr_rules['email']                 = "required|email";

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
                    if ($old_image!="" && $old_image!=null) 
                    {
                        if (file_exists($this->profile_image_base_img_path.$old_image))
                        {
                            @unlink($this->profile_image_base_img_path.$old_image);
                        }

                        if (file_exists($this->profile_image_base_img_path.'/thumb_50X50_'.$old_image)) 
                        {
                            @unlink($this->profile_image_base_img_path.'/thumb_50X50_'.$old_image);
                        }
                      
                    }
                }
            }
            else
            {
                Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }
        else
        {
             $file_name=$old_image;
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

       $user_details = login_user_details('creator');
       
       if(isset($user_details->id) && !empty($user_details->id))
       {
            $user_id = $user_details->id;
       }
       else
       {
            $user_id = 0;
       }

        $is_user_avail = $this->UsersModel->where('id',$user_id)->count();

        $arr_data['profile_image'] = $file_name;
        $arr_data['first_name']    = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']     = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['contact']       = $request->input('contact');
        $arr_data['address']       = trim($request->input('address'));
        $arr_data['email']         = trim($request->input('email'));
        $arr_data['user_name']     = trim($request->input('user_name'));
        $arr_data['phone_code']    = trim($request->input('phone_code',''));
        if($is_user_avail > 0)
        {
            $obj_data = $this->UsersModel->where('id',$user_id)->update($arr_data);
        }
        else
        {
            $obj_data = $this->UsersModel->create($arr_data);
        }

        if($obj_data)
        {
            Session::flash('success','Profile updated successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating profile');
        }
      
        return redirect()->back();
    
    }

    public function change_password()
    {
        $this->arr_view_data['arr_final_tile']       = array();
        $this->arr_view_data['page_title']           = "Change Password";
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/program-creator/dashboard';
        $this->arr_view_data['module_icon']          = "fa fa-key";
        $this->arr_view_data['module_title']         = "Change Password";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        
        $this->arr_view_data['creator_panel_slug']     = $this->creator_panel_slug;

        return view($this->module_view_folder.'.change_password',$this->arr_view_data);
    }

    public function update_password(Request $request)
    {
    	$user_details = "";

       $user_details = login_user_details('creator');
       
       if(isset($user_details->id) && !empty($user_details->id))
       {
       		$user_id = $user_details->id;
       }
       else
       {
       		$user_id = 0;
       }

        $arr_rules = array();
        $status = FALSE;
        $arr_rules['current_password']      = "required|min:6|max:16";
        $arr_rules['new_password']          = "required|min:6|max:16";
        $arr_rules['confirm_password']           = "required|same:new_password";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $current_password  =  $request->input('current_password');
        $new_password      =  $request->input('new_password');
        $confirm_password  =  $request->input('confirm_password');
      
        if(Hash::check($current_password,$user_details->password))
        {
            if($current_password != $new_password)
            {
                if($new_password == $confirm_password)
                {
                    $user_password       = Hash::make($confirm_password);
                    $is_password_changed = $this->UsersModel->where('id',$user_id)->update(['password'=>$user_password]);
                    
                    if($is_password_changed)
                    {
                        $this->auth->logout();
                        Session::flush();
                        Session::flash('success','Your password changed successfully.');
                        return redirect(url('/program-creator'));
                    }
                    else
                    {
                        Session::flash('error','Problem occured, while changing password');
                    }

                    return redirect()->back();
                }
                else
                {
                    Session::flash('error','New password and confirm password does not match.');
                    return redirect()->back();
                }
            }
            else
            {
                Session::flash('error','Sorry you can\'t use current password as new password, Please enter another password');
                    return redirect()->back();
            }
        }
        else
        {
            Session::flash('error',"Incorrect current password");
            return redirect()->back();
        }

       Session::flash('error','Problem occured, while changing password');
       return redirect()->back();
    }
}
