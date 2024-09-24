<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\ProgramModel;
use App\Models\ProgramTranslationModel;

use Session;
use Validator;
use DB;


class ProgramsController extends Controller
{
    
	use MultiActionTrait;
	
	public function __construct(ProgramModel $program_model,ProgramTranslationModel $program_translation_model)
	{
		$this->arr_view_data           = [];
		$this->supervisor_panel_slug   = config('app.project.supervisor_panel_slug');
		$this->supervisor_url_path     = url(config('app.project.supervisor_panel_slug'));
		$this->module_url_path         = $this->supervisor_url_path."/programs";
		$this->module_title            = "Program";
		$this->module_view_folder      = "supervisor.program";
		$this->module_icon             = "fa fa-tasks";
		$this->BaseModel               = $program_model;
		$this->ProgramTranslationModel = $program_translation_model;
	}

	/*
    | Function  : Listing page.
    | Name      : Deepak Bari
    | Date      : 22 June, 2018
    */

	public function index($status = false)
	{
		$this->arr_view_data['status']               = isset($status) ? $status : '';;
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->supervisor_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".ucfirst($status).' '.str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".ucfirst($status).' '.str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['supervisor_panel_slug']     = $this->supervisor_panel_slug;
        
        return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	/*
    | Function  : Get data for listing.
    | Name      : Deepak Bari
    | Date      : 22 June, 2018
    */

	public function load_data(Request $request)
	{
        $SubjectData     = $final_array = [];
        $column          = $order = $status =  '';
        $search_keyword  = $request->input('search_keyword');

        $status = isset($request->status) ? $request->status : '';
        
        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "title";
        }
        else if($request->input('order')[0]['column'] == 2) 
        {
            $column = "name";
        }
        else if($request->input('order')[0]['column'] == 3) 
        {
            $column = "grade_name";
        }

        else if($request->input('order')[0]['column'] == 4) 
        {
            $column = "template_name";
        }

        else if($request->input('order')[0]['column'] == 5) 
        {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->BaseModel->with(['program_translation' => function($query) use($column,$order){
	        										$query->where('locale','en');
        											$query->select('program_id','title');
                                                    if($column != '' && $column == 'title' &&  $order !='')
                                                    {
                                                        $query->orderBy($column,$order);
                                                    }
	        								 }])
        									 ->whereHas('program_translation',function($query) use($column,$order,$search_keyword){
        										$query->where('locale','en');
        										$query->select('program_id','title');
                                                if($column != '' && $column == 'title' &&  $order !='')
                                                {   
                                                    $query->orderBy($column,$order);
                                                }

                                                if($search_keyword != '')
                                                {
                                                    $query->where('title','like','%'.$search_keyword.'%');
                                                }

        									 })
        									 ->with(['subject_translation' => function($query) use($column,$order){
        										$query->where('locale','en');
        										$query->select('subject_id','name');
                                                if($column != '' && $column == 'name' &&  $order !='')
                                                {   
                                                    $query->orderBy($column,$order);
                                                }
        									 }])
        									  
        									 ->whereHas('subject_translation',function($query) use($column,$order){
        										$query->where('locale','en');
        										$query->select('subject_id','name');
                                                 if($column != '' && $column == 'name' &&  $order !='')
                                                {   
                                                    $query->orderBy($column,$order);
                                                }
        									 })
        									 ->with(['grade_translation' => function($query) use($column,$order){
        										$query->where('locale','en');
        										$query->select('grade_id','name');
                                                if($column != '' && $column == 'grade_name' &&  $order !='')
                                                {   
                                                    $query->orderBy('name',$order);
                                                }
        									 }])
        									 ->whereHas('grade_translation',function($query) use($column,$order){
        										$query->where('locale','cn');
        										$query->select('grade_id','name');
                                                if($column != '' && $column == 'grade_name' &&  $order !='')
                                                {   
                                                    $query->orderBy('name',$order);
                                                }
        									 })
        									 ->with(['template_details' => function($query) use($column,$order){
        										$query->select('id','name');
                                                if($column != '' && $column == 'template_name' &&  $order !='')
                                                {   
                                                    $query->orderBy('name',$order);
                                                }
        									 }]);

        if($status == 'new')
        {
            $obj_data = $obj_data->where('is_approved','0');
        }
        else if($status == 'approved')
        {
            $obj_data = $obj_data->where('is_approved','1');
        }
        $count = count($obj_data->get());
        
        if($column == 'created_at' && $order != '')
        {
            $obj_data = $obj_data->orderBy('created_at',$order);
        }   

        if($column == 'created_at' && $order != '')
        {
            $obj_data = $obj_data->orderBy('created_at',$order);
        }                                             

       
        $objData    = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($objData) > 0)
            {
                $i = 0;

                foreach($objData as $row)
                {

                    if($row['status'] != null && $row['status'] == "0")
                    {   
                        $build_active_btn = '<a class="btn btn-sm btn-danger" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="fa fa-lock"></i></a>';
                    }
                    elseif($row['status'] != null && $row['status'] == "1")
                    {
                       $build_active_btn = '<a class="btn btn-sm btn-success" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="fa fa-unlock"></i></a>';      
                    }

                    $build_view_action   = '';
                    $view_href = '';
                    //$view_href           = $this->module_url_path.'/view/'.base64_encode($row['id']);

                    if($status == 'new')
                    {
                        $approved_href       = $this->module_url_path.'/approve/'.base64_encode($row['id']);
                        
                        $build_view_action  .= '&nbsp;<a class="btn btn-outline btn-default btn-circle show-tooltip" href="'.$approved_href.'" onclick="return confirm_approve(this,event,\'Do you really want to approve this program ?\')"  title="Approve program"><i class="fa fa-check" ></i></a>';
                    }    

                    $build_view_action  .= '&nbsp;<a class="btn btn-outline btn-info btn-circle show-tooltip" href="'.$view_href.'" title="View"><i class="fa fa-eye" ></i></a>';

    
                    $final_array[$i][0] = "<input type='checkbox' name='checked_record[]' id='checked_record' class='checked_record' value='".base64_encode($row['id'])."'/>";

                    $final_array[$i][1] = isset($row['program_translation'][0]['title']) && $row['program_translation'][0]['title'] != '' ? $row['program_translation'][0]['title'] : "NA";
                    $final_array[$i][2] = isset($row['subject_translation'][0]['name']) && $row['subject_translation'][0]['name'] != '' ? $row['subject_translation'][0]['name'] : "NA";

                    $final_array[$i][3] = isset($row['grade_translation'][0]['name']) && $row['grade_translation'][0]['name'] != '' ? $row['grade_translation'][0]['name'] : "NA";
                   
                  
                    $final_array[$i][4] = isset($row['template_details']['name']) && $row['template_details']['name'] != '' ? $row['template_details']['name'] : "NA";
                    $final_array[$i][5] = isset($row->created_at) && $row->created_at!=''? get_formated_created_date($row->created_at) :"N/A";
                 
                    $final_array[$i][6] = $build_active_btn;
                    $final_array[$i][7] = $build_view_action;
                  
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp)); exit;      
    
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

    public function approve($enc_id = false)
    {
        $status = $id = '';       

        if($enc_id != false)
        {
             $id = base64_decode($enc_id);

             $status = $this->BaseModel->where('id',$id)->update(['is_approved' => '1']);

             if($status)
             {
                Session::flash('success',$this->module_title.' approved successfully');

                return redirect($this->module_url_path.'/approved');
             }
             else
             {
                Session::flash('error','Something went to wrong ! Please try again later');  
             }
        }
        else
        {
            Session::flash('error','Something went to wrong ! Please try again later');  
        }

        return redirect()->back();
    }


}
