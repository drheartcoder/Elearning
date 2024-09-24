<?php

$parent_panel_path = config('app.project.parent_panel_slug');


Route::group(array('prefix' => $parent_panel_path, 'middleware'=> 'users'), function () use($parent_panel_path)
{
	
	$route_slug        = 'parent_';
	$module_controller = "Front\Parent\DashboardController@";
	Route::get('/dashboard/{type?}/{year?}/{student_id?}', ['as' => $route_slug.'index', 'uses' => $module_controller.'Index']);

	Route::group(array('prefix' =>'account-setting'), function()
	{
		$route_slug        = 'parent_account_setting_';
		$module_controller = "Front\Parent\AccountSettingController@";
		Route::get('/my-profile',      ['as' => $route_slug.'my_profile',         'uses' => $module_controller.'MyProfile']);
		Route::post('/profile-update', ['as' => $route_slug.'profile_update',     'uses' => $module_controller.'UpdateProfile']);
		Route::post('/otp-request',    ['as' => $route_slug.'request_otp',        'uses' => $module_controller.'RequestOTP']);
		Route::get('/otp-verify',      ['as' => $route_slug.'verify_otp',         'uses' => $module_controller.'VerifyOTP']);
		Route::post('/otp/process',    ['as' => $route_slug.'process_verify_otp', 'uses' => $module_controller.'ProcessVerifyOTP']);

		Route::get('password/change',  ['as' => $route_slug.'change_password',    'uses' => $module_controller.'ChangePassword']);
		Route::post('password/update', ['as' => $route_slug.'update_password',    'uses' => $module_controller.'UpdatePassword']);
	});

	Route::group(array('prefix' =>'my-children'), function()
	{
		$route_slug        = 'parent_my_children_';
		$module_controller = "Front\Parent\DashboardController@";
		Route::post('add',                    ['as' => $route_slug.'add_my_child',           'uses' => $module_controller.'AddMyChild']);
		Route::post('update',                 ['as' => $route_slug.'update_my_child',        'uses' => $module_controller.'UpdateMyChild']);
		Route::post('delete',                 ['as' => $route_slug.'delete_my_child',        'uses' => $module_controller.'DeleteMyChild']);

		Route::post('pin-exists',             ['as' => $route_slug.'pin_exists',             'uses' => $module_controller.'PinExists']);
		Route::post('enrollment-code-exists', ['as' => $route_slug.'enrollment_code_exists', 'uses' => $module_controller.'EnrollmentCodeExists']);
	});
	
	$route_slug        = 'parent_my_children_program_';
	$module_controller = "Front\Parent\StudentController@";
	Route::any('change-program/{stud_id}', 					 ['as' => $route_slug.'change-program', 'uses' => $module_controller.'change_program']);
	Route::post('my-program/export-csv',   					 ['as' => $route_slug.'export_csv',     'uses' => $module_controller.'MyKidsExportCSV']);
	Route::any('my-program/{stud_id}',     					 ['as' => $route_slug.'my_program',     'uses' => $module_controller.'my_program']);

	Route::any('my-program/delete/{enc_program_id}',     	 ['as' => $route_slug.'delete_program',     'uses' => $module_controller.'delete_program']);

	Route::get('program-report/{slug}/{enc_student_id}',    ['as' => $route_slug.'generate_program_report', 'uses' => $module_controller.'generate_program_report']);
	
	Route::any('kids-pins', ['as' => 'kids-pins', 'uses' => 'Front\Parent\ParentController@PrintPin']);
	Route::any('transactions', ['as' => 'transactions', 'uses' => 'Front\Parent\ParentController@Transactions']);
	Route::any('my-kids',   ['as' => 'my-kids', 'uses' => 'Front\Parent\ParentController@my_kids']);


	Route::group(array('prefix' =>'notification'), function()
	{
		$route_slug        = 'parent_notification_';
		$module_controller = "Front\Parent\NotificationController@";
		Route::get('/',        ['as' => $route_slug.'index',  'uses' => $module_controller.'Index']);
		Route::post('/delete', ['as' => $route_slug.'delete', 'uses' => $module_controller.'Delete']);
	});


	Route::group(array('prefix' =>'homework'), function()
	{
		$route_slug        = 'parent_homework_';
		$module_controller = "Front\Parent\HomeworkController@";
		Route::get('/',         ['as' => $route_slug.'homework_list', 'uses' => $module_controller.'HomeworkList']);
		Route::get('/{enc_id}', ['as' => $route_slug.'homework_list', 'uses' => $module_controller.'HomeworkList']);
	});

	Route::group(array('prefix' =>'textbook'), function()
	{
		$route_slug        = 'parent_textbook_';
		$module_controller = "Front\Parent\TextbookController@";
		Route::get('/',         ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
		Route::get('/{enc_id}', ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
	});

});