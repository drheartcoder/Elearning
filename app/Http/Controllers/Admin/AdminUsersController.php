<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UsersModel;
use App\Common\Services\EmailService;
use App\Common\Services\NewsletterService;
use App\Models\ModulesModel;

use Validator;
use Session;
use Hash;
use DB;

class AdminUsersController extends Controller
{
    function __construct(
                            UsersModel    $users_model,
                            EmailService $email_service,
                            NewsletterService $NewsletterService,
                            ModulesModel $modules_model
                        )
    {
     
        
        $this->module_title                  = "Admin Users";
        $this->module_url_path               = url('/admin/admin_users');
        $this->module_view_folder            = "admin.admin_users";
        $this->module_icon                   = "fa fa-user-secret";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        
        $this->UsersModel                    = $users_model;
        $this->BaseModel                     = $this->UsersModel;
        $this->ModulesModel                  = $modules_model;
        $this->EmailService                  = $email_service;
        $this->NewsletterService             = $NewsletterService;

        
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    /*
    | Name : Deepak Bari 
    | Function : Show Account setting form.
    | Date : 14-04-2018
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

    public function load_data(Request $request)
    {
        DB::enableQueryLog();
        $ContactEnquiryData    =  $final_array=[]; 
        $column      = '';

        $keyword   = $request->input('keyword');
        $user_type = $request->input('user_type');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "first_name";
        }     
  
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "email";
        }    

        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "contact";
        }    

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_data               = [];

        $arr_search_column      = $request->input('column_filter');

        $obj_data = DB::table('users')
                    ->whereRaw("(user_type = 'program-creator' OR user_type = 'supervisor' OR user_type = 'subadmin')")                      
                    ->where('deleted_at','=',null);                                 
        
        if(isset($user_type) && $user_type!='')
        {
            $obj_data = $obj_data->where('user_type','=',$user_type);                                 
        }
        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
        }

        $count        = count($obj_data->get());        
        
    
        if(($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data   = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
        }
        if( $order !='' && $column!='' )
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
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

                    $edit_href = $this->module_url_path.'/edit/'.base64_encode($row->id); 
                    $build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit User details"><i class="material-icons" >create</i></a>'; 

                    $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp;<a class="btn btn-link btn-warning btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="fa fa-trash" ></i></a>'; 

                    $reporting_to = '-';
                    if($row->user_type=='supervisor')
                    {
                        $type = 'Supervisor';
                    }
                    else if($row->user_type=='subadmin')
                    {
                        $type = 'Subadmin';
                    }
                    else
                    {
                        $type = 'Program Creator';
                        if(isset($row->reporting_to) && $row->reporting_to!=null){
                            $arr_supervisor = $this->UsersModel->where('id',$row->reporting_to)->first();
                            if(isset($arr_supervisor) && count($arr_supervisor)>0){
                                $reporting_to = $arr_supervisor['first_name'].' '.$arr_supervisor['last_name'];
                            }
                        }
                    }

                    $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';

                    $final_array[$i][1] = isset($row->first_name) && isset($row->last_name) && $row->first_name!='' && $row->last_name!='' ?ucfirst($row->first_name.' '.$row->last_name):"N/A";
                    $final_array[$i][2] = isset($row->email) && $row->email!=''?$row->email:"N/A";
                    $final_array[$i][3] = isset($row->contact) && $row->contact!=''?$row->contact:"N/A";
                    $final_array[$i][4] = isset($type) && $type!=''?$type:"N/A";
                    $final_array[$i][5] = isset($reporting_to) && $reporting_to!=''?$reporting_to:"-";
                    $final_array[$i][6] = $build_active_btn;
                    $final_array[$i][7] = $build_view_action;
                  
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

            $obj_data = $this->UsersModel->where('id',$id)->with('reporting_to_details')->first();
            if($obj_data)
            {
                $arr_data = $obj_data->toArray();
            }

            $this->arr_view_data['arr_data']             = $arr_data;
            $this->arr_view_data['page_title']           = str_singular($this->module_title)." Details";
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;            
            $this->arr_view_data['sub_module_title']     =  'Show '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      =  'fa fa-eye';            
            
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
        $arr_modules = $arr_supervisor = [];
        $obj_modules    =   $this->ModulesModel
                            ->where('is_active','1')
                            ->orderBy('title','ASC')
                            ->get();

        if($obj_modules != FALSE)
        {
            $arr_modules=$obj_modules->toArray();
        }

        $arr_not_to_create_list = ['account_setting/password/change',
                                   'account_setting/edit_profile',
                                   'account_setting/site_status',
                                   'account_setting/reference_code',
                                   'global_setting',
                                   'email_template',
                                   'notifications',
                                   'front_pages',
                                   'contact_enquiry',
                                   'subscription_plan',
                                   'institutes',
                                   'applied_trainers',
                                   'shortlist_trainers',
                                   'flyer',
                                   'users',
                                   'classrooms','transaction','wire_transfer_request'];        

        $arr_not_to_update_list = ['notifications','contact_enquiry','users','classrooms','gallery','transaction','wire_transfer_request'];      

        $arr_not_to_delete_list = ['account_setting/password/change',
                                    'account_setting/edit_profile',
                                    'account_setting/site_status',
                                    'global_setting',
                                    'email_template',
                                    'front_pages',
                                    'account_setting/currency',
                                    'account_setting/reference_code',
                                    'subscription_plan',
                                    'classrooms',
                                    'transaction','wire_transfer_request'];     
         
        $obj_supervisor  =  $this->UsersModel->select('id','first_name','last_name')->where('is_active','active')->where('user_type','supervisor')->orderBy('first_name','ASC')->get();
        if($obj_supervisor!=false){
            $arr_supervisor = $obj_supervisor->toArray();    
        }

        $this->arr_view_data['arr_not_to_create_list']  = $arr_not_to_create_list;
        $this->arr_view_data['arr_not_to_update_list']  = $arr_not_to_update_list;
        $this->arr_view_data['arr_not_to_delete_list']  = $arr_not_to_delete_list;
        
        $this->arr_view_data['arr_modules']             = $arr_modules;
        $this->arr_view_data['arr_supervisor']          = $arr_supervisor;

        $this->arr_view_data['page_title']          = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          =  $this->module_url_path;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['sub_module_title']    = 'Add '.$this->module_title;
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

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
        $arr_rules['email']        = "required|email";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }        
        
        $check_email_duplicate = $this->UsersModel->where('email',trim($request->input('email')))
                                                  ->where('deleted_at','=',null)
                                                  ->get();
                                        
        if(count($check_email_duplicate)>0)
        {
            Session::flash('error','Email Already exist, Please try another email.');
            return redirect()->back()->withInput();
        }

        $permissions              =   $request->input('arr_permisssion');

        if(isset($permissions) && sizeof($permissions)>0)
        {
            $permission_arr    =   $permissions['subadmin'];
        }

        $arr_data['permissions']   = json_encode($permission_arr);            
        $arr_data['first_name']    = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']     = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['phone_code']    = $request->input('phone_code','');
        $arr_data['contact']       = $request->input('contact','');
        $arr_data['user_type']     = $request->input('user_type');
        $arr_data['address']       = trim($request->input('address'));
        $arr_data['email']         = trim($request->input('email'));
        $arr_data['password']      = Hash::make(trim($request->input('password')));
        $arr_data['is_active']     = 'active';
        $arr_data['is_verify']     = 'yes';
        if($request->input('user_type')=='program-creator'){
            $arr_data['reporting_to']   = base64_decode($request->input('reporting_to'));            
        }

        $obj_data = $this->UsersModel->create($arr_data);       
        $full_name = trim(ucfirst(strtolower($request->input('first_name').' '.$request->input('last_name'))));
        $password = trim($request->input('password'));        
        
        if($arr_data['user_type']=='supervisor')
        {
            $type = 'Supervisor';
        }
        else if($arr_data['user_type']=='subadmin')
        {
            $type = 'Subadmin';
        }
        else
        {
            $type = 'Program Creator';
        }

        if($obj_data)
        {
            // Newsletter subscribers
            $status = $this->NewsletterService->subscribe($obj_data->id, $obj_data->user_type);
            
            $arr_built_content = [  'EMAIL'        => $arr_data['email'],
                                    'PASSWORD'     => $password,
                                    'SITE_LINK'    => url('/').'/'.$arr_data['user_type'],
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
            $arr_user = $arr_supervisor = [];
            $obj_user = $this->UsersModel->where('id',$id)                                              
                                            ->first();
            if($obj_user)
            {
               $arr_user = $obj_user->toArray();
            }
            //dd($arr_user);
            $arr_modules = [];
            $obj_modules    =   $this->ModulesModel
                                ->where('is_active','1')
                                ->orderBy('title','ASC')
                                ->get();

            if($obj_modules != FALSE)
            {
                $arr_modules=$obj_modules->toArray();
            }

            $arr_not_to_create_list = ['account_setting/password/change',
                                       'account_setting/edit_profile',
                                       'account_setting/site_status',
                                       'account_setting/reference_code',
                                       'global_setting',
                                       'email_template',
                                       'notifications',
                                       'front_pages',
                                       'contact_enquiry',
                                       'subscription_plan',
                                       'institutes',
                                       'applied_trainers',
                                       'shortlist_trainers',
                                       'flyer',
                                       'users',
                                       'classrooms',
                                       'transaction',
                                       'program','wire_transfer_request'];        

            $arr_not_to_update_list = ['notifications','contact_enquiry','users','gallery','transaction','wire_transfer_request'];      

            $arr_not_to_delete_list = ['account_setting/password/change',
                                        'account_setting/edit_profile',
                                        'account_setting/site_status',
                                        'global_setting',
                                        'email_template',
                                        'front_pages',
                                        'account_setting/currency',
                                        'account_setting/reference_code',
                                        'subscription_plan',
                                        'classrooms','transaction','wire_transfer_request'];     
             
            $obj_supervisor  =  $this->UsersModel->select('id','first_name','last_name')->where('is_active','active')->where('user_type','supervisor')->orderBy('first_name','ASC')->get();
            if($obj_supervisor!=false){
                $arr_supervisor = $obj_supervisor->toArray();    
            }
            $this->arr_view_data['arr_not_to_create_list']  = $arr_not_to_create_list;
            $this->arr_view_data['arr_not_to_update_list']  = $arr_not_to_update_list;
            $this->arr_view_data['arr_not_to_delete_list']  = $arr_not_to_delete_list;
            
            $this->arr_view_data['arr_modules']             = $arr_modules;
            $this->arr_view_data['arr_supervisor']          = $arr_supervisor;
            
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

        $permissions              =   $request->input('arr_permisssion');

        if(isset($permissions) && sizeof($permissions)>0)
        {
            $permission_arr    =   $permissions['subadmin'];
        }     
        $arr_data['permissions']   = json_encode($permission_arr);          
        $arr_data['first_name']    = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']     = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['contact']       = $request->input('contact');        
        $arr_data['address']       = trim($request->input('address'));
        $arr_data['phone_code']    = trim($request->input('phone_code',''));
        if($request->input('user_type')=='program-creator'){
            $arr_data['reporting_to']   = base64_decode($request->input('reporting_to'));            
        }

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
        //dd($request->all());
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
            if($multi_action=="activate")
            {
               $resActive = $this->perform_activate(base64_decode($record_id)); 
               Session::flash('success', $this->module_title. ' unblocked Successfully');
            }
            elseif($multi_action=="deactivate")
            {
               $resDeactive = $this->perform_deactivate(base64_decode($record_id));   
               Session::flash('success', $this->module_title. ' blocked Successfully');
            }
            elseif($multi_action=="delete")
            {
               $resDeactive = $this->perform_delete(base64_decode($record_id));   
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
    public function perform_delete($id)
    {

        $delete= $this->BaseModel->where('id',$id)->delete();
        
        if($delete)
        {
            return TRUE;
        }

        return FALSE;
    }
    
}
