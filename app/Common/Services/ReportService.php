<?php 

namespace App\Common\Services;

use App\Models\StudentProgramQuestionModel;
use App\Models\ProgramModel;
use App\Models\GlobalSettingModel;
use App\Models\UsersModel;
use App\Models\PointsTableModel;
use App\Models\StudentProgramsModel;
use App\Common\Services\StudentService;

class ReportService
{
	public function __construct(StudentService $studentService)
	{
		$this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
		$this->ProgramModel 			   = new ProgramModel();
		$this->GlobalSettingModel 		   = new GlobalSettingModel();
		$this->UsersModel 		           = new UsersModel();
		$this->PointsTableModel 		   = new PointsTableModel();
		$this->StudentProgramsModel 	   = new StudentProgramsModel();
		$this->StudentService 	   		   = $studentService;
	}

	public function getReportPoints($type,$grade)
	{
		$arr_points = [];
		$points     = 0;
		if($type!='' && $grade!='')
		{
			$arr_points = $this->PointsTableModel->where('type',$type)->first();
			if(isset($arr_points) && count($arr_points)>0)
			{
				$arr_points = $arr_points->toArray();
				$points = intval($arr_points[$grade]);
			}
		}
		return $points; 
	}

	/**
    * Function  : report_b_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
	* Author    : Akshay Garje
	* Date      : 01/09/2018
    * @return [view] [Report B Calculation]
    */
    public function report_b_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
    {
		$scoreB_points = $given_answer_speed_percentage = 0;

    	if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
    	{
    		$arr_program_details = $this->StudentProgramQuestionModel->whereHas('program_details',function($query) use($program_id){
			    	    												$query->where('id',$program_id);
				    												})
    																->with(['program_details'=>function($query) use($program_id){
				    	    											$query->where('id',$program_id);
				    												}])
				    												 ->with('template'.$template_id)
				    												 ->whereHas('template'.$template_id)
																	 ->where('program_id',$program_id)
													                 ->where('student_id',$student_id)
													                 ->first();

			if(isset($arr_program_details) && count($arr_program_details))
			{
				$arr_program_details = $arr_program_details->toArray();
				sscanf($arr_program_details['template'.$template_id]['duration'], "%d:%d:%d", $q_hours, $q_minutes, $q_seconds);
				$question_time_seconds = isset($q_seconds) ? $q_hours * 3600 + $q_minutes * 60 + $q_seconds : $q_hours * 60 + $q_minutes;
				
				sscanf($arr_program_details['answer_time'], "%d:%d:%d", $hours, $minutes, $seconds);
				$answer_time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

				if($question_time_seconds!=0)
				{
					$given_answer_speed_percentage  = $answer_time_seconds / $question_time_seconds*100;
				}
	            if ($given_answer_speed_percentage<=30 && $given_answer_speed_percentage > 0){
					$scoreB_points =  $this->getReportPoints('score_b','a+');
	            }
	            else if($given_answer_speed_percentage<=50 && $given_answer_speed_percentage > 0){
					$scoreB_points =  $this->getReportPoints('score_b','a');
	            }
	            else if($given_answer_speed_percentage<=70 && $given_answer_speed_percentage > 0){
					$scoreB_points =  $this->getReportPoints('score_b','b');            	
	            }
	            else if($given_answer_speed_percentage<=100 && $given_answer_speed_percentage > 0){
					$scoreB_points =  $this->getReportPoints('score_b','c');            	
	            }
	            else{
					$scoreB_points =  $this->getReportPoints('score_b','d');
	            }
			}
    	}
    	return $scoreB_points;
    }

    /**
    * Function  : report_c_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
	* Author    : Akshay Garje
	* Date      : 01/09/2018
    * @return [view] [Report C Calculation]
    */
    public function report_c_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
    {
    	if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
    	{
    		$wrong_attempt_count = $scoreC_points = 0;
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
			if ($wrong_attempt_count==0){
				$scoreC_points =  $this->getReportPoints('score_c','a+');
			}
            else if($wrong_attempt_count==1){
				$scoreC_points =  $this->getReportPoints('score_c','a');
			}
            else if($wrong_attempt_count==2){
				$scoreC_points =  $this->getReportPoints('score_c','b');
			}
            else if($wrong_attempt_count==3){
				$scoreC_points =  $this->getReportPoints('score_c','c');
			}
			else{
				$scoreC_points =  $this->getReportPoints('score_c','d');
			}
			return $scoreC_points; 
    	}
    }

    /**
    * Function  : report_d_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
	* Author    : Akshay Garje
	* Date      : 01/09/2018
    * @return [view] [Report D Calculation]
    */
    public function report_d_calculation($program_id,$lesson_id,$template_id,$question_id,$student_id)
    {
    	if($program_id!='' && $lesson_id!='' && $template_id!='' && $question_id!='' && $student_id!='')
    	{
			$wrong_attempt_count = $scoreD_points = $given_answer_speed_percentage = 0;

    		$arr_program_details = $this->StudentProgramQuestionModel->whereHas('program_details',function($query) use($program_id){
			    	    												$query->where('id',$program_id);
				    												})
    																->with(['program_details'=>function($query) use($program_id){
				    	    											$query->where('id',$program_id);
				    												}])
				    												 ->with('template'.$template_id)
				    												 ->whereHas('template'.$template_id)
																	 ->where('program_id',$program_id)
													                 ->where('student_id',$student_id)
													                 ->first();

			if(isset($arr_program_details) && count($arr_program_details))
			{
				$arr_program_details = $arr_program_details->toArray();
            	$wrong_attempt_count = $arr_program_details['wrong_attempts'];
				sscanf($arr_program_details['template'.$template_id]['duration'], "%d:%d:%d", $q_hours, $q_minutes, $q_seconds);
				$question_time_seconds = isset($q_seconds) ? $q_hours * 3600 + $q_minutes * 60 + $q_seconds : $q_hours * 60 + $q_minutes;
				
				sscanf($arr_program_details['answer_time'], "%d:%d:%d", $hours, $minutes, $seconds);
				$answer_time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;  
				if($question_time_seconds!=0)
				{
					$given_answer_speed_percentage  = $answer_time_seconds / $question_time_seconds*100;
				}
	            if ($given_answer_speed_percentage<=30 && $given_answer_speed_percentage > 0){
					if ($wrong_attempt_count==0){
						$scoreD_points =  $this->getReportPoints('score_c','a+');         	
		            }
		            else if($wrong_attempt_count==1){
		            	$scoreD_points =  $this->getReportPoints('score_c','a');            	
		            }
		            else if($wrong_attempt_count==2){
		            	$scoreD_points =  $this->getReportPoints('score_c','b');            	
		            }
		            else{
		            	$scoreD_points =  $this->getReportPoints('score_c','c');            	
		            }
	            }
	            else if($given_answer_speed_percentage<=50 && $given_answer_speed_percentage > 0){
					if ($wrong_attempt_count==0){
						$scoreD_points =  $this->getReportPoints('score_c','a+');            	
		            }
		            else if($wrong_attempt_count==1){
		            	$scoreD_points =  $this->getReportPoints('score_c','a');            	
		            }
		            else if($wrong_attempt_count==2){
		            	$scoreD_points =  $this->getReportPoints('score_c','b');            	
		            }
		            else{
		            	$scoreD_points =  $this->getReportPoints('score_c','c');            	
		            }
	            }
	            else if($given_answer_speed_percentage<=70 && $given_answer_speed_percentage > 0){
					if ($wrong_attempt_count==0){
						$scoreD_points =  $this->getReportPoints('score_c','a+');            	
		            }
		            else if($wrong_attempt_count==1){
		            	$scoreD_points =  $this->getReportPoints('score_c','a');            	
		            }
		            else if($wrong_attempt_count==2){
		            	$scoreD_points =  $this->getReportPoints('score_c','b');            	
		            }
		            else{
		            	$scoreD_points =  $this->getReportPoints('score_c','c');            	
		            }            	
	            }
	            else if($given_answer_speed_percentage<=100 && $given_answer_speed_percentage > 0){
					if ($wrong_attempt_count==0){
						$scoreD_points =  $this->getReportPoints('score_c','a+');            	
		            }
		            else if($wrong_attempt_count==1){
		            	$scoreD_points =  $this->getReportPoints('score_c','a');            	
		            }
		            else if($wrong_attempt_count==2){
		            	$scoreD_points =  $this->getReportPoints('score_c','b');            	
		            }
		            else{
		            	$scoreD_points =  $this->getReportPoints('score_c','c');            	
		            }            	
	            }
	            else{
					if ($wrong_attempt_count==0){
						$scoreD_points =  $this->getReportPoints('score_c','a+');            	
		            }
		            else if($wrong_attempt_count==1){
		            	$scoreD_points =  $this->getReportPoints('score_c','a');            	
		            }
		            else if($wrong_attempt_count==2){
		            	$scoreD_points =  $this->getReportPoints('score_c','b');            	
		            }
		            else{
		            	$scoreD_points =  $this->getReportPoints('score_c','c');            	
		            }
	            }
	            return $scoreD_points;
	        }
    	}
    }

    /**
    * Function  : reports_grade($total_question, $student_points,$report)
	* Author    : Akshay Garje
	* Date      : 03/09/2018
    * @return [view] [Get Report B Grade]
    */
    public function reports_grade($total_question,$student_points,$report)
    {
		$grade_A_plus_points =  $total_question * $this->getReportPoints($report,'a+');
		$grade_A_points      =  $total_question * $this->getReportPoints($report,'a');
		$grade_B_points      =  $total_question * $this->getReportPoints($report,'b');            	
		$grade_C_points      =  $total_question * $this->getReportPoints($report,'c');
		$grade_D_points      =  $total_question * $this->getReportPoints($report,'d');
		if($student_points>=$grade_A_plus_points || $student_points>$grade_A_points){
			$grade = 'A+';
		}
		else if($student_points>=$grade_A_points || $student_points>$grade_B_points) {
			$grade = 'A';	
		}
		else if($student_points>=$grade_B_points || $student_points>$grade_C_points) {
			$grade = 'B';	
		}
		else if($student_points>=$grade_C_points) {
			$grade = 'C';	
		}
		else{
			$grade = 'D';	
		}
    	return $grade;
    }

    /**
    * Function  : reports_average_slabs($report_low, $report_high, $report_avg)
	* Author    : Akshay Garje
	* Date      : 03/09/2018
    * @return [view] [Get Report alass average slabls]
    */
    public function reports_average_slabs($report_low, $report_high, $report_avg)
    {
    	$slabls = [];
		$slabls['high'] = round($report_high);
		$slabls['average'] = round($report_avg);
		$slabls['low'] = round($report_low);
    	return $slabls;
    }

    /**
    * Function  : build_program_chart(reportb,_points$report_c_points,$report_d_points,$program_name)
	* Author    : Akshay Garje
	* Date      : 03/09/2018
    * @return [view] [Build the student_chart]
    */
    public function build_program_chart($report_b_points,$report_c_points,$report_d_points,$program_name)
    {
    	$arr_chart = $arr_data = [];
    	$arr_chart['chart'] = ["caption"=>$program_name." ".trans('parent.Performance'),"xaxisname"=> trans('parent.Reports'),"yaxisname"=> trans('parent.Points'),"theme"=> "fusion", "palettecolors"=>"c0db8a,f9a658,ff7b7c,598dfb"];
		$arr_data = [];
		
		$arr_data[0]['label'] = trans('parent.Summative_Assessment'); 
		$arr_data[0]['value'] = $report_b_points;
		$arr_data[1]['label'] = trans('parent.Quantitative_Assessment'); 
		$arr_data[1]['value'] = $report_c_points;
		$arr_data[2]['label'] = trans('parent.Challenge_Program_Assessment'); 
		$arr_data[2]['value'] = $report_d_points;
    	$arr_chart['data'] = $arr_data;
    	return json_encode($arr_chart);
    }  	

    /**
    * Function  : create_program_report($slug,$student_id)
	* Author    : Akshay Garje
	* Date      : 31/08/2018
    * @return [view] [Generate program report]
    */

    public function create_program_report($slug,$student_id,$teacher_id=false)
    {
        $arr_program  = $data = $arr_all_programs = $arr_total_programs = $report_a = $report_b = $report_c = $report_d = [];
        $total_time   = $report_b_student_performace_points = $report_c_student_performace_points = $report_d_student_performace_points = $report_b_class_average_performace = $report_c_class_average_performace = $report_d_class_average_performace = $report_b_global_average_performace = $report_c_global_average_performace = $report_d_global_average_performace = $total_class_students = $total_global_students = $total_students = $report_b_low_class_avg = $report_b_high_class_avg = $report_c_low_class_avg = $report_c_high_class_avg = $report_d_low_class_avg = $report_d_high_class_avg = $report_b_low_global_avg = $report_b_high_global_avg = $report_c_low_global_avg = $report_c_high_global_avg = $report_d_low_global_avg = $report_d_high_global_avg =  0;
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
	    	
            if($teacher_id!=false)
            {
	            $arr_total_programs = $this->StudentProgramsModel->where('student_id', $student_id)
										            ->whereHas('program_details',function($query){
				                                        $query->where('approve_status','approved')->where('status','1');
				                                    })
				                                    ->with(['program_details'=>function($query){
														$query->where('approve_status','approved')->where('status','1');
				            						}])
                                                    ->where('assigned_by', 'teacher')
                                                    ->where('created_by', $teacher_id)
                                                    ->orderBy('id', 'DESC')
                                                    ->get();
            }
            else
            {
		    	$arr_total_programs = $this->StudentProgramQuestionModel->whereHas('program_details',function($query){
	                                        $query->where('approve_status','approved')->where('status','1');
	                                    })
	                                    ->with(['program_details'=>function($query){
											$query->where('approve_status','approved')->where('status','1');
	            						}])
	                                  ->where('student_id',$student_id)
	                                  ->groupBy('program_id')
	                                  ->get();
            }

			if(isset($arr_total_programs) && count($arr_total_programs))
			{
				$arr_total_programs = $arr_total_programs->toArray();
				foreach ($arr_total_programs as $key => $value) {
	   	    		$program_status = $this->StudentService->CheckProgramStatus($arr_program['program_id'],$student_id);
	   	    		if($program_status!='Pending')
	   	    		{
	   	    			array_push($arr_all_programs, $value);
	   	    		}
				}
			}

			if((isset($arr_program) && count($arr_program)) && (isset($arr_all_programs) && count($arr_all_programs)))
			{
				$arr_program      		  = $arr_program->toArray();
				$is_holiday_program       = $arr_program['program_details']['is_holiday_program'];
		   	    $total_time               = $this->StudentService->calculateTotalTimeTakenForProgram($arr_program['program_id'],$student_id);
		   	    $answered_question_count  = $this->StudentService->CheckAnsweredQuestionInProgram($arr_program['program_id'],$student_id);
		   	    $pending_question_count   = $this->StudentService->CheckPendingQuestionInProgram($arr_program['program_id'],$student_id);
		    	
				//Calculation of Stundent Performance Reports
				
		    	$arr_program_questions = $this->StudentProgramQuestionModel->where('program_id',$arr_program['program_id'])
													                      ->where('student_id',$student_id)
													                      ->where('is_answer','yes')
													                      ->get();
				
				if(isset($arr_program_questions) && count($arr_program_questions))
				{
					$arr_program_questions = $arr_program_questions->toArray();
					foreach ($arr_program_questions as $key => $value){
		   	    		$report_b_student_performace_points += $this->report_b_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student_id);
		   	    		$report_c_student_performace_points += $this->report_c_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student_id);
		   	    		$report_d_student_performace_points += $this->report_d_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student_id);
					}
					$report_b['student_performace_points'] = $report_b_student_performace_points;
					$report_b['grade']     				   = $this->reports_grade($answered_question_count+$pending_question_count,$report_b_student_performace_points,'score_b');
					$report_c['student_performace_points'] = $report_c_student_performace_points;
					$report_c['grade']     				   = $this->reports_grade($answered_question_count+$pending_question_count,$report_c_student_performace_points,'score_c');
					$report_d['student_performace_points'] = $report_d_student_performace_points;
					$report_d['grade']     				   = $this->reports_grade($answered_question_count+$pending_question_count,$report_d_student_performace_points,'score_d');
				}
				else
				{
					$report_b['student_performace_points'] = 0;
					$report_b['grade']     				   = "D";
					$report_c['student_performace_points'] = 0;
					$report_c['grade']     				   = "D";
					$report_d['student_performace_points'] = 0;
					$report_d['grade']     				   = "D";	
				}

				// Calculation of class average points
				
				$arr_student = [];
				$arr_student = get_student_list($student_id);

				if(isset($arr_student) && count($arr_student))
				{
					foreach ($arr_student as $key => $student){
				    	$arr_class_program_questions = $this->StudentProgramQuestionModel->where('program_id',$arr_program['program_id'])
															                      ->where('student_id',$student['student_id'])
															                      ->where('is_answer','yes')
															                      ->get();
						if(isset($arr_class_program_questions) && count($arr_class_program_questions))
						{
							$arr_class_program_questions = $arr_class_program_questions->toArray();
			   	    		$total_class_students++;
			   	    		$temp_class_avg_report_b_score = $temp_class_avg_report_c_score = $temp_class_avg_report_d_score = 0;
							foreach ($arr_class_program_questions as $key => $value){
								if(isset($value))
								{
									$temp_class_avg_report_b_score += $this->report_b_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
									$temp_class_avg_report_c_score += $this->report_c_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
									$temp_class_avg_report_d_score += $this->report_d_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
					   	    		$report_b_class_average_performace += $this->report_b_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
					   	    		$report_c_class_average_performace += $this->report_c_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
					   	    		$report_d_class_average_performace += $this->report_d_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
								}
							}
							//Score B
							if(($report_b_low_class_avg > $temp_class_avg_report_b_score) || ($report_b_low_class_avg==0))
							{
								$report_b_low_class_avg = $temp_class_avg_report_b_score;  
							}
							if($report_b_high_class_avg < $temp_class_avg_report_b_score)	
							{
								$report_b_high_class_avg = $temp_class_avg_report_b_score;  
							}

							//Score C
							if(($report_c_low_class_avg > $temp_class_avg_report_c_score) || ($report_c_low_class_avg==0))
							{
								$report_c_low_class_avg = $temp_class_avg_report_c_score;  
							}
							if($report_c_high_class_avg < $temp_class_avg_report_c_score)	
							{
								$report_c_high_class_avg = $temp_class_avg_report_c_score;  
							}

							//Score D
							if(($report_d_low_class_avg > $temp_class_avg_report_d_score) || ($report_d_low_class_avg==0))
							{
								$report_d_low_class_avg = $temp_class_avg_report_d_score;  
							}
							if($report_d_high_class_avg < $temp_class_avg_report_d_score)	
							{
								$report_d_high_class_avg = $temp_class_avg_report_d_score;  
							}
						}
					}
					if($total_class_students==1)
					{
						$report_b_low_class_avg = $report_c_low_class_avg = $report_d_low_class_avg = 0;
					}
					$report_b['class_average_performace'] = $report_b_class_average_performace/$total_class_students;
					$report_b['class_average_slabs']      = $this->reports_average_slabs($report_b_low_class_avg, $report_b_high_class_avg, $report_b['class_average_performace']);
					$report_c['class_average_performace'] = $report_c_class_average_performace/$total_class_students;
					$report_c['class_average_slabs']      = $this->reports_average_slabs($report_c_low_class_avg, $report_c_high_class_avg, $report_c['class_average_performace']);
					$report_d['class_average_performace'] = $report_d_class_average_performace/$total_class_students;
					$report_d['class_average_slabs']      = $this->reports_average_slabs($answered_question_count+$pending_question_count,$report_d['class_average_performace'],'score_d');
					$report_d['class_average_slabs']      = $this->reports_average_slabs($report_d_low_class_avg, $report_d_high_class_avg, $report_d['class_average_performace']);
				}
				else
				{
					$report_b['class_average_performace'] = 0;
					$report_b['class_average_slabs']      = [];
					$report_c['class_average_performace'] = 0;
					$report_c['class_average_slabs']      = [];
					$report_d['class_average_performace'] = 0;
					$report_d['class_average_slabs']      = [];	
				}

				// Calculation of global average points
				
				$arr_global_student = [];
				$arr_global_student = get_student_grade_list($student_id);

				if(isset($arr_global_student) && count($arr_global_student))
				{
					foreach ($arr_global_student as $key => $student){
				    	$arr_global_program_questions = $this->StudentProgramQuestionModel->where('program_id',$arr_program['program_id'])
															                      ->where('student_id',$student['student_id'])
															                      ->where('is_answer','yes')
															                      ->get();
						
						if(isset($arr_global_program_questions) && count($arr_global_program_questions))
						{
							$arr_global_program_questions = $arr_global_program_questions->toArray();
			   	    		$total_global_students++;
			   	    		$temp_global_avg_report_b_score = $temp_global_avg_report_c_score = $temp_global_avg_report_d_score = 0;

							foreach ($arr_global_program_questions as $key => $value){
								$temp_global_avg_report_b_score += $this->report_b_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
								$temp_global_avg_report_c_score += $this->report_c_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
								$temp_global_avg_report_d_score += $this->report_d_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
				   	    		$report_b_global_average_performace += $this->report_b_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
				   	    		$report_c_global_average_performace += $this->report_c_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
				   	    		$report_d_global_average_performace += $this->report_d_calculation($value['program_id'],$value['lesson_id'],$value['template_id'],$value['question_id'],$student['student_id']);
							}

							//Score B
							if(($report_b_low_global_avg > $temp_global_avg_report_b_score) || ($report_b_low_global_avg==0))
							{
								$report_b_low_global_avg = $temp_global_avg_report_b_score;  
							}
							if($report_b_high_global_avg < $temp_global_avg_report_b_score)	
							{
								$report_b_high_global_avg = $temp_global_avg_report_b_score;  
							}

							//Score C
							if(($report_c_low_global_avg > $temp_global_avg_report_c_score) || ($report_c_low_global_avg==0))
							{
								$report_c_low_global_avg = $temp_global_avg_report_c_score;  
							}
							if($report_c_high_global_avg < $temp_global_avg_report_c_score)	
							{
								$report_c_high_global_avg = $temp_global_avg_report_c_score;  
							}

							//Score D
							if(($report_d_low_global_avg > $temp_global_avg_report_d_score) || ($report_d_low_global_avg==0))
							{
								$report_d_low_global_avg = $temp_global_avg_report_d_score;  
							}
							if($report_d_high_global_avg < $temp_global_avg_report_d_score)	
							{
								$report_d_high_global_avg = $temp_global_avg_report_d_score;  
							}
							if($total_global_students==1)
							{
								$report_b_low_global_avg = $report_c_low_global_avg = $report_d_low_global_avg = 0;
							}
						}
					}
					$report_b['global_average_performace'] = $report_b_global_average_performace/$total_global_students;
					$report_b['global_average_slabs']      = $this->reports_average_slabs($report_b_low_global_avg, $report_b_high_global_avg, $report_b['global_average_performace']);
					$report_c['global_average_performace'] = $report_c_global_average_performace/$total_global_students;
					$report_c['global_average_slabs']      = $this->reports_average_slabs($report_c_low_global_avg, $report_c_high_global_avg, $report_c['global_average_performace']);
					if($is_holiday_program=="yes")
					{
					$report_d['global_average_performace'] = $report_d_global_average_performace/$total_global_students;
					$report_d['global_average_slabs']      = $this->reports_average_slabs($report_d_low_global_avg, $report_d_high_global_avg, $report_d['global_average_performace']);
					}
					else
					{
						$report_d['student_performace_points'] = 0;
						$report_d['grade']     				   = "N/A";							
						$report_d['class_average_performace']  = 0;
						$report_d['class_average_slabs']       = [];							
						$report_d['global_average_performace'] = 0;
						$report_d['global_average_slabs']      = [];	
					}
				}
				else
				{
					$report_b['global_average_performace'] = 0;
					$report_b['global_average_slabs']      = [];
					$report_c['global_average_performace'] = 0;
					$report_c['global_average_slabs']      = [];
					$report_d['global_average_performace'] = 0;
					$report_d['global_average_slabs']      = [];	
				}
				// Build Student Chart
				$program_chart = $this->build_program_chart($report_b['student_performace_points'],$report_c['student_performace_points'],$report_d['student_performace_points'],ucwords($arr_program['program_details']['name']));
		   	    $data['report_b']  	   				= $report_b;
		   	    $data['report_c']  	   				= $report_c;
		   	    $data['report_d']  	   				= $report_d;
		   	    $data['program_chart']  	   		= $program_chart;
		   	    $data['arr_program']  	   			= $arr_program;
		   	    $data['arr_all_programs']  			= $arr_all_programs;
		   	    $data['total_time']        			= $total_time;
		   	    $data['answered_question_count']    = $answered_question_count;
		   	    $data['pending_question_count']     = $pending_question_count;
		   	    $data['program_name']      			= ucwords($arr_program['program_details']['name']);
		   	    $data['slug']     	       			= $slug;
		   	    $data['pageTitle']         			= trans('parent.Program_Report');
			    return $data;
			}
		}
		return "error";
    }
}

?>