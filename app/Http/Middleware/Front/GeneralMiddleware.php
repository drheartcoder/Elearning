<?php

namespace App\Http\Middleware\Front;

use App\Models\SiteStatusModel;
use App\Models\FrontPagesModel;

use Auth;
use Closure;
use Request;
use Session;
use App;

class GeneralMiddleware
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
        $arr_user_details = [];
        $this->auth       = Auth::user();

        $profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
        $default_image_public_img_path = url('/').config('app.project.img_path.default_image');

        view()->share('profile_image_base_img_path',$profile_image_base_img_path);
        view()->share('profile_image_public_img_path',$profile_image_public_img_path);
        view()->share('default_image_public_img_path',$default_image_public_img_path);

        if($this->auth && $this->auth['is_active'] == 'active')
        {
            $arr_user_details = $this->auth;
            view()->share('arr_user_details',$arr_user_details);
        }

        $locale = App::getLocale();

        $site_settings = [];
        $site_setting  = SiteStatusModel::first();
        if($site_setting)
        {
            $arr_site_settings = $site_setting->toArray();
            if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status'] == 0)
            {
                return response(view('errors.under_construction'));
            }
        }

        /*route handling*/
        $current_url_route = app()->router->getCurrentRoute()->uri();

        $arr_except[] = 'login';
        $arr_except[] = 'validate_login';
        $arr_except[] = 'forget_password';
        $arr_except[] = 'password_reset';


        /* Site Setting */                 
        $arr_site_data = array();
        $obj_site_data = SiteStatusModel::select('*')->first();
        if($obj_site_data)
        {   
            $arr_site_data = $obj_site_data->toArray();
        }

        view()->share('arr_global_site_setting',$arr_site_data);        
        /* Static Pages */         
        $arr_static_pages = [];         
        $obj_static_pages = FrontPagesModel::where('status','1')
                                            ->with(['translations'=>function($query) use ($locale)
                                            {
                                                $query->where('locale',$locale);
                                            }])
                                            ->orderBy('order', 'ASC')
                                            ->get();
        if ($obj_static_pages)
        {
            $arr_tmp_static_pages = $obj_static_pages->toArray();            
            
            if(isset($arr_tmp_static_pages) && sizeof($arr_tmp_static_pages))
            {
                $arr_static_pages = $arr_tmp_static_pages;
            }   
        }

        view()->share('arr_static_pages',$arr_static_pages); 

        return $next($request);
    }

}
