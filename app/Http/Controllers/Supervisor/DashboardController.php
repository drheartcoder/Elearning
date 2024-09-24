<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProgramModel;
use App\Models\UsersModel;
use App\Models\NotificationsModel;
use DB;
use auth;

class DashboardController extends Controller
{
	public function __construct(ProgramModel $program_model,
								NotificationsModel $notification_model)
	{
		$this->arr_view_data         = [];
		$this->ProgramModel          = $program_model; 
		$this->NotificationsModel    = $notification_model;
		$this->module_title          = "Dashboard";
		$this->module_view_folder    = "supervisor.dashboard";		
		$this->supervisor_url_path   = url(config('app.project.supervisor_panel_slug'));
		$this->supervisor_panel_slug = config('app.project.supervisor_panel_slug');
		$this->UsersModel            = new UsersModel();
        $this->auth                  = auth()->guard('supervisor');

	}
	public function index()
	{
		$arr_data               = $arr_notification = [];
		$login_user_id     		= login_user_id('supervisor'); 
		$program_count          = $this->get_program_count($login_user_id);
		$approved_program_count = $this->get_program_count($login_user_id,'approved');
		$pending_program_count  = $this->get_program_count($login_user_id,'pending');

		$notification_count     = $this->notification_count($login_user_id);
		$arr_notification       = $this->get_notification($login_user_id);

		$this->arr_view_data['approved_program_count']    	= $approved_program_count;
		$this->arr_view_data['pending_program_count']    	= $pending_program_count;

		$this->arr_view_data['arr_notification']    	= $arr_notification;
		$this->arr_view_data['program_count']        	= $program_count;
		$this->arr_view_data['notification_count']   	= $notification_count;
		$this->arr_view_data['page_title']           	= $this->module_title;
		$this->arr_view_data['parent_module_icon']   	= "fa fa-home";
		$this->arr_view_data['parent_module_title']  	= "Dashboard";
		$this->arr_view_data['supervisor_url_path']     = $this->supervisor_url_path;
		$this->arr_view_data['supervisor_panel_slug']   = $this->supervisor_panel_slug;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}
	public function get_program_count($creator_id,$type=false)
	{
		$arr_programers_details = $arr_programers = [];
        $str_programers = "";
        $arr_programers_details = $this->UsersModel->where('reporting_to',$this->auth->id())->get();
        if(count($arr_programers_details)>0){
            $arr_programers_details = $arr_programers_details->toArray();
            foreach ($arr_programers_details as $key => $val) {
                 array_push($arr_programers, $val['id']);
            }
        }

		$program_count = 0;
		if($type!=false && $type=='approved')
		{
			$program_count = $this->ProgramModel->where('approve_status','=','approved')
												->whereIn('user_id',$arr_programers)
												->count();
		}
		elseif ($type!=false && $type=='pending')
		{
			$program_count = $this->ProgramModel->where('approve_status','=','pending')
											    ->whereIn('user_id',$arr_programers)
											    ->count();	
		}
		else
		{
			$program_count = $this->ProgramModel->whereIn('user_id',$arr_programers)->count();	
		}
		return $program_count;
	}
	public function notification_count($creator_id)
	{
		$notification_count = $this->NotificationsModel->where('to_user_id','=',$creator_id)->count();	
		return $notification_count;
	}
	public function get_notification($creator_id)
	{
		$arr_notification     = [];
		$obj_notification     = $this->NotificationsModel->where('to_user_id','=',$creator_id)->get();
		if($obj_notification)
		{
			$arr_notification = $obj_notification->toArray();
		}
		return $arr_notification;
	}
}
