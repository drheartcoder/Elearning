<?php

namespace App\Http\Middleware\Admin;

use App\Models\UsersModel;

use Closure;
use Session;
use Auth;

class VerifyPermission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next,$permission =false)
    {
        $flag =1; $data_arr=[];                
        $arr_current_user_access = [];
        $this->auth = auth()->guard('admin');
        
        if($this->auth->user() && ($this->auth->user()['user_type']=='admin' || $this->auth->user()['user_type']=='subadmin'))
        {   
            $data_arr = UsersModel::where('id', '=', $this->auth->user()['id'])->select('permissions')->first();                                       
            $arr_current_user_access = json_decode($data_arr['permissions']);                        
            //dd( isset($arr_current_user_access) , count($arr_current_user_access)>0 , $this->auth->user()['user_type']=='admin');
            if($this->auth->user()['user_type']=='admin')
            {                
                $flag = 1;    
            }
            else
            {
                //dd($permission, $arr_current_user_access);
                if(array_key_exists($permission, $arr_current_user_access))
                {
                   $flag = 1; //return $next($request);                   
                }
                else
                {
                    $flag = 0;
                }
            }
            if($flag==1) 
            {
                return $next($request);
            }
            else
            {                
                Session::flash('error',"SORRY , You don't have access to do this action !");
                return redirect(url()->previous());
            }            
        }
        else
        {
            Session::flash('error','Not Sufficient Privileges');
            return redirect(url('admin'));
        }
       
       //return $next($request);

        
        
    }
}