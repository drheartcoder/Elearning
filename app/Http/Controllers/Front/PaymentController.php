<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UsersModel;
use App\Models\SubscriptionPlanModel;
use App\Models\TransactionsModel;
use App\Models\WireTransfereedRequestModel;
use App\Models\SiteStatusModel;
use App\Models\CouponsModel;
use App\Models\CouponUsageModel;
use App\Models\CurrencyRateModel;
use App\Models\ReferenceCodeModel;
use App\Common\Services\EmailService;
use App\Common\Services\NotificationService;
use App\Common\Services\SMSService;

//menthod paypal
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\AgreementTransaction;
use PayPal\Api\AgreementDetails;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;


//billing method
use PayPal\Api\ChargeModel; 
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition; 
use PayPal\Api\Plan;
use PayPal\Api\Agreement;

//billing update
use PayPal\Api\Patch; 
use PayPal\Api\PatchRequest; 
use PayPal\Common\PayPalModel;

//billing paypal
use PayPal\Api\ShippingAddress;

//billing CreditCard
use PayPal\Api\CreditCard; 
use PayPal\Api\FundingInstrument;


// Alipay
use Omnipay\Omnipay;

use Redirect;
use Session;
use PDF;
use DB;
use App;
use Pay;
use Config;
use Auth;
use Log;


class PaymentController extends Controller
{
    private $_apiContext;
    public function __construct (
                                    EmailService        $email_service,
                                    NotificationService $notification_service,
                                    SMSService          $sms_service,
                                    ReferenceCodeModel  $refernce_code
                                )
    {
        $this->EmailService                = $email_service;
        $this->NotificationService         = $notification_service;
        $this->SMSService                  = $sms_service;
        
        $this->BaseModel                   = new UsersModel();
        $this->SubscriptionPlanModel       = new SubscriptionPlanModel();
        $this->TransactionsModel           = new TransactionsModel();
        $this->WireTransfereedRequestModel = new WireTransfereedRequestModel();
        $this->SiteStatusModel             = new SiteStatusModel();
        $this->CouponsModel                = new CouponsModel();
        $this->CouponUsageModel            = new CouponUsageModel();
        $this->CurrencyRateModel           = new CurrencyRateModel();
        $this->ReferenceCodeModel          = new ReferenceCodeModel();
           
       
       /* $paypal_conf = config('paypal');        
        dd($paypal_conf);
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));        
        $this->_api_context->setConfig($paypal_conf['settings']);  */         
         
        $this->_api_context  = new ApiContext(new OAuthTokenCredential(config('services.paypal.client_id'), config('services.paypal.secret')));

        $this->alipay_config = Config('pay.alipay');
        $this->wechat_config = Config('pay.wechat');

        $this->_api_context->setConfig( array(
                                                'mode' => env('PAYPAL_MODE','live'),
                                                'http.ConnectionTimeOut' => 30,
                                                'log.LogEnabled' => true,
                                                'log.FileName' => storage_path() . '/logs/paypal.log',
                                                'log.LogLevel' => 'ERROR'
                                                )
                                      );                            
        //dd($this->_apiContext);
    }    

    public function PaypalIndex(Request $request)
    {
        $converted_total_price = $total_price_cny_amount = $coupon_code = $coupon_code_owner_id = $reward_amount = $convered_reward_amount = '';
        $pan_details_arr = [];

        $converted_total_price    = $request->input('converted_total_price','');        
        $total_price_cny_amount   = $request->input('total_price_cny_amount');
        $coupon_code              = $request->input('coupon_code');
        $coupon_code_owner_id     = $request->input('coupon_code_owner_id');
        $per_unit_conversion_rate = $request->input('per_unit_conversion_rate');
        $to_currency              = $request->input('to_currency');
        $from_currency            = $request->input('from_currency');
        $payment_note             = trim($request->input('payment_note',''));  

        if(Session::get('membership.plan_id')=="")
        {
            Session::flash('error',trans('home.Error_occured_while_transaction_Please_Select_plan'));
            return redirect(url('/').'/pricing');
        }
        $converted_total_price =  $a = str_replace(',', '', $converted_total_price);
        
        if(!empty(Session::get('membership')))
        {            
            $session = array(
                        'plan_id'                  => Session::get('membership.plan_id'),
                        'userid'                   => Session::get('membership.userid'),
                        'usertoken'                => Session::get('membership.usertoken'),
                        'social'                   => Session::get('membership.social'),
                        'converted_total_price'    => $converted_total_price,
                        'coupon_code'              => $coupon_code,
                        'coupon_code_owner_id'     => $coupon_code_owner_id,
                        'per_unit_conversion_rate' => $per_unit_conversion_rate,
                        'total_price_cny_amount'   => $total_price_cny_amount,
                        'from_currency'            => $from_currency,
                        'to_currency'              => $to_currency,
                        'payment_note'             => $payment_note
                        );
            Session::put('membership',$session);
        }
        $pan_details_arr = getPlanDetails(Session::get('membership.plan_id'));
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName($pan_details_arr['name']) // item name
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($converted_total_price); // unit price
              
          // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal($converted_total_price); //$converted_total_price

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription($pan_details_arr['details']);
       

        $redirect_urls = new RedirectUrls();
        $success_url = url('/').'/doPayment';
        $cancel_url = url('/').'/doCancel';
        $redirect_urls->setReturnUrl($success_url)
                      ->setCancelUrl($cancel_url);

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));

        try 
        {       
            $payment->create($this->_api_context);
            if ($payment)
            {
                foreach($payment->getLinks() as $link) 
                {
                                
                    if($link->getRel() == 'approval_url')
                    {

                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                if(isset($redirect_url)) 
                {
                    // redirect to paypal
                    Session::put('paypal_payment_id', $payment->getId());
                    Redirect::to($redirect_url)->send();
                }
            }

        } 
        catch (\PayPal\Exception\PayPalConnectionException $ex) 
        {
            if (\Config::get('app.debug')) 
            {
                Session::flash('error',$ex->getMessage());    
                $user_details_arr   = getUserDetails(base64_decode(Session::get('membership.userid')));                
                if($user_details_arr['is_active_membership']=='yes')
                {
                    return redirect(url('/pricing'));
                }
                else
                {
                    return redirect(url('/pricing?enc_id='.Session::get('membership.userid').'&token='.Session::get('membership.usertoken'))); 
                }
              
                /*echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;*/
            } 
            else 
            {
                die(trans('home.Error_occure_while_transaction'));
            }

            
        } 
    }    

    public function StoreCheckoutData(Request $request)
    {
        $id = $userid = $usertoken = '';

        $id        = $request->input('plan_id');
        $userid    = $request->input('userid');
        $usertoken = $request->input('usertoken');

        if($id != '')
        {
            if( !empty( Session::get('membership.social') ) )
            {
                $social = Session::get('membership.social');
            }
            else
            {
                $social = 'no';
            }

            $session = array(
                            'plan_id'   => $id,
                            'userid'    => $userid,
                            'usertoken' => $usertoken,
                            'social'    => $social
                            );

            Session::put('membership',$session);
            Session::put('return_url','/pricing');
            $resp = array('status' => 'success','is_social'=>$social);
            return response()->json($resp);      
        }
    }

    public function DoPayment(Request $request)
    {        
        $payment_id = $transaction_id = '';
        $arr_data   = [];

        $id         = $_GET['paymentId'];
        $token      = $_GET['token'];
        $payer_id   = $_GET['PayerID'];
        $payment_id = (Session::get('paypal_payment_id')!=null) ? Session::get('paypal_payment_id')  : $id;
          
        if (empty($payment_id) || empty($token)) 
        {
            return Redirect::route('original.route')->with('error', 'Payment failed');
        }
          
        $payment = Payment::get($payment_id, $this->_api_context);
          
        // PaymentExecution object includes information necessary 
        // to execute a PayPal account payment. 
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($payer_id);
          
          //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        if($result)
        {
            $response_result = $result->toArray();
        }
        if(isset($response_result) && sizeof($response_result)>0)
        {
            $user_details_arr = $user_arr = [];
            $transaction_id   = $response_result['id'];
            if($response_result['state']=="approved")
            {
                $payment_status = "paid";
            }
            elseif($response_result['state']=="pending")
            {   
                $payment_status = "pending";
            }
            elseif($response_result['state']=="captured")
            {   
                $payment_status = "unpaid";
            }
            elseif($response_result['state']=="loss")
            {
                $payment_status = "unpaid";  
            }
            $userid           = Session::get('membership.userid');
            $social           = Session::get('membership.social');
            $user_details_arr = getUserDetails(base64_decode($userid));
                
            $arr_data         = [
                                    'transaction_id'           => $transaction_id,
                                    'uniq_id'                  => uniqid(),
                                    'plan_id'                  => Session::get('membership.plan_id'),
                                    'userid'                   => Session::get('membership.userid'),
                                    'usertoken'                => Session::get('membership.usertoken'),
                                    'social'                   => Session::get('membership.social'),
                                    'converted_total_price'    => Session::get('membership.converted_total_price'),
                                    'coupon_code'              => Session::get('membership.coupon_code'),
                                    'per_unit_conversion_rate' => Session::get('membership.per_unit_conversion_rate'),
                                    'coupon_code_owner_id'     => Session::get('membership.coupon_code_owner_id'),
                                    'from_currency'            => Session::get('membership.from_currency'),
                                    'to_currency'              => Session::get('membership.to_currency'),
                                    'total_price_cny_amount'   => Session::get('membership.total_price_cny_amount'),
                                    'payment_via'              => 'paypal',
                                    'payment_status'           =>  $payment_status, 
                                ];

            $res = $this->create_transaction($arr_data);
            if($payment_status=='paid')
            {
                Session::flash('success',trans('home.Your_payment_has_been_done_successfully'));    
            }   
            elseif($payment_status=='unpaid' || $payment_status=='pending')
            {
                Session::flash('error',trans('home.Error_occure_during_payment_Please_try_again')); 
            }   
            else
            {
                Session::flash('error',trans('home.Error_occure_during_payment_Please_try_again')); 
            }

            $user = $this->BaseModel->where(['id' => base64_decode($userid)])->first();
            Auth::login($user);                         
            if($res  && $payment_status=='paid')
            {
                if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership']=='no')
                {
                  DB::table('users')->where('id',base64_decode($userid))->update(['is_active_membership' => 'yes']);
                }
                return redirect(url('parent/dashboard'));     
            }
            else
            {
               return redirect(url('parent/dashboard'));  
            }   
        }  
        else
        {
             return redirect(url('/signin'));   
        }      
    }

    public function DoCancel()
    {
         Session::flash('error',trans('home.Connection_has_been_failed_msg')); 
         return redirect(url('/pricing'));    
       /* $user_details_arr = getUserDetails(base64_decode(Session::get('membership.userid')));
        
        if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership'] == 'yes') 
        {
            Session::flash('success',"Your payment has been done successfully.");        
            return redirect(url('/pricing'));
        } 
        else 
        {
            Session::flash('error',"Payment has been canceled.");        
            if(!empty(Session::get('membership.userid')) && !empty(Session::get('membership.usertoken')))
            {
                return redirect(url('/pricing?enc_id='.Session::get('membership.userid').'&token='.Session::get('membership.usertoken'))); 
            }
            
        }
        return redirect(url('/pricing'));*/
    }


    function create_transaction($arr_data=false)
    {
        $pin = $invoice_name = '';
        $user_details_arr   = $res_status = $pan_details_arr = $reference_settings_arr =$arr_coupen_data = [];
        $arr_coupen_usage   = $arr_coupen_info = [];
        $plan_expired_date  = $invoice    = $convered_reward_amount = $plan_extension_date = $res = '';
        $coupen_usage_count = $total      = $final_amount = $no_of_days = 0;
        $code               = $transaction_amount = '0'; 

        $pan_details_arr    = getPlanDetails($arr_data['plan_id']);
        $arr_global_setting = getGlobalSetting();
        $user_id            = isset($arr_data['userid'])?base64_decode($arr_data['userid']):'';
        $user_details_arr   = getUserDetails($user_id);

        if($this->is_membership_plan_purchased($user_id)==true)
        {

            $obj_membership = $this->TransactionsModel->where('user_id',base64_decode($arr_data['userid']))
                                    ->where('status','=','active')
                                    ->orderBy('id','desc')
                                    ->first();

            if(isset($obj_membership->expiry_date) && $obj_membership->expiry_date!="")
            {
               $plan_validity = isset($pan_details_arr['validity'])?(int)$pan_details_arr['validity']:1;
               $plan_expired_date = ($arr_data['plan_id']!=4) ?date('Y-m-d', strtotime($obj_membership->expiry_date. ' + '.$plan_validity.' years')):'';
               $plan_extension_date = date('Y-m-d', strtotime($obj_membership->extension_date. ' + '.$plan_validity.' years'));
            }
            

        }
        else
        {
            $plan_validity = isset($pan_details_arr['validity'])?(int)$pan_details_arr['validity']:1;
            $plan_expired_date  = ($arr_data['plan_id']!=4) ? date('Y-m-d',strtotime('+'.$plan_validity.' years')) : "";
            $plan_extension_date = $plan_expired_date;
        }
        // Coupen Code Section
        if($arr_data['coupon_code']!='' && $arr_data['coupon_code']!=null)
        {
            $reference_settings_arr = $this->CouponsModel->where('coupon_code',$arr_data['coupon_code'])->first();

            if(isset($reference_settings_arr['reward_type_for_referral']) && $reference_settings_arr['reward_type_for_referral']=='both')
            {
                $reward_type_for_referral = $reference_settings_arr['reward_type_for_referral'];
                $message = ucwords($user_details_arr['first_name'].' '.$user_details_arr['last_name']).' parent registered with your reference code, So you have received Extension of '.$reference_settings_arr['validity_extension'].' months and Incentive of '.$reference_settings_arr['reward_amount'].'%';

            }  
            elseif(isset($reference_settings_arr['reward_type_for_referral']) && $reference_settings_arr['reward_type_for_referral']=='validity_extension')
            {    
                $message = ucwords($user_details_arr['first_name'].' '.$user_details_arr['last_name']).' parent registered with your reference code, So you have received Extension of '.$reference_settings_arr['validity_extension'].' months';

                $reward_type_for_referral = $reference_settings_arr['reward_type_for_referral'];
            }
            else
            {    
                $message = ucwords($user_details_arr['first_name'].' '.$user_details_arr['last_name']).' parent registered with your reference code, So you have received Incentive of '.$reference_settings_arr['reward_amount'].'%';

                $reward_type_for_referral = $reference_settings_arr['reward_type_for_referral'];

            }   

           
            $arr_coupen_usage = [
                                    'coupon_id'                => $reference_settings_arr['id'],
                                    'user_id'                  => base64_decode($arr_data['userid']),
                                    'created_by'               => isset($arr_data['coupon_code_owner_id'])?$arr_data['coupon_code_owner_id']:1,
                                    'reward_type_for_referral' => $reward_type_for_referral,
                                    'validity_extension'       => $reference_settings_arr['validity_extension'],
                                    'reward_amount'            => $reference_settings_arr['reward_amount'],
                                    'per_unit_conversion_rate' => isset($arr_data['per_unit_conversion_rate'])?$arr_data['per_unit_conversion_rate']:'',
                                    'from_currency'            =>isset($arr_data['from_currency'])?$arr_data['from_currency']:'',
                                    'to_currency'              => isset($arr_data['to_currency'])?$arr_data['to_currency']:'',
                                    'discount_amount'          => $reference_settings_arr['discount_amount'] 
                                ];

            $this->CouponUsageModel->insertGetId($arr_coupen_usage); 

        }

        //Expired Previous Plan
        if(isset($arr_data['payment_via']) && $arr_data['payment_via']!="offline")
        {
            $this->TransactionsModel->where('user_id',base64_decode($arr_data['userid']))->update(['status'=>'expired']);
        }
        // Transaction insert code
        $insert_arr = array(
            'user_id'                  => base64_decode($arr_data['userid']),
            'uniq_id'                  => isset($arr_data['uniq_id'])?$arr_data['uniq_id']:'',
            'amount'                   => isset($pan_details_arr['price'])?$pan_details_arr['price']:'',
            'plan_id'                  => isset($pan_details_arr['id'])?$pan_details_arr['id']:'',
            'expiry_date'              => $plan_expired_date,
            'extension_date'           => $plan_extension_date,
            'transaction_date'         => date('Y-m-d'),
            'status'                   => 'active',
            'invoice'                  => '',
            'coupon_id'                => isset($reference_settings_arr['id']) &&  $reference_settings_arr['id']!='' ?  $reference_settings_arr['id'] : '0',
            'coupon_usage_id'          => isset( $res_status->id ) &&  $res_status->id != '' ? $res_status->id : '0',
            'per_unit_conversion_rate' => isset($arr_data['per_unit_conversion_rate'])?$arr_data['per_unit_conversion_rate']:'',
            'total_converted_amount'   => isset($arr_data['converted_total_price'])?$arr_data['converted_total_price']:'',
            'total_price_cny_amount'   => isset($arr_data['total_price_cny_amount'])?$arr_data['total_price_cny_amount']:'',
            'from_currency'            => isset($arr_data['from_currency'])?$arr_data['from_currency']:'',
            'to_currency'              => isset($arr_data['to_currency'])?$arr_data['to_currency']:'',
            'transaction_id'           => isset($arr_data['transaction_id'])?$arr_data['transaction_id']:'',
            'payment_via'              => isset($arr_data['payment_via'])?$arr_data['payment_via']:'',
            'payment_status'           => isset($arr_data['payment_status'])?$arr_data['payment_status']:'',
            'wire_transfer_id'         => isset($arr_data['wire_transfer_id'])?$arr_data['wire_transfer_id']:'',
            'payment_note'             => isset($arr_data['payment_note'])?$arr_data['payment_note']:''
        );

        if(isset($arr_data['payment_via']) && $arr_data['payment_via']!='offline')
        {
            $this->delete_offline_transaction(base64_decode($arr_data['userid']));
        }
        if(isset($arr_data['payment_via']) && $arr_data['payment_via']=='wechat')
        {
            $this->delete_wechat_transaction(base64_decode($arr_data['userid']),$arr_data['uniq_id']);
        }
        $res = $this->TransactionsModel->insertGetId($insert_arr);
        if($res)
        {
            if(isset($arr_data['payment_via']) && $arr_data['payment_via']!='offline' && $arr_data['payment_via']!='wechat')
            {
                if($arr_data['coupon_code']!='' && $arr_data['coupon_code']!=null)
                {
                    $arr_coupen_data['coupon_code_owner_id'] =  isset($arr_data['coupon_code_owner_id'])?$arr_data['coupon_code_owner_id']:1;
                    $arr_coupen_data['reward_amount']        =  isset($reference_settings_arr['reward_amount'])?$reference_settings_arr['reward_amount']:'';
                    $arr_coupen_data['validity_extension']   =  isset($reference_settings_arr['validity_extension'])?$reference_settings_arr['validity_extension']:'';
                           
                    $this->update_plan_details($arr_coupen_data);
                }
                if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership']=='no')
                {
                   $pin     = $this->generatePin($user_details_arr); 
                   if(isset($pin) && $pin!=false)
                   {
                        $arr_ref_code       = $this->ReferenceCodeModel
                                                   ->where('coupen_type','=','PARENT')
                                                   ->first();

                        $arr_coupen_info['start_date']= isset($arr_ref_code->start_date)?$arr_ref_code->start_date:'';
                        $arr_coupen_info['end_date'] = isset($arr_ref_code->end_date)?$arr_ref_code->end_date:'';

                        //$this->EmailService->send_refer_email($user_details_arr,$pin,$arr_coupen_info);
                   }
                 
                }
                else
                {
                    if(isset($user_details_arr['pin']) && $user_details_arr['pin']!="")
                    {
                        $pin   = $user_details_arr['pin'];
                    }
                }
            
                $invoice_name         = $this->generateInvoice($res);
                $obj_transaction_data = DB::table('transactions')->where('id',$res)->update(['invoice'=>$invoice_name]);

                //sent email
                $first_name     = isset($user_details_arr['first_name'])?$user_details_arr['first_name']:'';
                $last_name      = isset($user_details_arr['last_name'])?$user_details_arr['last_name']:'';

                if(isset($arr_data['payment_via']) && $arr_data['payment_via']=='alipay')
                {
                    $transaction_amount = isset($arr_data['total_price_cny_amount'])?$arr_data['total_price_cny_amount']:'';
                    $final_amount       = $transaction_amount.' CNY';
                }
                else if(isset($arr_data['payment_via']) && $arr_data['payment_via']=='paypal')
                {
                     $transaction_amount = isset($arr_data['converted_total_price'])?$arr_data['converted_total_price']:'';
                     $final_amount       = $transaction_amount.' USD';
                }
                elseif(isset($arr_data['payment_via']) && $arr_data['payment_via']=='offline')
                {
                    $transaction_amount =  isset($arr_data['converted_total_price'])?$arr_data['converted_total_price']:'';
                    $final_amount       = $transaction_amount.' USD';
                }
                elseif(isset($arr_data['payment_via']) && $arr_data['payment_via']=='offline' || $arr_data['payment_via']=='From Received Insentive')
                {
                    $transaction_amount =  isset($arr_data['converted_total_price'])?$arr_data['converted_total_price']:'';
                    $final_amount       = $transaction_amount.' USD';
                }
                $arr_built_content = [
                        'NAME'                  => $first_name.' '.$last_name,
                        'SUBJECT'               => 'Subscription Transaction Mail',
                        'PROJECT_NAME'          => config('app.project.name'),
                        'PLAN_NAME'             => isset($pan_details_arr['name'])?$pan_details_arr['name']:'',
                        'TRANSACTION_ID'        => $arr_data['transaction_id'],
                        'TRANSACTION_AMOUNT'    => $final_amount,
                ];

                $arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '9';
                $attachment_path                    = base_path('uploads/invoice/'.$invoice_name);
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = [
                                                        'email'      => isset($user_details_arr['email'])?$user_details_arr['email']:'',
                                                        'first_name' => isset($user_details_arr['first_name'])?$user_details_arr['first_name']:'',
                                                        'attachment_path'=> $attachment_path
                                                      ];

                //$email_status  = $this->EmailService->send_mail($arr_mail_data);
                if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership'] == 'no')
                {
                         DB::table('users')->where('id',base64_decode($arr_data['userid']))
                                      ->update(['pin' => $pin]);
                }
            }
            $session = array(
                                    'plan_id'   => '',
                                    'userid'    => '',
                                    'usertoken' => '',
                                    'social'    => ''
                                );

            if($arr_data['payment_via']!='wechat')
            {
                Session::put('membership',$session);
            }
            return $res;
        }
        return false;
    }
    function update_plan_details($arr_user_data)
    { 
        // Extension of validity
        if(isset($arr_user_data) && sizeof($arr_user_data)>0)
        {
            $obj_active_plan = $this->TransactionsModel->where('user_id',$arr_user_data['coupon_code_owner_id'])->where('status','active')->orderBy('id','DESC')->first();

            if(isset($obj_active_plan) && $obj_active_plan!=null && isset($arr_user_data['validity_extension']) && $arr_user_data['validity_extension']!="")
            {                        
                $plan_expired_date = date('Y-m-d',strtotime('+'.$arr_user_data['validity_extension'].'months',strtotime($obj_active_plan->extension_date)));

                $obj_active_plan->update(['extension_date'=>$plan_expired_date]);
            }
            // Insentive amount
            $obj_user_details = $this->BaseModel->where('id',$arr_user_data['coupon_code_owner_id'])->first();
            if($obj_user_details && isset($arr_user_data['reward_amount']) && $arr_user_data['reward_amount']!="")
            {
                $total_insentive_amount = $obj_user_details->insentive_amount + $arr_user_data['reward_amount'];
                $final_incentive_amount = $obj_user_details->total_incentive_amount + $arr_user_data['reward_amount'];
                $obj_user_details->update(['insentive_amount'=>$total_insentive_amount,'total_incentive_amount'=>$final_incentive_amount]);
            }
        }
       
        
    }
    function delete_offline_transaction($parent_id)
    {
        $this->WireTransfereedRequestModel->where('user_id','=',$parent_id)->where('payment_status','=','unpaid')
                                                                           ->delete();

        $status     =  $this->TransactionsModel->where('user_id',$parent_id)->where('payment_via','=','offline')
                                                                            ->where('payment_status','=','unpaid')
                                                                            ->delete();
        return $status;
    }
    function delete_wechat_transaction($parent_id,$uniq_id)
    {
        $status =   $this->TransactionsModel->where('user_id',$parent_id)->where('payment_via','=','wechat')
                                                                         ->where('payment_status','=','unpaid')
                                                                         ->where('uniq_id','<>',$uniq_id)
                                                                         ->delete();
        return $status;
    }
    function generateReferenceCode()
    {
        $check_reference_code = [];
        $reference_code       = 0;
        $string               = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string_shuffled      = str_shuffle($string);
        $reference_code       = substr($string_shuffled, 1, 10);

        $check_reference_code = DB::table('users')->where('pin',$reference_code)->count();                
        if($check_reference_code>0)
        {
            $reference_code = $this->generateReferenceCode();
        }
        return $reference_code;
    }

    function generateInvoice($transaction_id=false)
    {
        $ReceivedData = $SenderData = [];
        $html = $view = "";

        if(isset($transaction_id) && $transaction_id!=false)
        {
            $TrasactionData = DB::table('transactions')
                                ->select('transactions.*','subscription_plan.validity','subscription_plan_translation.name','coupons.coupon_code','coupons.title','coupons.discount_amount')
                                ->join('coupons','coupons.id','=','transactions.coupon_id','left')
                                ->join('subscription_plan','subscription_plan.id','=','transactions.plan_id')
                                ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','subscription_plan.id')
                                ->where('transactions.id',$transaction_id)
                                ->where('subscription_plan_translation.locale','en')
                                ->first();
            
            if(isset($TrasactionData->user_id) && $TrasactionData->user_id!="")
            {
                 $SenderData   = DB::table('users')->where('id',$TrasactionData->user_id)->select('first_name','last_name','id','email','address')->first();
            }
           
            $ReceivedData = DB::table('site_status')->select('site_name','site_contact_number','site_email_address')->first();

            $data['logo']     = url('/images/logo-footer.png');
            $data['base_url'] = url('/');
            if(isset($TrasactionData) && $TrasactionData!="")
            {
              $view = view('invoice_pdf')->with(['ReceivedData'=>$ReceivedData,'SenderData'=>$SenderData,'TrasactionData'=>$TrasactionData,'Data'=>$data]);
               $html = $view->render();
            }

            $FileName = 'Invoice_T'.$transaction_id.'.pdf';
            $path     = base_path('uploads/invoice/'.$FileName);
            @chmod($path,0777);
            $res      = PDF::loadHTML($html)->save($path,'F');
            
            return $FileName;   
        }
    }

    public function AlipayIndex(Request $request)
    {
        $converted_total_price = $total_price_cny_amount = $coupon_code = $coupon_code_owner_id = $reward_amount = $convered_reward_amount = '';
        $pan_details_arr          = [];

        $converted_total_price    = $request->input('converted_total_price');     
        $total_price_cny_amount   = $request->input('total_price_cny_amount');   
        $coupon_code              = $request->input('coupon_code');
        $coupon_code_owner_id     = $request->input('coupon_code_owner_id');
        $per_unit_conversion_rate = $request->input('per_unit_conversion_rate');
        $to_currency              = $request->input('to_currency');
        $from_currency            = $request->input('from_currency'); 
        $payment_note             = trim($request->input('payment_note',''));   

        if(empty(Session::get('membership')))
        {
            Session::flash('error',trans('home.Error_occured_while_transaction_Please_Select_plan'));
            return redirect(url('/').'/pricing');
        }

        if(!empty(Session::get('membership')))
        {            
            $session = array(
                                'plan_id'                  => Session::get('membership.plan_id'),
                                'userid'                   => Session::get('membership.userid'),
                                'usertoken'                => Session::get('membership.usertoken'),
                                'social'                   => Session::get('membership.social'),
                                'converted_total_price'    => $converted_total_price,
                                'coupon_code'              => $coupon_code,
                                'coupon_code_owner_id'     => $coupon_code_owner_id,
                                'per_unit_conversion_rate' => $per_unit_conversion_rate,
                                'from_currency'            => $from_currency,
                                'to_currency'              => $to_currency,
                                'total_price_cny_amount'   => $total_price_cny_amount,
                                'payment_note'             => $payment_note
                            );
            Session::put('membership',$session);
        }

        $pan_details_arr = getPlanDetails(Session::get('membership.plan_id'));       
        if(count($pan_details_arr)>0)
        {
            $order = [
                        'out_trade_no' => time(),
                        'total_amount' => (int) $total_price_cny_amount,
                        'subject'      => $pan_details_arr['name'],
                    ];
            return Pay::alipay($this->alipay_config)->web($order);
        }
        else
        {
            Session::flash('error',trans('teacher.select_membership_plan'));
            return redirect()->back();
        }
    }

    public function AlipayCallback(Request $request) 
    {
        $payment_status = '';
        if(empty(Session::get('membership')))
        {
            Session::flash('error',trans('home.Error_occure_while_transaction'));
            return redirect(url('/').'/pricing');
        }
        $user_details_arr = $user_arr = [];

        try{
            // 查询
            $result = Pay::alipay($this->alipay_config)->find($request->input('out_trade_no')); // 返回 `Yansongda\Supports\Collection` 实例，可以通过 `$result->xxx` 访问服务器返回的数据。
            $userid = Session::get('membership.userid');
            $social = Session::get('membership.social');
            $user_details_arr = getUserDetails(base64_decode($userid));
            
            if(isset($result->trade_status) && $result->trade_status=="TRADE_SUCCESS")
            {
                $payment_status = "paid";
            }
            elseif(isset($result->trade_status) && $result->trade_status=="TRADE_FINISHED")
            {   
                $payment_status = "paid";
            }
            else
            {   
                $payment_status = "unpaid";
            }


            if($result->trade_status=='TRADE_SUCCESS' || $result->trade_status=='TRADE_FINISHED')
            {
                $transaction_id = $request->input('trade_no');        
                // dd($result,$userid,$social,$user_details_arr,$transaction_id,Session::all());                    
                $arr_data = [
                             'transaction_id'           => $transaction_id,
                             'uniq_id'                  => uniqid(),
                             'plan_id'                  => Session::get('membership.plan_id'),
                             'userid'                   => Session::get('membership.userid'),
                             'usertoken'                => Session::get('membership.usertoken')!=null ? Session::get('membership.usertoken') : "",
                             'social'                   => Session::get('membership.social'),
                             'converted_total_price'    => Session::get('membership.converted_total_price'),
                             'coupon_code'              => Session::get('membership.coupon_code'),
                             'per_unit_conversion_rate' => Session::get('membership.per_unit_conversion_rate'),
                             'coupon_code_owner_id'     => Session::get('membership.coupon_code_owner_id'),
                             'from_currency'            => Session::get('membership.from_currency'),
                             'to_currency'              => Session::get('membership.from_currency'),
                             'total_price_cny_amount'   => Session::get('membership.total_price_cny_amount'),
                             'payment_via'              => 'alipay',
                             'payment_status'           => $payment_status,
                             'payment_note'             => Session::get('membership.payment_note'),
                         ];
                
                $res = $this->create_transaction($arr_data);    
                $user = $this->BaseModel->where(['id' => base64_decode($userid)])->first();
                Session::flash('success',trans('home.Your_payment_has_been_done_successfully'));                  
                if($res)
                {
                  Auth::login($user);  
                  if(isset($user->is_active_membership) && $user->is_active_membership=='no')
                  {
                    DB::table('users')->where('id',base64_decode($userid))->update(['is_active_membership' => 'yes']);
                  }
                  return redirect(url('parent/dashboard'));                
                }
                else
                {
                    return redirect(url('/signin'));  
                }   
            }
            else
            {
                Session::flash('error','Error occure during payment, Please try again');    
                return redirect(url('/signin'));  
            }
        } 
        catch (Exception $e) 
        {            
            Session::flash('error',$e->getMessage());

            if($social=='no' && $user_details_arr['is_active_membership']=='no')
            {
                return redirect(url('/signup/otp/'.$userid));                
            }
            else if($social=='yes' && $user_details_arr['is_active_membership']=='no')
            {
                return redirect(url('parent/account-setting/my-profile'));   
            }
            else if($social=='yes' && $user_details_arr['is_active_membership']=='yes')
            {
                return redirect()->back();
            }
            else
            {
                return redirect(url('/signin'));  
            }  
        }
    }

    public function WechatIndex(Request $request,$uniq_id='')
    {
        if($uniq_id!='')
        {
            $this->data = $plan_details_arr = [];
            $converted_total_price = $total_price_cny_amount = $coupon_code = $coupon_code_owner_id = $reward_amount = $convered_reward_amount = '';

            $converted_total_price    = $request->input('converted_total_price','');        
            $total_price_cny_amount   = $request->input('total_price_cny_amount');
            $coupon_code              = $request->input('coupon_code');
            $coupon_code_owner_id     = $request->input('coupon_code_owner_id');
            $per_unit_conversion_rate = $request->input('per_unit_conversion_rate');
            $to_currency              = $request->input('to_currency');
            $from_currency            = $request->input('from_currency');
            $payment_note             = trim($request->input('payment_note',''));  

            if(Session::get('membership.plan_id')=="")
            {
                Session::flash('error',trans('home.Error_occured_while_transaction_Please_Select_plan'));
                return redirect(url('/').'/pricing');
            }
            $converted_total_price =  $a = str_replace(',', '', $converted_total_price);
            
            if(!empty(Session::get('membership')))
            {            
                $session = array(
                            'plan_id'                  => Session::get('membership.plan_id'),
                            'userid'                   => Session::get('membership.userid'),
                            'usertoken'                => Session::get('membership.usertoken'),
                            'social'                   => Session::get('membership.social'),
                            'uniq_id'                  => $uniq_id,
                            'converted_total_price'    => $converted_total_price,
                            'coupon_code'              => $coupon_code,
                            'coupon_code_owner_id'     => $coupon_code_owner_id,
                            'per_unit_conversion_rate' => $per_unit_conversion_rate,
                            'total_price_cny_amount'   => $total_price_cny_amount,
                            'from_currency'            => $from_currency,
                            'to_currency'              => $to_currency,
                            'payment_note'             => $payment_note
                            );
                Session::put('membership',$session);
            }

            $plan_details_arr = getPlanDetails(Session::get('membership.plan_id'));
            if(empty(Session::get('membership')))
            {
                Session::flash('error',trans('home.Error_occured_while_transaction_Please_Select_plan'));
                return redirect(url('/').'/pricing');
            }
            if(count($plan_details_arr)>0)
            {
                $arr_data = [
                                 'transaction_id'           => $uniq_id,
                                 'uniq_id'                  => $uniq_id,
                                 'plan_id'                  => Session::get('membership.plan_id'),
                                 'userid'                   => Session::get('membership.userid'),
                                 'usertoken'                => Session::get('membership.usertoken'),
                                 'social'                   => Session::get('membership.social'),
                                 'converted_total_price'    => Session::get('membership.converted_total_price'),
                                 'coupon_code'              => Session::get('membership.coupon_code'),
                                 'per_unit_conversion_rate' => Session::get('membership.per_unit_conversion_rate'),
                                 'coupon_code_owner_id'     => Session::get('membership.coupon_code_owner_id'),
                                 'from_currency'            => Session::get('membership.from_currency'),
                                 'to_currency'              => Session::get('membership.from_currency'),
                                 'total_price_cny_amount'   => Session::get('membership.total_price_cny_amount'),
                                 'payment_via'              => 'wechat',
                                 'payment_status'           => 'unpaid',
                                 'payment_note'             => Session::get('membership.payment_note'),
                            ];

                $check_if_transaction_exists = $this->TransactionsModel->where('user_id',base64_decode($arr_data['userid']))->where('uniq_id',$uniq_id)->count();
                
                if($check_if_transaction_exists>0)
                {
                    $user_id = base64_decode(Session::get('membership.userid'));
                    $plan_id = Session::get('membership.plan_id');
                    //get plan date
                    if($this->is_membership_plan_purchased($user_id)==true)
                    {

                        $obj_membership = $this->TransactionsModel->where('user_id',$user_id)
                                                ->where('status','=','active')
                                                ->orderBy('id','desc')
                                                ->first();

                        if(isset($obj_membership->expiry_date) && $obj_membership->expiry_date!="" && isset($obj_membership->extension_date) && $obj_membership->extension_date!="")
                        {
                           $plan_validity = isset($plan_details_arr['validity'])?(int)$plan_details_arr['validity']:1;
                           $plan_expired_date = ($plan_id!=4) ?date('Y-m-d', strtotime($obj_membership->expiry_date. ' + '.$plan_validity.' years')):'';
                           $plan_extension_date = date('Y-m-d', strtotime($obj_membership->extension_date. ' + '.$plan_validity.' years'));
                        }
                    }
                    else
                    {
                        $plan_validity = isset($plan_details_arr['validity'])?(int)$plan_details_arr['validity']:1;
                        $plan_expired_date  = ($plan_id!=4) ? date('Y-m-d',strtotime('+'.$plan_validity.' years')) : "";
                        $plan_extension_date = $plan_expired_date;
                    }
                    
                    //get coupon info
                    if(isset($coupon_code) && $coupon_code!='' && $coupon_code!=null)
                    {
                        $reference_settings_arr = $this->CouponsModel->where('coupon_code',$coupon_code)->first();
                    }

                    $arr_update_data = array(
                        'user_id'                  => $user_id,
                        'amount'                   => isset($plan_details_arr['price'])?$plan_details_arr['price']:'',
                        'plan_id'                  => isset($plan_details_arr['id'])?$plan_details_arr['id']:'',
                        'expiry_date'              => $plan_expired_date,
                        'extension_date'           => $plan_extension_date,
                        'transaction_date'         => date('Y-m-d'),
                        'status'                   => 'active',
                        'coupon_id'                => isset($reference_settings_arr['id']) &&  $reference_settings_arr['id']!='' ?  $reference_settings_arr['id'] : '0',
                        'coupon_usage_id'          => isset( $res_status->id ) &&  $res_status->id != '' ? $res_status->id : '0',
                        'per_unit_conversion_rate' => Session::get('membership.per_unit_conversion_rate'),
                        'total_converted_amount'   => Session::get('membership.converted_total_price'),
                        'total_price_cny_amount'   => Session::get('membership.total_price_cny_amount'),
                        'from_currency'            => Session::get('membership.from_currency'),
                        'to_currency'              => Session::get('membership.to_currency'),
                        'transaction_id'           => $uniq_id,
                        'uniq_id'                  => $uniq_id,
                        'payment_via'              => 'wechat',
                        'payment_status'           => 'unpaid',
                        'payment_note'             => Session::get('membership.payment_note')
                    );
                    $this->TransactionsModel->where('user_id',$user_id)->where('uniq_id',$uniq_id)->update($arr_update_data);
                }
                else
                {
                    $res = $this->create_transaction($arr_data);
                }

                $plan_details_arr['uniq_id']    = $uniq_id;
                $this->data['plan_details_arr'] = $plan_details_arr;
                $this->data['pageTitle']        = trans('home.wechat_pay');
                $this->data['middleContent']    = 'wechat_pay';
                
                return view('front.layout.master')->with($this->data);
            }
            else
            {
                Session::flash('error',trans('teacher.select_membership_plan'));
                return redirect()->back();
            }  
        }
        Session::flash('error',trans('home.Error_occure_during_payment_Please_try_again'));
        return redirect()->back();

    }

    public function WechatCallback(Request $request) 
    {
        $streamData = isset($GLOBALS['HTTP_RAW_POST_DATA'])? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
        if(empty($streamData)){
            $streamData = file_get_contents('php://input');
        }
        $streamData = simplexml_load_string($streamData, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data       = json_encode($streamData, true);
        $data       = json_decode($data, true);
        if($data!='')
        {
            Log::debug($data);
            if($data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS'){
                try {
                        $arr_data = [
                                     'transaction_id'           => $data['transaction_id'],
                                     'uniq_id'                  => $data['attach'],
                                     'payment_status'           => 'paid',
                                    ];
                        
                        $res = $this->TransactionsModel->where('uniq_id',$data['attach'])->update($arr_data);
                        $this->wechatPaymentConfirmation($data['transaction_id']);

                    } catch (Exception $e) {
                        Log::debug($e);
                        throw $e;
                    }
            }
        }
        else
        {
            dd("No transaction is done");
        }
    }

    public function wechatPaymentConfirmation($transaction_id)
    {
        $arr_data = [];
        $arr_data = $this->TransactionsModel->where('transaction_id',$transaction_id)->where('payment_status','paid')->where('payment_via','wechat')->with('coupon_data')->first();
        
        if(isset($arr_data) && count($arr_data)>0)
        {
            $user_id = $arr_data['user_id'];
            if(isset($arr_data['coupon_data']) && $arr_data['coupon_data']!='')
            {
                $arr_coupen_data = [];

                $arr_coupen_data['coupon_code_owner_id'] =  isset($arr_data['coupon_data']['coupon_code_owner_id'])?$arr_data['coupon_data']['coupon_code_owner_id']:1;
                $arr_coupen_data['reward_amount']        =  isset($arr_data['coupon_data']['reward_amount'])?$arr_data['coupon_data']['reward_amount']:'';
                $arr_coupen_data['validity_extension']   =  isset($arr_data['coupon_data']['validity_extension'])?$arr_data['coupon_data']['validity_extension']:'';
                       
                $this->update_plan_details($arr_coupen_data);
            }

            $user_details_arr = [];
            $user_details_arr = getUserDetails($user_id);
            if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership']=='no')
            {
               $pin     = $this->generatePin($user_details_arr); 
               if(isset($pin) && $pin!=false)
               {
                    $arr_coupen_info    = [];
                    $arr_ref_code       = $this->ReferenceCodeModel
                                               ->where('coupen_type','=','PARENT')
                                               ->first();

                    $arr_coupen_info['start_date'] = isset($arr_ref_code->start_date)?$arr_ref_code->start_date:'';
                    $arr_coupen_info['end_date']   = isset($arr_ref_code->end_date)?$arr_ref_code->end_date:'';

                    //$this->EmailService->send_refer_email($user_details_arr,$pin,$arr_coupen_info);
               }
             
            }
            else
            {
                if(isset($user_details_arr['pin']) && $user_details_arr['pin']!="")
                {
                    $pin   = $user_details_arr['pin'];
                }
            }
        
            $invoice_name         = $this->generateInvoice($arr_data['id']);
            $obj_transaction_data = DB::table('transactions')->where('id',$arr_data['id'])->update(['invoice'=>$invoice_name]);
            $pan_details_arr      = getPlanDetails($arr_data['plan_id']);
            
            //sent email
            $first_name         = isset($user_details_arr['first_name'])?$user_details_arr['first_name']:'';
            $last_name          = isset($user_details_arr['last_name'])?$user_details_arr['last_name']:'';
            $transaction_amount = isset($arr_data['total_price_cny_amount'])?$arr_data['total_price_cny_amount']:'';
            $final_amount       = $transaction_amount.' CNY';
            
            $arr_built_content = [
                    'NAME'                  => $first_name.' '.$last_name,
                    'SUBJECT'               => 'Subscription Transaction Mail',
                    'PROJECT_NAME'          => config('app.project.name'),
                    'PLAN_NAME'             => isset($pan_details_arr['name'])?$pan_details_arr['name']:'',
                    'TRANSACTION_ID'        => $arr_data['transaction_id'],
                    'TRANSACTION_AMOUNT'    => $final_amount,
            ];

            $arr_mail_data                      = [];
            $arr_mail_data['email_template_id'] = '9';
            $attachment_path                    = base_path('uploads/invoice/'.$invoice_name);
            $arr_mail_data['arr_built_content'] = $arr_built_content;
            $arr_mail_data['user']              = [
                                                    'email'      => isset($user_details_arr['email'])?$user_details_arr['email']:'',
                                                    'first_name' => isset($user_details_arr['first_name'])?$user_details_arr['first_name']:'',
                                                    'attachment_path'=> $attachment_path
                                                  ];

            //$email_status  = $this->EmailService->send_mail($arr_mail_data);
            if(isset($user_details_arr['is_active_membership']) && $user_details_arr['is_active_membership'] == 'no')
            {
                     DB::table('users')->where('id',base64_decode($arr_data['userid']))
                                  ->update(['pin' => $pin]);
            }
            dd("mail sent successfully");
        }
    }

    public function WireTransferIndex(Request $request)
    {
        $arr_transaction = $arr_user = $arr_data = [];
        $res = '';
        if(Session::get('membership.plan_id')=="")
        {
            Session::flash('error',trnas('home.Error_occured_while_transaction_Please_Select_plan'));
            return redirect(url('/').'/pricing');
        }
        if(Session::get('membership')!='' && Session::get('membership')!=null)
        {            
            $insert_arr['user_id']        = base64_decode(Session::get('membership.userid'));
            $insert_arr['plan_id']        = Session::get('membership.plan_id');
            $insert_arr['requested_date'] = date('Y-m-d');
            $insert_arr['payment_status'] = 'unpaid';


            $is_plan_purchase = $this->WireTransfereedRequestModel->where('user_id',$insert_arr['user_id'])
                                                                  ->where('payment_status','unpaid')
                                                                  ->count();
            if($is_plan_purchase>0)
            {
                Session::flash('error',trans('teacher.sent_request_of_wire_transfer'));
                return redirect(url('/parent/dashboard'));
            }
            else
            {
                  $res = $this->WireTransfereedRequestModel->create($insert_arr);
            }

            $arr_data       = [
                                'transaction_id'           => generate_public_random_id(),
                                'uniq_id'                  => uniqid(),
                                'plan_id'                  => Session::get('membership.plan_id'),
                                'userid'                   => Session::get('membership.userid'),
                                'usertoken'                => Session::get('membership.usertoken'),
                                'social'                   => Session::get('membership.social'),
                                'converted_total_price'    => $request->input('converted_total_price',''),
                                'coupon_code'              => $request->input('coupon_code',''),
                                'per_unit_conversion_rate' => $request->input('per_unit_conversion_rate',''),
                                'coupon_code_owner_id'     => $request->input('coupon_code_owner_id',''),
                                'from_currency'            => $request->input('from_currency',''),
                                'to_currency'              => $request->input('to_currency',''),
                                'total_price_cny_amount'   => $request->input('total_price_cny_amount',''),
                                'payment_via'              => 'offline',
                                'payment_status'           => 'unpaid', 
                                'wire_transfer_id'         => isset($res->id)?$res->id:'',
                                'payment_note'             => trim($request->input('payment_note',''))
                            ];

            $user_id  = base64_decode(Session::get('membership.userid')); 
            $arr_user = getUserDetails($user_id);
            $res      = $this->create_transaction($arr_data);  
           
            //Store notification for admin
            $first_name = isset($arr_user['first_name'])?$arr_user['first_name']:'';
            $last_name  = isset($arr_user['last_name'])?$arr_user['last_name']:'';

            $arr_notify['message']      = $first_name.' '.$last_name.' has requested for wire transfer payment.';
            $arr_notify['from_user_id'] = $user_id;
            $arr_notify['to_user_id']   = 1;
            $arr_notify['url']          = '/admin/wire-transfer';
            $arr_noti['is_read']        = "0";
            $notification               = $this->NotificationService->send_notification($arr_notify);

            //send notification to user
            $arr_notification['message']      = trans('home.Your_wire_transfer_request_has_been_sent_successfully_msg');
            $arr_notification['from_user_id'] = 1;
            $arr_notification['to_user_id']   = $user_id;
            $arr_notification['url']          = '/pricing';
            $arr_notification['is_read']      = "0";
            $notification                     = $this->NotificationService->send_notification($arr_notification);
            
            if($res)
            {
                Session::flash('success',trans('parent.wire_transfer_request_sent'));
                $status = DB::table('users')->where('id',$user_id)->update(['is_active_membership'=>'yes']);
                if(Auth::check()!=false)
                {
                    return redirect(url('/parent/dashboard'));
                }
                else
                {
                    return redirect(url('/signin'));
                }
                
            }
            else
            {
                Session::flash('error',trans('home.Error_occure_while_transaction'));
                return redirect(url('/signin'));
            }
           
        }
        else
        {
            Session::flash('error',trans('teacher.select_membership_plan'));
            return redirect(url('/parent/dashboard'));
        }
    }

    public function WechatcheckTransaction(Request $request)
    {
        $redirect_url = '';
        if($request->input('uniq_id'));
        {
            $uniq_id = $request->input('uniq_id');
            $arr_transaction = 0;
            $arr_transaction = $this->TransactionsModel->where('uniq_id',$uniq_id)
                                                         ->where('payment_via','wechat')
                                                         ->where('payment_status','paid')
                                                         ->first();
            if(count($arr_transaction) > 0)
            {
                $arr_transaction = $arr_transaction->toArray();
                $user = $this->BaseModel->where('id', $arr_transaction['user_id'])->first();
                Session::flash('success',trans('home.Your_payment_has_been_done_successfully'));                  
                Auth::login($user);  
                if(isset($user->is_active_membership) && $user->is_active_membership=='no')
                {
                    DB::table('users')->where('id',$arr_transaction['user_id'])->update(['is_active_membership' => 'yes']);
                }
                $redirect_url = url('parent/dashboard');                
                $session = array(
                                    'plan_id'   => '',
                                    'userid'    => '',
                                    'usertoken' => '',
                                    'social'    => ''
                                );
                
                Session::put('membership',$session);
                
                return response()->json(['msg'=>'success','redirect_url'=>$redirect_url]);
            }
        }
        return response()->json(['msg'=>'fail','redirect_url'=>$redirect_url]);
    }

    public function DeductFromInsentiveAmount(Request $request)
    {
 
        $arr_coupen_data = [];
        if(Session::get('membership')!=null)
        { 
            $coupon_code_owner_id     = $request->input('coupon_code_owner_id');
            $coupon_code              = $request->input('coupon_code');
            $total_price_cny_amount   = $request->input('payable_cny_amount');
            $converted_total_price    = $request->input('converted_total_price');
            $per_unit_conversion_rate = $request->input('per_unit_conversion_rate');

            $plan_id            = Session::get('membership.plan_id');
            $user_id            = base64_decode(Session::get('membership.userid'));
            $pan_details_arr    = getPlanDetails($plan_id);
            $arr_global_setting = getGlobalSetting();                    
            $user_details_arr   = getUserDetails($user_id);

             $arr_data = [
                             'transaction_id'           => generate_public_random_id(),
                             'uniq_id'                  => uniqid(),
                             'plan_id'                  => $plan_id,
                             'userid'                   => base64_encode($user_id),
                             'usertoken'                => Session::get('membership.usertoken')!=null ? Session::get('membership.usertoken') : "",
                             'social'                   => Session::get('membership.social'),
                             'converted_total_price'    => $converted_total_price,
                             'coupon_code'              => $coupon_code,
                             'per_unit_conversion_rate' => $per_unit_conversion_rate,
                             'coupon_code_owner_id'     => $coupon_code_owner_id,
                             'from_currency'            => Session::get('membership.from_currency'),
                             'to_currency'              => Session::get('membership.to_currency'),
                             'total_price_cny_amount'   => $total_price_cny_amount,
                             'payment_via'              => 'From Received Insentive'
                         ];
            $res = $this->create_transaction($arr_data);   
            if($res)
            {         
                $payment_amount =  $user_details_arr['insentive_amount']-$total_price_cny_amount;
                DB::table('users')->where('id',$user_id)->update(['insentive_amount'=>$payment_amount]); 
                Session::flash('success', trans('home.Your_payment_has_been_done_successfully'));
                return redirect(url('/parent/dashboard'));
            }
            else
            {
                Session::flash('error', trans('home.Problem_Occured_While_Upgrading_Plan'));
                return redirect(url('/pricing'));
            }
  
        }
    }
    public function generatePin($arr_user)
    {
            $pin          = false;
            $user_type    =  $extension = '';
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
    public function is_membership_plan_purchased($user_id)
    {
          $plan_purchased_flag = false;
          $check_is_exist    = TransactionsModel::where('user_id','=',$user_id)
                                        ->where('status','=','active')
                                        ->orderBy('id','desc')
                                        ->count();
          if($check_is_exist>0)
          {
            $plan_purchased_flag = true;
          }
          return $plan_purchased_flag;
    }
   

}
