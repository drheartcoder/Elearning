<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FrontPagesModel;
use App\Models\GalleryModel;
use App\Models\SubscriptionPlanModel;
use App\Models\BankDetailsModel;
use App\Models\ReferenceCodeModel;
use App\Models\CouponsModel;
use App\Models\CurrencyRateModel;
use App\Models\UsersModel;
use App\Models\ClassroomsModel;
use App\Models\TransactionsModel;
use Session;
use App;
use Auth;
use View;
class HomeController extends Controller
{
    function __construct(FrontPagesModel $FrontPagesModel, GalleryModel $gallery_model,
                        TransactionsModel $transaction_model)
    {
        $this->arr_view_data         = [];
        $this->module_title          = "Home";
        $this->FrontPagesModel       = $FrontPagesModel;
        $this->GalleryModel          = $gallery_model;
        $this->SubscriptionPlanModel = new SubscriptionPlanModel();
        $this->BankDetailsModel      = new BankDetailsModel(); 
        $this->ReferenceCodeModel    = new ReferenceCodeModel();
        $this->CurrencyRateModel     = new CurrencyRateModel();
        $this->CouponsModel          = new CouponsModel(); 
        $this->UsersModel            = new UsersModel(); 
        $this->ClassroomsModel       = new ClassroomsModel(); 
        $this->TransactionsModel     = new TransactionsModel();

        $this->gallery_base_img_path   = base_path().config('app.project.img_path.gallery_image');
        $this->gallery_public_img_path = url('/').config('app.project.img_path.gallery_image');
    }
    /*
    | Function  : Get homepage data
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2018
    | Output    : Show homepage data
    */
    public function Index()
    {
        $content     = '';
        $obj_gallery = $get_student_count =  $arr_page = $arr_site_data = [];
        $session = array(
                            'plan_id'   => '',
                            'userid'    => '',
                            'usertoken' => '',
                            'social'    => ''
                        );
        Session::put('membership',$session);

        $obj_page    = $this->FrontPagesModel->where('page_slug','home')->first();

        $obj_gallery = $this->GalleryModel->orderByRaw("RAND()")->take(6)->get();
        if($obj_gallery)
        {
            $arr_gallery = $obj_gallery->toArray();
        }

        $get_student_count      =   $this->UsersModel->where('is_active','active')
                                              ->where('user_type','student')
                                              ->where('deleted_at',NULL)
                                              ->get();

        $get_teacher_count      =   $this->UsersModel->where('is_active','active')
                                              ->where('user_type','teacher')
                                               ->where('deleted_at',NULL)
                                              ->get();

        $get_parent_count       =   $this->UsersModel->where('is_active','active')
                                              ->where('user_type','parent')
                                              ->get();

        $get_classroom_count    =   $this->ClassroomsModel->where('status','1')->get();

        $classroom_count        = '56839';
        $student_count          = '102989';
        $teacher_count          = '29216';
        $parent_count           = '101968';



        if($obj_page != false)
        {
            $arr_page = $obj_page->toArray();
            $arr_site_data = get_site_data();

            if( count($arr_page) > 0 )
            {
                $content                  = $arr_page['description'];
                $content                  = str_replace("##TEACHER_COUNT##",$teacher_count,$content);
                $content                  = str_replace("##PARENT_COUNT##",$parent_count,$content);
                $content                  = str_replace("##CLASSROOM_COUNT##",$classroom_count,$content);
                $content                  = str_replace("##STUDENT_COUNT##",$student_count,$content);

                $apple_site_url       = isset($arr_site_data['apple_url'])?$arr_site_data['apple_url']:'javascript:void(0)';
                $google_play_site_url = isset($arr_site_data['google_play_url'])?$arr_site_data['google_play_url']:'javascript:void(0)';
                $acrobat_url_site_url = isset($arr_site_data['acrobat_url'])?$arr_site_data['acrobat_url']:'javascript:void(0)';
                $chrome_url_site_url = isset($arr_site_data['chrome_url'])?$arr_site_data['chrome_url']:'javascript:void(0)';

                $apple_url                = "<a href='".$apple_site_url."' target='_blank' class='play-btn blue-btn'><i class='fab fa-apple'></i><div class='apple-store'><span>".trans('home.Download_From')."</span>".trans('home.Apple_Store')."</div></a>";

               

                $android_url               = "<a href='".$google_play_site_url."' target='_blank' class='play-btn trans-btn'><i class='fab fa-google-play'></i><div class='apple-store'><span>".trans('home.Download_From')."</span>".trans('home.Google_Play')."</div></a>";

                $acrobat_url               = "<a href='".$acrobat_url_site_url."' target='_blank' class='trans-btn'>
                <img src='".url('/').'/images/acrobat.png'."' class='img-responsive' alt=''/><div class='apple-store'><span>".trans('home.Download_From')."</span>".trans('home.Acrobat')."</div></a>";

                $chrome_url                = "<a href='".$chrome_url_site_url."' target='_blank' class='play-btn trans-btn'><i class='fab fa-chrome'></i><div class='apple-store'><span>".trans('home.Download_From')."</span>".trans('home.Chrome')."</div></a>";

                $video_url                 = " <a class='play-btn-block' data-toggle='modal' href='#watch_video'><div class='video-play-btn'>&nbsp;</div></a>";

                $started_button           = "<a target='_blank' href='".url('/signup')."' class='get-start-btn sim-button'>".trans('home.Get_Started_Now')."</a>";

                $content                  = str_replace("##APPLE_URL##",$apple_url,$content);
                $content                  = str_replace("##GOOGLE_PLAY_URL##",$android_url,$content);
                $content                  = str_replace("##ACROBAT_URL##",$acrobat_url,$content);
                $content                  = str_replace("##CHROME_URL##",$chrome_url,$content);
                $content                  = str_replace("##PLAY_VIDEO##",$video_url,$content);
                $content                  = str_replace("##STARTED_BUTTON##",$started_button,$content);


                $data['pageTitle']       =  $arr_page['title'];
                $data['pageDescription'] =  $content;
                $data['meta_keyword']    =  $arr_page['meta_keyword'];
                $data['meta_desc']       =  $arr_page['meta_description'];
                $data['meta_title']      =  $arr_page['meta_title'];
            }
        }
        $data['arr_gallery']                =   $arr_gallery;
        $data['gallery_base_img_path']      =   $this->gallery_base_img_path;
        $data['gallery_public_img_path']    =   $this->gallery_public_img_path;
        $data['middleContent']              =   'index';


        return view('front.layout.master')->with($data);
    }
    public function Pricing(Request $request)
    {
        $active_plan_id = $from_currency_symbol = $to_currency_symbol = '';
        $pricing_arr = $arr_price_page = $arr_currency = $arr_subscription_plan = []; 
        $arr_from_currency = $arr_to_currency = [];

        $enc_id = $token = '';
        $enc_id = $request->input('enc_id');
        $token  = $request->input('token');

        $pricing_obj = $this->SubscriptionPlanModel->with(['subscription_plan_translation'=>function($q){
            $q->where('locale', App::getLocale());
        }])->get();

        if(isset($pricing_obj) && count($pricing_obj)>0)
        {
          $pricing_arr = $pricing_obj->toArray();
        }
        $obj_page    = $this->FrontPagesModel->where('page_slug','price-page')->first();
        if($obj_page)
        {
            $arr_price_page = $obj_page->toArray();
        }
        $locale = App::getLocale();
        //rate model
        $obj_currency     = $this->CurrencyRateModel->where('from_currency_code','=','CNY')
                                                    ->where('to_currency_code','=','USD')
                                                    ->first();

        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }
        $from_currency_id  = isset($arr_currency['from_currency_id'])?$arr_currency['from_currency_id']:'';
        $to_currency_id    = isset($arr_currency['to_currency_id'])?$arr_currency['to_currency_id']:'';

        $arr_from_currency = getCurrency($from_currency_id);
        $arr_to_currency   = getCurrency($to_currency_id);
        
        if(isset($arr_from_currency) && isset($arr_to_currency))
        {
            $from_currency_symbol  = html_entity_decode($arr_from_currency['html_code']);
            $to_currency_symbol    = html_entity_decode($arr_to_currency['html_code']);
        }
        $rate = isset($arr_currency['rate'])?$arr_currency['rate']:'';
        if(isset($pricing_arr) && sizeof($pricing_arr)>0)
        {
            foreach($pricing_arr as $key => $value)
            {
                $arr_subscription_plan[$key]   = $value;
                $plan_price_in_yuan            = isset($value['price'])?$value['price']:'';
                $cancel_price_in_yuan          = isset($value['scrash_price1'])?$value['scrash_price1']:'';
                $cancel_price_in_yuan_per_day  = isset($value['scrash_price2'])?$value['scrash_price2']:'';
                $plan_price_in_yuan_per_day    = isset($value['per_day_price'])?$value['per_day_price']:'';
               
               
               if($locale=='en')
               {
                    $plan_price                    = $rate*$plan_price_in_yuan;
                    $cancel_price_per_day          = $rate*$cancel_price_in_yuan_per_day;
                    $total_cancel_price            = $rate*$cancel_price_in_yuan;
                    $plan_price_per_day            = $rate*$plan_price_in_yuan_per_day;

                    $arr_subscription_plan[$key]['plan_price']           = number_format((float)$plan_price,2);
                    $arr_subscription_plan[$key]['plan_price_per_day']   = number_format((float)$plan_price_per_day,2);
                    $arr_subscription_plan[$key]['total_cancel_price']   = number_format((float)$total_cancel_price,2);
                    $arr_subscription_plan[$key]['cancel_price_per_day'] = number_format((float)$cancel_price_per_day,2);
               }
               else
               {
                    $arr_subscription_plan[$key]['plan_price']           = $plan_price_in_yuan;
                    $arr_subscription_plan[$key]['plan_price_per_day']   = $plan_price_in_yuan_per_day;
                    $arr_subscription_plan[$key]['total_cancel_price']   = $cancel_price_in_yuan;
                    $arr_subscription_plan[$key]['cancel_price_per_day'] = $cancel_price_in_yuan_per_day; 
               }
              
            }
        }

        //replace subscription plan on dynamic view
        $data['pricingData']             = $arr_subscription_plan;
        if($locale=='en')
        {
            $data['currency_symbol']     = $to_currency_symbol;
        }
        else
        {
            $data['currency_symbol']    = $from_currency_symbol;
        }
        
        $data['userid']             = $enc_id;
        $view                       = View::make('front.common.subscription_plan',$data);
        $contents                   = $view->render();
        $arr_price_page             = str_replace("##PLANLIST##",$contents,$arr_price_page);

        $data['arr_price_page']     = $arr_price_page;
        $data['active_plan_id']     = $active_plan_id;
        $data['pageTitle']          = trans('parent.Pricing');
        $data['middleContent']      = 'pricing';
        $data['user_id']            = $enc_id;
        $data['usertoken']          = $token;
        return view('front.layout.master')->with($data);
    }

    public function Checkout($enc_plan_id=false)
    {
         $pricing_arr = $transfer_bank_details = [];
         $enc_id      = $token  = '';  
         $user_insentive_amount_in_cny = 0; $converted_user_insentive_amount = 0;
         $arr_bank_details = [];
         $from_currency_code = 'CNY'; 
         $to_currency_code   = 'USD';

        if(isset($enc_plan_id) && $enc_plan_id!=false)
        {
            $plan_id = base64_decode($enc_plan_id);                
        }
        else
        {
            $plan_id = Session::get('membership.plan_id');                
        }
        $pricing_obj = $this->SubscriptionPlanModel->with(['subscription_plan_translation'=>function($q){
                                                            $q->where('locale', App::getLocale());
                                                          }])
                                                        ->where('id',$plan_id)
                                                        ->first();

        if(isset($pricing_obj) && count($pricing_obj)>0)
        {
            $pricing_arr             = $pricing_obj->toArray();
            $reference_settings_arr  = $this->ReferenceCodeModel->first(); 
                  
            $currency_conversion_arr = $this->CurrencyRateModel->where('from_currency_code',$from_currency_code)
                                            ->where('to_currency_code',$to_currency_code)->first();          

            $from_currency_arr = getCurrency($currency_conversion_arr['from_currency_id']);
            $to_currency_arr   = getCurrency($currency_conversion_arr['to_currency_id']);

            $from_currency_symbol                     = html_entity_decode($from_currency_arr['html_code']);
            $to_currency_symbol                       = html_entity_decode($to_currency_arr['html_code']);

            $data['per_currency_rate']                = $to_currency_symbol.' '.$currency_conversion_arr['rate'];
            $data['converted_total_price']            = ($currency_conversion_arr['rate']*$pricing_arr['price']);
            $data['total_price_cny_amount']           = isset($pricing_arr['price'])?$pricing_arr['price']:'';

            $data['to_currency_symbol']               = $to_currency_symbol;
            $data['without_symbol_per_currency_rate'] = $currency_conversion_arr['rate'];
            $data['to_currency']                      = $to_currency_arr['id'];
            $data['from_currency']                    = $from_currency_arr['id'];
        }            
        $locale = App::getLocale();                    
        $transfer_bank_details = $this->BankDetailsModel->with(['bank_translation'=>function($q1) use($locale){
                                                            $q1->where('locale','=',$locale);
                                                        }])->first();

        if($transfer_bank_details)
        {
            $arr_bank_details  = $transfer_bank_details->toArray();
        }
        if(Auth::check()!=false)
        {
            $user = Auth::user();
            if($user->user_type =='parent' && $user->insentive_amount!='0')
            {
                if(isset($pricing_arr['price']) && $pricing_arr['price']<=$user->insentive_amount)
                {
                    $user_insentive_amount_in_cny   = $user->insentive_amount-$pricing_arr['price'];         
                    $data['total_price_cny_amount'] = $pricing_arr['price'];
                }                
                if(isset($currency_conversion_arr['rate']) && $currency_conversion_arr['rate']!="")
                {
                  $converted_user_insentive_amount  =  $currency_conversion_arr['rate']*$user->insentive_amount;
                }
                $data['converted_total_insentive_price'] = $converted_user_insentive_amount;
            }
        }

        $data['user_insentive_amount_in_cny']    = $user_insentive_amount_in_cny;
        $data['converted_user_insentive_amount'] = $converted_user_insentive_amount;
        $data['arr_bank_details']                = $arr_bank_details;
        $data['pageTitle']                       = trans('parent.Payment_Checkout');
        $data['middleContent']                   = 'payment-checkout';
        $data['pricing_arr']                     = $pricing_arr;
        return view('front.layout.master')->with($data);   
    }


}
