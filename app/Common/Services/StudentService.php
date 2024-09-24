<?php 

namespace App\Common\Services;

use App\Models\StudentProgramQuestionModel;
use App\Models\GlobalSettingModel;
use App\Models\ProgramModel;

class StudentService
{
	public function __construct()
	{
		$this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
		$this->ProgramModel 			   = new ProgramModel();
		$this->GlobalSettingModel 		   = new GlobalSettingModel();
	}

	public function get_program_id($program_slug)
	{
		if(isset($program_slug) && $program_slug!='')
		{
			$arr_slug = [];
			$arr_slug = $this->ProgramModel->where('slug',$program_slug)->first();		
			if(count($arr_slug)>0)
			{
				return $arr_slug['id'];
			}
		}
		return false; 
	}

	public function getTotalQuestionCount($program_id,$lesson_id,$student_id)
	{
		if($program_id!='' && $lesson_id!='' && $student_id!='')
		{
			$total_question_count = 0;
			$total_question_count = $this->StudentProgramQuestionModel->where('program_id',$program_id)
						                                          	  ->where('lesson_id',$lesson_id)
						                                              ->where('student_id',$student_id)
						                                              ->count();
			return $total_question_count;
		}
		return 0; 
	}

	public function getTotalLessonQuestions($program_id,$lesson_id,$student_id)
	{
		if($program_id!='' && $lesson_id!='' && $student_id!='')
		{
			$arr_questions = [];
			$arr_questions = $this->StudentProgramQuestionModel->where('program_id',$program_id)
						                                          	  ->where('lesson_id',$lesson_id)
						                                              ->where('student_id',$student_id)
						                                              ->get();
			if(isset($arr_questions) && count($arr_questions)>0)
			{
				return $arr_questions->toArray();
			}
		}
		return false; 
	}

	public function checkDailyLessonLimit($student_id)
	{
		$lesson_count  = 0;
		if($student_id!='')
		{
			$todaysDate = date('Y-m-d');
			$arr_questions = [];
			$arr_questions = $this->StudentProgramQuestionModel->where('student_id',$student_id)
									                           ->where('is_answer','yes')
									                           ->whereDate('answer_date', '=', $todaysDate)
									                           ->orderBy('id','ASC')
									                           ->distinct('lesson_id')
									                           ->distinct('group_id')
															   ->groupBy('lesson_id')
									                           ->get();

			if(isset($arr_questions) && count($arr_questions)>0)
			{
				$arr_questions = $arr_questions->toArray();
				foreach ($arr_questions as $key => $value) {
					$total_lesson_count = $this->StudentProgramQuestionModel->where('program_id',$value['program_id'])
																	  		->where('lesson_id',$value['lesson_id'])
																	  		->where('student_id',$student_id)
																	  		->count();

					$total_lesson_completed = $this->StudentProgramQuestionModel->where('program_id',$value['program_id'])
																		  		->where('lesson_id',$value['lesson_id'])
																		  		->where('student_id',$student_id)
										                           		  		->where('is_answer','yes')
																		  		->count();
					
					if($total_lesson_count == $total_lesson_completed)
					{
						$lesson_count++;
					}
				}
			}
		}
		return $lesson_count; 
	}

	public function CheckProgramStatus($program_id, $student_id)
	{
		$lesson_status = 'Pending';
		$status = 0;

		$total_count 				 = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->count();

		$current_status_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('is_answer','yes')
																		 ->count();

		if( $current_status_count == 1 ) {
			$lesson_status = 'On-Going';
		} else if( $total_count == $current_status_count ) {
			$lesson_status = 'Completed';
		} else {
			$lesson_status = 'Pending';
		}
		return $lesson_status;
	}

	public function globalDailyLessonLimit()
	{
		$count = 0;
		$arr_settings = [];
		$arr_settings = $this->GlobalSettingModel->first();

		if(isset($arr_settings) && count($arr_settings))
		{
			$arr_settings = $arr_settings->toArray();
			$count = $arr_settings['daily_lesson_limit'];
		}
		return $count;
	}

	public function getProgramSlug($program_id)
	{
		if($program_id!='')
		{
			$arr_program = [];
			$arr_program = $this->ProgramModel->where('id',base64_decode($program_id))->first();

			if(isset($arr_program) && count($arr_program))
			{
				$arr_program = $arr_program->toArray();
				return $arr_program['slug'];
			}
		}
		return false;
	}

	public function calculateTotalTimeTakenForProgram($program_id, $student_id)
	{
		$no_of_hours = "00:00:00";
		if($program_id!='' && $student_id!='')
		{
			$arr_hours = $this->StudentProgramQuestionModel->where('student_id','=',$student_id)
												 			 ->where('program_id','=',$program_id)
							                     			 ->selectRaw('SEC_TO_TIME(SUM(answer_time)) as time')
							                     			 ->first();
			if(isset($arr_hours) && count($arr_hours))
			{
				$arr_hours = $arr_hours->toArray();
				$no_of_hours = $arr_hours['time'];
			}
		}
		return $no_of_hours;
	}

	public function getSubjectName($program_id,$student_id)
	{
		$subject_id = '';
		if($program_id!='' && $student_id!='')
		{
			$arr_program = [];
    	    $arr_program = $this->StudentProgramQuestionModel->whereHas('program_details',function($query) use($program_id){
	    												$query->where('approve_status','approved')->where('status','1')->where('id',$program_id);
	    												$query->whereHas('subjectData');
    												})
    											 ->with(['program_details'=>function($query) use($program_id){
    	    											$query->where('approve_status','approved')->where('status','1')->where('id',$program_id);
    	    											$query->with('subjectData');
    												}])
						                         ->where('student_id',$student_id)
						                         ->first();
			if(isset($arr_program) && count($arr_program))
			{
				$arr_program = $arr_program->toArray();
				$subject_id  = base64_encode($arr_program['program_details']['subject_data']['id']);
			}
		}
		return $subject_id;
	}

	public function CheckAnsweredQuestionInProgram($program_id, $student_id)
	{
		$answered_question_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('is_answer','yes')
																		 ->count();
		return $answered_question_count;
	}

	public function CheckPendingQuestionInProgram($program_id, $student_id)
	{
		$pending_question_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('is_answer','no')
																		 ->count();
		return $pending_question_count;
	}		

	public function CheckRightAnswerPercentage($program_id, $student_id)
	{
		$right_status = 0;

		$total_count 				 = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->count();

		$current_status_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('is_delay','no')
																		 ->where('wrong_attempts','=',0)
																		 ->count();

		if( $current_status_count > 0 ) {
			$right_status = round(($current_status_count / $total_count) * 100);
		}
		return $right_status;
	}

	public function CheckWrongAnswerPercentage($program_id, $student_id)
	{
		$wrong_status = 0;

		$total_count 				 = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->count();

		$current_status_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('wrong_attempts','>',0)
																		 ->count();
		if( $current_status_count > 0 ) {
			$wrong_status = round(($current_status_count / $total_count) * 100);
		}
		return $wrong_status;
	}

	public function CheckDelayAnswerPercentage($program_id, $student_id)
	{
		$delay_status = 0;

		$total_count 				 = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->count();

		$current_status_count        = $this->StudentProgramQuestionModel->where('program_id',$program_id)
																		 ->where('student_id',$student_id)
																		 ->where('is_delay','yes')
																		 ->count();

		if( $current_status_count > 0 ) {
			$delay_status = round(($current_status_count / $total_count) * 100);
		}
		return $delay_status;
	}	

}

?>