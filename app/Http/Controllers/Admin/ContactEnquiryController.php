<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\EmailService;
use App\Models\ContactEnquiryModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class ContactEnquiryController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                LanguageService     $language_service,
                                EmailService        $email_service,
                                ContactEnquiryModel $contact_enquiry_model
                                )
	{
        $this->arr_view_data       = [];
        $this->LanguageService     = $language_service;
        $this->ContactEnquiryModel = $contact_enquiry_model;
        $this->BaseModel           = $this->ContactEnquiryModel;
        $this->EmailService        = $email_service;

        $this->module_title        = "Contact Enquiry";
        $this->module_icon         = "fa fa-phone";
        $this->module_view_folder  = "admin.contact_enquiry";
        $this->admin_url_path      = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug    = config('app.project.admin_panel_slug');
        $this->module_url_path     = url(config('app.project.admin_panel_slug')."/contact_enquiry");
	}

	public function index()
	{
		$this->arr_view_data['page_title']           = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}   

    public function load_data(Request $request)
    {
        $ContactEnquiryData    =  $final_array=[]; 
        $column      = '';

        $first_name = $request->input('first_name');
        $last_name  = $request->input('last_name');
        $email      = $request->input('email');
        $mobile     = $request->input('mobile');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "first_name";
        }

        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "last_name";
        }     
  
        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "email";
        }    

        if($request->input('order')[0]['column'] == 4) 
        {
            $column = "mobile";
        }    

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_data          = [];

        $arr_search_column = $request->input('column_filter');
        $obj_data          = DB::table('contact_enquiry')
                                ->select('contact_enquiry.*','country_phone_codes.iso','country_phone_codes.nicename','country_phone_codes.phonecode')
                                ->leftJoin('country_phone_codes', 'country_phone_codes.id', '=', 'contact_enquiry.phone_code')
                                ->where('contact_enquiry.deleted_at','=',null);

        if(isset($first_name) && $first_name != "")
        {
            $obj_data = $obj_data->whereRaw("(first_name LIKE '%".$first_name."%')");
        }
        if(isset($last_name) && $last_name != "")
        {
            $obj_data = $obj_data->whereRaw("(last_name LIKE '%".$last_name."%')");
        }

        if(isset($email) && $email != "")
        {
            $obj_data = $obj_data->whereRaw("(email LIKE '%".$email."%')");
        }

        if(isset($mobile) && $mobile != "")
        {
            $obj_data = $obj_data->whereRaw("(mobile LIKE '%".$mobile."%')");
        }

        $count = count($obj_data->get());
        
        if(($order =='ASC' || $order=='') && $column=='')
        {
            $obj_data   = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }  
        }
        if($order !='' && $column!='')
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }

        $ContactEnquiryData     = $obj_data->get();

        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ; 

        if(count($ContactEnquiryData)>0)
            {
                $i = 0;

                foreach($ContactEnquiryData as $row)
                {
                    $build_view_action =''; 

                    $view_href = $this->module_url_path.'/view/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp; <a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons">visibility </i></a>'; 

                    $reply_href = $this->module_url_path.'/reply/'.base64_encode($row->id); 
                    $build_view_action .= '&nbsp; <a class="btn btn-link btn-primary btn-just-icon like" href="'.$reply_href.'" title="Reply"><i class="material-icons" >near_me</i></a>'; 

                    $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                    $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

    
                    $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';
                    $phone_code = $country_code = $country_phone_code = '';
                    if(isset($row->phonecode) && $row->phonecode!='' && isset($row->nicename) && $row->nicename!="")
                    {
                         $phone_code = $row->phonecode;
                         $country_code = isset($row->nicename)?$row->nicename:'';
                         $country_phone_code =  '('.$country_code.')'.'-'.$row->phonecode;
                    } 

                   

                    $final_array[$i][1] = isset($row->first_name) && $row->first_name!=''?$row->first_name:"N/A";
                    $final_array[$i][2] = isset($row->last_name) && $row->last_name!=''?$row->last_name:"N/A";
                    $final_array[$i][3] = isset($row->email) && $row->email!=''?$row->email:"N/A";
                    $final_array[$i][4] = $country_phone_code;
                    $final_array[$i][5] = isset($row->mobile) && $row->mobile!=''?$row->mobile:"N/A";
                    $final_array[$i][6] = isset($row->subject) && $row->subject!=''? substr($row->subject,0,50)."..":"N/A";
                    $final_array[$i][7] = isset($row->message) && $row->message!=''? substr($row->message,0,50)."..":"N/A";
                    $final_array[$i][8] = $build_view_action;
                  
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

            $obj_data = $this->ContactEnquiryModel->where('id',$id)->with(['phone_code_details'])->first();
            if($obj_data)
            {
                $arr_data = $obj_data->toArray();
            }

            $this->arr_view_data['arr_data']             = $arr_data;

            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']     =  'Show '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      =  'fa fa-eye';
            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;

            return view($this->module_view_folder.'.view',$this->arr_view_data);

        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/');
        }
    }

    public function reply($enc_id=null)
    {
            $id = '';
            $id = base64_decode($enc_id);

            $arr_data = [];

            $obj_data = $this->ContactEnquiryModel->where('id',$id)->first();
            if($obj_data)
            {
                $arr_data = $obj_data->toArray();
            }

            $this->arr_view_data['arr_data']             = $arr_data;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']     =  $this->module_title." Reply";
            $this->arr_view_data['sub_module_icon']      =  'fa fa-eye';
            $this->arr_view_data['page_title']           = $this->module_title." Reply";
            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;

            return view($this->module_view_folder.'.reply',$this->arr_view_data);
    }

    public function send_reply(Request $request)
    {           
        $arr_rules['message']    = 'required';
        $arr_rules['email']      = 'required';
        $arr_rules['first_name'] = 'required';
        $arr_rules['last_name']  = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {            
            Session::flash('error','All fields are required.');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $to_email   = $request->input('email');
        $message    = $request->input('message');
        $first_name = $request->input('first_name');
        $last_name  = $request->input('last_name');

        if($message)
        {
            $user_name                          =   $first_name.' '.$last_name;
            $user_details                       =   [
                                                        'first_name' => $first_name,
                                                        'email'      => $to_email
                                                    ];

            $arr_built_content                  =   [
                                                        'NAME'         => $first_name.' '.$last_name,
                                                        'PROJECT_NAME' => config('app.project.name'),
                                                        'MESSAGE'      => $message
                                                    ];

              $arr_mail_data                      = [];
              $arr_mail_data['email_template_id'] = '7';
              $arr_mail_data['arr_built_content'] = $arr_built_content;
              $arr_mail_data['user']              = $user_details;

            $email_status  = $this->EmailService->send_mail($arr_mail_data);
            Session::flash('success','Reply has been sent successfully.');
        }
        else
        {
            Session::flash('error','Some error occured while sending reply.');
        }
        return redirect()->back();

    }
}
