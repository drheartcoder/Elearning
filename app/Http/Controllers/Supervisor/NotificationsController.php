<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\NotificationsModel;

use Session;
use Validator;
use DB;

class NotificationsController extends Controller
{
	use MultiActionTrait;
	
	public function __construct(NotificationsModel $notifications_model)
	{
		$this->arr_view_data           = [];
		$this->supervisor_panel_slug   = config('app.project.supervisor_panel_slug');
		$this->supervisor_url_path     = url(config('app.project.supervisor_panel_slug'));
		$this->module_url_path         = $this->supervisor_url_path."/notifications";
		$this->module_title            = "Notification";
		$this->module_view_folder      = "supervisor.notifications";
		$this->module_icon             = "fa fa-bell";
		$this->BaseModel               = $notifications_model;
	}

	/*
    | Function  : Listing page.
    | Name      : Deepak Bari
    | Date      : 21 June, 2018
    */

	public function index()
	{
		$login_user_id = '';
		
		$login_user_id = login_user_id('supervisor');

		$this->BaseModel->where('is_read','0')
		->where('to_user_id',$login_user_id)
		->update(['is_read'=>'1']);
		
		$this->arr_view_data['parent_module_icon']   = "fa fa-home";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->supervisor_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['supervisor_panel_slug']     = $this->supervisor_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	/*
    | Function  : Get data for listing.
    | Name      : Deepak Bari
    | Date      : 21 June, 2018
    */

	public function load_data(Request $request)
	{
        $objectData = $final_array = $arr_data = $arr_search_column = $resp = []; 

        $column  = $order = $title = $count = $obj_data = $search_keyword = $msg =  $notification_message = $login_user_id = '';

        $search_keyword   = isset($request->search_keyword) ? $request->search_keyword : ''; 
        
        if ($request->input('order')[0]['column'] == 1) 
        {
            $column = "message";
        }

        if ($request->input('order')[0]['column'] == 2) 
        {
            $column = "created_at";
        }

		$login_user_id = login_user_id('supervisor'); 

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column      = $request->input('column_filter');

        $tbl_notification = $this->BaseModel->getTable();

        $obj_data = DB::table($tbl_notification)
                    ->select('id','message','url','created_at')
                    ->where('to_user_id',$login_user_id);

        if(isset($search_keyword) && $search_keyword != "")
        {
          $obj_data = $obj_data->where(function($query) use($search_keyword){
            $query->where('message','like','%'.$search_keyword.'%');
            
          });
        }
        
        $count = count($obj_data->get());
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

		if(($order =='ASC' || $order =='') && $column=='')
        {
          $obj_data   = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if($order !='' && $column!='' )
        {
            $obj_data   = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }
      

        $objectData     = $obj_data->get();

        $resp['draw']            = isset($_GET['draw']) ? $_GET['draw'] : '';
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ; 

        if(count($objectData)>0)
            {
                $i = 0;

                foreach($objectData as $row)
                {
					
					if(isset($row->message) && !empty($row->message))
					{
						$msg = htmlspecialchars_decode($row->message);

						if(isset($row->url) && !empty($row->url))
						{
							$notification_message = "<a href='".$row->url."'>".$msg."</a>";	
						}
						else
						{
							$notification_message = $msg;	
						}
					}

					$build_view_action ='';

					$delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp;<a class="btn btn-circle btn-danger btn-outline show-tooltip" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this notification?\')"  title="Delete"><i class="fa fa-trash" ></i></a>';                     
    
                    $final_array[$i][0] = "<input type='checkbox' name='checked_record[]' id='checked_record' class='checked_record' value='".base64_encode($row->id)."'/>";

                    $final_array[$i][1] = isset($notification_message) && $notification_message!=''?$notification_message:"N/A";
                    
                    $final_array[$i][2] = isset($row->created_at) && $row->created_at!=''? date('d M, Y h:i a',strtotime($row->created_at)) :"N/A";
                    $final_array[$i][3] = isset($build_view_action) ? $build_view_action : '';
                    
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp));exit;      
    
    
	}

	/*
    | Function  : Set notification status as read.
    | Name      : Deepak Bari
    | Date      : 21 June, 2018
    */

	public function read($enc_notification_id = false)
	{
		$arr_response = [];
		if($enc_notification_id != false)
		{
			$notification_id = base64_decode($enc_notification_id);

			$status = $this->BaseModel->where('id',$notification_id)
					            	  ->update(['is_read'=>'1']);

			if($status)
			{
				$arr_response['status'] = 'success';
			}
			else
			{
				$arr_response['status'] = 'error';	
			}
		}
		else
		{
			$arr_response['status'] = 'error';	
		}

		return $arr_response;
	}

}
