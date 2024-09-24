<?php

$web_admin_path = config('app.project.admin_panel_slug');
$module_permission = "module_permission:";

// ------------Before Login Routes----------------

Route::group(array('prefix' => $web_admin_path), function ()
{
	$route_slug        = 'admin_';
	$module_controller = "Admin\AuthController@";
	Route::get('/',               ['as' => $route_slug.'login',    'uses' => $module_controller.'login']);		
	Route::post('validate_login', ['as' => $route_slug.'validate', 'uses' => $module_controller.'validate_login']);

	$module_controller = "Admin\PasswordController@";
	Route::get('forgot_password',             ['as' => $route_slug.'forgot_password',            'uses' => $module_controller.'forgot_password']);
	Route::post('forgot_password/post_email', ['as' => $route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);
	Route::post('forgot_password/postReset',  ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);
	Route::get('/reset_password/{token?}',    ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'get_email'])->name('password.reset');
});

Route::group(array('prefix' => $web_admin_path), function ()
{
	$route_slug        = 'admin_';
	$module_controller = "Admin\AuthController@";
	Route::get('logout', ['as' => $route_slug.'logout', 'uses' => $module_controller.'logout']);
});



// ----------------------After login routes--------------------------

Route::group(array('prefix' => $web_admin_path,'middleware'=>'admin_auth_check'), function () use($web_admin_path,$module_permission)
{
	$route_slug        = 'admin_';
	$module_controller = "Admin\DashboardController@";
	Route::get('/dashboard/{enc_year?}', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);


	Route::group(array('prefix' => 'subject'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "admin_subject_";
		$module_controller = "Admin\SubjectController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'subject.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'subject.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'subject.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'subject.update']);
		Route::post('/update',             ['as' => $route_slug.'edit',         'uses' => $module_controller.'update', 'middleware' => $module_permission.'subject.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'subject.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'subject.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'subject.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'subject.update']);
		
	});


	Route::group(array('prefix' =>'account_setting'), function() use($module_permission)
	{
		$route_slug        = 'web_admin_account_setting_';
		$module_controller = "Admin\AccountSettingController@";
		Route::get('edit_profile',     ['as' => $route_slug.'edit_profile',    'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/edit_profile.list']);
		Route::post('profile_update',  ['as' => $route_slug.'profile_update',  'uses' => $module_controller.'update', 'middleware' => $module_permission.'account_setting/edit_profile.update']);
		Route::get('password/change',  ['as' => $route_slug.'change_password', 'uses' => $module_controller.'change_password', 'middleware' => $module_permission.'account_setting/password/change.list']);
		Route::post('password/update', ['as' => $route_slug.'update_password', 'uses' => $module_controller.'update_password', 'middleware' => $module_permission.'account_setting/password/change.update']);

		$module_controller = "Admin\SiteStatusController@";
		Route::get('site_status',         ['as' => $route_slug.'site_setting',    'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/site_status.list']);
		Route::post('site_status/update', ['as' => $route_slug.'update_password', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'account_setting/site_status.update']);

		$module_controller = "Admin\ContactDetailsController@";
		Route::any('contact_address_manage', 					 ['as' 	  => $route_slug.'index',		  'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/contact_address_manage.list']);		

		Route::any('contact_address_manage/create', 			 ['as'    => $route_slug.'add', 		  'uses' => $module_controller.'create', 'middleware' => $module_permission.'account_setting/contact_address_manage.create']);		

		Route::any('contact_address_manage/store', 			  	 ['as'    => $route_slug.'add', 		  'uses' => $module_controller.'store', 'middleware' => $module_permission.'account_setting/contact_address_manage.create']);		

		Route::any('contact_address_manage/edit/{enc_id}',       ['as'    => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'account_setting/contact_address_manage.edit']);

		Route::any('contact_address_manage/update', 			 ['as'    => $route_slug.'update',		  'uses' => $module_controller.'update', 'middleware' => $module_permission.'account_setting/contact_address_manage.edit']);		

		Route::get('contact_address_manage/activate/{enc_id}',   ['as'    => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'account_setting/contact_address_manage.update']);

		Route::get('contact_address_manage/deactivate/{enc_id}', ['as'    => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'account_setting/contact_address_manage.update']);

		Route::get('contact_address_manage/delete/{enc_id}',     ['as'    => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'account_setting/contact_address_manage.delete']);

		Route::post('contact_address_manage/multi_action',       ['as'    => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'account_setting/contact_address_manage.update']);
		
		$module_controller = "Admin\OTPController@";
		Route::get('/otp',           ['as' => $route_slug.'index',     'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/otp.list']);
		Route::get('/otp/load_data', ['as' => $route_slug.'load_data', 'uses' => $module_controller.'load_data']);
		Route::post('/otp/multi_action', ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
	});
	$module_controller = "Admin\ReferenceCodeController@";
		Route::get('reference_code',         ['as'  => $route_slug.'reference_code',        'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/reference_code.list']);
		Route::post('reference_code/update', ['as' => $route_slug.'update_reference_code', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'account_setting/reference_code.update']);
		
	Route::group(array('prefix' =>'admin_users'), function() use($module_permission)
	{

		$route_slug        = 'admin_users_';
		$module_controller = "Admin\AdminUsersController@";

		Route::get('/',                     ['as' => $route_slug.'index',          'uses' => $module_controller.'index', 'middleware' => $module_permission.'admin_users.list']);
		Route::get('/load_data',            ['as' => $route_slug.'load',           'uses' => $module_controller.'load_data']);
		Route::get('/create',               ['as' => $route_slug.'create',         'uses' => $module_controller.'create', 'middleware' => $module_permission.'admin_users.create']);
		Route::post('/store',               ['as' => $route_slug.'create',         'uses' => $module_controller.'store', 'middleware' => $module_permission.'admin_users.create']);
		Route::get('/edit/{id}',            ['as' => $route_slug.'profile_update', 'uses' => $module_controller.'edit', 'middleware' => $module_permission.'admin_users.update']);
		Route::post('/update/{id}',        	['as' => $route_slug.'profile_update', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'admin_users.update']);
		Route::get('/view/{id}',            ['as' => $route_slug.'profile_update', 'uses' => $module_controller.'view', 'middleware' => $module_permission.'admin_users.list']);
		Route::get('/deactivate/{enc_id}',  ['as' => $route_slug.'deactivate',     'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'admin_users.update']);
		Route::get('/activate/{enc_id}',    ['as' => $route_slug.'activate',       'uses' => $module_controller.'activate', 'middleware' => $module_permission.'admin_users.update']);
		Route::post('/multi_action',        ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'admin_users.update']);

		Route::get('/delete/{enc_id}',      ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete',       'middleware' => $module_permission.'users.delete']);
	});

	Route::group(array('prefix' =>'wire-transfer'), function() use($module_permission)
	{

		$route_slug        = 'admin_users_';
		$module_controller = "Admin\WireTransferRequestsController@";

		Route::get('/',                     ['as' => $route_slug.'index',          'uses' => $module_controller.'index', 'middleware' => $module_permission.'admin_users.list']);
		Route::get('/load_data',            ['as' => $route_slug.'load',           'uses' => $module_controller.'load_data']);/*
		Route::get('/create',               ['as' => $route_slug.'create',         'uses' => $module_controller.'create', 'middleware' => $module_permission.'admin_users.create']);
		Route::post('/store',               ['as' => $route_slug.'create',         'uses' => $module_controller.'store', 'middleware' => $module_permission.'admin_users.create']);*/
		Route::get('/edit/{id}',            ['as' => $route_slug.'profile_update', 'uses' => $module_controller.'edit', 'middleware' => $module_permission.'admin_users.update']);
		Route::post('/update/{id}',        	['as' => $route_slug.'profile_update', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'admin_users.update']);
		Route::get('/view/{id}',            ['as' => $route_slug.'profile_update', 'uses' => $module_controller.'view', 'middleware' => $module_permission.'admin_users.list']);
		Route::post('export-csv',    		['as' => $route_slug.'export-csv', 'uses' => $module_controller.'ExportCSV', 'middleware' => $module_permission.'transaction.list']);
		Route::post('/update_plan_type/{wire_transfer_id}',['as' => $route_slug.'update_plan_type','uses' => $module_controller.'update_plan_type']);
		Route::get('/change_payment_status/{id}',['as' => $route_slug.'change_payment_status','uses' => $module_controller.'change_payment_status']);

		/*
		Route::get('/deactivate/{enc_id}',  ['as' => $route_slug.'deactivate',     'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'admin_users.update']);
		Route::get('/activate/{enc_id}',    ['as' => $route_slug.'activate',       'uses' => $module_controller.'activate', 'middleware' => $module_permission.'admin_users.update']);
		Route::post('/multi_action',        ['as' => $route_slug.'multi_action',   'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'admin_users.update']);*/
	});


		
	/*------------------Subadmin -------------------*/
			
	/*Route::group(array('prefix' => '/subadmin'),function() 
	{
		$route_slug       = "subadmin";
		$module_slug       = "subadmin";
		$module_controller = "Admin\SubadminController@";
		Route::get('/',							[ 'as' => $route_slug.'index','uses'=> $module_controller.'index']);
		Route::get('/create',					[ 'as' => $route_slug.'create','uses'=> $module_controller.'create']);
		Route::post('/store',		   			[ 'as' => $route_slug.'store','uses'=> $module_controller.'store']);
		Route::get('/edit/{enc_id}',    		[ 'as' => $route_slug.'edit','uses'=> $module_controller.'edit']);
		Route::post('/update/{enc_id}',			[ 'as' => $route_slug.'update','uses'=> $module_controller.'update']);
		Route::get('/delete/{enc_id}', 			[ 'as' => $route_slug.'edit','uses'=> $module_controller.'delete']);
		Route::get('activate/{enc_id}', 		[ 'as' => $route_slug.'activate','uses'=> $module_controller.'activate']);	
		Route::get('deactivate/{enc_id}',		[ 'as' => $route_slug.'deactivate','uses'=> $module_controller.'deactivate']);	
		Route::post('multi_action',				[ 'as' => $route_slug.'multi_action','uses'=> $module_controller.'multi_action']);	
	});*/

	Route::group(array('prefix' => 'front_pages'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "front_pages_";
		$module_controller = "Admin\FrontPagesController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'front_pages.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'front_pages.create']);
		Route::post('/store',              ['as' => $route_slug.'create',       'uses' => $module_controller.'store', 'middleware' => $module_permission.'front_pages.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'front_pages.update']);
		Route::post('/update/{id?}',       ['as' => $route_slug.'update',       'uses' => $module_controller.'update', 'middleware' => $module_permission.'front_pages.update']);
		Route::post('/update_contact_us',  ['as' => $route_slug.'update',       'uses' => $module_controller.'update_contact_us', 'middleware' => $module_permission.'front_pages.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'front_pages.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'front_pages.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'front_pages.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'front_pages.update']);

	});

	Route::group(array('prefix' => 'email_template'), function () use($route_slug,$module_permission)
	{
		$route_slug        = "email_template_";
		$module_controller = "Admin\EmailTemplateController@";		
		Route::get('/',             ['as' => $route_slug.'index',   'uses' => $module_controller.'index', 'middleware' => $module_permission.'email_template.list']);
		Route::get('/load_data',    ['as' => $route_slug.'load',    'uses' => $module_controller.'load_data']);
		Route::post('/store',       ['as' => $route_slug.'store',   'uses' => $module_controller.'store', 'middleware' => $module_permission.'email_template.create']);
		Route::get('/edit/{id}',    ['as' => $route_slug.'edit',    'uses' => $module_controller.'edit', 'middleware' => $module_permission.'email_template.update']);
		Route::post('/update/{id}', ['as' => $route_slug.'update',  'uses' => $module_controller.'update', 'middleware' => $module_permission.'email_template.update']);
		Route::post('/preview',     ['as' => $route_slug.'preview', 'uses' => $module_controller.'preview', 'middleware' => $module_permission.'email_template.list']);		

	});

	/*Route::group(array('prefix' => 'notification_template'), function () use($route_slug)
	{
		$route_slug        = "notification_template_";
		$module_controller = "Admin\NotificationTemplateController@";		
		Route::get('/',             ['as' => $route_slug.'index',   'uses' => $module_controller.'index']);
		Route::get('/load_data',    ['as' => $route_slug.'load',    'uses' => $module_controller.'load_data']);
		Route::post('/store',       ['as' => $route_slug.'store',   'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',    ['as' => $route_slug.'edit',    'uses' => $module_controller.'edit']);
		Route::post('/update/{id}', ['as' => $route_slug.'update',  'uses' => $module_controller.'update']);
		Route::post('/preview',     ['as' => $route_slug.'preview', 'uses' => $module_controller.'preview']);		

	});*/

	Route::group(array('prefix' => 'grade'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "admin_grade_";
		$module_controller = "Admin\GradeController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'grade.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'grade.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'grade.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'grade.update']);
		Route::post('/update',             ['as' => $route_slug.'edit',         'uses' => $module_controller.'update', 'middleware' => $module_permission.'grade.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'grade.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'grade.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'grade.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'grade.update']);
		
	});

	Route::group(array('prefix' => 'contact_enquiry'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "admin_contact_enquiry_";
		$module_controller = "Admin\ContactEnquiryController@";
		Route::get('/',                ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'contact_enquiry.list']);
		Route::get('/load_data',       ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/view/{enc_id}',   ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'contact_enquiry.list']);
		Route::any('/reply/{enc_id}',  ['as' => $route_slug.'reply',        'uses' => $module_controller.'reply', 'middleware' => $module_permission.'contact_enquiry.list']);
		Route::post('/send_reply',     ['as' => $route_slug.'send_reply',   'uses' => $module_controller.'send_reply', 'middleware' => $module_permission.'contact_enquiry.list']);
		Route::get('/delete/{enc_id}', ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'contact_enquiry.delete']);
		Route::post('/multi_action',   ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'contact_enquiry.delete']);
		
	});


	Route::group(array('prefix' => 'subscription_plan'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "subscription_plan_";
		$module_controller = "Admin\SubscriptionPlanController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'subscription_plan.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'subscription_plan.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'subscription_plan.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'subscription_plan.list']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'subscription_plan.update']);
		Route::post('/update',             ['as' => $route_slug.'update',       'uses' => $module_controller.'update', 'middleware' => $module_permission.'subscription_plan.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'subscription_plan.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'subscription_plan.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'subscription_plan.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'subscription_plan.update']);
	});

	Route::group(array('prefix' => 'testimonials'), function () use($web_admin_path,$module_permission)
	{
		$route_slug            = "admin_testimonials_";
		$module_controller     = "Admin\TestimonialsController@";
		
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'testimonials.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'testimonials.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'testimonials.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'testimonials.update']);
		Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'testimonials.list']);
		Route::post('/update/{id}',        ['as' => $route_slug.'edit',         'uses' => $module_controller.'update', 'middleware' => $module_permission.'testimonials.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'testimonials.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'testimonials.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'testimonials.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'testimonials.update']);
		
	});


	Route::group(array('prefix' => 'account_setting/currency'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "currency_";
		$module_controller = "Admin\CurrencyController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'account_setting/currency.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'account_setting/currency.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'account_setting/currency.create']);
		Route::any('/rate-manage',   	['as' => $route_slug.'rate-manage',  'uses' => $module_controller.'rate_manage', 'middleware' => $module_permission.'account_setting/currency.create']);
		Route::get('/rate-manage/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'rate_manage_load_data']);	
		

		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		/*Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view']         );*/
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'account_setting/currency.update']);
		Route::post('/update',             ['as' => $route_slug.'edit',         'uses' => $module_controller.'update', 'middleware' => $module_permission.'account_setting/currency.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'account_setting/currency.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'account_setting/currency.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'account_setting/currency.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'account_setting/currency.update']);
	});

	/*Change by kavita*/
	Route::group(array('prefix' => '/newsletter'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "newsletter_";
		$module_controller = "Admin\NewsLetterController@";

		Route::get('/',            [
										'as'         => $route_slug.'newsletter_list',
										'uses'       => $module_controller.'index',
										'middleware' => $module_permission.'newsletter.list'
									]);

		Route::get('/load_data', [
									'as'   => $route_slug.'load_data',
									'uses' => $module_controller.'load_data',
									'middleware' => $module_permission.'newsletter.list'
								]);		

		Route::get('/create',      [
										'as'         => $route_slug.'newsletter_list',
										'uses'       => $module_controller.'create',
										'middleware' => $module_permission.'newsletter.create'
									]);

		Route::post('/store',     [
										'as'         => $route_slug.'store',
										'uses'       => $module_controller.'store',
										'middleware' => $module_permission.'newsletter.create'
									]);

		Route::get('/edit/{enc_id}',      [
										'as'         => $route_slug.'newsletter_edit',
										'uses'       => $module_controller.'edit',
										'middleware' => $module_permission.'newsletter.update'
										]);

		Route::post('/update/{enc_id}',     	[
													'as'         => $route_slug.'update',
													'uses'       => $module_controller.'update',
													'middleware' => $module_permission.'newsletter.update'
												]);		

		Route::get('/activate/{enc_id}', [
														'as' => $route_slug.'activate',
														'uses' => $module_controller.'activate',
														'middleware' => $module_permission.'newsletter.update'
													]);
		Route::get('/deactivate/{enc_id}', [
														'as'         => $route_slug.'deactivate',
														'uses'       => $module_controller.'deactivate',
														'middleware' => $module_permission.'newsletter.update'
														]);

		Route::post('/multi_action', [
										'as'         => $route_slug.'multi_action',
										'uses'       => $module_controller.'multi_action',
										'middleware' => $module_permission.'newsletter.update'
									]);

		Route::get('/delete/{id}', [
										'as'         => $route_slug.'newsletter_subscriber_unsubscrib',
										'uses'       => $module_controller.'delete',
										'middleware' => $module_permission.'newsletter.delete'
									]);
		
	});

	Route::group(array('prefix' => 'coupons'), function () use($web_admin_path,$module_permission)
	{
		$route_slug            = "admin_testimonials_";
		$module_controller     = "Admin\CouponsController@";
		
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'coupons.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'coupons.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'coupons.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'coupons.update']);
		Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'coupons.update']);
		Route::post('/update/{id}',        ['as' => $route_slug.'edit',         'uses' => $module_controller.'update', 'middleware' => $module_permission.'coupons.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'coupons.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'coupons.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'coupons.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'coupons.update']);

		Route::post('redeem_amount',       ['as' => $route_slug.'redeem_amount', 'uses' => $module_controller.'redeem_amount']);
		
	});



	Route::group(array('prefix' => 'textbook'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "textbook_";
		$module_controller = "Admin\TextbookController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'textbook.list']);
		Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create', 'middleware' => $module_permission.'textbook.create']);
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store', 'middleware' => $module_permission.'textbook.create']);
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'textbook.list']);
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit', 'middleware' => $module_permission.'textbook.update']);
		Route::post('/update',             ['as' => $route_slug.'update',       'uses' => $module_controller.'update', 'middleware' => $module_permission.'textbook.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'textbook.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'textbook.update']);
		Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'textbook.delete']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'textbook.update']);
	});

	Route::group(array('prefix' => 'notifications'), function () use($route_slug,$module_permission)
	{
		$route_slug        = "notifications_";
		$module_controller = "Admin\NotificationsController@";
		Route::get('/',              ['as' => $route_slug.'index',        'uses' => $module_controller.'index', 'middleware' => $module_permission.'notifications.list']);
		Route::get('/load_data',     ['as' => $route_slug.'load',         'uses' => $module_controller.'load_data']);				
		Route::get('/delete/{id}',   ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete', 'middleware' => $module_permission.'notifications.delete']);
		Route::post('/multi_action', ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'notifications.delete']);
	});

	Route::group(array('prefix' => 'users'), function () use($route_slug,$module_permission)
	{
		Route::group(array('prefix' => 'teacher'), function () use($route_slug,$module_permission)
		{
			$route_slug        = "teacher_";
			$module_controller = "Admin\TeacherController@";
			Route::get('/',                     ['as' => $route_slug.'index',        'uses' => $module_controller.'index',        'middleware' => $module_permission.'users.list']);
			Route::get('/load_data',            ['as' => $route_slug.'load',         'uses' => $module_controller.'load_data']);
			Route::get('/view/{enc_id}',        ['as' => $route_slug.'view',         'uses' => $module_controller.'view',         'middleware' => $module_permission.'users.list']);
			Route::get('/edit/{enc_id}',        ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit',         'middleware' => $module_permission.'users.update']);
			Route::post('/update',              ['as' => $route_slug.'update',       'uses' => $module_controller.'update',       'middleware' => $module_permission.'users.update']);
			Route::get('/activate/{enc_id}',    ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'middleware' => $module_permission.'users.update']);
			Route::get('/deactivate/{enc_id}',  ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'middleware' => $module_permission.'users.update']);
			Route::get('/verify/{enc_id}',     	['as' => $route_slug.'verify',       'uses' => $module_controller.'verify',       'middleware' => $module_permission.'users.update']);
			Route::get('/delete/{enc_id}',      ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete',       'middleware' => $module_permission.'users.delete']);
			Route::post('/multi_action',        ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'users.update']);
			Route::post('export-csv',           ['as' => $route_slug.'export-csv',   'uses' => $module_controller.'ExportCSV',    'middleware' => $module_permission.'users.list']);

			Route::get('/load-classes',         ['as' => $route_slug.'load-classes', 'uses' => $module_controller.'LoadClasses',  'middleware' => $module_permission.'users.list']);

			Route::get('/{enc_id}/transfer_classes',           ['as' => $route_slug.'transfer-classes',      'uses' => $module_controller.'TransferClasses',     'middleware' => $module_permission.'users.list']);
			Route::get('/{enc_id}/transfer_classes/load_data', ['as' => $route_slug.'load-transfer-classes', 'uses' => $module_controller.'LoadTransferClasses', 'middleware' => $module_permission.'users.list']);
			

			Route::get('/{enc_id}/share_classes',           ['as' => $route_slug.'share-classes',      'uses' => $module_controller.'ShareClasses',     'middleware' => $module_permission.'users.list']);
			Route::get('/{enc_id}/share_classes/load_data', ['as' => $route_slug.'load-share-classes', 'uses' => $module_controller.'LoadShareClasses', 'middleware' => $module_permission.'users.list']);
		});

		Route::group(array('prefix' => 'student'), function () use($route_slug,$module_permission)
		{
			$route_slug        = "student_";
			$module_controller = "Admin\StudentController@";
			Route::get('/',                    ['as' => $route_slug.'index',         'uses' => $module_controller.'index',        'middleware' => $module_permission.'users.list']);
			Route::get('/load_data',           ['as' => $route_slug.'load',          'uses' => $module_controller.'load_data']);
			Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',          'uses' => $module_controller.'view',         'middleware' => $module_permission.'users.list']);
			Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',          'uses' => $module_controller.'edit',         'middleware' => $module_permission.'users.update']);
			Route::post('/update',             ['as' => $route_slug.'update',        'uses' => $module_controller.'update',       'middleware' => $module_permission.'users.update']);
			Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',      'uses' => $module_controller.'activate',     'middleware' => $module_permission.'users.update']);
			Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',    'uses' => $module_controller.'deactivate',   'middleware' => $module_permission.'users.update']);
			Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',        'uses' => $module_controller.'delete',       'middleware' => $module_permission.'users.delete']);
			Route::post('/multi_action',       ['as' => $route_slug.'multi_action',  'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'users.update']);
			Route::post('export-csv',           ['as' => $route_slug.'export-csv',   'uses' => $module_controller.'ExportCSV',    'middleware' => $module_permission.'users.list']);

			Route::get('/load-programs',       ['as' => $route_slug.'load-programs', 'uses' => $module_controller.'LoadPrograms', 'middleware' => $module_permission.'users.list']);
		});

		Route::group(array('prefix' => 'parent'), function () use($route_slug,$module_permission)
		{
			$route_slug        = "parent_";
			$module_controller = "Admin\ParentController@";
			Route::get('/',                    ['as' => $route_slug.'index',         'uses' => $module_controller.'index',        'middleware' => $module_permission.'users.list']);
			Route::get('/load_data',           ['as' => $route_slug.'load',          'uses' => $module_controller.'load_data']);
			Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',          'uses' => $module_controller.'view',         'middleware' => $module_permission.'users.list']);
			Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',          'uses' => $module_controller.'edit',         'middleware' => $module_permission.'users.update']);
			Route::post('/update',             ['as' => $route_slug.'update',        'uses' => $module_controller.'update',       'middleware' => $module_permission.'users.update']);
			Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',      'uses' => $module_controller.'activate',     'middleware' => $module_permission.'users.update']);
			Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',    'uses' => $module_controller.'deactivate',   'middleware' => $module_permission.'users.update']);
			Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',        'uses' => $module_controller.'delete',       'middleware' => $module_permission.'users.delete']);
			Route::post('/multi_action',       ['as' => $route_slug.'multi_action',  'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'users.update']);
			Route::post('export-csv',           ['as' => $route_slug.'export-csv',   'uses' => $module_controller.'ExportCSV',    'middleware' => $module_permission.'users.list']);

			Route::any('/upgrade_plan/{enc_id}',   ['as' => $route_slug.'activate',   'uses' => $module_controller.'upgrade_plan',  'middleware' => $module_permission.'users.update']);

			Route::get('/verify/{enc_id}',     ['as' => $route_slug.'verify',   	   'uses' => $module_controller.'verify',  'middleware' => $module_permission.'users.update']);

			Route::get('/load-children',       ['as' => $route_slug.'load-children', 'uses' => $module_controller.'LoadChildren', 'middleware' => $module_permission.'users.list']);
		});
	});


	Route::group(array('prefix' => 'classrooms'), function () use($web_admin_path,$module_permission)
	{
		$route_slug        = "classrooms_";
		$module_controller = "Admin\ClassroomsController@";
		Route::get('/',                    ['as' => $route_slug.'manage',       'uses' => $module_controller.'index', 'middleware' => $module_permission.'classrooms.list']);
		/*Route::get('/create',              ['as' => $route_slug.'create',       'uses' => $module_controller.'create']       );
		Route::post('/store',              ['as' => $route_slug.'store',        'uses' => $module_controller.'store']        );*/
		Route::get('/load_data',           ['as' => $route_slug.'load_data',    'uses' => $module_controller.'load_data']);
		Route::get('/view/{enc_id}',       ['as' => $route_slug.'view',         'uses' => $module_controller.'view', 'middleware' => $module_permission.'classrooms.list']);
		
		Route::get('/edit/{enc_id}',       ['as' => $route_slug.'edit',         'uses' => $module_controller.'edit']         );		
		Route::post('/update',             ['as' => $route_slug.'update',       'uses' => $module_controller.'update']       );
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate', 'middleware' => $module_permission.'classrooms.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate', 'middleware' => $module_permission.'classrooms.update']);
		/*Route::get('/delete/{enc_id}',     ['as' => $route_slug.'delete',       'uses' => $module_controller.'delete']       );*/
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'classrooms.update']);
		Route::post('export-csv',          ['as' => $route_slug.'export-csv',   'uses' => $module_controller.'ExportCSV',    'middleware' => $module_permission.'classrooms.list']);

		Route::post('/transfer', ['as' => $route_slug.'transfer-class', 'uses' => $module_controller.'TransferClass', 'middleware' => $module_permission.'classrooms.update']);
		Route::post('/share',    ['as' => $route_slug.'share-class',    'uses' => $module_controller.'ShareClass',    'middleware' => $module_permission.'classrooms.update']);

		Route::get('/load-students',                               ['as' => $route_slug.'load-students',         'uses' => $module_controller.'LoadStudents',        'middleware' => $module_permission.'classrooms.view']);
		Route::get('/students/activate/{enc_class_id}/{enc_id}',   ['as' => $route_slug.'students-activate',     'uses' => $module_controller.'StudentActivate',     'middleware' => $module_permission.'classrooms.update']);
		Route::get('/students/deactivate/{enc_class_id}/{enc_id}', ['as' => $route_slug.'students-deactivate',   'uses' => $module_controller.'StudentDeactivate',   'middleware' => $module_permission.'classrooms.update']);
		Route::post('/students/multi_action',                      ['as' => $route_slug.'students-multi-action', 'uses' => $module_controller.'StudentsMultiAction', 'middleware' => $module_permission.'classrooms.update']);

		Route::get('/transfer/{enc_class_id}/{enc_student_id}', ['as' => $route_slug.'transfer-students', 'uses' => $module_controller.'TransferStudents', 'middleware' => $module_permission.'classrooms.update']);
		Route::get('/share/{enc_class_id}/{enc_student_id}',    ['as' => $route_slug.'share-students',    'uses' => $module_controller.'ShareStudents',    'middleware' => $module_permission.'classrooms.update']);
		Route::post('getGrade/',                      			['as' => $route_slug.'getGrade',          'uses' => $module_controller.'getGrade']);
		Route::post('getProgram/',['as' => $route_slug.'getProgram',          'uses' => $module_controller.'getProgram']);

		Route::get('/delete/{enc_id}', ['as' => $route_slug.'edit','uses' => $module_controller.'delete_classroom']);		
	});

	Route::group(array('prefix' => 'flyer'), function () use($route_slug,$module_permission)
	{
		$route_slug        = "flyer_";
		$module_controller = "Admin\FlyerController@";
		Route::get('/',             ['as' => $route_slug.'index',   'uses' => $module_controller.'index',       'middleware' => $module_permission.'flyer.list']);
		Route::get('/load_data',    ['as' => $route_slug.'load',    'uses' => $module_controller.'load_data']);
		Route::post('/store',       ['as' => $route_slug.'store',   'uses' => $module_controller.'store',       'middleware' => $module_permission.'flyer.create']);
		Route::get('/edit/{id}',    ['as' => $route_slug.'edit',    'uses' => $module_controller.'edit',        'middleware' => $module_permission.'flyer.update']);
		Route::post('/update/{id}', ['as' => $route_slug.'update',  'uses' => $module_controller.'update',      'middleware' => $module_permission.'flyer.update']);
		Route::post('/preview',     ['as' => $route_slug.'preview', 'uses' => $module_controller.'preview',     'middleware' => $module_permission.'flyer.list']);
	});


	Route::group(array('prefix' => 'certificate'), function () use($route_slug,$module_permission)
	{
		$route_slug        = "certificate_";
		$module_controller = "Admin\CertificateController@";
		Route::get('/',             ['as' => $route_slug.'index',   'uses' => $module_controller.'index',       'middleware' => $module_permission.'certificate.list']);
		Route::get('/load_data',    ['as' => $route_slug.'load',    'uses' => $module_controller.'load_data']);
		Route::post('/store',       ['as' => $route_slug.'store',   'uses' => $module_controller.'store',       'middleware' => $module_permission.'certificate.create']);
		Route::get('/edit/{id}',    ['as' => $route_slug.'edit',    'uses' => $module_controller.'edit',        'middleware' => $module_permission.'certificate.update']);
		Route::post('/update/{id}', ['as' => $route_slug.'update',  'uses' => $module_controller.'update',      'middleware' => $module_permission.'certificate.update']);
		Route::post('/preview',     ['as' => $route_slug.'preview', 'uses' => $module_controller.'preview',     'middleware' => $module_permission.'certificate.list']);
	});

	Route::group(array('prefix' => 'gallery'), function () use ($route_slug,$module_permission)
	{
		$route_slug        = "gallery_";
		$module_controller = "Admin\GalleryController@";
		Route::get('/',        ['as' => $route_slug.'index',  'uses' => $module_controller.'Index',  'middleware' => $module_permission.'gallery.list']);
		Route::post('/store',  ['as' => $route_slug.'store',  'uses' => $module_controller.'Store',  'middleware' => $module_permission.'gallery.create']);
		Route::post('/delete', ['as' => $route_slug.'delete', 'uses' => $module_controller.'Delete', 'middleware' => $module_permission.'gallery.delete']);
	});

	Route::group(array('prefix' =>'global_setting'), function() use ($module_permission)
	{
		$route_slug        = 'web_admin_global_setting_';
		$module_controller = "Admin\GlobalSettingController@";
		Route::get('/', ['as' => $route_slug.'global_setting', 'uses' => $module_controller.'index', 'middleware' => $module_permission.'global_setting.list']);
		Route::post('update', ['as' => $route_slug.'update', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'global_setting.update']);
	});

	Route::group(array('prefix' =>'bank_details'), function() use ($module_permission)
	{
		$route_slug        = 'web_admin_bank_details_';
		$module_controller = "Admin\BankDetailsController@";
		
		Route::get('/',       ['as' => $route_slug.'bank_details', 'uses' => $module_controller.'Index',  'middleware' => $module_permission.'bank_details.list']);
		Route::post('update', ['as' => $route_slug.'update',       'uses' => $module_controller.'Update', 'middleware' => $module_permission.'bank_details.update']);
	});


	/*Route::group(array('prefix' =>'program'), function() use ($module_permission)
	{
		$route_slug        = 'web_admin_program_';
		$module_controller = "Admin\ProgramController@";
		
		Route::get('/new',               ['as' => $route_slug.'new_program',   'uses' => $module_controller.'NewProgram',    'middleware' => $module_permission.'new_program.list']);
		Route::get('/new/load-data',     ['as' => $route_slug.'new_load_data', 'uses' => $module_controller.'NewLoadData']);
		Route::get('/new/view/{enc_id}', ['as' => $route_slug.'new_view',      'uses' => $module_controller.'NewView',       'middleware' => $module_permission.'program.list']);

		Route::get('/new/lesson/view/{program_id}/{lesson_id}', ['as' => $route_slug.'new_lesson_view', 'uses' => $module_controller.'ViewNewLesson', 'middleware' => $module_permission.'program.list']);


		Route::get('/approved',               ['as' => $route_slug.'approved_program',   'uses' => $module_controller.'ApprovedProgram',    'middleware' => $module_permission.'approved_program.list']);
		Route::get('/approved/load-data',     ['as' => $route_slug.'approved_load_data', 'uses' => $module_controller.'ApprovedLoadData']);
		Route::get('/approved/view/{enc_id}', ['as' => $route_slug.'approved_view',      'uses' => $module_controller.'ApprovedView',       'middleware' => $module_permission.'program.list']);

		Route::get('/approved/lesson/view/{program_id}/{lesson_id}', ['as' => $route_slug.'approved_lesson_view', 'uses' => $module_controller.'ViewApprovedLesson', 'middleware' => $module_permission.'program.list']);


		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'MultiAction', 'middleware' => $module_permission.'program.update']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'Activate',    'middleware' => $module_permission.'program.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'Deactivate',  'middleware' => $module_permission.'program.update']);
		Route::get('/approve/{enc_id}',    ['as' => $route_slug.'approve',      'uses' => $module_controller.'Approve',     'middleware' => $module_permission.'program.update']);
		Route::get('/pending/{enc_id}',    ['as' => $route_slug.'pending',      'uses' => $module_controller.'Pending',     'middleware' => $module_permission.'program.update']);

		Route::get('/activate/{template_id}/{id}',   ['as' => $route_slug.'question_activate',   'uses' => $module_controller.'QuestionActivate']);
		Route::get('/deactivate/{template_id}/{id}', ['as' => $route_slug.'question_deactivate', 'uses' => $module_controller.'QuestionDeactivate']);
		
	});*/

	Route::group(array('prefix' => 'program'), function () use($module_permission)
	{
		$route_slug        = "program_";
		$module_controller = "Admin\ProgramController@";




		Route::get('/',                              ['as' 		  	=> $route_slug.'manage',          
													 'uses' 	  	=> $module_controller.'index', 
													 'middleware' 	=> $module_permission.'program.list']);

		Route::get('/export/{enc_program_id}',       ['as' 		  	=> $route_slug.'manage',          
													 'uses' 	  	=> $module_controller.'export', 
													 'middleware' 	=> $module_permission.'program.list']);
		
		Route::post('getGrade/',                      ['as' 	    => $route_slug.'getGrade',          
													   'uses' 	    => $module_controller.'getGrade', 
													   'middleware' => $module_permission.'program.create']);

		Route::get('/load_data',                     ['as' 			=>  $route_slug.'load_data',       
													  'uses' 		=>  $module_controller.'load_data', 
													  'middleware'  =>  $module_permission.'program.list']);

		Route::get('/activate/{enc_id}',             ['as' 			=>  $route_slug.'activate',        
													  'uses' 		=>  $module_controller.'activate', 
													  'middleware'  =>  $module_permission.'program.update']);

		Route::get('/deactivate/{enc_id}',           ['as' 			=>  $route_slug.'deactivate',      
													  'uses' 		=>  $module_controller.'deactivate', 
													  'middleware'  =>  $module_permission.'program.update']);

		Route::get('/approveProgramStatus/{enc_id}', ['as' 		=>  $route_slug.'approveProgramStatus',
													  'uses' 	=>	$module_controller.'approveProgramStatus', 
												  'middleware'  =>  $module_permission.'program.update']);

		Route::post('/rejectProgramStatus/{enc_id}', ['as' 		=>  $route_slug.'rejectProgramStatus',
													 'uses' 	=>  $module_controller.'rejectProgramStatus', 
												  	 'middleware'  =>  $module_permission.'program.update']);

		Route::get('/AddHolidayProgram/{enc_id}',    ['as' 			=>  $route_slug.'AddHolidayProgram',
												      'uses' 		=>	$module_controller.'AddHolidayProgram', 
												      'middleware'  =>  $module_permission.'program.update']);

		Route::get('/RemoveHolidayProgram/{enc_id}', ['as' 		  =>  $route_slug.'RemoveHolidayProgram',
													  'uses' 	 =>	$module_controller.'RemoveHolidayProgram', 
												     'middleware'  =>  $module_permission.'program.update']);

		Route::post('/multi_action',                ['as' 		 =>   $route_slug.'multi_action',    
													'uses' 		 =>   $module_controller.'multi_action', 
												  	'middleware' =>  $module_permission.'program.update']);

		Route::get('/delete/{enc_id}',               ['as' 		  =>  $route_slug.'delete',          
													 'uses' 	  =>  $module_controller.'delete', 
												  	 'middleware' =>  $module_permission.'program.delete']);

		/*Route::get('/create',                      ['as' => $route_slug.'create',          'uses' => $module_controller.'create']);
		Route::post('/store',                        ['as' => $route_slug.'store',           'uses' => $module_controller.'store']);
		Route::get('/create/{enc_id}',               ['as' => $route_slug.'create template', 'uses' => $module_controller.'template']);*/

		Route::get('/load_template/{id}',            ['as' => $route_slug.'create',          'uses' => $module_controller.'loadTemplate']);
		Route::post('/store_template/{enc_id}',      ['as' => $route_slug.'store template',  'uses' => $module_controller.'storeTemplate']);
		Route::get('/view/{enc_id}',                 ['as' => $route_slug.'view',            'uses' => $module_controller.'view']);
		Route::get('/view/{enc_id}/activate/{template_id}/{id}',   ['as' => $route_slug.'activate',        'uses' => $module_controller.'activateQuestion']);
		Route::get('/view/{enc_id}/deactivate/{template_id}/{id}', ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivateQuestion']);
		Route::get('/view/{enc_id}/delete/{template_id}/{id}',     ['as' => $route_slug.'delete',          'uses' => $module_controller.'deleteQuestion']);
		/*Route::get('/view/{enc_id}/edit/{template_id}/{id}',     ['as' => $route_slug.'delete',          'uses' => $module_controller.'editQuestion']);*/
		Route::get('/edit/{enc_id}',                 ['as' => $route_slug.'edit',            'uses' => $module_controller.'edit']);
		Route::post('/edit/{enc_id}/update',         ['as' => $route_slug.'update',          'uses' => $module_controller.'update']);
		Route::get('/question/edit/{program_id}/{template_id}/{question_id}',  ['as' => $route_slug.'edit',          'uses' => $module_controller.'editQuestion']);
		Route::post('/question/edit/{program_id}/{template_id}/{question_id}/update',  ['as' => $route_slug.'update1','uses' => $module_controller.'updateQuestion']);
		Route::get('/deleteQuestionFile/{program_id}/{template_id}/{question_id}/{file_type}/{file}/{file_name}',  ['as' => $route_slug.'deleteQuestionFile','uses' => $module_controller.'deleteQuestionFile']);
		Route::get('/deleteQuestionOption/{program_id}/{template_id}/{question_id}/{option}',  ['as' => $route_slug.'deleteQuestionOption','uses' => $module_controller.'deleteQuestionOption']);

		Route::get('lesson/view/{program_id}/{lesson_id}',   ['as' => $route_slug.'lesson_view',  'uses' => $module_controller.'viewLesson']);
		Route::post('lesson/update/{program_id}/{lesson_id}',['as' => $route_slug.'lesson_update','uses' => $module_controller.'updateLesson']);
		
		Route::get('/test',                ['as' => $route_slug.'create',        'uses' => $module_controller.'test']);

		/*Material [TEXTBOOK]*/
		Route::group(array('prefix'=>'material'), function(){
			$route_slug        = "program_material";
			$module_controller = "Admin\ProgramTextbookController@";

			Route::get('{program_id}',       										['as'=>$route_slug.'_listing', 'uses'=>$module_controller.'index']);
			Route::get('load_data/{program_id}',       								['as'=>$route_slug.'load_data', 'uses'=>$module_controller.'load_data']);
			Route::get('create/{subject_id}/{grade_id}/{program_id}/{lesson_id}',   ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'create']);
			Route::any('store',       ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'store']);

			Route::get('/activate/{enc_id}',             ['as' => $route_slug.'activate',        'uses' => $module_controller.'activate']);
			Route::get('/deactivate/{enc_id}',           ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivate']);
			Route::post('/multi_action',                 ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action']);

			Route::get('/delete/{program_id}/{enc_id}',  ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete']);
			/*Route::get('/view/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'view']);*/
			Route::get('/edit/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'edit']);
			Route::post('/update/{program_id}/{enc_id}', ['as' => $route_slug.'update',          'uses' => $module_controller.'update']);

			Route::get('/deleteFile/{program_id}/{textbook_id}/{file_id}', ['as' => $route_slug.'delete_file','uses' => $module_controller.'dileteFile']);

		});

		/*Homework*/
		Route::group(array('prefix'=>'homework'), function(){
			$route_slug        = "program_material";
			$module_controller = "Admin\ProgramHomeworkController@";

			Route::get('{program_id}',       										['as'=>$route_slug.'_listing', 'uses'=>$module_controller.'index']);
			Route::get('load_data/{program_id}',       								['as'=>$route_slug.'load_data', 'uses'=>$module_controller.'load_data']);
			Route::get('create/{subject_id}/{grade_id}/{program_id}/{lesson_id}',   ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'create']);
			Route::any('store',       ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'store']);

			Route::get('/activate/{enc_id}',             ['as' => $route_slug.'activate',        'uses' => $module_controller.'activate']);
			Route::get('/deactivate/{enc_id}',           ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivate']);
			Route::post('/multi_action',                 ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action']);

			Route::get('/delete/{program_id}/{enc_id}',  ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete']);
			/*Route::get('/view/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'view']);*/
			Route::get('/edit/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'edit']);
			Route::post('/update/{program_id}/{enc_id}', ['as' => $route_slug.'update',          'uses' => $module_controller.'update']);

			Route::get('/deleteFile/{program_id}/{textbook_id}/{file_id}', ['as' => $route_slug.'delete_file','uses' => $module_controller.'dileteFile']);

		});
		
	});


	/*Material [TEXTBOOK]*/
	Route::group(array('prefix' => 'material'), function() use ($module_permission)
	{
		$route_slug        = "program_material_";
		$module_controller = "Admin\TextbookController@";

		Route::get('/',         ['as' => $route_slug.'listing',   'uses' => $module_controller.'index',     'middleware' => $module_permission.'material.list']);
		Route::any('store',     ['as' => $route_slug.'create',    'uses' => $module_controller.'store',     'middleware' => $module_permission.'material.list']);
		Route::get('load_data', ['as' => $route_slug.'load_data', 'uses' => $module_controller.'load_data', 'middleware' => $module_permission.'material.list']);
		Route::get('create',    ['as' => $route_slug.'create',    'uses' => $module_controller.'create',    'middleware' => $module_permission.'material.create']);
		Route::post('getGrade', ['as' => $route_slug.'getGrade',  'uses' => $module_controller.'getGrade',  'middleware' => $module_permission.'material.create']);

		Route::get('/delete/{enc_id}',  ['as' => $route_slug.'delete', 'uses' => $module_controller.'delete', 'middleware' => $module_permission.'material.delete']);
		Route::get('/edit/{enc_id}',    ['as' => $route_slug.'delete', 'uses' => $module_controller.'edit',   'middleware' => $module_permission.'material.update']);
		Route::post('/update/{enc_id}', ['as' => $route_slug.'update', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'material.update']);

		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'middleware' => $module_permission.'material.update']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'middleware' => $module_permission.'material.update']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'material.update']);

		Route::get('/deleteFile/{material_id}/{file_id}', ['as' => $route_slug.'delete_file','uses' => $module_controller.'dileteFile',  'middleware' => $module_permission.'material.delete']);
	});


	/*Homework*/
	Route::group(array('prefix' => 'homework'), function() use ($module_permission)
	{
		$route_slug        = "program_homework_";
		$module_controller = "Admin\HomeworkController@";
		
		Route::get('/',         ['as' => $route_slug.'listing',   'uses' => $module_controller.'index',     'middleware' => $module_permission.'homework.list']);
		Route::get('load_data', ['as' => $route_slug.'load_data', 'uses' => $module_controller.'load_data', 'middleware' => $module_permission.'homework.list']);
		Route::get('create',    ['as' => $route_slug.'create',    'uses' => $module_controller.'create',    'middleware' => $module_permission.'homework.create']);
		Route::any('store',     ['as' => $route_slug.'create',    'uses' => $module_controller.'store',     'middleware' => $module_permission.'homework.create']);

		Route::post('getGrade',   ['as' => $route_slug.'getGrade',   'uses' => $module_controller.'getGrade']);
		Route::post('getProgram', ['as' => $route_slug.'getProgram', 'uses' => $module_controller.'getProgram']);
		Route::post('getLesson',  ['as' => $route_slug.'getLesson',  'uses' => $module_controller.'getLesson']);

		Route::get('/edit/{enc_id}',    ['as' => $route_slug.'delete', 'uses' => $module_controller.'edit',   'middleware' => $module_permission.'homework.list']);
		Route::post('/update/{enc_id}', ['as' => $route_slug.'update', 'uses' => $module_controller.'update', 'middleware' => $module_permission.'homework.list']);
		Route::get('/delete/{enc_id}',  ['as' => $route_slug.'delete', 'uses' => $module_controller.'delete', 'middleware' => $module_permission.'homework.delete']);

		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate',     'uses' => $module_controller.'activate',     'middleware' => $module_permission.'homework.list']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate',   'uses' => $module_controller.'deactivate',   'middleware' => $module_permission.'homework.list']);
		Route::post('/multi_action',       ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action', 'middleware' => $module_permission.'homework.list']);

		Route::get('/AddHolidayHomework/{enc_id}',['as' => $route_slug.'AddHolidayHomework', 'uses' => $module_controller.'AddHolidayHomework',     'middleware' => $module_permission.'homework.list']);
		Route::get('/RemoveHolidayHomework/{enc_id}',['as' => $route_slug.'RemoveHolidayHomework', 'uses' => $module_controller.'RemoveHolidayHomework',     'middleware' => $module_permission.'homework.list']);

		Route::get('/deleteFile/{homework_id}/{file_id}', ['as' => $route_slug.'delete_file','uses' => $module_controller.'dileteFile', 'middleware' => $module_permission.'homework.delete']);
	});



	Route::group(array('prefix' => 'transaction'), function() use ($module_permission)
	{
		$route_slug        = "transaction_";
		$module_controller = "Admin\TransactionController@";
		
		Route::get('/',              ['as' => $route_slug.'listing',    'uses' => $module_controller.'Index',     'middleware' => $module_permission.'transaction.list']);
		Route::get('load_data',      ['as' => $route_slug.'load_data',  'uses' => $module_controller.'LoadData',  'middleware' => $module_permission.'transaction.list']);
		Route::post('export-csv',    ['as' => $route_slug.'export-csv', 'uses' => $module_controller.'ExportCSV', 'middleware' => $module_permission.'transaction.list']);
		Route::get('/view/{enc_id}', ['as' => $route_slug.'view',       'uses' => $module_controller.'View',      'middleware' => $module_permission.'transaction.view']);
		
	});


});