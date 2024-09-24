<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\GlobalSettingModel;

use Validator;
use Session;
use Hash;

class GlobalSettingController extends Controller
{
    function __construct()
    {
        $this->auth               = auth()->guard('admin');
        $this->module_title       = "Global Setting";
        $this->module_url_path    = url('/admin/global_setting');
        $this->module_view_folder = "admin.global_setting";
        $this->module_icon        = "fa fa-gear";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');

        $this->GlobalSettingModel = new GlobalSettingModel();
    }

    /*
    | Name : Deepak Bari
    | Function : Show Account setting form.
    | Date : 14-04-2018
    */

    public function index()
    {
        $arr_global_setting = [];

        $obj_global_setting = $this->GlobalSettingModel->first();
        if($obj_global_setting)
        {
           $arr_global_setting = $obj_global_setting->toArray();    
        }
               
        $this->arr_view_data['arr_global_setting']  = $arr_global_setting;
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function update(Request $request)
    {
        $arr_rules = $is_setting_avail = $obj_data = array();
        
        $arr_rules['child_limit']          = "required";
        $arr_rules['daily_lesson_limit']   = "required";
        $arr_rules['daily_homework_limit'] = "required";
        $arr_rules['daily_textbook_limit'] = "required";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails()) {
            Session::flash('error', 'All fields are required');
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $is_setting_avail                 = $this->GlobalSettingModel->where('id', '1')->count();
        $arr_data['child_limit']          = $request->input('child_limit');
        $arr_data['daily_lesson_limit']   = $request->input('daily_lesson_limit');
        $arr_data['daily_homework_limit'] = $request->input('daily_homework_limit');
        $arr_data['daily_textbook_limit'] = $request->input('daily_textbook_limit');

        if($is_setting_avail > 0) {
            $obj_data = $this->GlobalSettingModel->where('id','1')->update($arr_data);
        } else {
            $obj_data = $this->GlobalSettingModel->create($arr_data);
        }

        if($obj_data) {
            Session::flash('success','Global setting updated successfully.');
        } else {
            Session::flash('error','Problem occurred, while updating global setting');
        }
      
        return redirect()->back();
    }

}
