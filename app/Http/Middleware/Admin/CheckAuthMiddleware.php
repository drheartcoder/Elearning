<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;
class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $arr_except = array();     
        $this->auth = auth()->guard('admin');        

        $admin_path = config('app.project.admin_panel_slug');

        $arr_except[] =  $admin_path;
        $arr_except[] =  $admin_path.'/';
        $arr_except[] =  $admin_path.'/validate_login';
        $arr_except[] =  $admin_path.'/forgot_password';
        $arr_except[] =  $admin_path.'/forgot_password/post_email';
        $arr_except[] =  $admin_path.'/forgot_password/postReset';
        $arr_except[] =  $admin_path.'/reset_password/{token?}';
        $arr_except[] =  $admin_path.'/notifications/read';
        
        $request_path = $request->route()->getCompiled()->getStaticPrefix();
        $request_path = substr($request_path,1,strlen($request_path));        
        if(!in_array($request_path, $arr_except))
        {
            if($this->auth->user()!=null && ($this->auth->user()['user_type']=='admin' || $this->auth->user()['user_type']=='subadmin'))
            {   
                $super_admin_details = $this->auth->user()->toArray();
                                
                view()->share('shared_admin_details', $super_admin_details);
                view()->share('profile_image_base_img_path', base_path().config('app.project.img_path.user_profile_image'));
                view()->share('profile_image_public_img_path', url('/').config('app.project.img_path.user_profile_image'));
                view()->share('default_img_path', url('/').config('app.project.img_path.user_default_img_path'));

                view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));            
                view()->share('arr_current_user_access',json_decode($this->auth->user()['permissions']));
                return $next($request);
            }
            else
            {
                $this->auth->logout();                           
                return redirect(url(config('app.project.admin_panel_slug')));
            }
        }
        else
        { 
            return $next($request);
        }    
    }
}
