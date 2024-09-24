<?php

namespace App\Http\Controllers\Supervisor;

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
        $this->auth                  = auth()->guard('supervisor');
        $this->arr_view_data         = [];
        $this->module_title          = "Supervisor";
        $this->module_view_folder    = "supervisor.auth";
        $this->supervisor_panel_slug = config('app.project.supervisor_panel_slug');
        $this->module_url_path       = url($this->supervisor_panel_slug);
        $this->admin_url_path        = url(config('app.project.admin_panel_slug'));
        $this->UsersModel            = $user_model;
    }

    public function login()
    {
        return redirect($this->admin_url_path); 
    }

    public function validate_login(Request $request)
    {
        $arr_rules      = array();
        $status         = false;

        $remember_me    = "";

        $arr_rules['email']          = "required|email";
        $arr_rules['password']       = "required";

        $validator = validator::make($request->all(),$arr_rules);

        if($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }
        $remember_me = $request->input('remember_me');

        $obj_group_supervisor  = $this->UsersModel->where('user_type', 'supervisor')->where('email',$request->only('email'))->first();

        if($obj_group_supervisor) 
        {
            $active_supervisor  = $this->UsersModel->where('email',$request->only('email'))
                                                ->where('user_type','supervisor')
                                                ->where('is_active','active')
                                                ->first();

            if(!$active_supervisor)
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
