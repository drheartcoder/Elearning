<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CouponsModel;
use App\Models\CurrencyModel;
use App\Models\ReferenceCodeModel;

use App\Common\Traits\MultiActionTrait;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Models\RedeemModel;
use App\Models\UsersModel;
use Validator;
use Session;

use DB;

use DataTables;

class CouponsController extends Controller
{
	use MultiActionTrait;
	
	public function __construct(CouponsModel  $coupons_model,
                                CurrencyModel $currency_model,
                                ReferenceCodeModel $reference_code_model,
                                RedeemModel        $redeem_model,
                                UsersModel         $users_model,
                                NotificationService $notification_service)
	{
        $this->arr_view_data      = [];
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->module_url_path    = $this->admin_url_path."/coupons";
        $this->module_title       = "Coupons";
        $this->module_view_folder = "admin.coupons";
        $this->module_icon        = "fa fa-trophy";
        $this->BaseModel          = $coupons_model;
        $this->CurrencyModel      = $currency_model;
        $this->RedeemModel        = $redeem_model;
        $this->ReferenceCodeModel = $reference_code_model;
        $this->UsersModel         = $users_model;
        $this->NotificationService = $notification_service;
	}
	
	/*
    | Function  : Display listing.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function index()
	{
        $arr_currency = $arr_reference_code = $obj_reference_code = [];
        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }

        

        $obj_reference_code = $this->ReferenceCodeModel->first();
        if($obj_reference_code) 
        {
            $arr_reference_code = $obj_reference_code->toArray();
        }

        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['arr_reference_code']  = $arr_reference_code;
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;

        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

    /*
    | Function  : Get data to show listing.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

    public function load_data(Request $request)
    {
        $objectData = $final_array = $arr_search_column = $resp = []; 

        $column  = $order = $title = $count = $obj_data = $search_keyword = '';

        $search_keyword   = isset($request->search_keyword) ? $request->search_keyword : ''; 
        
        if ($request->input('order')[0]['column'] == 1) 
        {
            $column = "coupon_code";
        } 
        elseif($request->input('order')[0]['column'] == 2) 
        {
            $column = "title";
        }    
        elseif($request->input('order')[0]['column'] == 3) 
        {
            $column = "discount_amount";
        }     
        elseif($request->input('order')[0]['column'] == 4) 
        {
            $column = "start_date";
        }
        elseif($request->input('order')[0]['column'] == 5) 
        {
            $column = "end_date";
        }     
        elseif($request->input('order')[0]['column'] == 6) 
        {
            $column = "created_at";
        }

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column = $request->input('column_filter');

        $tbl_coupons = $this->BaseModel->getTable();

        $obj_data = DB::table($tbl_coupons)->selectRaw('coupons.id,coupon_code,title,coupons.discount_amount,coupen_usage_count,start_date,end_date,status,coupons.created_at,users.insentive_amount,coupons.coupen_type,users.total_incentive_amount,owner,count(coupon_usage.id) as uses,coupons.created_by')
                                            ->join('coupon_usage','coupon_usage.coupon_id','=','coupons.id','left')
                                            ->join('users','users.id','=','coupons.created_by','left');
       
        if(isset($search_keyword) && $search_keyword != "")
        {
          $obj_data = $obj_data->where(function($query) use($search_keyword){
            $query->where('title','like','%'.$search_keyword.'%');
            $query->orWhere('coupon_code','like','%'.$search_keyword.'%');
          });
        }

        $obj_data = $obj_data->groupBy('coupons.id');
        
        $count = count($obj_data->get());
        
        if(($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data   = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }
        if($order !='' && $column!='' )
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }

        $objectData = $obj_data->get();     
        $resp['draw']            = isset($_GET['draw']) ? $_GET['draw'] : '';
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '-' ; 

        if(count($objectData)>0)
            {
                $i = 0;

                foreach($objectData as $row)
                {
                    $build_view_action =''; 
                       
                    if(isset($row->insentive_amount) && $row->insentive_amount!="" && $row->insentive_amount
                        >0 && isset($row->created_by)  && $row->created_by!=1)
                    {
                        $build_view_action = '<a class="btn btn-link btn-danger btn-just-icon remove" onclick="showReedemModal('.$row->id.')" data-coupon-id='.$row->id.'  title="Reedem Amount"><i class="fa fa-gift"></i></a>';

                    } 
                    if($row->created_by==1)
                    {
                        if(isset($row->status) && $row->status != null && $row->status == "0")
                        {   
                            $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                        }
                        elseif(isset($row->status) && $row->status != null && $row->status == "1")
                        {
                           $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                        }

                        $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                        $build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';

                        $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                        $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon remove" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this notification?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>';

                        $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                    }
                    else
                    {
                        $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                    }

                    $final_array[$i][1] = isset($row->coupon_code) && $row->coupon_code!=''?$row->coupon_code:"N/A";
                    $final_array[$i][2] = isset($row->title) && $row->title!=''?$row->title:"N/A";
                    $final_array[$i][3] = isset($row->discount_amount) && $row->discount_amount!=''?$row->discount_amount:"N/A";
                    $final_array[$i][4] = isset($row->start_date) && $row->start_date!='' && $row->start_date!='1970-01-01' && $row->start_date!='0000-00-00'?date('d-m-Y',strtotime($row->start_date)):"N/A";
                    $final_array[$i][5] = isset($row->end_date) && $row->end_date!='' && $row->end_date!='1970-01-01' && $row->end_date!='0000-00-00'? date('d-m-Y',strtotime($row->end_date)) :"N/A";
                    $final_array[$i][6] = isset($row->owner) && $row->owner!=''? $row->owner :"N/A";
                    $final_array[$i][7] = isset($row->coupen_type) && $row->coupen_type!=''? ucwords($row->coupen_type) :"ADMIN";
                    $final_array[$i][8] = isset($row->insentive_amount) && $row->insentive_amount!=''? $row->insentive_amount :"N/A";
                    $final_array[$i][9] = isset($row->total_incentive_amount) && $row->total_incentive_amount!=''? $row->total_incentive_amount :"N/A";
                    $final_array[$i][10] = isset($row->uses) ? $row->uses : '0';
                    if($build_active_btn!="-")
                    {
                        $final_array[$i][11]= isset($build_view_action) ? $build_active_btn.$build_view_action : '';
                    }
                    else
                    {
                        $final_array[$i][11]= isset($build_view_action) ?$build_view_action : '';
                    }
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp));exit;      
    
    }

	/*
    | Function  : Create new front page.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function create()
	{
        $arr_currency = $arr_reference_code = [];
        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }
        $code = $this->generate_code();

        $obj_reference_code = $this->ReferenceCodeModel->get();
        if($obj_reference_code) 
        {
            $arr_reference_code = $obj_reference_code->toArray();
        }
        $this->arr_view_data['arr_reference_code']  = $arr_reference_code;
        $this->arr_view_data['coupon_code']         = $code;
        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['page_title']          = "Add ".str_singular($this->module_title);
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	/*
    | Function  : Store data
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function store(Request $request)
	{
		$is_coupon_code_exist = $status = "";

        $arr_rules = $arr_data =  array();
        
        $arr_rules['coupon_code']            = "required";
        $arr_rules['title']                  = "required"; 
        $arr_rules['discount_amount']        = "required|max:8";
        $arr_rules['start_date']             = "required";
        $arr_rules['end_date']               = "required";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $is_coupon_code_exist = $this->BaseModel->where('coupon_code',$request->coupon_code)->count();

        if($is_coupon_code_exist > 0)
        {
        	Session::flash('error','This '.str_singular($this->module_title).' code is already exist.');
        	return redirect()->back()->withInput();
        }	

        $arr_data['coupon_code']     = isset($request->coupon_code)?$request->coupon_code : '';
        $arr_data['created_by']      = 1;
        $arr_data['owner']           = 'admin';
        $arr_data['title']           = isset($request->title) ? $request->title : '';
        $arr_data['discount_amount'] = isset($request->discount_amount) ? $request->discount_amount : '';
        $arr_data['start_date']      = isset($request->start_date) ? date( 'Y-m-d', strtotime($request->start_date)) : '';
        $arr_data['end_date']        = isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date))  : '';
        //$arr_data['coupon_option']   = isset($request->coupen_option) ? $request->coupen_option : '';
        
        if(isset($request->coupen_option) && $request->coupen_option=="one")
        {
            $arr_data['coupen_usage_count']   = 1;
            $arr_data['coupon_option']   = 1;
        }
        elseif(isset($request->coupen_option) && $request->coupen_option=="multiple")
        {
            $arr_data['coupen_usage_count']   = isset($request->number_of_times) ? $request->number_of_times : '';
            $arr_data['coupon_option']   = isset($request->number_of_times) ? $request->number_of_times : '';
        }
        $arr_data['status']          = '1';
        $status = $this->BaseModel->create($arr_data);

        if($status)
        {
        	Session::flash('success',str_singular($this->module_title).' added successfully.');
        	return redirect($this->module_url_path);
        }
        else
        {
        	Session::flash('error','Problem occured while adding '.str_singular($this->module_title));
        	return redirect()->back();
        }
	}

	/*
    | Function  : Edit details
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function edit($id=null)
	{
        $arr_coupons = $arr_currency = [];

        ($id)? $id = base64_decode($id):NULL;
        
        $obj_coupons = $this->BaseModel->where('id',$id)->first();

        if($obj_coupons)
        {
            $arr_coupons = $obj_coupons->toArray();
        }
        
        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }

        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['id']                  = base64_encode($id);
        $this->arr_view_data['arr_coupons']         = $arr_coupons;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
        $this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
		
		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	/*
    | Function  : Update specific record.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function update(Request $request, $id=null)
	{
        if($id != false)
        {
            $coupon_id = base64_decode($id);

            $is_coupon_code_exist = $status = "";

            $arr_rules = $arr_data =  array();
            
            $arr_rules['coupon_code']            = "required";
            $arr_rules['title']                  = "required"; 
            $arr_rules['discount_amount']        = "required|max:8";
            $arr_rules['start_date']             = "required";
            $arr_rules['end_date']               = "required";
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {       
                return redirect()->back()->withErrors($validator)->withInput();  
            }

            $is_coupon_code_exist = $this->BaseModel->where('coupon_code',$request->coupon_code)
                                                    ->where('id', '<>', $coupon_id)
                                                    ->count();

            if($is_coupon_code_exist > 0)
            {
                Session::flash('error','This '.str_singular($this->module_title).' code is already exist.');
                return redirect()->back();
            }   

            $arr_data['coupon_code'] = isset($request->coupon_code) ? $request->coupon_code : '';
            $arr_data['created_by']      = 1;
            $arr_data['owner']           = 'admin';
            $arr_data['title'] = isset($request->title) ? $request->title : '';
            $arr_data['discount_amount'] = isset($request->discount_amount) ? $request->discount_amount : '';
            $arr_data['start_date'] = isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : '';
            $arr_data['end_date'] = isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date))  : '';

            $arr_data['coupon_option'] = isset($request->number_of_times) ? $request->number_of_times : '';
            $arr_data['coupen_usage_count']   = isset($request->number_of_times) ? $request->number_of_times : '';

            $status = $this->BaseModel->where('id',$coupon_id)->update($arr_data);

            if($status)
            {
                Session::flash('success',str_singular($this->module_title).' updated successfully.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error','Problem occured while adding '.str_singular($this->module_title));
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error','Problem occured while adding '.str_singular($this->module_title));
            return redirect()->back();
        }

	}

    /*
    | Function  : View details.
    | Author    : Deepak Bari
    | Date      : 16 June, 2018
    */

    public function view($enc_id=null)
    {

       if($enc_id)
        {
            $id = base64_decode($enc_id);
            $arr_currency = [];
            
            $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
            if($obj_currency)
            {
                $arr_currency = $obj_currency->toArray();
            }

            $arr_subscription_plan = [];
            $obj_subscription_plan = $this->BaseModel->where('id',$id)->with('testimonial_translation')->first();
            if($obj_subscription_plan)
            {
                $arr_subscription_plan                                  = $obj_subscription_plan->toArray();
                $arr_subscription_plan['testimonial_translation'] = $this->LanguageService->arrange_locale_wise($arr_subscription_plan['testimonial_translation']);
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_currency']          = $arr_currency;
            $this->arr_view_data['arr_lang']              = $arr_lang;
            $this->arr_view_data['id']                    = base64_encode($id);
            $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
            $this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
            $this->arr_view_data['page_title']            = "View ".$this->module_title;
            $this->arr_view_data['parent_module_icon']    = "fa fa-home";
            $this->arr_view_data['parent_module_title']   = "Dashboard";
            $this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']           = "fa fa-file-text";
            $this->arr_view_data['module_title']          = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']            = $this->module_url_path;
            $this->arr_view_data['sub_module_title']      = 'View '.$this->module_title;
            $this->arr_view_data['sub_module_icon']       = 'fa fa-eye';
            $this->arr_view_data['module_url_path']       = $this->module_url_path;

            return view($this->module_view_folder.'.view',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/manage');
        }
    }

    public function generate_code()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 10; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars)-1)];
        } 
        $codeExist = $this->BaseModel->where('coupon_code',$code)->count();
        if($codeExist==0)       
        {
            return $code;
        }
        else
        {
            $this->generate_code();
        }
    }
    public function redeem_amount(Request $request)
    {
       $remaining_incentive = $incentive_amount = 0;
       $user_id    = '';
       $form_data  = $arr_reedem =  $arr_notication = [];
       $form_data  = $request->all();
       $coupon_id  = $request->input('coupon_id','');
       $redeem_amount  = $request->input('redeem_amount','');

       $obj_coupon = $this->BaseModel->where('id','=',$coupon_id)->first();
       if(isset($obj_coupon->created_by) && $obj_coupon->created_by!="")
       {
            $user_id = $obj_coupon->created_by;
       }
       $obj_user = $this->UsersModel->where('id','=',$user_id)->first();
       if($obj_user)
       {
         $incentive_amount = isset($obj_user->insentive_amount)?$obj_user->insentive_amount:'';
       }
       if(isset($incentive_amount) && $incentive_amount!= 0 && $incentive_amount>=$redeem_amount)
       {
           $remaining_incentive = $incentive_amount-$redeem_amount;
           $update_status       = $obj_user->update(['insentive_amount'=>$remaining_incentive]);
           if($update_status)
           {
                $arr_reedem['user_id']         = $user_id;
                $arr_reedem['coupon_id']       = $coupon_id;
                $arr_reedem['redeem_amount']   = $redeem_amount;

                //send notification to user
                $plan_name = isset($obj_data->plan_data->name)?$obj_data->plan_data->name:'';
                $arr_notication['message']      = $redeem_amount.' has been deducted from your incentive amount.';
                $arr_notication['from_user_id'] = 1;
                $arr_notication['to_user_id']   = isset($user_id)?$user_id:'';
                $arr_notication['url']          = '/parent/dashboard';
                $arr_notication['is_read']      = "0";

                $status  = $this->NotificationService->send_notification($arr_notication);


                Session::flash('success','Amount is withdrawn successfully.');
           }
           else
           {
                Session::flash('error','Error occure while withdraw an amount.');
           }
       }
       else
       {
          Session::flash('error','You can not withdraw this amount because,They have an insufficient incentive amount in there account.');
       }
        return redirect($this->module_url_path);
      
    }
}
