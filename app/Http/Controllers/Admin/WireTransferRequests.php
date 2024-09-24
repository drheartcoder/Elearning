<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;
use App\Models\UsersModel;
use App\Models\NotificationsModel;
use App\Models\WireTransfereedRequestModel;
use App\Models\TransactionsModel;
use App\Models\ReferenceCodeModel;
use App\Models\SubscriptionPlanModel;
use App\Models\CouponsModel;
use App\Models\SubscriptionPlanTranslationModel;
use App\Common\Services\NotificationService;
use App\Common\Services\EmailService;
use Session;
use Validator;
use Auth;
use DB;
use Excel;
use PDF;
class WireTransferRequestsController extends Controller
{
	use MultiActionTrait;
	
	public function __construct(NotificationsModel $notifications_model,
                               WireTransfereedRequestModel $wire_transfereed_request_model,
                               TransactionsModel   $transaction_model,
                               UsersModel          $user_model,
                               ReferenceCodeModel  $refernce_code_model,
                               NotificationService $notification_service,
                               EmailService        $email_service,
                               CouponsModel        $coupon_model)
	{
		$this->arr_view_data                      = [];
		$this->admin_panel_slug                   = config('app.project.admin_panel_slug');
		$this->admin_url_path                     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path                    = $this->admin_url_path."/wire-transfer";
		$this->module_title                       = "Wire Transfer Requests";
		$this->module_view_folder                 = "admin.wire-transfer-requests";
		$this->module_icon                        = "fa fa-money";
		$this->BaseModel                          = $wire_transfereed_request_model;
        $this->TransactionsModel                  = $transaction_model;
        $this->UsersModel                         = $user_model;
        $this->ReferenceCodeModel                 = $refernce_code_model;
        $this->SubscriptionPlanModel              = new SubscriptionPlanModel();
        $this->SubscriptionPlanTranslationModel   = new SubscriptionPlanTranslationModel();
        $this->WireTransfereedRequestModel        = $wire_transfereed_request_model;
        $this->NotificationService                = $notification_service;
        $this->EmailService                       = $email_service;
        $this->CouponsModel                       = $coupon_model;
	}

	public function index()
	{
		$arr_plan = [];
        $login_user_id = '';
		$login_user_id = login_user_id('admin');
		  
        $arr_plan = $this->SubscriptionPlanModel->where('status','1')->get();
        if(count($arr_plan)>0)
        {
            $arr_plan = $arr_plan->toArray();
        }
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
        $this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['arr_plan']             = $arr_plan;
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function load_data(Request $request)
	{

        $objectData = $final_array = $arr_data = $arr_search_column = $resp = []; 

        $column  = $order = $title = $count = $obj_data = $search_keyword = $requested_date = $msg =  $notification_message = $login_user_id = '';

        $search_keyword   = isset($request->search_keyword) ? $request->search_keyword : ''; 
        $requested_date   = isset($request->requested_date) ? $request->requested_date : ''; 
        
        if ($request->input('order')[0]['column'] == 1) 
        {
            $column = "subscription_plan_translation.name";
        }

        if ($request->input('order')[0]['column'] == 2) 
        {
            $column = "parent_name";
        }


        if ($request->input('order')[0]['column'] == 3) 
        {
            $column = "email";
        }

        if ($request->input('order')[0]['column'] == 4) 
        {
            $column = "contact";
        }

        if ($request->input('order')[0]['column'] == 5) 
        {
            $column = "created_at";
        }        

        if ($request->input('order')[0]['column'] == 6) 
        {
            $column = "requested_date";
        }

		$login_user_id = login_user_id('admin'); 

        $order         = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column   = $request->input('column_filter');        

        $obj_data = DB::table('wire_transfereed_request')
                    ->select('wire_transfereed_request.id',
                             'wire_transfereed_request.plan_id',
                             'wire_transfereed_request.payment_status',
                             'subscription_plan_translation.name',
                             'users.email',
                             'users.contact',
                             'users.created_at',
                             DB::Raw('CONCAT(users.first_name, " ", users.last_name) AS parent_name'),
                             'wire_transfereed_request.requested_date')
                    ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','wire_transfereed_request.plan_id')
                    ->join('users','users.id','=','wire_transfereed_request.user_id')
                    ->where('subscription_plan_translation.locale','en')
                    ->where('users.deleted_at',null);
        

        if ($requested_date != '' && $requested_date != "0000-00-00 00:00:00") 
        {
          $obj_data = $obj_data->whereDate('wire_transfereed_request.requested_date','=',date('Y-m-d',strtotime($requested_date)));
        }

        if(isset($search_keyword) && $search_keyword != "")
        {
          $obj_data = $obj_data->whereRaw("(CONCAT(users.first_name,' ',users.last_name) LIKE '%".$search_keyword."%' OR  subscription_plan_translation.name LIKE '%".$search_keyword."%' OR users.email LIKE '%".$search_keyword."%' OR users.contact LIKE '%".$search_keyword."%')");
        }

        $count        = count($obj_data->get());

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
                $build_status_action = $build_action_action = '-';

                if(isset($row->payment_status) && $row->payment_status == "paid")
                {   
                    $build_status_action = '<a style="color: #fff" class="btn btn-success updatePlan">Paid<div class="ripple-container"></div></a>';
                }
                elseif(isset($row->payment_status) && $row->payment_status == "unpaid")
                {
                   $data_url = $this->module_url_path.'/update_plan_type/'.base64_encode($row->id);  
                   $build_action_action = '<a class="btn btn-link btn-warning btn-just-icon like updatePlan" href="javascript:void(0)" data-plan_id="'.($row->plan_id).'" onclick="UpdatePlan(this)"; data-url="'.$data_url.'" title="Change Plan Type"><i class="material-icons">create</i><div class="ripple-container"></div></a>'; 
                   
                   $build_status_action = '<a style="color: #fff" href="'.$this->module_url_path.'/change_payment_status/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to change the status of this request ?\')" class="btn btn-danger">Unpaid</a>';
                }

                $final_array[$i][0] =  '<div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>';                   

                $final_array[$i][1] = isset($row->name) && $row->name!=''?$row->name:"N/A";
                $final_array[$i][2] = isset($row->parent_name) && $row->parent_name!=''?$row->parent_name:"N/A";
                $final_array[$i][3] = isset($row->email) && $row->email!=''?$row->email:"N/A";
                $final_array[$i][4] = isset($row->contact) && $row->contact!=''?$row->contact:"N/A";
                $final_array[$i][5] = isset($row->created_at) && $row->created_at!=''?$row->created_at:"N/A";
                $final_array[$i][6] = isset($row->requested_date) && $row->requested_date!=''? date('d M Y',strtotime($row->requested_date)) :"N/A";
                $final_array[$i][7] = isset($build_status_action) ? $build_status_action : '';
                $final_array[$i][8] = isset($build_action_action) ? $build_action_action : '';

                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;         
    
	}

    /*public function View($enc_id)
    {

        if($enc_id) {
            $wire_transfer_id = base64_decode($enc_id);

            $arr_data =  DB::table('wire_transfereed_request')
                        ->select('wire_transfereed_request.id',
                                 'subscription_plan_translation.name',
                                 DB::Raw('CONCAT(users.first_name, " ", users.last_name) AS parent_name'),
                                 'wire_transfereed_request.requested_date')
                        ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','wire_transfereed_request.plan_id')
                        ->join('users','users.id','=','wire_transfereed_request.user_id')
                        ->where('subscription_plan_translation.locale','en')
                        ->where('wire_transfereed_request.id',$wire_transfer_id)->first();
            
            

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
            
            return view($this->module_view_folder.'.view',$this->arr_view_data);

        } else {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect()->back();
        }
    }*/


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_transactions = [];

        $form_data    = $request->all();
        $search_keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $requested_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        $obj_data = DB::table('wire_transfereed_request')
                    ->select('wire_transfereed_request.id',
                             'wire_transfereed_request.plan_id',
                             'wire_transfereed_request.payment_status',
                             'subscription_plan_translation.name',
                             'users.email',
                             'users.contact',
                             'users.created_at',
                             DB::Raw('CONCAT(users.first_name, " ", users.last_name) AS parent_name'),
                             'wire_transfereed_request.requested_date')
                    ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','wire_transfereed_request.plan_id')
                    ->join('users','users.id','=','wire_transfereed_request.user_id')
                    ->where('subscription_plan_translation.locale','en')
                    ->where('users.deleted_at',null);

        if($requested_date != '' && $requested_date != "0000-00-00 00:00:00") 
        {
          $obj_data = $obj_data->whereDate('wire_transfereed_request.requested_date','=',date('Y-m-d',strtotime($requested_date)));
        }

        if(isset($search_keyword) && $search_keyword != "")
        {
          $obj_data = $obj_data->whereRaw("(CONCAT(users.first_name,' ',users.last_name) LIKE '%".$search_keyword."%' OR  subscription_plan_translation.name LIKE '%".$search_keyword."%')");
        }        

        $obj_data = $obj_data->get();

        if($obj_data)
        {
            $arr_wire_transfer = $obj_data;
            //dd($arr_wire_transfer);

            // build data array to export
            foreach ($arr_wire_transfer as $key => $row) 
            {

                $data['Plan']           = isset($row->name) ? $row->name : 'NA';
                $data['User Name']      = isset($row->parent_name) ? $row->parent_name : 'NA';         
                $data['Email']          = isset($row->email) ? $row->email : 'NA';         
                $data['Contact']        = isset($row->contact) ? $row->contact : 'NA';         
                $data['Requested Date'] = isset($row->requested_date) ? date('d-M-Y',strtotime($row->requested_date)) : 'NA';   
                $data['Registration Date'] = isset($row->requested_date) ? $row->created_at : 'NA';   

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        $type = 'CSV';

        return Excel::create('Wire Transfer Request Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Wire Transfer Request Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Wire Transfer Request Report');

            $excel->sheet('Wire Transfer Request Report', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

    }
    public function change_payment_status($id)
    {
       $arr_transaction = $arr_notication = $arr_coupen_data = $arr_user_data = [];
       $status = $final_amount = $transaction_amount = '';
       $arr_invoice_data = $arr_plan_details = [];
       if(isset($id) && $id!="")
       {
          $request_id = base64_decode($id);
          $status     = $this->WireTransfereedRequestModel->where('id','=',$request_id)
                                                          ->update(['payment_status'=>'paid']);

          $obj_data = $this->TransactionsModel->where('wire_transfer_id','=',$request_id)
                                             ->with(['plan_data','user_data','coupon_data'])
                                             ->first();
                       
          if($obj_data)
          {
            $arr_transaction = $obj_data->toArray();
            if(isset($arr_transaction['coupon_data']) && sizeof($arr_transaction['coupon_data'])>0)
            {
                $arr_coupen_data['coupon_code_owner_id'] =  isset($arr_transaction['coupon_data']['created_by'])?$arr_transaction['coupon_data']['created_by']:1;

                $arr_coupen_data['reward_amount']        =  isset($arr_transaction['coupon_data']['reward_amount'])?$arr_transaction['coupon_data']['reward_amount']:'';
                $arr_coupen_data['validity_extension']   =  isset($arr_transaction['coupon_data']['validity_extension'])?$arr_transaction['coupon_data']['validity_extension']:'';

                $arr_coupen_data['start_date']   =  isset($arr_transaction['coupon_data']['start_date'])?$arr_transaction['coupon_data']['start_date']:'';
                $arr_coupen_data['end_date']   =  isset($arr_transaction['coupon_data']['end_date'])?$arr_transaction['coupon_data']['end_date']:'';
                       
                $this->update_coupon_details($arr_coupen_data);
            }
            $user_id       = isset($arr_transaction['user_id'])?$arr_transaction['user_id']:'';
            $plan_id       = isset($obj_data->plan_id)?$obj_data->plan_id:'';
            $arr_user_data = getUserDetails($user_id);
            if(isset($arr_user_data['pin']) && $arr_user_data['pin']!="")
            {
                $pin = $arr_user_data['pin'];
            }
            else
            {
                $pin = $this->generatePin($arr_user_data); 
                if(isset($pin) && $pin!="")
                {
                    $arr_coupen_info = $arr_ref_code = [];

                    //$arr_coupen_info['start_date'] = isset($arr_transaction['coupon_data']['start_date'])?$arr_transaction['coupon_data']['start_date']:'';
                    //$arr_coupen_info['end_date']   = isset($arr_transaction['coupon_data']['end_date'])?$arr_transaction['coupon_data']['end_date']:'';

                    $arr_ref_code       = $this->ReferenceCodeModel
                                                   ->where('coupen_type','=','PARENT')
                                                   ->first();

                    $arr_coupen_info['start_date']= isset($arr_ref_code->start_date)?$arr_ref_code->start_date:'';
                    $arr_coupen_info['end_date'] = isset($arr_ref_code->end_date)?$arr_ref_code->end_date:'';

                    $this->EmailService->send_refer_email($arr_user_data,$pin,$arr_coupen_info);
                }
               
            }
            $this->UsersModel->where('id','=',$user_id)->update(['pin'=>$pin]);

            $transaction_id       = isset($arr_transaction['id'])?$arr_transaction['id']:'';
            $invoice_name         = $this->generateInvoice($transaction_id);
            
            //send transaction mail
            if(isset($arr_transaction['payment_via']) && $arr_transaction['payment_via']=='offline')
            {
                $transaction_amount =  isset($arr_transaction['total_converted_amount'])?$arr_transaction['total_converted_amount']:'';
                $final_amount       = $transaction_amount.' USD';
            }

            $arr_mail_data     = [];
            $arr_plan_details  = getPlanDetails($plan_id);
            $first_name        = isset($arr_user_data['first_name'])?$arr_user_data['first_name']:'';
            $last_name         = isset($arr_user_data['last_name'])?$arr_user_data['last_name']:'';
            $arr_built_content = [
                        'NAME'                  => $first_name.' '.$last_name,
                        'SUBJECT'               => 'Subscription Transaction Mail',
                        'PROJECT_NAME'          => config('app.project.name'),
                        'PLAN_NAME'             => isset($arr_plan_details['name'])?$arr_plan_details['name']:'',
                        'TRANSACTION_ID'        => isset($arr_transaction['transaction_id'])?$arr_transaction['transaction_id']:'',
                        'TRANSACTION_AMOUNT'    => $final_amount,
                ];
                
            $attachment_path                    = base_path('uploads/invoice/'.$invoice_name);
            $arr_mail_data['email_template_id'] = '9';
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = [
                                                    'email'      => isset($arr_user_data['email'])?$arr_user_data['email']:'',
                                                    'first_name' => isset($arr_user_data['first_name'])?$arr_user_data['first_name']:'',
                                                     'attachment_path'=> $attachment_path
                                                  ];

            $email_status  = $this->EmailService->send_mail($arr_mail_data);
            $obj_data->update(['payment_status'=>'paid','invoice'=>$invoice_name]);

            //send notification to user
            $plan_name = isset($obj_data->plan_data->name)?$obj_data->plan_data->name:'';
            $arr_notication['message']      = 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -'.$plan_name;
            $arr_notication['from_user_id'] = 1;
            $arr_notication['to_user_id']   = isset($user_id)?$user_id:'';
            $arr_notication['url']          = "/parent/transactions";
            $arr_notication['is_read']      = "0";

            $status  = $this->NotificationService->send_notification($arr_notication);

          }

       }
       if($status)
       {
            Session::flash('success','Payment Status changed successfully.');
       }
       else
       {
            Session::flash('error','Error occured while change the status.');
       }
       return redirect()->back();
    }

    public function update_coupon_details($arr_user_data)
    {
        // Extension of validity
        if(isset($arr_user_data) && sizeof($arr_user_data)>0)
        {
            $obj_active_plan = $this->TransactionsModel->where('user_id',$arr_user_data['coupon_code_owner_id'])
                                                        ->where('status','active')
                                                        ->orderBy('id','DESC')->first();

            if(isset($obj_active_plan) && $obj_active_plan!=null && isset($arr_user_data['validity_extension']) && $arr_user_data['validity_extension']!="")
            {                        
                $plan_expired_date = date('Y-m-d',strtotime('+'.$arr_user_data['validity_extension'].'months',strtotime($obj_active_plan->extension_date)));

                $obj_active_plan->update(['extension_date'=>$plan_expired_date]);
            }
            // Insentive amount
            $obj_user_details = $this->UsersModel->where('id',$arr_user_data['coupon_code_owner_id'])->first();
            if($obj_user_details && isset($arr_user_data['reward_amount']) && $arr_user_data['reward_amount']!="")
            {
                $total_insentive_amount = $obj_user_details->insentive_amount + $arr_user_data['reward_amount'];
                $final_incentive_amount = $obj_user_details->total_incentive_amount + $arr_user_data['reward_amount'];
                $update_status = $obj_user_details->update(['insentive_amount'=>$total_insentive_amount,'total_incentive_amount'=>$final_incentive_amount]);
            }
        }
    }
    public function generatePin($arr_user)
    {
        $pin          = false;
        $user_type    = $extension = '';
        $insert_array = $reference_settings_arr  = [];
        
        if(isset($arr_user['user_type']) && $arr_user['user_type']=='teacher')
        {
            $user_type = "TEACHER";
        }
        else if(isset($arr_user['user_type']) && $arr_user['user_type']=='parent')
        {
            $user_type = "PARENT";
        }
        $current_date = date('Y-m-d');
        $reference_settings_arr       = $this->ReferenceCodeModel
                                             ->where('coupen_type','=',$user_type)
                                             //->where('start_date','>=',$current_date)
                                             //->where('end_date','<=',$current_date)
                                             //->whereRaw('? between start_date and end_date',[date('Y-m-d')])
                                             ->first();
        if($reference_settings_arr)
        {
            $pin          = RandomPin();
            if($reference_settings_arr['reference_reward_type']=='both')
            {
              $extension = 'Extension of '.$reference_settings_arr['validity_extension'].' months and Incentive of '.$reference_settings_arr['reward_amount'];
            }
            elseif($reference_settings_arr['reference_reward_type']=='validity_extension')
            {
              $extension = 'Extension of '.$reference_settings_arr['validity_extension'].' months';
            }
            else
            {
              $extension = 'Incentive of '.$reference_settings_arr['reward_amount'];
            }
             
            $insert_array = [   'created_by'               => isset($arr_user['id'])?$arr_user['id']:'',
                                'coupon_code'              => $pin,
                                'status'                   => '1',
                                'title'                    => $extension,
                                'reward_type_for_referral' => isset($reference_settings_arr['reference_reward_type'])?$reference_settings_arr['reference_reward_type']:'',
                                'reward_amount'            => isset($reference_settings_arr['reward_amount'])?$reference_settings_arr['reward_amount']:'',
                                'validity_extension'       => isset($reference_settings_arr['validity_extension'])?$reference_settings_arr['validity_extension']:'',
                                'discount_amount'          => isset($reference_settings_arr['discount_amount'])?$reference_settings_arr['discount_amount']:'',
                                'start_date'               => isset($reference_settings_arr['start_date'])?$reference_settings_arr['start_date']:'',
                                'end_date'               => isset($reference_settings_arr['end_date'])?$reference_settings_arr['end_date']:'',
                                'coupen_type'             => $user_type,
                                'owner'                   => $arr_user['first_name'].' '.$arr_user['last_name']];
            $this->CouponsModel->insert($insert_array);   
            
        }
        return $pin;
    }
    public function update_plan_type($wire_transfer_id, Request $request)
    {
       $arr_wiretransfer = $arr_date =  [];
       $status = '';
       if(isset($wire_transfer_id) && $wire_transfer_id!="" && $request->has('plan_id')==true)
       {
          $plan_id          = base64_decode($request->input('plan_id'));
          $wire_transfer_id = base64_decode($wire_transfer_id);
          $arr_wiretransfer = $this->WireTransfereedRequestModel->where('id','=',$wire_transfer_id)->first();
          if(isset($arr_wiretransfer) && count($arr_wiretransfer)>0){
            $arr_wiretransfer = $arr_wiretransfer->toArray();
            $user_id = $arr_wiretransfer['user_id'];
            $old_plan_id = $arr_wiretransfer['plan_id'];

            $arr_plan_date       = $this->get_plan_date($user_id,$plan_id);

            $expiry_date    = isset($arr_plan_date['plan_expired_date'])?$arr_plan_date['plan_expired_date']:'';
            $extension_date = isset($arr_plan_date['plan_extension_date'])?$arr_plan_date['plan_extension_date']:'';

            $update_transaction = $this->TransactionsModel->where('user_id','=',$user_id)->where('payment_status','=','unpaid')
                                    ->where('payment_status','=','unpaid')->where('plan_id','=',$old_plan_id)
                                    ->orderBy('id','desc')->limit(1)
                                    ->update(['plan_id'=>$plan_id,'expiry_date'=>$expiry_date,'extension_date'=>$extension_date]);
            if($update_transaction)
            {
                $status           = $this->WireTransfereedRequestModel->where('id','=',$wire_transfer_id)->update(['plan_id'=>$plan_id]);
                if($status)
                {
                    Session::flash('success','Plan Status changed successfully.');
                }
            }
            else
            {
                Session::flash('error','Error occured while change the status.');
            }
          }
       }
       return redirect()->back();
    }
    public function get_plan_date($user_id,$plan_id)
    {   
         $plan_validity       = $plan_expired_date = $plan_extension_date = '';
         $arr_plan_details    = $arr_data = [];
         $arr_plan_details    = getPlanDetails($plan_id);

        $obj_membership      = $this->TransactionsModel->where('user_id',$user_id)
                                    ->where('status','=','active')
                                    ->where('payment_via','<>','offline')
                                    ->orderBy('id','desc')
                                    ->first();
        $plan_validity       = isset($arr_plan_details['validity'])?(int)$arr_plan_details['validity']:1;
        if($obj_membership)
        {
            $plan_expired_date   = ($plan_id!=4) ?date('Y-m-d', strtotime($obj_membership->expiry_date. ' + '.$plan_validity.' years')):'';
            $plan_extension_date = date('Y-m-d', strtotime($obj_membership->extension_date. ' + '.$plan_validity.' years'));

        }
        else
        {
            $plan_expired_date  = ($plan_id!=4) ? date('Y-m-d',strtotime('+'.$plan_validity.' years')) : "";
            $plan_extension_date = $plan_expired_date;
        }
        $arr_data['plan_expired_date']   = $plan_expired_date;
        $arr_data['plan_extension_date'] = $plan_extension_date;
        return $arr_data;
    }
    function generateInvoice($transaction_id=false)
    {
        $ReceivedData = $SenderData = [];
        $html = $view = "";

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
            $path     = base_path('uploads/invoice/'.$FileName);
            @chmod($path,0777);
            $res      = PDF::loadHTML($html)->save($path,'F');
            return $FileName;   
        }
    }
}
