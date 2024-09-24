<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;

use App\Models\UsersModel;
use App\Models\StudentDetailsModel;
use App\Models\SubscriptionPlanModel;
use App\Models\CurrencyRateModel;
use App\Models\ReferenceCodeModel;
use App\Models\TransactionsModel;

use Validator;
use Session;
use Excel;
use Hash;
use PDF;
use DB;

class ParentController extends Controller
{
    function __construct(
                            UsersModel   $users_model,
                            EmailService $email_service,
                            SubscriptionPlanModel $subscription_plan
                        )
    {
        $this->module_title                  = "Parent";
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/users/parent");
        $this->module_view_folder            = "admin.users.parent";
        $this->module_icon                   = "fa fa-users";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        
        $this->UsersModel                    = $users_model;
        $this->BaseModel                     = $this->UsersModel;
        $this->EmailService                  = $email_service;
        $this->SubscriptionPlanModel         = $subscription_plan;
        $this->StudentDetailsModel           = new StudentDetailsModel();
        $this->CurrencyRateModel             = new CurrencyRateModel();
        $this->ReferenceCodeModel            = new ReferenceCodeModel();
        $this->TransactionsModel             = new TransactionsModel();
        
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.user_profile_image');
    }

    /*
    | Function  : Get all the Parent data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the Parent data
    */

    public function index()
    {    
        $arr_plan= [];      
        $plan_obj = $this->SubscriptionPlanModel->get();
        if (isset($plan_obj) && count($plan_obj)>0) 
        {
            $arr_plan = $plan_obj->toArray();
        }
        //dd($arr_plan);
        $this->arr_view_data['arr_plan']            = $arr_plan;
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
    | Function  : Get all the Parent data
    | Author    : Deepak Arvind Salunke
    | Date      : 19/06/2018
    | Output    : Show all the Parent data
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

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_data               = [];

        $arr_search_column      = $request->input('column_filter');

        $obj_data = DB::table('users')
                    ->select('users.*','transactions.extension_date','transactions.expiry_date','transactions.plan_id','country_phone_codes.iso','country_phone_codes.nicename','country_phone_codes.phonecode')
                    ->whereRaw("(user_type = 'parent')")
                    ->where('users.deleted_at','=',null)
                     ->leftJoin('country_phone_codes', 'country_phone_codes.id', '=', 'users.phone_code')
                    ->leftJoin('transactions',function($query){
                        $query->on('transactions.user_id','=','users.id');
                        $query->where('transactions.status','=','active');
                    });

        if(isset($user_type) && $user_type!='')
        {
            $obj_data = $obj_data->where('user_type','=',$user_type);
        }
        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR user_name LIKE '%".$keyword."%' OR contact LIKE '%".$keyword."%' OR gender LIKE '".$keyword."%' OR pin LIKE '%".$keyword."%' )");
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $count        = count($obj_data->get());
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        
        if (($order =='ASC' || $order =='') && $column=='') {
          $obj_data   = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }

        if ( $order !='' && $column!='' ) {
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
                    $build_membership_action = '';$build_view_action = '';  $build_active_btn = '' ; 

                    /*if($row->is_active_membership != null && $row->is_active_membership == "no")
                    {   
                        $data_url = $this->module_url_path.'/upgrade_plan/'.base64_encode($row->id);

                        $build_membership_action = '<a class="btn btn-link btn-warning btn-just-icon like upgradePlan" title="Upgrade Plan" href="javascript:void(0);" data-url="'.$data_url.'" ><i class="fa fa-star-o"></i></a>';
                    }
                    elseif($row->is_active_membership != null && $row->is_active_membership == "yes")
                    {
                       $build_membership_action = '<a class="btn btn-link btn-success btn-just-icon like" title="Already Subscribed" href="javascript:void(0);"><i class="fa fa-star"></i></a>';      
                    }*/

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

                    $expiration_date = "-";
                    if($row->expiry_date!=null)
                    {
                        $expiration_date = get_added_on_date($row->expiry_date);
                    }

                    if(date('Y-m-d',strtotime($row->extension_date)) <= date('Y-m-d',strtotime('+3 days'))){
                        $extension_date = "<span style='color:orange'>".get_added_on_date($row->extension_date)."</span>";
                    }else{
                        $extension_date = "<span style='color:green'>".get_added_on_date($row->extension_date)."</span>";
                    }
                    if(date('Y-m-d',strtotime($row->extension_date)) == date('Y-m-d')){
                        $extension_date = "<span style='color:red'>".get_added_on_date($row->extension_date)."</span>";
                    }
                    if($row->plan_id==4){
                        $extension_date  = "Lifetime";
                        $expiration_date = "Lifetime";
                    }

                    if($row->extension_date==null){
                        $extension_date = "-";   
                    }
                    $phone_code          = isset($row->phonecode)?$row->phonecode:'';
                    $final_array[$i][1]  = isset($row->pin) && $row->pin != '' ? $row->pin : "-";
                    $final_array[$i][2]  = isset($row->first_name) && isset($row->last_name) && $row->first_name != '' && $row->last_name != '' ? ucfirst($row->first_name).' '.ucfirst($row->last_name) : "N/A";
                    $final_array[$i][3]  = isset($row->email) && $row->email != '' ? $row->email : "N/A";
                    if(isset($phone_code) && $phone_code!="")
                    {
                        $str = '('.$phone_code.')';
                        $final_array[$i][4]  = isset($row->contact) && $row->contact != '' ?$str.$row->contact : "N/A";
                    }
                    else
                    {
                        $final_array[$i][4]  = isset($row->contact) && $row->contact != '' ?$row->contact : "N/A";
                    }
                    $final_array[$i][5]  = isset($row->gender) && $row->gender != '' ? ucfirst($row->gender) : "N/A";
                    $final_array[$i][6]  = isset($row->created_at) && $row->created_at != '' ? get_added_on_date_time($row->created_at) : "-";
                    $final_array[$i][7]  = $expiration_date;
                    $final_array[$i][8]  = $extension_date;
                    $final_array[$i][9]  = get_membership_status($row->id);
                    /*$final_array[$i][7] = $build_membership_action;*/
                    $final_array[$i][10]  = $build_active_btn;
                    $final_array[$i][11] = $build_view_action;
                  
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

            $obj_data = $this->UsersModel->with(['transaction_details','phone_code_details'])->where('id',$id)->first();
            if($obj_data)
            {
                $arr_data = $obj_data->toArray();
            }

            $this->arr_view_data['arr_data']              = $arr_data;
            $this->arr_view_data['page_title']            = $this->module_title;
            $this->arr_view_data['parent_module_icon']    = "fa fa-home";
            $this->arr_view_data['parent_module_title']   = "Dashboard";
            $this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
            $this->arr_view_data['module_url_path']       = $this->module_url_path;
            $this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']           = $this->module_icon;
            $this->arr_view_data['module_url']            = $this->module_url_path;
            $this->arr_view_data['module_title']          = "Manage ".$this->module_title;
            $this->arr_view_data['sub_module_title']      = 'Show '.$this->module_title;
            $this->arr_view_data['sub_module_icon']       = 'fa fa-eye';

            $this->arr_view_data['children_module_title'] = 'Manage Children';
            $this->arr_view_data['children_module_icon']  = 'fa fa-user';
            $this->arr_view_data['children_module_url']   = $this->module_url_path.'/view/'.$enc_id;
            
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
    public function upgrade_plan($enc_id = FALSE,Request $request)
    {
        $plan_id            = $request->input('plan_id');
        $user_id            = base64_decode($enc_id);
        $pan_details_arr    = getPlanDetails($plan_id);
        $arr_global_setting = getGlobalSetting();

        $reference_settings_arr     = $this->ReferenceCodeModel->first(); 

       /* $from_currency_code         = 'CNY'; $to_currency_code = 'CNY';
        $currency_conversion_arr    = $this->CurrencyRateModel->where('from_currency_code',$from_currency_code)->where('to_currency_code',$to_currency_code)->first();  

        $from_currency_arr          =  CurrencyRateModel($currency_conversion_arr['from_currency_id']);
        $to_currency_arr            =  CurrencyRateModel($currency_conversion_arr['to_currency_id']); 

        $from_currency_symbol       =  html_entity_decode($from_currency_arr['html_code']);
        $to_currency_symbol         =  html_entity_decode($to_currency_arr['html_code']); 

        $from_currency              =  $from_currency_arr['id'];
        $to_currency                =  $to_currency_arr['id'];*/

      /* $reward_amount               =  ($pan_details_arr['price']*($reference_settings_arr['reward_amount']/100));           */     
        /*$converted_discount_price   =  ($currency_conversion_arr['rate']*$reward_amount);*/

        /*$converted_total_price      =  $to_currency_symbol.' '.number_format((($currency_conversion_arr['rate']*$pan_details_arr['price'])-$converted_discount_price),'3');*/

        /*$per_unit_conversion_rate   =  $currency_conversion_arr['rate'];*/
        $plan_expired_date          =  ($plan_id!=4) ? date('Y-m-d',strtotime('+'.$pan_details_arr['validity'])) : "";

        $insert_arr = array(
                    'user_id'                  => $user_id,
                    'amount'                   => $pan_details_arr['price'],
                    'plan_id'                  => $pan_details_arr['id'],                 
                    'expiry_date'              => $plan_expired_date,                            
                    'transaction_date'         => date('Y-m-d'),
                    'status'                   => 'active',
                    'invoice'                  => '',
                    'coupon_id'                => '0',
                    'coupon_usage_id'          => '0',
                    'per_unit_conversion_rate' => '1',
                    'total_converted_amount'   => $pan_details_arr['price'],
                    'from_currency'            => '2',
                    'to_currency'              => '2',
                    'transaction_id'           => '',
                    'payment_via'              => 'wire-transfer'
                );
        
        $res = $this->TransactionsModel->insertGetId($insert_arr);
        if($res)
        {         
            $code = '0'; 
            $invoice = $this->generateInvoice($res);
            DB::table('transactions')->where('id',$res)->update(['invoice'=>$invoice]);

            if($this->perform_upgrade_plan($user_id))
            {
                Session::flash('success', $this->module_title. ' Plan Upgrade Successfully');
            }
            else
            {
                Session::flash('error', 'Problem Occured While '.$this->module_title.' Upgrade Plan ');
            }
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
            Session::flash('error', 'Problem occured while '.$this->module_title.' Deletion ');
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
    public function perform_upgrade_plan($id)
    {
        
        $responce = $this->BaseModel->where('id',$id)->first();
        if($responce)
        {
            return $responce->update(['is_active_membership'=>'yes']);
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
    function generateInvoice($transaction_id=false)
    {
        $ReceivedData=[]; $SenderData=[];
        $html = $view = "";
        //$transaction_id = '58';
        if(isset($transaction_id) && $transaction_id!=false)
        {
            $TrasactionData = DB::table('transactions')
                            ->select('transactions.*','subscription_plan.validity','subscription_plan_translation.name','coupons.coupon_code','coupons.discount_amount')    
                            ->join('coupons','coupons.id','=','transactions.coupon_id','left')
                            ->join('subscription_plan','subscription_plan.id','=','transactions.plan_id')
                            ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','subscription_plan.id')
                            ->where('transactions.id',$transaction_id)
                            ->where('subscription_plan_translation.locale','en')                            
                            ->first();
            // dd($TrasactionData);
            $SenderData   = DB::table('users')->where('id',$TrasactionData->user_id)->select('first_name','last_name','id','email','address')->first();
            $ReceivedData = DB::table('site_status')->select('site_name','site_contact_number','site_email_address')->first();

            $data['logo']     = url('/images/logo-footer.png');
            $data['base_url'] = url('/');
       
            $view = view('invoice_pdf')->with(['ReceivedData'=>$ReceivedData,'SenderData'=>$SenderData,'TrasactionData'=>$TrasactionData,'Data'=>$data]);
            $html = $view->render();

            $FileName = 'Invoice_T'.$transaction_id.'.pdf';
            $res      = PDF::loadHTML($html)->save(base_path('uploads/invoice/'.$FileName),'F');
            
            return $FileName;   
        }
    }

    public function LoadChildren(Request $request)
    {
        DB::enableQueryLog();

        $ChildrenData = $final_array = [];
        $column       = '';
        $keyword      = $request->input('keyword');
        $search_date  = $request->input('search_date');
        $parent_id    = $request->input('parent_id');

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
            $column = "subject";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "grade";
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

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_data          = [];
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->StudentDetailsModel->where('parent_id', $parent_id)
                                                        ->with(['user_data' => function($query){
                                                            $query->select('id', 'first_name', 'last_name', 'pin', 'is_active', 'created_at');
                                                        }])
                                                        ->with(['subject_trans' => function($query){ }])
                                                        ->with(['grade_trans' => function($query){ }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                                $q->WhereHas("user_data", function($query) use ($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR pin LIKE '%".$keyword."%' )");
                                })
                                ->orWhereHas("subject_trans", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                 ->orWhereHas("grade_trans", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                });
                            });
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->where(function($q) use($search_date) {
                                $q->orWhereHas("user_data", function($query) use ($search_date){
                                    $query->whereDate('created_at', '=', date('Y-m-d', strtotime($search_date)) );
                                });
                            });
        }

        $count        = count($obj_data->get());
        if($order == 'ASC' && $column == '')
        {
            $obj_data   = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if( $order !='' && $column!='' )
        {
            if($column == 'pin' || $column == 'first_name' || $column == 'gender' || $column == 'is_active')
            {
                $obj_data = $obj_data->whereHas('user_data', function ($query) use ($column, $order)
                {
                    $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'subject')
            {
                $obj_data = $obj_data->whereHas('subject_trans', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
                });
            }
            elseif($column == 'grade')
            {
                $obj_data = $obj_data->whereHas('grade_trans', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order)->limit($_GET['length'])->offset($_GET['start']);
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
                if(isset($row->user_data) && $row->user_data!='')
                {


                    $build_view_action = $build_active_btn = '' ; 

                    if($row->user_data->is_active != null && $row->user_data->is_active == "block")
                    {   
                        $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->admin_url_path.'/users/student/activate/'.base64_encode($row->user_data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                    }
                    elseif($row->user_data->is_active != null && $row->user_data->is_active == "active")
                    {
                       $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->admin_url_path.'/users/student/deactivate/'.base64_encode($row->user_data->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                    }

                    $view_href = $this->admin_url_path.'/users/student/view/'.base64_encode($row->user_data->id); 
                    $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                    $final_array[$i][0] =  '<div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->user_data->id).'">
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>';

                    $final_array[$i][1] = isset($row->user_data->pin) && $row->user_data->pin != '' ? $row->user_data->pin : "-";
                    $final_array[$i][2] = isset($row->user_data->first_name) && isset($row->user_data->last_name) && $row->user_data->first_name != '' && $row->user_data->last_name != '' ? ucfirst($row->user_data->first_name).' '.ucfirst($row->user_data->last_name) : "N/A";
                    $final_array[$i][3] = isset($row->subject_trans->name) && $row->subject_trans->name != '' ? ucfirst($row->subject_trans->name) : "N/A";
                    $final_array[$i][4] = isset($row->grade_trans->name) && $row->grade_trans->name != '' ? ucfirst($row->grade_trans->name) : "N/A";
                    $final_array[$i][5] = isset($row->user_data->gender) && $row->user_data->gender != '' ? ucfirst($row->user_data->gender) : "N/A";
                    $final_array[$i][6] = isset($row->user_data->created_at) && $row->user_data->created_at != '' ? get_added_on_date_time($row->user_data->created_at) : "N/A";
                    $final_array[$i][7] = $build_active_btn;
                    $final_array[$i][8] = $build_view_action;

                    $i++;
                }
            }
        }

        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    } // end LoadChildren


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_users = [];

        $form_data    = $request->all();
        $keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $search_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        
        $obj_data = DB::table('users')->whereRaw("(user_type = 'parent')")->where('deleted_at','=',null);

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

        return Excel::create('Parent Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Parent Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Parent Report');

            $excel->sheet('Parent Report', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

    }
}
