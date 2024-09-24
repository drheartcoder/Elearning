<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UsersModel;

use Validator;
use Session;
use Cookie;

class AuthController extends Controller
{
    public function __construct(UsersModel $user_model)
    {
        $this->auth               = auth()->guard('admin');
        $this->arr_view_data      = [];
        $this->module_title       = "Admin";
        $this->module_view_folder = "admin.auth";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = url($this->admin_panel_slug);
        $this->UsersModel         = $user_model;
    }

    public function login()
    {
        $this->arr_view_data['module_title']     = $this->module_title." Login";
        $this->arr_view_data['page_title']       = $this->module_title." Login";
        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;

        return view($this->module_view_folder.'.login',$this->arr_view_data);	
    }

    public function validate_login(Request $request)
    {
        $arr_rules      = array();
        $status         = false;

        $remember_me = "";

        $arr_rules['email']          = "required|email";
        $arr_rules['password']       = "required";

        $validator = validator::make($request->all(),$arr_rules);

        if($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

        $remember_me = $request->input('remember_me');        
        $obj_group_admin  = $this->UsersModel->whereRaw("(user_type = 'admin' OR user_type = 'subadmin' OR user_type = 'program-creator' OR user_type = 'supervisor') AND email = '".$request->input('email')."' ")->first();
        // ->where('user_type', 'admin')->where('email',$request->only('email'))
        if($obj_group_admin) 
        {
            $user_type = $obj_group_admin->user_type;
            if($user_type=='admin' || $user_type=='subadmin')
            {
                $this->auth = auth()->guard('admin');
                $redirect_url = url('/').'/admin/dashboard';
            }
            else if($user_type=='program-creator')
            {
                $this->auth = auth()->guard('creator');
                $redirect_url = url('/').'/program-creator/dashboard';
            }
            else if($user_type=='supervisor')
            {
                $this->auth = auth()->guard('supervisor');
                $redirect_url = url('/').'/supervisor/dashboard';
            }
            else
            {
                $this->logout();
            }
            if($this->auth->attempt($request->only('email', 'password')))
            {
                if($remember_me != 'on' || $remember_me == null)
                {
                   setcookie("remember_me_email","");
                   setcookie("remember_me_password","");
                }
                else
                {
                
                  setcookie('remember_me_email', $request->input('email'), time()+60*60*24*100);
                  setcookie('remember_me_password', $request->input('password'), time()+60*60*24*100);
                }
                Session::put('loggedinId',$this->auth->user()['id']);
                Session::flash('success','You are successfully login to your account.');
                return redirect($redirect_url);
            }
            else
            {
                 setcookie("remember_me_email","");
                 setcookie("remember_me_password","");

                 Session::flash('error','Invalid login credential.');

                 return redirect()->back();
            }
        }
        else
        {
             setcookie("remember_me_email","");
             setcookie("remember_me_password","");

             Session::flash('error','Invalid login credentials.');
             return redirect()->back();
        }
        return redirect()->back();
    }

    public function logout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect($this->module_url_path.'/');
    }

}
