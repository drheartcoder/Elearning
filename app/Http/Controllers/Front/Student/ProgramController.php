<?php

namespace App\Http\Controllers\Front\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\StudentProgramQuestionModel;
use App\Models\ProgramModel;
use App\Models\ProgramQuestionModel;
use App\Models\StudentProgramsModel;
use App\Models\UsersModel;
use App\Models\HomeworkimagesModel;
use App\Common\Services\StudentService;
use App\Common\Services\ReportService;
use App\Common\Services\NotificationService;

use Validator;
use Session;
use Auth;
use App;

class ProgramController extends Controller
{
	public function __construct(StudentService      $studentService,ReportService $reportService,
								NotificationService $notification_service)
	{
		$this->StudentService 	   		   		= $studentService;
		$this->ReportService 	   		   		= $reportService;
		$this->ProgramModel 	   		   		= new ProgramModel();
		$this->StudentProgramQuestionModel 		= new StudentProgramQuestionModel();
		$this->StudentProgramsModel     		= new StudentProgramsModel();
		$this->UsersModel     					= new UsersModel();
		$this->HomeworkimagesModel     			= new HomeworkimagesModel();
        $this->template_base_img_path      		= base_path().config('app.project.img_path.template_image');
        $this->template_public_img_path    		= url('/').config('app.project.img_path.template_image');
        $this->default_base_img_path       		= base_path().config('app.project.img_path.default_image');
        $this->default_public_img_path     		= url('/').config('app.project.img_path.default_image');
        $this->question_image_base_path    		= base_path().config('app.project.img_path.question_image');
        $this->question_image_public_path  		= url('/').config('app.project.img_path.question_image');
        $this->question_video_base_path    		= base_path().config('app.project.img_path.question_video');
        $this->question_video_public_path  		= url('/').config('app.project.img_path.question_video');
        $this->question_audio_base_path    		= base_path().config('app.project.img_path.question_audio');
        $this->question_audio_public_path  		= url('/').config('app.project.img_path.question_audio');	    
        $this->student_answer_audio_base_path   = base_path().config('app.project.img_path.student_answer_audio');
        $this->NotificationService              = $notification_service;
	    $this->auth = auth()->guard('users');
	}
   
    /**
    * Function  : program_details($slug)
	* Author    : Akshay Garje
	* Date      : 17/07/2018
    * @return [view] [Return view of Program Details]
    */
   
    public function program_details($slug=false)
    {
    	$arr_program = $arr_programs = [];
        $student_id   = Auth::user()->id;
        if($student_id!='')
        {
        	Session::put('program_id', null);
			Session::put('lesson_id', null);
			Session::put('template_id', null);
			Session::put('question_id', null);
    	    if($slug!='' && $slug!=null)
    	    {
	    	    $arr_program = $this->StudentProgramQuestionModel->whereHas('program_details',function($query) use($slug){
			    	    												$query->where('approve_status','approved')->where('status','1')->where('slug',$slug);
			    	    												$query->whereHas('subjectData');
                                                    					$query->whereHas('gradeData');
				    												})
	    	    												 ->whereHas('lessonData')
				    											 ->with(['program_details'=>function($query) use($slug){
				    	    											$query->where('approve_status','approved')->where('status','1')->where('slug',$slug);
				    	    											$query->with('subjectData');
                        												$query->with('gradeData');
				    												}])
				    											 ->with(['lessonData'])
										                         ->where('student_id',$student_id)
										                         ->orderBy('lesson_id','ASC')
										                         ->orderBy('is_answer','ASC')
										                         ->orderBy('question_id','ASC')
										                         ->orderBy('id','ASC')
										                         ->get();
    	    }
			if(isset($arr_program) && count($arr_program)>0)
			{
				$arr_program = $arr_program->toArray();
			}
    	    
	    	$arr_programs = $this->StudentProgramQuestionModel->whereHas('program_details',function($query){
                                                    $query->where('approve_status','approved')->where('status','1');
                                                })
                                                ->with(['program_details'=>function($query){
    												$query->where('approve_status','approved')->where('status','1');
                        						}])
                                              ->where('student_id',$student_id)
                                              ->groupBy('program_id')
                                              ->get()->toArray();
			
	   	    $data['arr_program']   = $arr_program;
	   	    $data['arr_programs']  = $arr_programs;
	   	    $data['slug']     	   = $slug;
	   	    $data['pageTitle']     = trans('parent.Program_Details');
		    $data['middleContent'] = 'student.program.program_details';
		    return view('front.layout.master')->with($data);
        }
		return redirect(url('/').'/student/dashboard');
    }

    /**
    * Function  : start_program($slug)
	* Author    : Akshay Garje
	* Date      : 18/07/2018
    * @return [view] [Return view of start Program]
    */
   
    public function start_program($program_slug,$lesson_id)
    {
    	if($program_slug!='' && $lesson_id!='')
    	{
	        $daily_lesson_completed_count = $daily_lesson_limit = 0;
	        $student_id   = Auth::user()->id;
    		//Check Daily Lesson Limit
			$daily_lesson_completed_count = $this->StudentService->checkDailyLessonLimit($student_id);
			$daily_lesson_limit = $this->StudentService->globalDailyLessonLimit();
			if($daily_lesson_completed_count >= $daily_lesson_limit)
			{
				Session::flash('error', 'Your daily limit for lessons exceeded.');
				return redirect()->back();
			}
    		if(!empty(Session('program_id')) && !empty(Session('lesson_id')) && !empty(Session('template_id')) && !empty(Session('question_id')))
    		{
    			$program_id  = Session('program_id');
    			$lesson_id 	 = Session('lesson_id');
    			$template_id = Session('template_id');
    			$question_id = Session('question_id');

				return $this->GetTemplateQuestion($program_id,$lesson_id,$template_id,$question_id);
    		}
    		else
    		{
				$program_id = $this->StudentService->get_program_id($program_slug);
				if($program_id!=false)
				{
			    	$arr_program = [];
			        if($student_id!='')
			        {
			    	    $arr_program = $this->StudentProgramQuestionModel->where('lesson_id',base64_decode($lesson_id))
					    											     ->where('program_id',$program_id)
											                             ->where('student_id',$student_id)
											                             ->where('is_answer','no')
											                             ->orderBy('id','ASC')
											                             ->orderBy('question_id','ASC')
											                             ->first();

						if(isset($arr_program) && count($arr_program)>0)
						{
							$arr_program = $arr_program->toArray();
							$question_id = base64_encode($arr_program['question_id']);
							$template_id = base64_encode($arr_program['template_id']);
							$program_id  = base64_encode($program_id);
							
							Session::put('program_id',$program_id);
							Session::put('lesson_id',$lesson_id);
							Session::put('template_id',$template_id);
							Session::put('question_id',$question_id);

						    return $this->GetTemplateQuestion($program_id,$lesson_id,$template_id,$question_id);
						}
			        }
				}
    		}
    	}
    	Session::flash('error', 'Oops! Soemthing went wrong !');
		return redirect(url('/').'/student/dashboard');
    }

    /**
    * Function  : GetTemplateQuestion($template_id,$lesson_id)
	* Author    : Akshay Garje
	* Date      : 18/07/2018
    * @return [view] [Return template as per the question]
    */    
    public function GetTemplateQuestion($program_id,$lesson_id,$template_id,$question_id,$request=false)
    { 
    	if($program_id!='' && $lesson_id!='')
    	{
	    	$arr_program     =  $arr_question = $arr_data = $arr_total_question = [];
	    	$total_questions = $next_question_template_id = $next_question_id = $previous_question_template_id = $previous_question_id = $previous_question = $current_question = 0;
    		
    		$program_id    = base64_decode($program_id);
    		$lesson_id     = base64_decode($lesson_id);
    		$template_id   = base64_decode($template_id);
    		$question_id   = base64_decode($question_id);
	        $student_id    = Auth::user()->id;
	        if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
	        {
				$arr_question = $this->StudentProgramQuestionModel->where('program_id',$program_id)
						                                          ->where('lesson_id',$lesson_id)
						                                          ->where('template_id',$template_id)
						                                          ->where('question_id',$question_id)
						                                          ->where('student_id',$student_id)
						                                          ->with('template'.$template_id)
						                                          ->first();
		   	    if(isset($arr_question) && count($arr_question))
		   	    {
		   	    	$arr_question 		  = $arr_question->toArray();
		   	    	$total_question_count = $this->StudentService->getTotalQuestionCount($program_id,$lesson_id,$student_id);
		   	    	$arr_total_questions  = $this->StudentService->getTotalLessonQuestions($program_id,$lesson_id,$student_id);
		   	    	foreach ($arr_total_questions as $key => $value)
		   	    	{
		   	    		if($value['id']==$arr_question['id'])
		   	    		{
	   	    				$current_question = $key + 1;
	   	    				if($current_question < $total_question_count)
	   	    				{
		   	    				$next_question_template_id = $arr_total_questions[$current_question]['template_id'];
		   	    				$next_question_id          = $arr_total_questions[$current_question]['question_id'];
	   	    				}
	   	    				if($key>0)
	   	    				{
	   	    					$previous_question = $key-1;
		   	    				$previous_question_template_id = $arr_total_questions[$previous_question]['template_id'];
		   	    				$previous_question_id          = $arr_total_questions[$previous_question]['question_id'];
	   	    				}
		   	    		}
		   	    	}
			   	    $data['program_id']           		    = base64_encode($program_id);
			   	    $data['lesson_id']           		    = base64_encode($lesson_id);
			   	    $data['next_question_template_id']      = base64_encode($next_question_template_id);
			   	    $data['previous_question_template_id']  = base64_encode($previous_question_template_id);
			   	    $data['next_question_id']           	= base64_encode($next_question_id);
			   	    $data['previous_question_id']           = base64_encode($previous_question_id);
			   	    $data['current_question']           	= $current_question;
			   	    $data['arr_question']           		= $arr_question;
			   	    $data['total_question_count']       	= $total_question_count;
			   	    $data['template_public_img_path']   	= $this->template_public_img_path;
			   	    $data['default_public_img_path']    	= $this->default_public_img_path;
			   	    $data['question_image_public_path'] 	= $this->question_image_public_path;
			   	    $data['question_video_public_path'] 	= $this->question_video_public_path;
			   	    $data['question_audio_public_path'] 	= $this->question_audio_public_path;
			   	    $data['question_audio_base_path'] 		= $this->question_audio_base_path;
			   	    $data['pageTitle']                  	= trans('parent.Program_Test');
				    $data['templateContent']              	= 'student.program_templates.template_'.$template_id;
				    if($request!=false)
				    {
				    	return view('front.student.program_templates.template_'.$template_id)->with($data);
				    }
				    return view('front.student.template_layout.master')->with($data);
		   	    }
	        }
    	}
		Session::flash('error', 'Oops! Soemthing went wrong !');
        return redirect(url('/').'/student/dashboard/');
    }

    /**
    * Function  : go_to_next_question(Request $request)
	* Author    : Akshay Garje
	* Date      : 19/07/2018
    * @return [view] [Return template for next question]
    */    
    public function go_to_next_question(Request $request)
    {
    	$program_id    		 = $request->input('program_id');
		$lesson_id     		 = $request->input('lesson_id');
		$template_id   		 = $request->input('template_id');
		$template_id   		 = $request->input('template_id');
		$question_id   		 = $request->input('question_id');
		$type   	   		 = $request->input('type');
        $student_id    		 = Auth::user()->id;
        $daily_lesson_completed_count = $daily_lesson_limit = $homework_count = 0;

		if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='' && $type!='')
		{
			if($type=='save')
			{
				$arr_data = [];
				$actual_time  = strtotime($request->input('actual_time'));
				$current_time = strtotime($request->input('current_time'));
				$current_template_id = $request->input('current_template_id');
				$current_question_id = $request->input('current_question_id');
				$answer_time  = gmdate("H:i:s", strtotime($request->input('actual_time')) - strtotime($request->input('current_time')));
				if($answer_time==$request->input('actual_time'))
				{
					$arr_data['is_delay'] = 'yes';
				}
				// Insert Points for given question
/*				if(gmdate("s", strtotime($request->input('actual_time')))!='00')
				{
					$given_answer_speed_percentage  = (gmdate("s", strtotime($answer_time)) / gmdate("s", strtotime($request->input('actual_time'))))*100;
				}
				else
				{
					$given_answer_speed_percentage  = 100;
				}
				$this->insert_points(base64_decode($program_id),base64_decode($lesson_id),base64_decode($current_template_id),base64_decode($current_question_id),$student_id,$given_answer_speed_percentage);*/

				$arr_data['answer_date']  = date('Y-m-d');
				$arr_data['answer_time']  = $answer_time;
				$arr_data['is_answer'] 	  = 'yes';
				
				/*if($request->hasFile('audio_file'))
		        {
		            $file_extension = strtolower($request->file('audio_file')->getClientOriginalExtension());
		            if(in_array($file_extension,['mp3','wav']))
		            {
		            	$file_name = $request->input('audio_filename');
		                $file_name = sha1(uniqid().$file_name.uniqid()).$student_id.'.'.$file_extension;
		                $isUpload = $request->file('audio_file')->move($this->student_answer_audio_base_path , $file_name);
						if($isUpload)
						{
							$arr_data['audio_file'] = $file_name;
						}
		            }
		            else
		            {	
		                Session::flash('error','Invalid File type');
		                return redirect()->back();
		            }
		        }*/
				$update_answer = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
						                                          ->where('lesson_id',base64_decode($lesson_id))
						                                          ->where('template_id',base64_decode($current_template_id))
						                                          ->where('question_id',base64_decode($current_question_id))
						                                          ->where('student_id',$student_id)
						                                          ->update($arr_data);
			}
			//Check Daily Lesson Limit
			$daily_lesson_completed_count = $this->StudentService->checkDailyLessonLimit($student_id);
			$daily_lesson_limit           = $this->StudentService->globalDailyLessonLimit();
			$program_slug                 = $this->StudentService->getProgramSlug($program_id);
			$subject_id                   = $this->StudentService->getSubjectName(base64_decode($program_id),$student_id);

			if(base64_decode($template_id)==0 || base64_decode($question_id)==0)
			{
				$arr_program = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
									                             ->where('student_id',$student_id)
									                             ->where('is_answer','no')
									                             ->orderBy('is_answer','DESC')
									                             ->orderBy('id','ASC')
									                             ->orderBy('question_id','ASC')
									                             ->first();
				
				if(isset($arr_program) && count($arr_program)>0)
				{
					$arr_program = $arr_program->toArray();
					//Check homework given count
			        $homework_count = $this->HomeworkimagesModel->with(['homeworkData' => function($query) use ($student_id,$lesson_id,$program_id,$subject_id){
                                                $query->where('status','1');
                                                $query->where('lesson_id', base64_decode($lesson_id));
                                                $query->where('program_id', base64_decode($program_id));
                                                $query->where('subject_id', base64_decode($subject_id));
                                                $query->with(['program_assign' => function($sub_query) use ($student_id){
                                                    $sub_query->where('student_id',$student_id);
                                                }]);
                                            }])
                                          ->whereHas("homeworkData", function($query) use($student_id,$lesson_id,$program_id,$subject_id) {
                                                $query->where('status','1');
                                                $query->where('lesson_id', base64_decode($lesson_id));
                                                $query->where('program_id', base64_decode($program_id));
                                                $query->where('subject_id', base64_decode($subject_id));
                                                $query->whereHas("program_assign", function($sub_query) use($student_id) {
                                                    $sub_query->where('student_id',$student_id);
                                                });
                                            })
                                          ->count();

					//Check Daily Lesson Limit
					if($daily_lesson_completed_count >= $daily_lesson_limit)
					{
						return response()->json(['type'=>'daily_limit','status'=>'fail','msg'=>'Your daily limit for lessons exceeded.','program_slug'=>$program_slug,'subject_id'=>$subject_id,'homework_count'=>$homework_count]);
					}

					//Check Confirmation for next lesson
					if($request->has('next_question_confirmation')==true && $request->input('next_question_confirmation')=='yes')
					{
						$question_id = base64_encode($arr_program['question_id']);
						$template_id = base64_encode($arr_program['template_id']);
						$lesson_id   = base64_encode($arr_program['lesson_id']);
					}
					else
					{
						//Redirection for next lesson
						return response()->json(['type'=>'next_lesson','status'=>'fail','program_slug'=>$program_slug,'subject_id'=>$subject_id,'homework_count'=>$homework_count]);
					}
				}
				else
				{
					//If program is completed
					$arr_user_details = $arr_program = [];
					$arr_user_details = getUserDetails($student_id);
					$first_name 	  = isset($arr_user_details['first_name'])?$arr_user_details['first_name']:'';
					$last_name   	  = isset($arr_user_details['last_name'])?$arr_user_details['last_name']:'';
					$arr_program 	  = get_program_details(base64_decode($program_id));
					$slug             = isset($arr_program['slug'])?$arr_program['slug']:'';
					$program_name     = isset($arr_program['name'])?$arr_program['name']:'';
						
					//sent notifcation to student
					$arr_notification = [];
					$arr_notification['message']      = 'You have successfully completed program - '.$program_name;
		            $arr_notification['from_user_id'] = 1;
		            $arr_notification['to_user_id']   = $student_id;
		            $arr_notification['url']          = "/student/program/details/".$slug;
		            $arr_notification['is_read']      = "0";
		             $this->NotificationService->send_notification($arr_notification);

		            //sent notifcation to admin
		            $arr_notification = [];
					$arr_notification['message']      = $first_name.' '.$last_name.' has successfully completed program - '.$program_name;
		            $arr_notification['from_user_id'] = $student_id;
		            $arr_notification['to_user_id']   = 1;
		            $arr_notification['url']          = "/admin/users/student/view/".base64_encode($student_id);
		            $arr_notification['is_read']      = "0";
		             $this->NotificationService->send_notification($arr_notification);

					Session::flash('success', 'You have successfully completed program.');
					return response()->json(['type'=>'program_over','status'=>'complete','program_slug'=>$program_slug]);
				}
			}
			
			Session::put('program_id',$program_id);
			Session::put('lesson_id',$lesson_id);
			Session::put('template_id',$template_id);
			Session::put('question_id',$question_id);
		    return $this->GetTemplateQuestion($program_id,$lesson_id,$template_id,$question_id,$request);
		}
    }

    /**
    * Function  : go_to_previous_question(Request $request)
	* Author    : Akshay Garje
	* Date      : 19/07/2018 20/07/2018
    * @return [view] [Return template for next question]
    */

    public function go_to_previous_question(Request $request)
    {
    	$program_id    = $request->input('program_id');
		$lesson_id     = $request->input('lesson_id');
		$template_id   = $request->input('template_id');
		$question_id   = $request->input('question_id');
        $student_id    = Auth::user()->id;
		if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
		{
			Session::put('program_id',$program_id);
			Session::put('lesson_id',$lesson_id);
			Session::put('template_id',$template_id);
			Session::put('question_id',$question_id);
		    return $this->GetTemplateQuestion($program_id,$lesson_id,$template_id,$question_id,$request);
		}
		return response()->json(['msg'=>'fail']);
    }

    /**
    * Function  : wrong_attempts(Request $request)
	* Author    : Akshay Garje
	* Date      : 20/07/2018
    * @return [view] [Inserting wrong attempts for question]
    */

    public function wrong_attempts(Request $request)
    {
    	$program_id    = $request->input('program_id');
		$lesson_id     = $request->input('lesson_id');
		$template_id   = $request->input('template_id');
		$question_id   = $request->input('question_id');
        $student_id    = Auth::user()->id;

		if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
		{
			$check_attempts = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
						                                          ->where('lesson_id',base64_decode($lesson_id))
						                                          ->where('template_id',base64_decode($template_id))
						                                          ->where('question_id',base64_decode($question_id))
						                                          ->where('student_id',$student_id)
						                                          ->first();

            if(isset($check_attempts) && count($check_attempts)>0)
            {
            	$arr_data 					= [];
            	$check_attempts 			= $check_attempts->toArray();
            	$total_attempts 			= $check_attempts['wrong_attempts'] + 1;
            	$arr_data['wrong_attempts'] = $total_attempts;
            	$update_attempts = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
						                                          	->where('lesson_id',base64_decode($lesson_id))
						                                          	->where('template_id',base64_decode($template_id))
						                                          	->where('question_id',base64_decode($question_id))
						                                          	->where('student_id',$student_id)
						                                          	->update($arr_data);
				return response()->json(['msg'=>'success']);
            }			
		}
		return response()->json(['msg'=>'fail']);
    }

    /**
    * Function  : update_delay_flag(Request $request)
	* Author    : Akshay Garje
	* Date      : 20/07/2018
    * @return [view] [Update Delay Flag once the time is Up]
    */

    public function update_delay_flag(Request $request)
    {
    	$program_id    = $request->input('program_id');
		$lesson_id     = $request->input('lesson_id');
		$template_id   = $request->input('template_id');
		$question_id   = $request->input('question_id');
        $student_id    = Auth::user()->id;

		if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
		{
			$ix_exits = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
						                                          ->where('lesson_id',base64_decode($lesson_id))
						                                          ->where('template_id',base64_decode($template_id))
						                                          ->where('question_id',base64_decode($question_id))
						                                          ->where('student_id',$student_id)
						                                          ->first();

            if(isset($ix_exits) && count($ix_exits)>0)
            {
            	$arr_data 			  = [];
            	$ix_exits 			  = $ix_exits->toArray();
            	$arr_data['is_delay'] = 'yes';
            	$update_delay = $this->StudentProgramQuestionModel->where('program_id',base64_decode($program_id))
						                                          	->where('lesson_id',base64_decode($lesson_id))
						                                          	->where('template_id',base64_decode($template_id))
						                                          	->where('question_id',base64_decode($question_id))
						                                          	->where('student_id',$student_id)
						                                          	->update($arr_data);
				return response()->json(['msg'=>'success']);
            }			
		}
		return response()->json(['msg'=>'fail']);
    }

    /**
    * Function  : generate_certificate($slug)
	* Author    : Akshay Garje
	* Date      : 03/08/2018
    * @return [view] [Generate Certificate after completion of program]
    */

    public function generate_certificate($slug)
    {
        $student_id   = Auth::user()->id;
        $arr_program  = $data = [];
        $teacher_name = '';
        $total_time   = 0;
		if($slug!='' && $student_id!='')
		{
			$arr_program = $this->StudentProgramQuestionModel->whereHas('program_details',function($query) use($slug){
			    	    												$query->where('approve_status','approved')->where('status','1')->where('slug',$slug);
			    	    												$query->whereHas('subjectData');
                                                    					$query->whereHas('gradeData');
				    												})
	    	    												 ->whereHas('lessonData')
	    	    												 ->whereHas('studentData')
				    											 ->with(['program_details'=>function($query) use($slug){
				    	    											$query->where('approve_status','approved')->where('status','1')->where('slug',$slug);
				    	    											$query->with('subjectData');
                        												$query->with('gradeData');
				    												}])
				    											 ->with(['lessonData'])
				    											 ->with(['studentData'])
										                         ->where('student_id',$student_id)
										                         ->where('is_answer','yes')
										                         ->orderBy('lesson_id','ASC')
										                         ->orderBy('is_answer','ASC')
										                         ->orderBy('question_id','ASC')
										                         ->orderBy('id','ASC')
										                         ->first();
			if(isset($arr_program) && count($arr_program))
			{
				$arr_programs 		       = $arr_program->toArray();

				$arr_get_teacher_details   = $this->StudentProgramsModel->whereHas('user_details')->with('user_details')
																		->where('program_id',$arr_program['program_id'])
																		->where('student_id',$student_id)
																		->orderBy('id','desc')
																		->orderBy('assigned_by','asc')
																		->first();

		   	    if(isset($arr_get_teacher_details) && count($arr_get_teacher_details)>0)
		   	    {
		   	    	$arr_get_teacher_details = $arr_get_teacher_details->toArray();
		   	    	$teacher_name            = ucwords($arr_get_teacher_details['user_details']['first_name']).' '.ucwords($arr_get_teacher_details['user_details']['last_name']);
		   	    }
		   	    $total_time                = $this->StudentService->calculateTotalTimeTakenForProgram($arr_program['program_id'],$student_id);
		   	    $data['total_time']        = $total_time;
		   	    $data['teacher_name']      = $teacher_name;
		   	    $data['program_name']      = ucwords($arr_programs['program_details']['name']);
		   	    $data['student_name']      = ucwords($arr_programs['student_data']['first_name']).' '.ucwords($arr_programs['student_data']['last_name']);
		   	    $data['date']              = date('d/m/Y',strtotime($arr_programs['answer_date']));
		   	    $data['slug']     	       = $slug;
		   	    $data['pageTitle']         = trans('parent.Program_Certificate');
			    $data['middleContent']     = 'student.program.program_certificate';
			    return view('front.layout.master')->with($data);
			}
		}
		Session::flash('error', 'Something went wrong while generating program completion certificate.');
		return redirect(url('/').'/student/dashboard');
    }


    /**
    * Function  : insert_points($program_id,$lesson_id,$template_id,$question_id,$student_id,$given_answer_speed_percentage)
	* Author    : Akshay Garje
	* Date      : 14/08/2018
    * @return [view] [Inserting points for student answer]
    */

    public function insert_points($program_id,$lesson_id,$template_id,$question_id,$student_id,$given_answer_speed_percentage)
    {
    	if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='' && $given_answer_speed_percentage)
    	{
    		$wrong_attempt_count = $scoreB_points = $scoreC_points = $scoreD_points = 0;
    		$arr_wrong_attempt_count = $arr_user = $arr_points_data = [];
    		$arr_wrong_attempt_count = $this->StudentProgramQuestionModel->where('program_id',$program_id)
							                                          ->where('lesson_id',$lesson_id)
							                                          ->where('template_id',$template_id)
							                                          ->where('question_id',$question_id)
							                                          ->where('student_id',$student_id)
							                                          ->first();
            
            if(isset($arr_wrong_attempt_count) && count($arr_wrong_attempt_count)>0)
            {
            	$arr_wrong_attempt_count = $arr_wrong_attempt_count->toArray();
            	$wrong_attempt_count = $arr_wrong_attempt_count['wrong_attempts'];
            }

            $arr_user = $this->UsersModel->where('id',$student_id)->first();
			if(isset($arr_user) && count($arr_user)>0)
            {
            	$arr_user     = $arr_user->toArray();
            	$a_points     = $arr_user['a_points'];
            	$b_points     = $arr_user['b_points'];
            	$c_points     = $arr_user['c_points'];
            	$d_points     = $arr_user['d_points'];
            	$total_points = $arr_user['total_points'];
            }            

            //Calculation for Score B, Score C & Score D points
            if ($given_answer_speed_percentage<=30 && $given_answer_speed_percentage > 0){
				$scoreB_points =  $this->ReportService->getReportPoints('score_b','a+');
				if ($wrong_attempt_count==0){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a+');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a+');            	
	            }
	            else if($wrong_attempt_count==1){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a');            	
	            }
	            else if($wrong_attempt_count==2){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','b');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','b');            	
	            }
	            else{
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','c');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','c');            	
	            }
            }
            else if($given_answer_speed_percentage<=50 && $given_answer_speed_percentage > 0){
				$scoreB_points =  $this->ReportService->getReportPoints('score_b','a');
				if ($wrong_attempt_count==0){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a+');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a+');            	
	            }
	            else if($wrong_attempt_count==1){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a');            	
	            }
	            else if($wrong_attempt_count==2){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','b');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','b');            	
	            }
	            else{
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','c');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','c');            	
	            }
            }
            else if($given_answer_speed_percentage<=70 && $given_answer_speed_percentage > 0){
				$scoreB_points =  $this->ReportService->getReportPoints('score_b','b');
				if ($wrong_attempt_count==0){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a+');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a+');            	
	            }
	            else if($wrong_attempt_count==1){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a');            	
	            }
	            else if($wrong_attempt_count==2){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','b');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','b');            	
	            }
	            else{
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','c');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','c');            	
	            }            	
            }
            else if($given_answer_speed_percentage<=100 && $given_answer_speed_percentage > 0){
				$scoreB_points =  $this->ReportService->getReportPoints('score_b','b');
				if ($wrong_attempt_count==0){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a+');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a+');            	
	            }
	            else if($wrong_attempt_count==1){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a');            	
	            }
	            else if($wrong_attempt_count==2){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','b');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','b');            	
	            }
	            else{
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','c');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','c');            	
	            }            	
            }
            else{
				$scoreB_points =  $this->ReportService->getReportPoints('score_b','c');
				if ($wrong_attempt_count==0){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a+');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a+');            	
	            }
	            else if($wrong_attempt_count==1){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','a');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','a');            	
	            }
	            else if($wrong_attempt_count==2){
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','b');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','b');            	
	            }
	            else{
					$scoreC_points =  $this->ReportService->getReportPoints('score_c','c');            	
					$scoreD_points =  $this->ReportService->getReportPoints('score_c','c');            	
	            }
            }
            $arr_points_data['b_points']     = $b_points + $scoreB_points;
            $arr_points_data['c_points']     = $c_points + $scoreC_points;
            $arr_points_data['d_points']     = $d_points + $scoreD_points;
            $arr_points_data['total_points'] = $a_points + $arr_points_data['b_points'] + $arr_points_data['c_points'] + $arr_points_data['d_points'];

            $insert_points = $this->UsersModel->where('id',$student_id)->update($arr_points_data);
    	}
    }

    /**
    * Function  : generate_program_report($slug)
	* Author    : Akshay Garje
	* Date      : 31/08/2018
    * @return [view] [Generate program report]
    */

    public function generate_program_report($slug)
    {
        $student_id   = Auth::user()->id;
        $result = $this->ReportService->create_program_report($slug,$student_id);
        if($result!='error' && $result!='')
        {
		    $result['middleContent'] = 'student.program.program_report';
		    return view('front.layout.master')->with($result);
        }
        else
        {
			Session::flash('error', 'Something went wrong while showing report.');
        	return redirect()->back();
        }
    }

}