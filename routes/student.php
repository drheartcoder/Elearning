<?php

$student_panel_path = config('app.project.student_panel_slug');

Route::group(array('prefix' => $student_panel_path, 'middleware'=>'users'), function () use($student_panel_path)
{
	$route_slug = "student_";
	
	/*--------------- Dashboard ------------------*/
	
	Route::get('/dashboard/{type?}/{year?}',       				['as' => $route_slug.'index', 			'uses' => 'Front\Student\DashboardController@index']);
	
	/*----------------------------------------------------------------------------------------
				Student Program
	----------------------------------------------------------------------------------------*/
	Route::group(array('prefix' => '/program/'), function () use($route_slug)
	{
		$moduleController = "Front\Student\ProgramController@";
		
		Route::get('details/{slug?}',       				   ['as' => $route_slug.'program_details', 'uses' => $moduleController.'program_details']);
		Route::get('test/{program_slug}/{lesson_id}',          ['as' => $route_slug.'program_test', 'uses' => $moduleController.'start_program']);
		Route::post('next_question',          			   	   ['as' => $route_slug.'next_question', 'uses' => $moduleController.'go_to_next_question']);
		Route::post('previous_question',          			   ['as' => $route_slug.'previous_question', 'uses' => $moduleController.'go_to_previous_question']);
		Route::post('wrong_attempts',          			   	   ['as' => $route_slug.'wrong_attempts', 'uses' => $moduleController.'wrong_attempts']);
		Route::post('update_delay_flag',          			   ['as' => $route_slug.'update_delay_flag', 'uses' => $moduleController.'update_delay_flag']);
		Route::get('certificate/{slug}',          			   ['as' => $route_slug.'generate_certificate', 'uses' => $moduleController.'generate_certificate']);
		Route::get('report/{slug}',       				       ['as' => $route_slug.'generate_program_report', 'uses' => $moduleController.'generate_program_report']);
	});


	Route::group(array('prefix' =>'textbook'), function()
	{
		$route_slug        = 'student_textbook_';
		$module_controller = "Front\Student\TextbookController@";
		Route::get('/',         ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
		Route::get('/{enc_id}', ['as' => $route_slug.'textbook_list', 'uses' => $module_controller.'TextbookList']);
	});

	Route::group(array('prefix' =>'homework'), function()
	{
		$route_slug        = 'student_homework';
		$module_controller = "Front\Student\HomeworkController@";
		Route::get('/',         ['as' => $route_slug.'homework_list', 'uses' => $module_controller.'index']);
	});

	Route::group(array('prefix' =>'notification'), function()
	{
		$route_slug        = 'parent_notification_';
		$module_controller = "Front\Student\NotificationController@";
		Route::get('/',        ['as' => $route_slug.'index',  'uses' => $module_controller.'Index']);
		Route::post('/delete', ['as' => $route_slug.'delete', 'uses' => $module_controller.'Delete']);
	});	

});