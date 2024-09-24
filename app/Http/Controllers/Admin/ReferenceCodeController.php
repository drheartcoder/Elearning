<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Models\ReferenceCodeModel;
use App\Models\CurrencyModel;
use App\Models\CouponsModel;
use Validator;
use Session;

class ReferenceCodeController extends Controller
{
    public function __construct(
                                CurrencyModel      $currency_model,
                                ReferenceCodeModel $reference_code_model,
                                CouponsModel       $coupon_model,
                                EmailService       $email_service
                                )
    {
        $this->arr_view_data      = [];
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = $this->admin_url_path."/account_setting/reference_code";
        $this->module_view_folder = "admin.reference_code";
        $this->module_title       = "Reference Code";
        $this->module_icon        = 'fa fa-cog';
        $this->CurrencyModel      = $currency_model;
        $this->ReferenceCodeModel = $reference_code_model;
        $this->CouponsModel       = $coupon_model;
        $this->EmailService       = $email_service;
    }

    public function index()
    {
        $arr_reference_code = $obj_reference_code = $arr_currency = [];

        $obj_reference_code = $this->ReferenceCodeModel->get();
        if($obj_reference_code) 
        {
            $arr_reference_code = $obj_reference_code->toArray();
        }
        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }

        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['arr_reference_code']  = $arr_reference_code;
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

    public function update(Request $request)
    {

        $update    = $create   = '';
        $arr_rules = $arr_data = array();
       
        $coupen_type   = trim($request->input('coupon_type',''));
        if(isset($coupon_type) && $coupon_type=='PARENT')
        {
             $arr_rules['reference_reward_type']              = "required";
             $arr_rules['reward_amount_for_reference_parent'] = 'required';   
             if($request->input('reference_reward_type')!='' && ($request->input('reference_reward_type')=='validity_extension' || $request->input('reference_reward_type')=='both'))
             {            
                $arr_rules['validity_extension']              = "required";
             }
             elseif ($request->input('reference_reward_type')!='' && ($request->input('reference_reward_type')=='reference_amount' || $request->input('reference_reward_type')=='both')) 
             {
                $arr_rules['reward_amount']                   = "required";        
             }
        }
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        $arr_data['validity_extension']           = trim($request->input('validity_extension',''));      
        $coupon_type                              = trim($request->input('coupon_type',''));

        if(isset($coupon_type) && $coupon_type=="PARENT")
        {
            $arr_data['discount_amount']       = trim($request->input('reward_amount_for_reference_parent',''));
            $arr_data['reward_amount']         = trim($request->input('reward_amount',''));  
            $arr_data['reference_reward_type'] = trim($request->input('reference_reward_type',''));
            $start_date                        = trim($request->input('parent_validity_start_date',''));
            $end_date                          = trim($request->input('parent_validity_end_date',''));
            $arr_data['start_date']            = isset($start_date)?date('Y-m-d',strtotime($start_date)):'';
            $arr_data['end_date']              = isset($end_date)?date('Y-m-d',strtotime($end_date)):'';

        }
        else if(isset($coupon_type) && $coupon_type=="TEACHER")
        {
            $arr_data['discount_amount']       = trim($request->input('discount_amount_by_teacher',''));
            $arr_data['reward_amount']         = trim($request->input('insentive_amount',''));  
            $arr_data['reference_reward_type'] = 'reference_amount';
          
            $start_date                        = trim($request->input('teacher_validity_start_date',''));
            $end_date                          = trim($request->input('teacher_validity_end_date',''));
            $arr_data['start_date']            = isset($start_date)?date('Y-m-d',strtotime($start_date)):'';
            $arr_data['end_date']              = isset($end_date)?date('Y-m-d',strtotime($end_date)):'';

        }
        $arr_data['coupen_type'] =  $coupon_type;
        $obj_data = $this->ReferenceCodeModel->where('coupen_type','=',$coupen_type)->first();
        if($obj_data)
        {
            if($this->check_coupon_data($arr_data,$obj_data)>0)
            {
                $update       = $obj_data->update($arr_data);
                $this->update_user_coupen_details($arr_data);
            }
            else
            {
                $update       = $obj_data->update($arr_data);
            }
            
            
        }
        else
        {
            $create = $this->ReferenceCodeModel->create($arr_data);
        }
        if($update) 
        {
            Session::flash('success',str_singular($this->module_title).' details updated successfully.');
        }
        elseif($create)
        {
            Session::flash('success',str_singular($this->module_title).' details added successfully.');
        }
        else
        {
            Session::flash('error','Problem Occurred, While Updating '.str_singular($this->module_title));
        }
        return redirect()->back();
    }
    function update_user_coupen_details($arr_coupon)
    {
        $title            = $status  = '';
        $arr_coupon_data  = $arr_ids = $arr_update_data = $arr_user_data = $arr_coupon_info = [];
        $coupon_type      = isset($arr_coupon['coupen_type'])?$arr_coupon['coupen_type']:'';
        
        $obj_coupons      = CouponsModel::where('coupen_type','=',$coupon_type)->get();
        if($obj_coupons)
        {
            $arr_coupon_data = $obj_coupons->toArray();
            $arr_ids         = isset($arr_coupon_data) && sizeof($arr_coupon_data)>0?array_column($arr_coupon_data,'id'):[];
        }
        if(isset($arr_ids) && sizeof($arr_ids)>0)
        {
            $reward_type = isset($arr_coupon['reference_reward_type'])?$arr_coupon['reference_reward_type']:'';
            
            if(isset($reward_type) && $reward_type=='both')
            {
                $title = 'Extension of '.$arr_coupon['validity_extension'].' months and Incentive of '.$arr_coupon['reward_amount'];

            }  
            elseif(isset($reward_type) && $reward_type=='validity_extension')
            {    
               $title = 'Extension of '.$arr_coupon['validity_extension'].' months';
            }
            else
            {    
               $title = 'Incentive of '.$arr_coupon['reward_amount'];
            }   

            $arr_update_data['title']                    = $title;
            $arr_update_data['start_date']               = isset($arr_coupon['start_date'])?$arr_coupon['start_date']:'';
            $arr_update_data['end_date']                 = isset($arr_coupon['end_date'])?$arr_coupon['end_date']:'';
            $arr_update_data['reward_type_for_referral'] = $reward_type;
            $arr_update_data['reward_amount']            = isset($arr_coupon['reward_amount'])?$arr_coupon['reward_amount']:'';
            $arr_update_data['validity_extension']       = isset($arr_coupon['validity_extension'])?$arr_coupon['validity_extension']:'';
            $arr_update_data['discount_amount']          = isset($arr_coupon['discount_amount'])?$arr_coupon['discount_amount']:'';

            $status = CouponsModel::whereIn('id', $arr_ids)->update($arr_update_data);
            if($coupon_type=='PARENT' || $coupon_type=='TEACHER')
            {
                if(isset($arr_coupon_data) && sizeof($arr_coupon_data)>0)
                {
                    foreach ($arr_coupon_data as $key => $value) 
                    {
                        $user_id       = isset($value['created_by'])?$value['created_by']:'';
                        $arr_user_data = getUserDetails($user_id);
                        $pin_id        = isset($arr_user_data['pin'])?$arr_user_data['pin']:'';

                    $arr_coupon_info['start_date'] = isset($arr_coupon['start_date'])?$arr_coupon['start_date']:'';
                        $arr_coupon_info['end_date'] = isset($arr_coupon['end_date'])?$arr_coupon['end_date']:'';
                        $status = $this->EmailService->send_refer_email($arr_user_data,$pin_id,$arr_coupon_info);
                    }
                }
               
            }
        }
        return $status;
    }
    function check_coupon_data($arr_data,$obj_data)
    {
        $is_change = 0;
        if(isset($arr_data['validity_extension']) && $arr_data['validity_extension']!=$obj_data->validity_extension)
        {
          $is_change++;
        }
        if(isset($arr_data['discount_amount']) && $arr_data['discount_amount']!=$obj_data->discount_amount)
        {
          $is_change++;
        }
        if(isset($arr_data['reward_amount']) && $arr_data['reward_amount']!=$obj_data->reward_amount)
        {
          $is_change++;
        }
        if(isset($arr_data['start_date']) && $arr_data['start_date']!=$obj_data->start_date)
        {
          $is_change++;
        }
        if(isset($arr_data['reference_reward_type']) && $arr_data['reference_reward_type']!=$obj_data->reference_reward_type)
        {
          $is_change++;
        }
        if(isset($arr_data['end_date']) && $arr_data['end_date']!=$obj_data->end_date)
        {
          $is_change++;
        }
        return $is_change;
    }
}
