<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\ModulesModel;

class SubadminController extends Controller
{
    public function __construct(UsersModel $UsersModel,
    							ModulesModel $ModulesModel)
    {
    	$this->module_title                  = "Subadmin";
    	$this->module_url_path               = url('/admin/subadmin');
    	$this->module_view_folder            = "admin.subadmin";
    	$this->UsersModel 					 = $UsersModel;
    	$this->ModulesModel 				 = $ModulesModel;
    }

    public function index()
    {
    	$obj_user = []; $temp_arr=[];

        $obj_users = UsersModel::with('admin_details')->where('user_type','subadmin')->orderBy('id','DESC')->get();        

        if(isset($obj_users) && count($obj_users)>0)
        {
            foreach ($obj_users as $key => $value) 
            {
                $temp_arr[$key]['id'] = $value['id'];
                $temp_arr[$key]['email'] = $value['email'];
                $temp_arr[$key]['user_type'] = ucfirst($value['user_type']);
                $temp_arr[$key]['is_active'] = $value['is_active'];
                $temp_arr[$key]['first_name'] = ucfirst($value['admin_details']['first_name']);
                $temp_arr[$key]['last_name'] = ucfirst($value['admin_details']['last_name']);
            }
        }
        $is_last_user = count($obj_users)==1?true:false;                
        $this->arr_view_data['is_last_user']    = $is_last_user;
        $this->arr_view_data['obj_users']       = $temp_arr;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
        $obj_role = UsersModel::whereIn('user_type',['subadmin']);
        $obj_role = $obj_role->orderBy('id','desc')->get(); 
        if( $obj_role != FALSE)
        {
            $arr_roles = $obj_role->toArray();
        }
        
        $obj_modules    =   $this->ModulesModel
                            ->where('is_active','1')
                            ->orderBy('title','ASC')
                            ->get();

        if($obj_modules != FALSE)
        {
            $arr_modules=$obj_modules->toArray();
        }

        $arr_not_to_create_list = ['change_password','account_settings','email_template','site_settings','notifications','activities','contact_details','static_pages','institutes','applied_trainers','shortlist_trainers','my_trainers','communication','reviews','my_availability','wire_transfer_request'];

        $arr_not_to_update_list = ['notifications','activities','my_availability','wire_transfer_request'];   

        $arr_not_to_delete_list = ['change_password','account_settings','email_template','site_settings','static_pages','skills','contact_details','activities','trainers','institutes','jobs','applied_trainers','shortlist_trainers','my_trainers','communication','reviews','my_availability','wire_transfer_request'];     
       
        $this->arr_view_data['arr_not_to_create_list']  = $arr_not_to_create_list;
        $this->arr_view_data['arr_not_to_update_list']  = $arr_not_to_update_list;
        $this->arr_view_data['arr_not_to_delete_list']  = $arr_not_to_delete_list;
        $this->arr_view_data['arr_roles']               = $arr_roles;
        $this->arr_view_data['arr_modules']             = $arr_modules;
        $this->arr_view_data['page_title']              = "Create ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']            = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']         = $this->module_url_path;
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }
}
