<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UsersModel;

use Validator;
use Session;
use Cookie;
use Auth;

class AuthController extends Controller
{
    public function __construct(UsersModel $user_model)
    {
        $this->auth               = auth()->guard('creator');
        $this->arr_view_data      = [];
        $this->module_title       = "Program Creator";
        $this->module_view_folder = "creator.auth";
        $this->creator_panel_slug = config('app.project.creator_panel_slug');
        $this->module_url_path    = url($this->creator_panel_slug);
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->UsersModel         = $user_model;
    }

    public function login()
    {
        return redirect($this->admin_url_path);	
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
        

        $obj_creator  = $this->UsersModel->where('email',$request->only('email'))
                                        ->where('user_type','program-creator')
                                        //->where('is_active','active')
                                        ->first();

        if($obj_creator) 
        {
            $active_creator  = $this->UsersModel->where('email',$request->only('email'))
                                                ->where('user_type','program-creator')
                                                ->where('is_active','active')
                                                ->first();
            if(!$active_creator)
            {
                setcookie("remember_me_email","");
                setcookie("remember_me_password","");
                Session::flash('error','You are blocked by Admin');
                return redirect()->back();
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
                return redirect($this->module_url_path.'/dashboard');
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
        return redirect($this->admin_url_path);
    }

}
