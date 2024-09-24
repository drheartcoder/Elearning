<?php

$web_supervisor_path = config('app.project.supervisor_panel_slug');


// ------------Before Login Routes----------------

Route::group(array('prefix' => $web_supervisor_path,'middleware'=>'supervisor_auth_check'), function ()
{
	$route_slug        = 'supervisor_';
	$module_controller = "Supervisor\AuthController@";

	Route::get('/',               ['as' =>$route_slug.'login',    'uses' => $module_controller.'login']);
	Route::post('validate_login', ['as' =>$route_slug.'validate', 'uses' => $module_controller.'validate_login']);

	$module_controller = "Supervisor\PasswordController@";
	Route::get('forgot_password',             ['as' => $route_slug.'forgot_password',            'uses' => $module_controller.'forgot_password']);
	Route::post('forgot_password/post_email', ['as' => $route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);
	Route::post('forgot_password/postReset',  ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);
	Route::get('/reset_password/{token?}',    ['as' => $route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'get_email'])->name('password.reset');
});

Route::group(array('prefix' => $web_supervisor_path), function ()
{
	$route_slug        = 'supervisor_';
	$module_controller = "Supervisor\AuthController@";
	Route::get('logout', ['as' =>$route_slug.'logout', 'uses' => $module_controller.'logout']);
});



// ----------------------After login routes--------------------------

Route::group(array('prefix' => $web_supervisor_path,'middleware'=>'auth_supervisor'), function () use($web_supervisor_path)
{
	$route_slug        = 'supervisor_';
	$module_controller = "Supervisor\DashboardController@";
	Route::get('/dashboard', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);

	Route::group(array('prefix' =>'account_setting'), function()
	{
		$route_slug        = 'web_supervisor_account_setting_';
		$module_controller = "Supervisor\AccountSettingController@";
		Route::get('/',                ['as' => $route_slug.'edit_profile',    'uses' => $module_controller.'index']);
		Route::post('profile_update',  ['as' => $route_slug.'profile_update',  'uses' => $module_controller.'update']);
		Route::get('password/change',  ['as' => $route_slug.'change_password', 'uses' => $module_controller.'change_password']);
		Route::post('password/update', ['as' => $route_slug.'update_password', 'uses' => $module_controller.'update_password']);
	});

	Route::group(array('prefix' => 'notifications'), function () use($route_slug)
	{
		$module_controller = "Supervisor\NotificationsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load_data',	  ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::get('/read',    		  ['as' => $route_slug.'read',         'uses' => $module_controller.'read']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'programs'), function () use($route_slug)
	{
		$module_controller = "Supervisor\ProgramsController@";		
		Route::get('/load_data',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/{status}',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/activate/{enc_id}',   ['as' => $route_slug.'activate','uses' => $module_controller.'activate']);
		Route::get('/deactivate/{enc_id}', ['as' => $route_slug.'deactivate','uses' => $module_controller.'deactivate']);
		Route::get('/read/{id}',	  ['as' =>$route_slug.'read', 'uses' => $module_controller.'read']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
		Route::get('/approve/{id}',	  ['as' =>$route_slug.'approve', 'uses' => $module_controller.'approve']);

	});

	Route::group(array('prefix' => 'program'), function () use($route_slug)
	{
		$route_slug        = "program_";
		$module_controller = "Supervisor\ProgramController@";
		Route::get('/',                              ['as' => $route_slug.'manage',          'uses' => $module_controller.'index']);
		Route::get('/export/{enc_program_id}',['as' =>$route_slug.'export','uses' => $module_controller.'export']);
		Route::post('getGrade/',                      ['as' => $route_slug.'getGrade',          'uses' => $module_controller.'getGrade']);

		Route::get('/load_data',                     ['as' => $route_slug.'load_data',       'uses' => $module_controller.'load_data']);
		Route::get('/activate/{enc_id}',             ['as' => $route_slug.'activate',        'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{enc_id}',           ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivate']);
		Route::get('/approveProgramStatus/{enc_id}',['as' => $route_slug.'approveProgramStatus','uses' => $module_controller.'approveProgramStatus']);
		Route::post('/rejectProgramStatus/{enc_id}', ['as' => $route_slug.'rejectProgramStatus','uses' => $module_controller.'rejectProgramStatus']);
		Route::post('/multi_action',                 ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action']);
		Route::get('/delete/{enc_id}',               ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete']);
		/*Route::get('/create',                        ['as' => $route_slug.'create',          'uses' => $module_controller.'create']);
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
		Route::get('/AddHolidayProgram/{enc_id}',    ['as' 		=>  $route_slug.'AddHolidayProgram',
												      'uses' 	=>	$module_controller.'AddHolidayProgram']);

		Route::get('/RemoveHolidayProgram/{enc_id}', ['as' 		 =>  $route_slug.'RemoveHolidayProgram',
													  'uses' 	 =>	$module_controller.'RemoveHolidayProgram']);		

		/*Material [TEXTBOOK]*/
		Route::group(array('prefix'=>'material'), function(){
			$route_slug        = "program_material";
			$module_controller = "Supervisor\TextbookController@";

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
			$module_controller = "Supervisor\HomeworkController@";

			Route::get('{program_id}',       										['as'=>$route_slug.'_listing', 'uses'=>$module_controller.'index']);
			Route::get('load_data/{program_id}',       								['as'=>$route_slug.'load_data', 'uses'=>$module_controller.'load_data']);
			Route::get('create/{subject_id}/{grade_id}/{program_id}/{lesson_id}',   ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'create_homework']);
			Route::get('create/{program_id}',   									['as'=>$route_slug.'_create', 'uses'=>$module_controller.'create']);
			Route::any('store',       ['as'=>$route_slug.'_create', 'uses'=>$module_controller.'store']);

			Route::get('/activate/{enc_id}',             ['as' => $route_slug.'activate',        'uses' => $module_controller.'activate']);
			Route::get('/deactivate/{enc_id}',           ['as' => $route_slug.'deactivate',      'uses' => $module_controller.'deactivate']);
			Route::post('/multi_action',                 ['as' => $route_slug.'multi_action',    'uses' => $module_controller.'multi_action']);

			Route::get('/delete/{program_id}/{enc_id}',  ['as' => $route_slug.'delete',          'uses' => $module_controller.'delete']);
			/*Route::get('/view/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'view']);*/
			Route::get('/edit/{program_id}/{enc_id}',    ['as' => $route_slug.'delete',          'uses' => $module_controller.'edit']);
			Route::post('/update/{program_id}/{enc_id}', ['as' => $route_slug.'update',          'uses' => $module_controller.'update']);

			Route::get('/AddHolidayHomework/{enc_id}',		['as' => $route_slug.'AddHolidayHomework', 'uses' => $module_controller.'AddHolidayHomework']);

			Route::get('/RemoveHolidayHomework/{enc_id}',['as' => $route_slug.'RemoveHolidayHomework', 'uses' => $module_controller.'RemoveHolidayHomework']);

			Route::get('/deleteFile/{program_id}/{textbook_id}/{file_id}', ['as' => $route_slug.'delete_file','uses' => $module_controller.'dileteFile']);

		});
		
	});

});