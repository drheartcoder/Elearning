<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionsModel;
use App\Models\NewsletterSubscriberModel;

use App\Common\Services\NotificationService;
use App\Common\Services\EmailService;
use App\Common\Services\SMSService;

use Validator;
use Session;

class CronController extends Controller
{
	public function __construct(EmailService        $email_service,
                                NotificationService $notification_service,
                                SMSService          $sms_service)
    {
        
        $this->NotificationService           = $notification_service;
        $this->EmailService                  = $email_service;        
        $this->SMSService                    = $sms_service;
        $this->TransactionsModel             = new TransactionsModel();
        $this->NewsletterSubscriberModel     = new NewsletterSubscriberModel();
    }

    public function SendPlanExpiredRemainder()
    {
        $transaction_arr = [];
        $PlanExpiredDate = date("Y-m-d",strtotime('+3 day'));
        $transaction_arr = $this->TransactionsModel->with(['user_data'=>function($q){
                                                        $q->select('id','email','first_name','last_name');
                                                    },'plan_data'=>function($q){
                                                        $q->select('id','validity');
                                                    }])->whereDate('extension_date',$PlanExpiredDate)
                                                       ->where('status','=','active')
                                                       ->groupBy('user_id')             
                                                       ->get(); 
                            
        if(isset($transaction_arr) && count($transaction_arr)>0)
        {
            foreach ($transaction_arr as $key => $value) 
            {
                $first_name = isset($value['user_data']['first_name'])?ucfirst($value['user_data']['first_name']):'';
                $last_name  = isset($value['user_data']['last_name'])?ucfirst($value['user_data']['last_name']):'';
                $plan_name  = isset($value['plan_data']['name'])?$value['plan_data']['name']:'';

                $arr_built_content = [
                                        'NAME'         => $first_name.' '.$last_name,
                                        'PLAN_NAME'    => ucfirst($plan_name),
                                        'PROJECT_NAME' => config('app.project.name'),
                                        'VALIDITY'     => isset($value['plan_data']['validity'])?$value['plan_data']['validity']:'',                                    
                                        'START_DATE'   => isset($value['transaction_date'])?$value['transaction_date']:'',
                                        'END_DATE'     => isset($value['extension_date'])?date('Y-m-d',strtotme($value['extension_date'])):''
                                     ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '8';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = [
                                                        'email'      => $value['user_data']['email'],
                                                        'first_name' => $first_name.' '.$last_name
                                                      ];

                $email_status  = $this->EmailService->send_mail($arr_mail_data);

                // Store notification for user
                $arr_notify['message']      = "Your current ".ucfirst($plan_name)." plan going to expire after 3 day's, Please upgread your membership plan.";
                $arr_notify['from_user_id'] = 1;
                $arr_notify['to_user_id']   = $value['user_id'];
                $arr_notify['url']          = "/pricing";
                $arr_noti['is_read']        = "0";
                $notification               = $this->NotificationService->send_notification($arr_notify);                  

            }
            echo "Cron run successfully.";
        }
        else
        {
            echo "Records not found.";
        }
    }

    public function UpdatePlanExpiryStatus()
    {
        $transaction_arr = $arr_notify =[];
        $PlanExpiredDate = date("Y-m-d");
        $transaction_arr = $this->TransactionsModel->with(['user_data'=>function($q){
                                                        $q->select('id','email','first_name','last_name');
                                                    },'plan_data'=>function($q){
                                                        $q->select('id','validity');
                                                    }])->whereDate('extension_date',$PlanExpiredDate)
                                                       ->where('status','=','active')
                                                       ->groupBy('user_id')             
                                                       ->get(); 
                                                       

        if(isset($transaction_arr) && count($transaction_arr)>0)
        {
            foreach ($transaction_arr as $key => $value) 
            {
                $value->update(['status'=>'expired']);
                // Store notification for user
                $arr_notify['message']      = "Your current ".ucfirst($value['plan_data']['name'])." plan has been expired, Please upgread your membership.";
                $arr_notify['from_user_id'] = 1;
                $arr_notify['to_user_id']   = isset($value['user_id'])?$value['user_id']:'';
                $arr_notify['url']          = "/pricing";
                $arr_noti['is_read']        = "0";
                $notification               = $this->NotificationService->send_notification($arr_notify);                  
            }
            echo "Cron run successfully.";
        }
        else
        {
             echo "no record found.";
        }
       
    }

    public function unsubscribe_newsletter($enc_id)
    {
        if($enc_id!='')
        {
            $id = decrypt($enc_id);
            $check_is_exist = $this->NewsletterSubscriberModel->where('user_id',$id)->count();
            if($check_is_exist>0){
               $result = $this->NewsletterSubscriberModel->where('user_id',$id)->update(['is_active'=>'block']);
               if($result){
                    Session::flash('success','You have been successfully unsubscribed from newsletters.');
                    return redirect(url('/signin'));
               }
            }
        }
        Session::flash('error','Error occured while unsubscription. Please try again later.');
        return redirect(url('/signin'));
    }
}