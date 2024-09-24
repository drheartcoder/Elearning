<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Common\Services\StudentService;

use App\Models\UsersModel;
use App\Models\StudentDetailsModel;
use App\Models\StudentProgramsModel;

use Validator;
use Session;
use Excel;
use Hash;
use DB;

class StudentController extends Controller
{
    function __construct(
                            UsersModel     $users_model,
                            EmailService   $email_service,
                            StudentService $student_service
                        )
    {
        $this->module_title                  = "Student";
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/users/student");
        $this->module_view_folder            = "admin.users.student";
        $this->module_icon                   = "fa fa-users";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        
        $this->UsersModel                    = $users_model;
        $this->BaseModel                     = $this->UsersModel;
        $this->EmailService                  = $email_service;
        $this->StudentService                = $student_service;
        $this->StudentDetailsModel           = new StudentDetailsModel();
        $this->StudentProgramsModel          = new StudentProgramsModel();
        
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    /*
    | Function  : Get all the student data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the student data
    */

    public function index()
    {          
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


    /*
    | Function  : Get all the student data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the student data
    */

    public function load_data(Request $request)
    {
        DB::enableQueryLog();
        $ContactEnquiryData = $final_array = [];
        $column             = '';
        $keyword            = $request->input('keyword');
        $search_date        = $request->input('search_date');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "pin";
        }     
  
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "first_name";
        }    

        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "email";
        }

        if($request->input('order')[0]['column'] == 6) 
        {
            $column = "created_at";
        }

        if($request->input('order')[0]['column'] == 7) 
        {
            $column = "is_active";
        }    

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_data               = [];

        $arr_search_column      = $request->input('column_filter');

        $obj_data = DB::table('users')->whereRaw("(user_type = 'student')")->where('deleted_at','=',null);                                 
        
        if(isset($user_type) && $user_type!='')
        {
            $obj_data = $obj_data->where('user_type','=',$user_type);
        }
        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR enrollment_code LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR pin LIKE '%".$keyword."%' )");
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $count        = count($obj_data->get());
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        if(($order =='ASC' || $order =='') && $column=='')
        {
          $obj_data   = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if( $order !='' && $column!='' )
        {
          $obj_data   = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        $UsersData     = $obj_data->get();
        
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;

        if(count($UsersData)>0)
            {
                $i = 0;

                foreach($UsersData as $row)
                {
                    $build_view_action = '';  $build_active_btn = '' ; 

                    if($row->is_active != null && $row->is_active == "block")
                    {   
                        $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                    }
                    elseif($row->is_active != null && $row->is_active == "active")
                    {
                       $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                    }

                    $view_href = $this->module_url_path.'/view/'.base64_encode($row->id); 
                    $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>'; 

                    /*$edit_href = $this->module_url_path.'/edit/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp; <a class="btn btn-circle btn-info btn-outline show-tooltip" href="'.$edit_href.'" title="Edit User details"><i class="fa fa-pencil" > </i></a>'; */

                    $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                    $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon remove" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

                    $final_array[$i][0] =  '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>'; 
                    $final_array[$i][1] = isset($row->pin) && $row->pin != '' ? $row->pin : "-";
                    $final_array[$i][2] = isset($row->first_name) && isset($row->last_name) && $row->first_name != '' && $row->last_name != '' ? ucfirst($row->first_name).' '.ucfirst($row->last_name) : "N/A";
                    $final_array[$i][3] = isset($row->enrollment_code) && $row->enrollment_code != '' ? $row->enrollment_code : "N/A";
                    $final_array[$i][4] = isset($row->created_at) && $row->created_at != '' ? get_added_on_date_time($row->created_at) : "N/A";
                    $final_array[$i][5] = $build_active_btn;
                    $final_array[$i][6] = $build_view_action;
                  
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp));exit;      
    } 

    public function view($enc_id=null)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_data = [];

            $obj_data = $this->UsersModel->where('id',$id)
                             ->select('id','user_type','first_name','last_name','pin','enrollment_code')
                             ->with(['student_details'=>function($q1){
                                $q1->select('id','student_id','parent_id');
                                $q1->with(['parent_data'=>function($q2){
                                    $q2->select('id','user_type','first_name','last_name','email','contact');
                                }]);
                             }])
                             ->first();
            if($obj_data)
            {
                $arr_data = $obj_data->toArray();
            }   

            $this->arr_view_data['arr_data']             = $arr_data;
            $this->arr_view_data['page_title']           = $this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_url']           = $this->module_url_path;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['sub_module_title']     = 'Show '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      = 'fa fa-eye';

            $this->arr_view_data['program_module_title'] = 'Manage Program';
            $this->arr_view_data['program_module_icon']  = 'fa fa-file-text';
            $this->arr_view_data['program_module_url']   = $this->admin_url_path.'/users/student/view/'.$enc_id;
            
            return view($this->module_view_folder.'.view',$this->arr_view_data);

        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/');
        }
    }

    public function create()
    {
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function store(Request $request)
    {
        $arr_rules = array(); $full_name='';
        
        $arr_rules['first_name']   = "required|max:60";
        $arr_rules['last_name']    = "required|max:60"; 
        $arr_rules['contact']      = "required|min:7|max:16";
        $arr_rules['user_type']    = "required";
        $arr_rules['address']      = "required|max:255";
        $arr_rules['email']        = "required|email|unique:users";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }        
        
        $check_email_duplicate = $this->UsersModel->where('email',trim($request->input('email')))->get();
        if(count($check_email_duplicate)>0)
        {
            Session::flash('error','Email Already exist, Please try another ema.');
            return redirect()->back()->withInput();
        }

        
        $arr_data['first_name']    = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']     = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['contact']       = $request->input('contact');
        $arr_data['user_type']     = $request->input('user_type');
        $arr_data['address']       = trim($request->input('address'));
        $arr_data['email']         = trim($request->input('email'));
        $arr_data['password']      = Hash::make(trim($request->input('password')));
        $arr_data['is_active']     = 'active';
        $arr_data['is_verify']     = 'yes';

        $obj_data = $this->UsersModel->create($arr_data);       
        $full_name = trim(ucfirst(strtolower($request->input('first_name').' '.$request->input('last_name'))));
        $password = trim($request->input('password'));        
        
        if($arr_data['user_type']=='supervisor')
        {
            $type = 'Supervisor';
        }
        else
        {
            $type = 'Program Creator';
        }

        if($obj_data)
        {
            $arr_built_content = [  'EMAIL'        => $arr_data['email'],
                                    'PASSWORD'     => $password,
                                    'SITE_LINK'    => url('/').$arr_data['user_type'],
                                    'SUBJECT'      => 'Register as '.$type.' at '.config('app.project.name'),
                                    'FIRST_NAME'   => ucfirst($full_name),
                                    'USER_TYPE'    => $type, 
                                    'PROJECT_NAME' => config('app.project.name')];
            if($arr_built_content)
            {
                $arr_mail_data['arr_built_content'] = $arr_built_content;    
            }
            $arr_mail_data['email_template_id'] = 5;
            $arr_mail_data['user']  = [
                                        'first_name'    => $full_name,
                                        'email'         => $arr_data['email']
                                      ];

            $email_status  = $this->EmailService->send_mail($arr_mail_data);

            Session::flash('success','User register successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while adding user.');
        }
      
        return redirect()->back();
    }

    public function edit($enc_id=null)
    {
        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $arr_user = [];
            $obj_user = $this->UsersModel->where('id',$id)                                              
                                            ->first();
            if($obj_user)
            {
                $arr_user = $obj_user->toArray();
            }
            
            $this->arr_view_data['id']                   = base64_encode($id);
            $this->arr_view_data['arr_user']             = $arr_user;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']     =  'Edit '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      =  'fa fa-pencil-square-o';
            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            return view($this->module_view_folder.'.edit',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/manage');
        }
    }


    public function update(Request $request)
    {
        $arr_rules = array(); $full_name='';
       
        $arr_rules['first_name']   = "required|max:60";
        $arr_rules['last_name']    = "required|max:60"; 
        $arr_rules['contact']      = "required|min:7|max:16";        
        $arr_rules['address']      = "required|max:255";
        
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        } 

        $user_id = $request->input('id')!=''?base64_decode($request->input('id')):'';

        $arr_data['first_name']    = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']     = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['contact']       = $request->input('contact');        
        $arr_data['address']       = trim($request->input('address'));
        

        $obj_data = $this->UsersModel->where('id',$user_id)->update($arr_data);              
        if($obj_data)
        {
            Session::flash('success','User details updated successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating user details.');
        }
      
        return redirect()->back();
    
    }


    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Session::flash('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {          
            Session::flash('error', 'Problem Occurred, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
                $resDelete = $this->perform_delete(base64_decode($record_id));    
                Session::flash('success', $this->module_title. ' Deleted Successfully');
            }
            elseif($multi_action=="activate")
            {
               $resActive = $this->perform_activate(base64_decode($record_id)); 
               Session::flash('success', $this->module_title. ' unblocked Successfully');
            }
            elseif($multi_action=="deactivate")
            {
               $resDeactive = $this->perform_deactivate(base64_decode($record_id));   
               Session::flash('success', $this->module_title. ' blocked Successfully');
            }
        }      
        return redirect()->back();
    }

    public function activate($enc_id = FALSE)
    {
        
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_activate(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' Activated Successfully');
            return redirect()->back();
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title.' Activation ');
        }

        return redirect()->back();
    }

    public function deactivate($enc_id = FALSE)
    {
       
        
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_deactivate(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' Deactivated Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title.' Deactivation ');
        }

        return redirect()->back();
    }

    public function delete($enc_id = FALSE)
    {       
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' Deleted Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title.' Deletion ');
        }

        return redirect()->back();
    }
    
    public function perform_activate($id)
    {
        $responce = $this->BaseModel->where('id',$id)->first();          
        if($responce)
        {
            return $responce->update(['is_active'=>'active']);
        }

        return FALSE;
    }

    public function perform_deactivate($id)
    {
        $responce = $this->BaseModel->where('id',$id)->first();
        if($responce)
        {
            return $responce->update(['is_active'=>'block']);
        }

        return FALSE;
    }

    public function perform_delete($id)
    {

        $delete= $this->BaseModel->where('id',$id)->delete();
        
        if($delete)
        {
            return TRUE;
        }

        return FALSE;
    }


    public function LoadPrograms(Request $request)
    {
        DB::enableQueryLog();

        $ProgramData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $search_date = $request->input('search_date');
        $student_id  = $request->input('student_id');

        if($request->input('order')[0]['column'] == 1)
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "assigned_by";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "first_name";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_data          = [];
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->StudentProgramsModel->where('student_id', $student_id)
                                                        ->with(['program_details' => function($query){
                                                            $query->select('id', 'unique_id', 'name', 'subject', 'grade', 'template_id');
                                                        }])
                                                        ->with(['user_details' => function($query){
                                                            $query->select('id', 'first_name', 'last_name', 'pin', 'user_type', 'email', 'contact', 'is_active');
                                                        }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                                    $q->orWhere('assigned_by', 'like','%'.$keyword.'%')
                                      ->orWhereHas("program_details", function($query) use ($keyword){
                                        $query->where('name', 'like','%'.$keyword.'%');
                                      })
                                      ->orWhereHas("user_details", function($query) use ($keyword){
                                        $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                                      });
                                });
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $count = count($obj_data->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_data   = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if( $order !='' && $column!='' )
        {
            if($column == 'name')
            {
                $obj_data = $obj_data->whereHas('program_details', function ($query) use ($column, $order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'first_name')
            {
                $obj_data = $obj_data->whereHas('user_details', function ($query) use ($column,$order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }

        $ChildrenData            = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;

        if( count($ChildrenData) > 0 )
        {
            $i = 0;

            foreach($ChildrenData as $row)
            {
                $build_view_action = $build_active_btn = '';

                $view_href = $this->admin_url_path.'/program/view/'.base64_encode($row->program_id); 
                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                $final_array[$i][0] =  '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';

                $program_status = $this->StudentService->CheckProgramStatus($row->program_id, $row->student_id);

                $final_array[$i][1] = isset($row->program_details->name) && $row->program_details->name != '' ? ucfirst($row->program_details->name) : "-";
                $final_array[$i][2] = isset($row->assigned_by) && $row->assigned_by != '' ? ucfirst($row->assigned_by) : "-";
                $final_array[$i][3] = isset($row->user_details->first_name) && isset($row->user_details->last_name) && $row->user_details->first_name != '' && $row->user_details->last_name != '' ? ucfirst($row->user_details->first_name).' '.ucfirst($row->user_details->last_name) : "N/A";
                $final_array[$i][4] = isset($row->created_at) && $row->created_at != '' ? get_added_on_date_time($row->created_at) : "N/A";
                $final_array[$i][5] = $program_status;
                $final_array[$i][6] = $build_view_action;

                $i++;
            }
        }

        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    } // end LoadPrograms


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_users = [];

        $form_data    = $request->all();
        $keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $search_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        
        //$obj_data = DB::table('users')->whereRaw("(user_type = 'student')")->where('deleted_at','=',null);

        $obj_data = $this->UsersModel->whereRaw("(user_type = 'student')")
                                     ->with('student_details', 'student_details.subject_data', 'student_details.grade_data', 'student_details.added_by_user')
                                     ->where('deleted_at','=',null);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR user_name LIKE '%".$keyword."%' OR contact LIKE '%".$keyword."%' OR gender LIKE '".$keyword."%' OR pin LIKE '%".$keyword."%' )");
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $obj_data = $obj_data->get();

        if($obj_data)
        {
            $arr_users = $obj_data->toArray();
            /*dd($arr_users);*/

            // build data array to export
            foreach ($arr_users as $key => $users) 
            {
                $first_name = isset($users['first_name']) ? ucfirst($users['first_name']) : '';
                $last_name  = isset($users['last_name']) ? ucfirst($users['last_name']) : '';

                $added_by_fname = isset($users['student_details']['added_by_user']['first_name']) ? ucfirst($users['student_details']['added_by_user']['first_name']) : '';
                $added_by_lname = isset($users['student_details']['added_by_user']['last_name']) ? ucfirst($users['student_details']['added_by_user']['last_name']) : '';
                $added_by_user  = isset($users['student_details']['added_by_user']['user_type']) ? ucfirst($users['student_details']['added_by_user']['user_type']) : '';

                $data['Sr. No.']           = ( $key + 1 );
                $data['User Name']         = $first_name.' '.$last_name;
                $data['Pin']               = isset($users['pin']) ? $users['pin'] : '';
                $data['Enrollment Code']   = isset($users['enrollment_code']) ? $users['enrollment_code'] : '';
                $data['Added By UserType'] = $added_by_user;
                $data['Added By']          = $added_by_fname.' '.$added_by_lname;
                $data['Subject']           = isset($users['student_details']['subject_data']['name']) ? $users['student_details']['subject_data']['name'] : '';
                $data['Grade']             = isset($users['student_details']['grade_data']['name']) ? $users['student_details']['grade_data']['name'] : '';
                $data['Is Active']         = isset($users['is_active']) ? ucwords($users['is_active']) : '';
                $data['Registrated Date']  = isset($users['created_at']) ? get_added_on_date_time($users['created_at']) : 'NA';

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        //$type = 'XLSX';
        $type = 'CSV';

        return Excel::create('Student Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Student Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Student Report');

            $excel->sheet('Student Report', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

    }
}
