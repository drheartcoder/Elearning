<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SiteStatusModel;


use Validator;
use Session;

class SiteStatusController extends Controller
{
    public function __construct(SiteStatusModel $site_status_model)
    {
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug     = config('app.project.admin_panel_slug');
        $this->module_url_path      = $this->admin_url_path."/account_setting/site_status";
        $this->module_view_folder   = "admin.site_status";
          
        $this->module_title         = "Site Setting";
        $this->module_icon          = 'fa fa-cog';
          
        $this->BaseModel           = $site_status_model;
    }

    public function index()
    {
        $arr_site_settings = [];
        $obj_site_settings = $this->BaseModel->first();

        if($obj_site_settings) 
        {
            $arr_site_settings = $obj_site_settings->toArray();
        }

        $this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;

        $this->arr_view_data['module_url_path']         = $this->module_url_path;

        $this->arr_view_data['arr_site_settings']    = $arr_site_settings;

        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function update(Request $request)
    {
        $status_update = $status_create = $latitude = $longitude = '';
        $arr_rules     = $arr_data      = array();

        $arr_rules['site_name']           = "required";
        //$arr_rules['site_address']        = "required";
        $arr_rules['site_email_address']  = "required";
        $arr_rules['site_contact_number'] = "required";
        
        /*$arr_rules['meta_keyword']        = "required";
        $arr_rules['meta_description']    = "required";*/
        $arr_rules['facebook_url']        = "required";
        $arr_rules['twitter_url']         = "required";
        $arr_rules['google_plus_url']     = "required";    
        $arr_rules['site_video']     = "required";    
        //$arr_rules['linkedin_url']     = "required";    
      

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        

        $arr_data['site_name']           = trim($request->input('site_name',''));        
        $arr_data['site_email_address']  = $request->input('site_email_address');       
        $arr_data['site_contact_number'] = $request->input('site_contact_number');
        $arr_data['site_status']         = $request->input('site_status','');
        $arr_data['meta_desc']           = $request->input('meta_description','');
        $arr_data['meta_keyword']        = $request->input('meta_keyword','');
        $arr_data['fb_url']              = $request->input('facebook_url','');
        $arr_data['twitter_url']         = $request->input('twitter_url','');
        $arr_data['google_plus_url']     = $request->input('google_plus_url','');
        $arr_data['linkedin_url']        = ($request->input('linkedin_url')!='') ? $request->input('linkedin_url') : "";
        $arr_data['site_video']          = ($request->input('site_video')!='') ? $request->input('site_video') : "";

        $arr_data['apple_url']           = $request->input('apple_url','');
        $arr_data['google_play_url']     = $request->input('google_play_url','');
        $arr_data['acrobat_url']         = $request->input('acrobat_url','');
        $arr_data['chrome_url']          = $request->input('chrome_url','');
        $arr_data['youtube_url']         = $request->input('youtube_url','');


        $obj_data = $this->BaseModel->first();
        
        if($obj_data)
        {
            $status_update = $obj_data->update($arr_data);
        }
        else
        {
            $status_create = $this->SiteSettingModel->create($arr_data);
        }
        if($status_update) 
        {
            Session::flash('success',str_singular($this->module_title).' details updated successfully.');
        }
        elseif($status_create)
        {
            Session::flash('success',str_singular($this->module_title).' details added successfully.');
        }
        else
        {
            Session::flash('error','Problem Occurred, While Updating '.str_singular($this->module_title));
        }
        return redirect()->back();
                                      
    }   
}
