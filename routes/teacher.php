<?php

$teacher_panel_path = config('app.project.teacher_panel_slug');


Route::group(array('prefix' => $teacher_panel_path, 'middleware'=> 'users'), function () use($teacher_panel_path)
{
	
	$route_slug        = 'teacher_';
	$module_controller = "Front\Teacher\DashboardController@";
	Route::get('/dashboard', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
	Route::get('/class', ['as' => $route_slug.'class', 'uses' => $module_controller.'class_list']);

	$module_controller = "Front\Teacher\StudentReportController@";
	Route::get('/student_report/{enc_student_id}/{enc_class_id}/{type?}/{year?}', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);

	Route::group(array('prefix' =>'account-setting'), function()
	{
		$route_slug        = 'teacher_account_setting_';
		$module_controller = "Front\Teacher\AccountSettingController@";
		Route::get('/my-profile',      ['as' => $route_slug.'my_profile',         'uses' => $module_controller.'MyProfile']);
		Route::post('/profile-update', ['as' => $route_slug.'profile_update',     'uses' => $module_controller.'UpdateProfile']);
		Route::post('/otp-request',    ['as' => $route_slug.'request_otp',        'uses' => $module_controller.'RequestOTP']);
		Route::get('/otp-verify',      ['as' => $route_slug.'verify_otp',         'uses' => $module_controller.'VerifyOTP']);
		Route::post('/otp/process',    ['as' => $route_slug.'process_verify_otp', 'uses' => $module_controller.'ProcessVerifyOTP']);
		
		Route::get('password/change',  ['as' => $route_slug.'change_password',    'uses' => $module_controller.'ChangePassword']);
		Route::post('password/update', ['as' => $route_slug.'update_password',    'uses' => $module_controller.'UpdatePassword']);
	});

	Route::group(array('prefix' =>'my-class'), function()
	{
		$route_slug        = 'teacher_my_class_';
		$module_controller = "Front\Teacher\DashboardController@";
		Route::post('add',      ['as' => $route_slug.'add_my_class',    'uses' => $module_controller.'AddMyClass']);
		Route::post('update',   ['as' => $route_slug.'update_my_class', 'uses' => $module_controller.'UpdateMyClass']);
		Route::post('delete',   ['as' => $route_slug.'delete_my_class', 'uses' => $module_controller.'DeleteMyClass']);

		Route::post('getgrade', ['as' => $route_slug.'getgrade',        'uses' => $module_controller.'GetGrade']);
	});

	Route::group(array('prefix' =>'my-student'), function()
	{
		$route_slug        = 'teacher_my_student_';
		$module_controller = "Front\Teacher\MyStudentController@";
		Route::get('/{enc_id}',   ['as' => $route_slug.'my_student_list',   'uses' => $module_controller.'MyStudentList']);
		Route::post('/update',    ['as' => $route_slug.'update_my_student', 'uses' => $module_controller.'UpdateMyStudent']);
		Route::post('/remove',    ['as' => $route_slug.'remove_my_student', 'uses' => $module_controller.'RemoveMyStudent']);
		Route::post('add',        ['as' => $route_slug.'add_my_student',    'uses' => $module_controller.'AddMyStudent']);
		Route::post('export-csv', ['as' => $route_slug.'export_csv',        'uses' => $module_controller.'MyStudentExportCSV']);

		Route::post('add/new/form',    ['as' => $route_slug.'add_my_new_student_form', 'uses' => $module_controller.'AddMyNewStudentForm']);
		Route::post('get/student/pin', ['as' => $route_slug.'get_student_pin',         'uses' => $module_controller.'GetStudentPin']);

		Route::post('transfer_student', ['as' => $route_slug.'transfer_student',         'uses' => $module_controller.'TransferStudent']);

		Route::post('add/transfer/form',        ['as' => $route_slug.'add_my_transfer_student_form', 'uses' => $module_controller.'AddMyTransferStudentForm']);
		Route::post('add/transfer/check-email', ['as' => $route_slug.'check_teacher_email',          'uses' => $module_controller.'CheckTeacherEmail']);
		Route::post('add/transfer/check-email-data', ['as' => $route_slug.'check_email_data',             'uses' => $module_controller.'CheckEmailData']);

		Route::post('add/existing/form',             ['as' => $route_slug.'add_my_existing_student_form', 'uses' => $module_controller.'AddMyExistingStudentForm']);
		Route::post('add/existing/check-email-code', ['as' => $route_slug.'check_email_code',             'uses' => $module_controller.'CheckEmailCode']);

		Route::get('/{enc_class_id}/{enc_student_id}/my-program', ['as' => $route_slug.'my_program', 'uses' => $module_controller.'MyProgram']);
		
		Route::post('change-program',         ['as' => $route_slug.'change_program', 'uses' => $module_controller.'ChangeProgram']);
		Route::post('/my-program/export-csv', ['as' => $route_slug.'export_csv',     'uses' => $module_controller.'MyProgramsExportCSV']);
		Route::get('{class_id}/program-report/{slug}/{enc_student_id}',    ['as' => $route_slug.'generate_program_report', 'uses' => $module_controller.'generate_program_report']);
	});

	Route::post('/export-student-certificates',  ['as' => $route_slug.'student-certificates', 	  'uses' => 'Front\Teacher\TeacherController@ExportStudentCertificates']);	


	Route::any('student-flyers/{class_id}',  ['as' => $route_slug.'student-flyers', 	  'uses' => 'Front\Teacher\TeacherController@StudentFlyers']);	
	Route::any('send-multiple-flyers',  	 ['as' => $route_slug.'send-multiple-flyers', 'uses' => 'Front\Teacher\TeacherController@SendMultipleFlyers']);	
	
	Route::any('student-certificates/{class_id}',  ['as' => $route_slug.'student-certificates', 	  'uses' => 'Front\Teacher\TeacherController@StudentCertificates']);	

	Route::any('print-multiple-certificates',  	 ['as' => $route_slug.'print-multiple-certificates', 'uses' => 'Front\Teacher\TeacherController@PrintMultipleCertificates']);	
	Route::any('print-certificate/{stude_id}/{program_name}/{lang}/{program_id}',  	 ['as' => $route_slug.'print-multiple-certificates', 'uses' => 'Front\Teacher\TeacherController@PrintCertificates']);	
	
	
	Route::any('student-pins/{class_id}',   ['as' => $route_slug.'student-pins',             'uses' => 'Front\Teacher\TeacherController@StudentReports']);         	
	Route::any('print-student-pin',         ['as' => $route_slug.'print-student-pin',        'uses' => 'Front\Teacher\TeacherController@PrintStudentPin']);        	
	Route::any('print-class-report',        ['as' => $route_slug.'print-class-report',       'uses' => 'Front\Teacher\TeacherController@PrintClassReport']);       	

	Route::any('share-class/{class_id}',    ['as' => $route_slug.'share-class',              'uses' => 'Front\Teacher\TeacherController@ShareClass']);             	
	Route::any('transfer-class/{class_id}', ['as' => $route_slug.'transfer-class',           'uses' => 'Front\Teacher\TeacherController@TransferClass']);          	
	Route::any('transfered-class-listing/{class_id}', ['as' => $route_slug.'transfered-class-listing', 'uses' => 'Front\Teacher\TeacherController@TransferedClassListing']); 	


	Route::group(array('prefix' =>'notification'), function()
	{
		$route_slug        = 'teacher_notification_';
		$module_controller = "Front\Teacher\NotificationController@";
		Route::get('/',        ['as' => $route_slug.'index',  'uses' => $module_controller.'Index']);
		Route::post('/delete', ['as' => $route_slug.'delete', 'uses' => $module_controller.'Delete']);
	});


	Route::group(array('prefix' =>'homework'), function()
	{
		$route_slug        = 'teacher_homework_';
		$module_controller = "Front\Teacher\HomeworkController@";
		Route::get('/{class_id}/',         ['as' => $route_slug.'homework_list', 'uses' => $module_controller.'HomeworkList']);
		Route::get('/{class_id}/{enc_id}', ['as' => $route_slug.'homework_list', 'uses' => $module_controller.'HomeworkList']);
	});

	Route::group(array('prefix' =>'textbook'), function()
	{
		$route_slug        = 'teacher_textbook_';
		$module_controller = "Front\Teacher\TextbookController@";
		Route::get('/{class_id}/',         ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
		Route::get('/{class_id}/{enc_id}', ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
	});


});