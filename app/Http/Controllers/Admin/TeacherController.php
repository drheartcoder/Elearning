<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;

use App\Models\UsersModel;
use App\Models\ClassroomsModel;
use App\Models\ClassroomsTranslationModel;
use App\Models\ShareClassModel;

use Validator;
use Session;
use Excel;
use Hash;
use DB;

class TeacherController extends Controller
{
    function __construct(
                            UsersModel   $users_model,
                            EmailService $email_service
                        )
    {
        $this->module_title                  = "Teacher";
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/users/teacher");
        $this->module_view_folder            = "admin.users.teacher";
        $this->module_icon                   = "fa fa-users";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        
        $this->UsersModel                    = $users_model;
        $this->BaseModel                     = $users_model;
        $this->EmailService                  = $email_service;

        $this->ClassroomsModel               = new ClassroomsModel();
        $this->ClassroomsTranslationModel    = new ClassroomsTranslationModel();
        $this->ShareClassModel               = new ShareClassModel();
        
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    /*
    | Function  : Get all the teachers data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the teachers data
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
    | Function  : Get all the teachers data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the teachers data
    */

    public function load_data(Request $request)
    {
        DB::enableQueryLog();
        $UsersData   = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $search_date = $request->input('search_date');

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

        if($request->input('order')[0]['column'] == 4) 
        {
            $column = "contact";
        }

        if($request->input('order')[0]['column'] == 5) 
        {
            $column = "gender";
        }

        if($request->input('order')[0]['column'] == 6) 
        {
            $column = "created_at";
        }

        if($request->input('order')[0]['column'] == 7) 
        {
            $column = "is_active";
        }    

        $arr_data          = [];
        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');
        $obj_data          = DB::table('users')->whereRaw("(user_type = 'teacher')")
                                               ->select('users.*','country_phone_codes.iso','country_phone_codes.nicename','country_phone_codes.phonecode')
                                               ->leftJoin('country_phone_codes', 'country_phone_codes.id', '=', 'users.phone_code');

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR user_name LIKE '%".$keyword."%' OR contact LIKE '%".$keyword."%' OR gender LIKE '".$keyword."%' OR pin LIKE '%".$keyword."%' )");
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $count = count($obj_data->get());
        
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

        if(($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if( $order !='' && $column!='' )
        {
            $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        $UsersData = $obj_data->get();
        
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;

        if(count($UsersData)>0)
        {
            $i = 0;

            foreach($UsersData as $row)
            {
                $build_view_action = $build_active_btn = '' ;

                if($row->is_active != null && $row->is_active == "block")
                {
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row->is_active != null && $row->is_active == "active")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';
                }

                if ($row->is_verify == 'no') 
                {
                    $verify_href = $this->module_url_path.'/verify/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp; <a class="btn btn-link btn-danger btn-just-icon remove"  href="'.$verify_href.'" title="Verify Email" onclick="return confirm_action(this,event,\'Do you really want to verify this record ?\')"><i class="fa fa-times" > </i></a>';
                }
                else
                {
                    $build_view_action .= '&nbsp; <a class="btn btn-link btn-danger btn-just-icon remove" href="javascript:void(0);" title="Already Verified Email"><i class="fa fa-check" > </i></a>';

                }

                $view_href = $this->module_url_path.'/view/'.base64_encode($row->id);
                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                /*$edit_href = $this->module_url_path.'/edit/'.base64_encode($row->id); 
                $build_view_action .= '&nbsp; <a class="btn btn-circle btn-info btn-outline show-tooltip" href="'.$edit_href.'" title="Edit User details"><i class="fa fa-pencil" > </i></a>';*/

                $delete_href   = $this->module_url_path.'/delete/'.base64_encode($row->id);
                $transfer_href = $this->module_url_path.'/'.base64_encode($row->id).'/transfer_classes';
                $share_href    = $this->module_url_path.'/'.base64_encode($row->id).'/share_classes';

                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon remove" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>';

                $build_view_action   .= '<a href="javascript:void(0);" class="btn btn-link btn-info btn-just-icon like" data-toggle="dropdown">
                                            <i class="material-icons">chat</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="'.$transfer_href.'" class="btn btn-link btn-info like transfer_classes" ><i class="material-icons">swap_horiz</i> Transfer Classes</a></li>
                                            <li><a href="'.$share_href.'" class="btn btn-link btn-info like share_classes" ><i class="material-icons">share</i> Share Classes</a></li>
                                        </ul>';

                $final_array[$i][0] =  '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';   
                   
                $final_array[$i][1] = isset($row->pin) && $row->pin != '' ? $row->pin : "N/A";
                $final_array[$i][2] = isset($row->first_name) && isset($row->last_name) && $row->first_name != '' && $row->last_name != '' ? ucfirst($row->first_name).' '.ucfirst($row->last_name) : "N/A";
                $final_array[$i][3] = isset($row->email) && $row->email != '' ? $row->email : "N/A";
                $phone_code          = isset($row->phonecode)?$row->phonecode:'';
                if(isset($phone_code) && $phone_code!="")
                {
                    $str = '('.$phone_code.')';
                    $final_array[$i][4]  = isset($row->contact) && $row->contact != '' ?$str.$row->contact : "N/A";
                }
                else
                {
                    $final_array[$i][4]  = isset($row->contact) && $row->contact != '' ?$row->contact : "N/A";
                }
                //$final_array[$i][4] = isset($row->contact) && $row->contact != '' ? $row->contact : "N/A";
                $final_array[$i][5] = isset($row->gender) && $row->gender != '' ? ucfirst($row->gender) : "N/A";
                $final_array[$i][6] = isset($row->created_at) && $row->created_at != '' ? get_added_on_date_time($row->created_at) : "N/A";
                $final_array[$i][7] = $build_active_btn;
                $final_array[$i][8] = $build_view_action;

                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    } 

    public function view($enc_id=null)
    {
        if($enc_id)
        {
            /*$previous_url = \URL::previous();
            dd( base64_encode($previous_url) );*/

            $id       = base64_decode($enc_id);
            $arr_data = [];

            $obj_data = $this->UsersModel->where('id',$id)->with(['phone_code_details'])->first();
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

            $this->arr_view_data['classes_module_title'] = 'Manage Classes';
            $this->arr_view_data['classes_module_url']   = $this->module_url_path.'/view/'.$enc_id;
            $this->arr_view_data['classes_module_icon']  = 'fa fa-bank';
            
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
            $this->arr_view_data['parent_module_icon']   = "icon-home2";
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
    public function verify($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_verify(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' verified Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title.' verification');
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
    public function perform_verify($id)
    {
        $responce = $this->BaseModel->where('id',$id)->first();

        if($responce)
        {
            return $responce->update(['is_verify'=>'yes']);
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

    
    public function LoadClasses(Request $request)
    {
        $ClassesData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $end_date    = $request->input('end_date');
        $teacher_id  = $request->input('teacher_id');
        
        if($request->input('order')[0]['column'] == 1)
        {
            $column = "class_enrollment_code";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "subject_name";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "grade_name";
        }
        if($request->input('order')[0]['column'] == 5) 
        {
            $column = "end_date";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->ClassroomsModel->where('teacher_id', $teacher_id)
                                                    ->select('classroom.*','share_class.id as share_class_id','share_class.to_teacher_id','share_class.from_teacher_id')
                                                     ->join('share_class','share_class.classroom_id','=','classroom.id','left')
                                                     ->whereRaw("( 
                                                                    classroom.status = '1' AND 
                                                                    classroom.deleted_at IS NULL AND 
                                                                    (
                                                                        is_transfer = 'no' AND (to_teacher_id = ".$teacher_id." OR teacher_id = ".$teacher_id.")                                                              
                                                                    )  
                                                                    OR 
                                                                    (
                                                                        is_transfer = 'no' AND teacher_id = ".$teacher_id." AND to_teacher_id != '0'                                                                
                                                                    )
                                                                )")
                                                    ->with(['subject_data' => function($query){
                                                        $query->select('id', 'name as subject_name', 'locale', 'subject_id');
                                                    }])
                                                    ->with(['grade_data' => function($query){
                                                        $query->select('id', 'name as grade_name', 'locale', 'grade_id');
                                                    }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                                
                            $q->whereRaw("(class_enrollment_code LIKE '%".$keyword."%' OR name LIKE '%".$keyword."%' )")
                                ->orWhereHas("subject_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("grade_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                });
                        });
        }
        if(isset($end_date) && $end_date != "")
        {
            $obj_data = $obj_data->whereDate('end_date', '=', date('Y-m-d', strtotime($end_date)) );
        }

        $count = count($obj_data->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            if($column == 'name')
            {
                $obj_data = $obj_data->whereHas('classroom_translation', function ($query) use ($column,$order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'user_name')
            {
                $obj_data = $obj_data->whereHas('user_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('first_name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'subject_name')
            {
                $obj_data = $obj_data->whereHas('subject_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'grade_name')
            {
                $obj_data = $obj_data->whereHas('grade_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }
        //dd($obj_data->get()->toArray());

        $ClassesData             = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($ClassesData) > 0)
        {
            $i = 0;

            foreach($ClassesData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->admin_url_path.'/classrooms/activate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';                    
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->admin_url_path.'/classrooms/deactivate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action    = '';
                $delete_href          = $this->module_url_path.'/delete/'.base64_encode($row['id']);
                $view_href            = $this->admin_url_path.'/classrooms/view/'.base64_encode($row['id']);
                $edit_href            = $this->admin_url_path.'/classrooms/edit/'.base64_encode($row['id']);


                $build_view_action .= '&nbsp;<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="fa fa-pencil" ></i></a>';

                $build_view_action   .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                $final_array[$i][0]   = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                
                $final_array[$i][1]   = isset($row['class_enrollment_code']) && $row['class_enrollment_code'] != '' ? $row['class_enrollment_code'] : "NA";
                $final_array[$i][2]   = isset($row['name']) && $row['name'] != '' ? $row['name'] : "NA";
                $final_array[$i][3]   = isset($row['subject_data']['subject_name']) && $row['subject_data']['subject_name'] != '' ? $row['subject_data']['subject_name'] : "NA";
                $final_array[$i][4]   = isset($row['grade_data']['grade_name']) && $row['grade_data']['grade_name'] != '' ? $row['grade_data']['grade_name'] : "NA";
                $final_array[$i][5]   = isset($row['end_date']) && $row['end_date'] != '' ? get_added_on_date($row['end_date']) : "NA";
                $final_array[$i][6]   = $build_active_btn;
                $final_array[$i][7]   = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    }


    public function TransferClasses($enc_teacher_id = false)
    {
        if(isset($enc_teacher_id) && !empty($enc_teacher_id) && $enc_teacher_id != '')
        {
            $this->arr_view_data['enc_teacher_id']       = $enc_teacher_id;
            $this->arr_view_data['page_title']           = $this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_url_path']      = $this->module_url_path.'/'.$enc_teacher_id.'/transfer_classes';
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_url']           = $this->module_url_path;
            $this->arr_view_data['module_title']         = 'Teacher';
            $this->arr_view_data['sub_module_title']     = 'Transfer Classes';
            $this->arr_view_data['sub_module_icon']      = 'fa fa-eye';

            return view($this->module_view_folder.'.transfer_classrooms.index',$this->arr_view_data);
        }

    } // end TransferClasses


    public function LoadTransferClasses($enc_teacher_id = false, Request $request)
    {
        $ClassesData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $end_date    = $request->input('end_date');
        $teacher_id  = base64_decode($enc_teacher_id);

        if($request->input('order')[0]['column'] == 1)
        {
            $column = "class_enrollment_code";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "subject_name";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "grade_name";
        }
        if($request->input('order')[0]['column'] == 5) 
        {
            $column = "end_date";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->ClassroomsModel->where('teacher_id', $teacher_id)
                                                    ->where('is_transfer', 'yes')
                                                    ->with(['subject_data' => function($query){
                                                        $query->select('id', 'name as subject_name', 'locale', 'subject_id');
                                                    }])
                                                    ->with(['grade_data' => function($query){
                                                        $query->select('id', 'name as grade_name', 'locale', 'grade_id');
                                                    }])
                                                    ->with(['transfer_user_details' => function($query){
                                                        $query->select('id', 'first_name', 'last_name', 'email');
                                                    }]);
        //dd($obj_data->get()->toArray());

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                                
                            $q->whereRaw("(class_enrollment_code LIKE '%".$keyword."%' OR name LIKE '%".$keyword."%' )")
                                ->orWhereHas("subject_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("grade_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("transfer_user_details", function($query) use ($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                                });

                        });
        }
        if(isset($end_date) && $end_date != "")
        {
            $obj_data = $obj_data->whereDate('end_date', '=', date('Y-m-d', strtotime($end_date)) );
        }

        $count = count($obj_data->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            if($column == 'name')
            {
                $obj_data = $obj_data->whereHas('classroom_translation', function ($query) use ($column,$order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'user_name')
            {
                $obj_data = $obj_data->whereHas('user_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('first_name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'subject_name')
            {
                $obj_data = $obj_data->whereHas('subject_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'grade_name')
            {
                $obj_data = $obj_data->whereHas('grade_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }

        $ClassesData             = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($ClassesData) > 0)
        {
            $i = 0;

            foreach($ClassesData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->admin_url_path.'/classrooms/activate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->admin_url_path.'/classrooms/deactivate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';
                }

                $build_view_action    = '';
                $edit_href            = $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $delete_href          = $this->module_url_path.'/delete/'.base64_encode($row['id']);
                $view_href            = $this->admin_url_path.'/classrooms/view/'.base64_encode($row['id']);
                $build_view_action   .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                $final_array[$i][0]   = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                
                $first_name = isset($row['transfer_user_details']['first_name']) && !empty($row['transfer_user_details']['first_name']) ? $row['transfer_user_details']['first_name'] : '';
                $last_name = isset($row['transfer_user_details']['last_name']) && !empty($row['transfer_user_details']['last_name']) ? $row['transfer_user_details']['last_name'] : '';

                $final_array[$i][1]   = isset($row['class_enrollment_code']) && $row['class_enrollment_code'] != '' ? $row['class_enrollment_code'] : "NA";
                $final_array[$i][2]   = isset($row['name']) && $row['name'] != '' ? $row['name'] : "NA";
                $final_array[$i][3]   = $first_name.' '.$last_name;
                $final_array[$i][4]   = isset($row['subject_data']['subject_name']) && $row['subject_data']['subject_name'] != '' ? $row['subject_data']['subject_name'] : "NA";
                $final_array[$i][5]   = isset($row['grade_data']['grade_name']) && $row['grade_data']['grade_name'] != '' ? $row['grade_data']['grade_name'] : "NA";
                $final_array[$i][6]   = isset($row['end_date']) && $row['end_date'] != '' ? get_added_on_date($row['end_date']) : "NA";
                $final_array[$i][7]   = $build_active_btn;

                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    } // end LoadTransferClasses


    public function ShareClasses($enc_teacher_id = false)
    {
        if(isset($enc_teacher_id) && !empty($enc_teacher_id) && $enc_teacher_id != '')
        {
            $this->arr_view_data['enc_teacher_id']       = $enc_teacher_id;
            $this->arr_view_data['page_title']           = $this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_url_path']      = $this->module_url_path.'/'.$enc_teacher_id.'/share_classes';
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_url']           = $this->module_url_path;
            $this->arr_view_data['module_title']         = 'Teacher';
            $this->arr_view_data['sub_module_title']     = 'Share Classes';
            $this->arr_view_data['sub_module_icon']      = 'fa fa-eye';

            return view($this->module_view_folder.'.share_classrooms.index',$this->arr_view_data);
        }

    } // end ShareClasses


    public function LoadShareClasses($enc_teacher_id = false, Request $request)
    {
        $ClassesData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $end_date    = $request->input('end_date');
        $teacher_id  = base64_decode($enc_teacher_id);

        if($request->input('order')[0]['column'] == 1)
        {
            $column = "class_enrollment_code";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "subject_name";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "grade_name";
        }
        if($request->input('order')[0]['column'] == 5) 
        {
            $column = "end_date";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->ShareClassModel->where('from_teacher_id', $teacher_id)
                                                    ->with(['class_data' => function($query){
                                                        $query->select('id','class_enrollment_code','name','end_date','status','subject_id','grade_id');
                                                        $query->with(['subject_data' => function($sub_query){
                                                            $sub_query->select('id', 'name as subject_name', 'locale', 'subject_id');
                                                        }]);
                                                        $query->with(['grade_data' => function($sub_query){
                                                            $sub_query->select('id', 'name as grade_name', 'locale', 'grade_id');
                                                        }]);
                                                    }])
                                                    ->with(['share_to_user' => function($query){
                                                        $query->select('id','first_name','last_name','email','pin');
                                                    }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                                
                            $q->whereRaw("(to_teacher LIKE '%".$keyword."%' )")
                                ->orWhereHas("class_data", function($query) use ($keyword) {
                                    $query->whereRaw("(class_enrollment_code LIKE '%".$keyword."%' OR name LIKE '%".$keyword."%' )");
                                    $query->orWhereHas("subject_data", function($sub_query) use ($keyword){
                                        $sub_query->where('name', 'like','%'.$keyword.'%');
                                    });
                                    $query->orWhereHas("grade_data", function($sub_query) use ($keyword){
                                        $sub_query->where('name', 'like','%'.$keyword.'%');
                                    });
                                })
                                ->orWhereHas("share_to_user", function($query) use ($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                                });

                        });
        }
        if(isset($end_date) && $end_date != "")
        {
            $obj_data = $obj_data->whereHas("class_data", function($query) use ($end_date) {
                                        $query->whereDate('end_date', '=', date('Y-m-d', strtotime($end_date)) );
                                    });
        }

        $count = count($obj_data->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            if($column == 'name')
            {
                $obj_data = $obj_data->whereHas('classroom_translation', function ($query) use ($column,$order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'user_name')
            {
                $obj_data = $obj_data->whereHas('user_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('first_name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'subject_name')
            {
                $obj_data = $obj_data->whereHas('subject_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'grade_name')
            {
                $obj_data = $obj_data->whereHas('grade_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }

        $ClassesData             = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($ClassesData) > 0)
        {
            $i = 0;

            foreach($ClassesData as $row)
            {
                if($row['class_data']['status'] != null && $row['class_data']['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->admin_url_path.'/classrooms/activate/'.base64_encode($row['classroom_id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['class_data']['status'] != null && $row['class_data']['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->admin_url_path.'/classrooms/deactivate/'.base64_encode($row['classroom_id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';
                }

                $build_view_action    = '';
                $edit_href            = $this->module_url_path.'/edit/'.base64_encode($row['classroom_id']);
                $delete_href          = $this->module_url_path.'/delete/'.base64_encode($row['classroom_id']);
                $view_href            = $this->admin_url_path.'/classrooms/view/'.base64_encode($row['classroom_id']);
                $build_view_action   .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                $final_array[$i][0]   = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['classroom_id']).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                
                if(!empty($row['share_to_user']) && $row['share_to_user'] != null)
                {
                    $first_name = isset($row['share_to_user']['first_name']) && !empty($row['share_to_user']['first_name']) ? $row['share_to_user']['first_name'] : '';
                    $last_name  = isset($row['share_to_user']['last_name']) && !empty($row['share_to_user']['last_name']) ? $row['share_to_user']['last_name'] : '';

                    $user_name = $first_name.' '.$last_name;
                }
                else
                {
                    $user_name = $row['to_teacher'];
                }

                $final_array[$i][1]   = isset($row['class_data']['class_enrollment_code']) && $row['class_data']['class_enrollment_code'] != '' ? $row['class_data']['class_enrollment_code'] : "NA";
                $final_array[$i][2]   = isset($row['class_data']['name']) && $row['class_data']['name'] != '' ? $row['class_data']['name'] : "NA";
                $final_array[$i][3]   = $user_name;
                $final_array[$i][4]   = isset($row['class_data']['subject_data']['subject_name']) && $row['class_data']['subject_data']['subject_name'] != '' ? $row['class_data']['subject_data']['subject_name'] : "NA";
                $final_array[$i][5]   = isset($row['class_data']['grade_data']['grade_name']) && $row['class_data']['grade_data']['grade_name'] != '' ? $row['class_data']['grade_data']['grade_name'] : "NA";
                $final_array[$i][6]   = isset($row['class_data']['end_date']) && $row['class_data']['end_date'] != '' ? get_added_on_date($row['class_data']['end_date']) : "NA";
                $final_array[$i][7]   = $build_active_btn;

                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    } // end LoadShareClasses


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_users = [];

        $form_data    = $request->all();
        $keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $search_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        
        $obj_data = DB::table('users')->whereRaw("(user_type = 'teacher')")->where('deleted_at','=',null);

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
                $first_name = isset($users->first_name) ? ucfirst($users->first_name) : '';
                $last_name  = isset($users->last_name) ? ucfirst($users->last_name) : '';

                $data['Sr. No.']          = ( $key + 1 );
                $data['User Name']        = $first_name.' '.$last_name;
                $data['Pin']              = isset($users->pin) ? $users->pin : '';
                $data['Enrollment Code '] = isset($users->enrollment_code) ? $users->enrollment_code : '';
                $data['Email']            = isset($users->email) ? $users->email : '';
                $data['Mobile no']        = isset($users->contact) ? $users->contact : '';
                $data['Gender']           = isset($users->gender) ? ucfirst($users->gender) : 'NA';
                $data['Address']          = isset($users->address) ? $users->address : '';
                
                $preferred_language       = isset($users->preferred_language) ? $users->preferred_language : '';
                if($preferred_language == 'en') {
                    $data['Preferred Language'] = 'English';
                }
                else if($preferred_language == 'cn') {
                    $data['Preferred Language'] = 'Chinese';
                }
                else {
                    $data['Preferred Language'] = 'NA';
                }

                $data['Email Verified']   = isset($users->is_verify) ? ucwords($users->is_verify) : '';
                $data['Mobile Verified']  = isset($users->is_mobile_verify) ? ucwords($users->is_mobile_verify) : '';
                $data['Is Active']        = isset($users->is_active) ? ucwords($users->is_active) : '';
                $data['Social Login']     = isset($users->is_social) ? ucwords($users->is_social) : 'NA';

                if($data['Social Login'] == 'No') {
                    $data['Social via'] = 'NA';
                }
                else {
                    $data['Social via'] = isset($users->social_via) ? ucwords($users->social_via) : 'NA';
                }

                $data['Registrated Date'] = isset($users->created_at) ? get_added_on_date_time($users->created_at) : 'NA';

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        //$type = 'XLSX';
        $type = 'CSV';

        return Excel::create('Teacher Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Teacher Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Teacher Report');

            $excel->sheet('Teacher Report', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

    }

}
