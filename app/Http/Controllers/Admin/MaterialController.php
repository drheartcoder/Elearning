<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProgramModel;
use App\Models\LessonModel;
use App\Models\TextbookModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;

class MaterialController extends Controller
{
	use MultiActionTrait;
	public function __construct()
	{
        $this->arr_view_data            = [];
        $this->module_title             = "Material";
        $this->module_icon              = "fa fa-tasks";
        $this->module_view_folder       = "admin.material";
        $this->admin_url_path         = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug       = config('app.project.admin_panel_slug');
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/program/material");

        $this->BaseModel                = new ProgramModel();
        $this->ProgramModel             = new ProgramModel();
        $this->LessonModel              = new LessonModel();
        $this->TextbookModel            = new TextbookModel();
	}

	public function create()
	{
         $this->arr_view_data['page_title']         = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Create '.$this->module_title;
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']  = $this->admin_panel_slug;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}
}
