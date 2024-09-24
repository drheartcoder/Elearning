<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/generateInvoice', function () { return view('welcome'); });

// Clear all cache
Route::get('cache_clear', function () {
	\Artisan::call('cache:clear');
	//  Clears route cache
	\Artisan::call('route:clear');
	\Cache::flush();
	\Artisan::call('optimize');
	exec('composer dump-autoload');

	dd("Cache cleared!");
});

Route::group(array('prefix' => 'common'), function ()
{
	$module_controller = "Common\CommonController@";
	Route::any('/check_email_duplicate',        ['as' => 'check_email_duplicate',       'uses' => $module_controller.'check_email_duplicate']);
	Route::any('/get_notifications',            ['as' => 'check_email_duplicate',       'uses' => $module_controller.'get_notifications']);
	
	Route::post('/getgrade',                    ['as' => 'getgrade',                    'uses' => $module_controller.'GetGrade']);
	Route::post('/getprogram',                  ['as' => 'getprogram',                  'uses' => $module_controller.'GetProgram']);
	Route::post('/getencgrade',                 ['as' => 'getencgrade',                 'uses' => $module_controller.'GetEncGrade']);
	Route::post('/getencprogram',               ['as' => 'getencprogram',               'uses' => $module_controller.'GetEncProgram']);
	Route::post('/getenclesson',                ['as' => 'getenclesson',                'uses' => $module_controller.'GetEncLesson']);
	Route::post('/getEncStundentLessonOptions', ['as' => 'getEncStundentLessonOptions', 'uses' => $module_controller.'getEncStundentLessonOptions']);
	Route::post('/getSubject',                  ['as' => 'getSubject',                  'uses' => $module_controller.'getSubject']);

	Route::post('/getenchomeworkgrade',         ['as' => 'getenchomeworkgrade',         'uses' => $module_controller.'GetEncHomeworkGrade']);
	Route::post('/getenchomeworkprogram',       ['as' => 'getenchomeworkprogram',       'uses' => $module_controller.'GetEncHomeworkProgram']);
	Route::post('/getenchomeworklesson',        ['as' => 'getenchomeworklesson',        'uses' => $module_controller.'GetEncHomeworkLesson']);

	Route::post('/email/duplicate',             ['as' => 'duplicate_email',             'uses' => $module_controller.'DuplicateEmail']);
	Route::post('/mobile/duplicate',            ['as' => 'duplicate_mobile',            'uses' => $module_controller.'DuplicateMobile']);
	Route::any('/read',     	 				['as' => 'read',         				'uses' => $module_controller.'read']);
	Route::any('/LogoutDaily',   				['uses' => $module_controller.'LogoutDaily']);
});

Route::get('/currency_rate', function () { $exitCode = Artisan::call('currency_rate:schedule');});
Route::get('/send_newsletter',function () { $exitCode = Artisan::call('send_newsletter:schedule');});


Route::any('/recording-demo',   ['uses' => 'Demo\DemoController@index']);
Route::any('/load_view/{type}', ['uses' => 'Demo\DemoController@load_template']);

Route::any('/wechat/callback',     		['uses' => 'Front\PaymentController@WechatCallback']);
Route::any('/wechat/checkTransaction',  ['uses' => 'Front\PaymentController@WechatcheckTransaction']);

Route::any('/SendPlanExpiredRemainder',   ['uses' => 'Front\CronController@SendPlanExpiredRemainder']);
Route::any('/UpdatePlanExpiryStatus',   ['uses' => 'Front\CronController@UpdatePlanExpiryStatus']);
Route::any('/unsubscribe_newsletter/{enc_id}',   ['uses' => 'Front\CronController@unsubscribe_newsletter']);

include_once(base_path().'/routes/admin.php');
include_once(base_path().'/routes/supervisor.php');
include_once(base_path().'/routes/creator.php');
//routes for templte preview

Route::post('/template_preview/{enc_id}',        ['as' => 'template_preview',  'uses' => 'template_preview\TemplatePreviewController@template_preview']);


Route::post('/edit_template_preview/{enc_id}',        ['as' => 'edit_template_preview',  'uses' => 'template_preview\TemplatePreviewController@edit_template_preview']);

// Front Pages
Route::group(['middleware' => 'front_general'], function ()
{
	// Homepage
	$module_controller = "Front\HomeController@";
	Route::get('/', 					 ['as' => 'home_page' , 'uses' => $module_controller.'Index']);
	Route::any('/pricing',               ['as' => 'Pricing',            'uses' => $module_controller.'Pricing']);
	Route::any('/payment/checkout/{enc_plan_id?}',      ['as' => 'Checkout',            'uses' => $module_controller.'Checkout']);

	$module_controller = "LangController@";
	Route::get('lang/{lang}', ['as' => 'lang' , 'uses' => $module_controller.'Index']);

	$module_controller = "Front\PaymentController@";
	Route::any('store_checkout_data',          ['uses' => $module_controller.'StoreCheckoutData']);
	Route::any('paypal/payment',               ['uses' => $module_controller.'PaypalIndex']);
	Route::any('doPayment',                    ['uses' => $module_controller.'DoPayment']);
	Route::any('doCancel',                     ['uses' => $module_controller.'DoCancel']);
	
	Route::any('alipay/payment',               ['uses' => $module_controller.'AlipayIndex']);
	Route::any('alipay/callback',              ['uses' => $module_controller.'AlipayCallback']);
	Route::any('alipay/notify',                ['uses' => $module_controller.'AlipayNotify']);

	Route::any('wechat/payment/{uniq_id}',     ['uses' => $module_controller.'WechatIndex']);
/*	Route::any('wechat/callback',              ['uses' => $module_controller.'WechatCallback']);*/

	Route::any('wire-transfer/payment',        ['uses' => $module_controller.'WireTransferIndex']);
	Route::any('deduct_from_insentive_amount', ['uses' => $module_controller.'DeductFromInsentiveAmount']);
	Route::any('generateInvoice',              ['uses' => $module_controller.'generateInvoice']);



	// User Auth
	$route_slug        = "user_";
	$module_controller = "Front\AuthController@";

	Route::get('/signin',          ['as' => $route_slug.'signin',         'uses' => $module_controller.'Signin','middleware'=>'route-check']);
	Route::post('/signin/process', ['as' => $route_slug.'process_signin', 'uses' => $module_controller.'ProcessSignin']);

	Route::get('/signup',              ['as' => $route_slug.'signup',             'uses' => $module_controller.'Signup','middleware'=>'route-check']);

	Route::post('/check_enrollment_code',['uses' => $module_controller.'CheckEnrollmentCode']);
	Route::post('/check_coupen_code',['uses' => $module_controller.'CheckCoupenCode']);
	

	Route::post('/email/duplicate',      ['as' => $route_slug.'duplicate_email',    'uses' => $module_controller.'DuplicateEmail']);
	Route::post('/mobile/duplicate',     ['as' => $route_slug.'duplicate_mobile',   'uses' => $module_controller.'DuplicateMobile']);
	
	Route::post('/signup/store',         ['as' => $route_slug.'signup_store',       'uses' => $module_controller.'SignupStore']);
	Route::any('/signup/otp/{enc_id}',   ['as' => $route_slug.'signup_otp',         'uses' => $module_controller.'SignupOTP','middleware'=>'route-check']);
	Route::post('/signup/otp-process',   ['as' => $route_slug.'signup_otp_process', 'uses' => $module_controller.'SignupOTPProcess']);	


	Route::any('ProcessShareClass/{class_id}/{user}/{email}', 		 ['as' => $route_slug.'share-class', 	  'uses' => 'Front\AuthController@ProcessShareClass']);	

	Route::get('/forget-password',              ['as' => $route_slug.'forget_password',             'uses' => $module_controller.'ForgetPassword','middleware'=>'route-check']);
	Route::post('/forget-password/process',     ['as' => $route_slug.'process_forget_password',     'uses' => $module_controller.'ProcessForgetPassword']);
	Route::get('/forget-password/otp',          ['as' => $route_slug.'forget_password_otp',         'uses' => $module_controller.'ForgetPasswordOTP','middleware'=>'route-check']);
	Route::post('/forget-password/otp/process', ['as' => $route_slug.'forget_password_otp_process', 'uses' => $module_controller.'ForgetPasswordOTPProcess']);
	
	Route::get('/resend-otp',          ['as' => $route_slug.'resend_otp',         'uses' => $module_controller.'ResendOTP','middleware'=>'route-check']);
	Route::post('/resend-otp/request', ['as' => $route_slug.'request_resend_otp', 'uses' => $module_controller.'RequestResendOTP']);
	Route::get('/resend-otp/process',  ['as' => $route_slug.'process_resend_otp', 'uses' => $module_controller.'ProcessResendOTP']);
	Route::post('/resend-otp/change',  ['as' => $route_slug.'change_resend_otp',  'uses' => $module_controller.'ChangeResendOTP']);

	Route::get('/forget-pin',              ['as' => $route_slug.'forget_pin',             'uses' => $module_controller.'ForgetPin','middleware'=>'route-check']);
	Route::post('/forget-pin/process',     ['as' => $route_slug.'forget_pin_process',     'uses' => $module_controller.'ForgetPinProcess']);
	Route::get('/forget-pin/otp/{enc_id}', ['as' => $route_slug.'forget_pin_otp',         'uses' => $module_controller.'ForgetPinOTP']);
	Route::post('/forget-pin/otp-process', ['as' => $route_slug.'forget_pin_otp_process', 'uses' => $module_controller.'ForgetPinOTPProcess']);

	Route::get('/reset-password/{enc_id}/{token}', ['as' => $route_slug.'reset_password', 'uses' => $module_controller.'ResetPassword']);
	Route::post('/reset-password/process',         ['as' => $route_slug.'reset_password', 'uses' => $module_controller.'ProcessResetPassword']);

	Route::get('user/verify_account/{enc_user_id}/{_token}/{plan_id?}', ['as' => $route_slug.'verify_account', 'uses' => $module_controller.'VerifyAccount']);

	Route::any('/signin/{social}/{type}',   ['as' => $route_slug.'socialLogin', 'uses' => $module_controller.'SocialLogin'])->where('social','twitter|facebook|linkedin|google')->where('type','parent|teacher|student');
	Route::get('/signin/{social}/callback', ['as' => $route_slug.'callback',    'uses' => $module_controller.'Callback'])->where('social','twitter|facebook|linkedin|google');

	Route::get('/signin/wechat/callback', ['as' => $route_slug.'callback', 'uses' => $module_controller.'WechatCallback']);

	// The middleware supports the specified configuration name: 'wechat.oauth:default', of course, you can also specify the current one in the middleware parameter scopes:
	// Route::group(['middleware' => ['wechat.oauth:snsapi_userinfo']], function () {

	// Or specify scopes while specifying the account: 
	// Route::group([ ' middleware '  => [ ' wechat.oauth:default,snsapi_userinfo ' ]], function () {


	/*Route::group([ ' middleware '  => ' wechat.oauth ' ], function ()  {
		Route::get( ' /signin/wechat/callback ' , function () { 
			$user = Session( ' wechat.oauth_user ' ); // Get authorized user profile
	        dd($user);
	    });
	});*/


	
	$route_slug        = "user_";
	$module_controller = "Front\AuthController@";
	Route::get('logout', ['as' => $route_slug.'logout','uses' => $module_controller.'Logout']);

	include_once(base_path().'/routes/teacher.php');
	include_once(base_path().'/routes/student.php');
	include_once(base_path().'/routes/parent.php');

	$module_controller = "Front\StaticPagesController@";
	Route::post('/contact-us/store', ['as' => 'contact_us_store' , 'uses' => $module_controller.'StoreContactUs']);
	Route::get('/{slug}',            ['as' => 'front-pages'      , 'uses' => $module_controller.'Index']);

});





