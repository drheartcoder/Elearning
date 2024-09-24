<?php

use App\Models\StudentProgramQuestionModel;
use App\Models\UsersModel;
use App\Models\ClassroomStudentModel;
use App\Models\StudentDetailsModel;
function CheckLessonStatus($program_id,$lesson_id,$student_id)
{
	$lesson_status = 'Pending';
	if($program_id!='' && $lesson_id!='' && $student_id!='')
	{
		$status = 0;
		$StudentProgramQuestionModel = new StudentProgramQuestionModel(); 
		$total_count 				 = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('lesson_id',$lesson_id)
																	->where('student_id',$student_id)
																	->count();
		$current_status_count        = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('lesson_id',$lesson_id)
																	->where('student_id',$student_id)
																	->where('is_answer','yes')->count();
		
		if($current_status_count==1 && $total_count!=1){
			$lesson_status = 'On-Going';
		}
		else if($total_count == $current_status_count){
			$lesson_status = 'Completed';
		}
		else{
			$lesson_status = 'Pending';
		}
	}
	return $lesson_status;
}

function checkProgramStatus($program_id,$student_id)
{
	$lesson_status = 'Pending';
	if($program_id!='' && $student_id!='')
	{
		$StudentProgramQuestionModel = new StudentProgramQuestionModel(); 
		$total_count 				 = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('student_id',$student_id)
																	->count();
		$current_status_count        = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('student_id',$student_id)
																	->where('is_answer','yes')->count();
		
		if($current_status_count==1 && $total_count!=1){
			$lesson_status = 'On-Going';
		}
		else if($total_count == $current_status_count){
			$lesson_status = 'Completed';
		}
		else{
			$lesson_status = 'Pending';
		}
	}
	return $lesson_status;
}

function QuestionCountInProgram($program_id,$student_id)
{
	$total_count = 0;
	if($program_id!='' && $student_id!='')
	{
		$status = 0;
		$StudentProgramQuestionModel = new StudentProgramQuestionModel(); 
		$total_count 				 = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('student_id',$student_id)
																	->count();
	}
	return $total_count;
}

function LessonCountInProgram($program_id,$student_id)
{
	$total_count = 0;
	if($program_id!='' && $student_id!='')
	{
		$status = 0;
		$StudentProgramQuestionModel = new StudentProgramQuestionModel(); 
		$total_count 				 = $StudentProgramQuestionModel->where('program_id',$program_id)
																	->where('student_id',$student_id)
																	->distinct('lesson_id')
																	->groupBy('lesson_id')
																	->get();
		if(isset($total_count) && count($total_count)>0)
		{
			$total_count = $total_count->toArray();
			$total_count = count($total_count);	
		}
	}
	return $total_count;
}

function options_array_shuffle($string)
{
	$arr_options = [];
	$arr_options = explode(',', $string);
	shuffle($arr_options);
	return $arr_options;
}

function get_remainin_word($arr_word = [], $arr_position = [])
{
	$arr_new_word = [];
	if(count($arr_word)>0 && count($arr_position)>0)
	{
        foreach($arr_word as $word_key => $val){
        	foreach($arr_position as $position_key => $position_val){
				if($word_key==$position_key){
					if($position_val==1){
						array_push($arr_new_word, $val);
					}
				}        		
        	}
        }
	}
	if(count($arr_new_word)>0){
		return implode('', $arr_new_word);
	}
	return 'N/A';
}

function get_maxlength($arr_answer)
{
	$maxlength = 0;
	if(count($arr_answer)>0)
	{
    	foreach($arr_answer as $key => $val){
			if($maxlength < strlen($val)){
				$maxlength = strlen($val);
			}        		
    	}
	}
	return $maxlength;
}

function calculate_word_count($string,$answer)
{
	$wordcount = 0; $arr_words = [];
	if($string!='')
	{
		$arr_words = explode(' ', $string);
		if(count($arr_words)>0)
		{
	    	foreach($arr_words as $key => $val){
				if(substr($val, 0, strlen($answer)) === $answer)
				{
					$wordcount++;
				}
	    	}
		}
	}
	return $wordcount;
}

function get_program_list($student_id)
{
	$arr_programs = [];
    if($student_id!='')
    {
	  $StudentProgramQuestionModel = new StudentProgramQuestionModel();
      $arr_programs =   $StudentProgramQuestionModel->whereHas('program_details',function($query){
                                                      $query->where('approve_status','approved')->where('status','1');
                                                })
                                                ->with(['program_details'=>function($query){
                                                      $query->where('approve_status','approved')->where('status','1');
                                                }])
                                              ->where('student_id',$student_id)
                                              ->groupBy('program_id')
                                              ->get();
                                              
      if(isset($arr_programs) && count($arr_programs)>0)
      {
        $arr_programs = $arr_programs->toArray();
      }
      return $arr_programs;
    }
}
function get_academic_year($student_id)
{
	$arr_range = $arr_year_range = [];
	$previous_year = '';
	$obj_user      = UsersModel::where('id','=',$student_id)->select('id','created_at')->first();
	if($obj_user)
	{
		$previous_year = isset($obj_user->created_at)?date('Y',strtotime($obj_user->created_at)):'';
	}
	$current_year = date('Y',strtotime('+1 years'));
	$arr_range    = range($previous_year,$current_year);
	if(isset($previous_year) && $previous_year!="")
	{
		$new_previous_year = (int)$previous_year;
		for($i = $new_previous_year ; $i < $current_year; $i++)
		{	
			if(isset($i) && $i!="")
			{
			  $j = $i+1;
		      $arr_year_range[] = $i.'-'.$j;
			}
		}
	}
	
	return $arr_year_range;
}
function get_grade($point)
{
	
  if($point>=60)
  {
    return 'A+';
  }
  elseif($point>=50 || $point>=40)
  {
    return 'A';
  }
  elseif($point==30)
  {
    return 'B';
  }
  elseif($point==20)
  {
    return 'c';
  }
  elseif ($point<=10) 
  {
    return 'D';
  }
  elseif ($point==0) 
  {
    return '';
  }
}

function get_student_list($user_id=false)
{
	$arr_student    = [];
	$classroom_id   = '';
	if($user_id!=false)
	{
		$obj_classroom  = ClassroomStudentModel::where('student_id','=',$user_id)->select('id','classroom_id')
																			   ->first();
		if(isset($obj_classroom->classroom_id) && $obj_classroom->classroom_id!="")
		{
			$classroom_id = $obj_classroom->classroom_id;
		}
		$obj_student  =  ClassroomStudentModel::where('classroom_id','=',$classroom_id)
											->where('is_active','=','active')
											->select('id','student_id')
											->groupBy('student_id')
											->get();
	}
	else
	{
		$obj_student  =  ClassroomStudentModel::where('is_active','=','active')
												->select('id','student_id')
												->groupBy('student_id')
												->get();
	}
	if($obj_student)
	{
		$arr_student  =  $obj_student->toArray();
	}
	return $arr_student;
}

function get_student_grade_list($user_id)
{
	$arr_student    = [];
	$classroom_id   = $grade_id = $subject_id ='';
	if($user_id!=false)
	{
		$obj_grade_details  = StudentDetailsModel::where('student_id','=',$user_id)->first();

		if(isset($obj_grade_details->id) && $obj_grade_details->id!="")
		{
			$grade_id   = $obj_grade_details->grade_id;
			$subject_id = $obj_grade_details->subject_id;
		}
		$obj_student  =  StudentDetailsModel::where('grade_id','=',$grade_id)
											->where('subject_id','=',$subject_id)
											->select('id','student_id','grade_id','subject_id')
											->groupBy('student_id')
											->get();
		if($obj_student)
		{
			$arr_student  =  $obj_student->toArray();
		}
	}
	return $arr_student;
}
function get_student_list_by_parent($parent_id)
{
		$arr_student  = [];
		$obj_student  =  StudentDetailsModel::where('parent_id','=',$parent_id)
											->select('id','student_id','grade_id','subject_id')
											->with(['user_data'=>function($q1){
												$q1->select('id','first_name','last_name');
											}])
											->groupBy('student_id')
											->get();
		if($obj_student)
		{
			$arr_student  =  $obj_student->toArray();
		}	
		return $arr_student;
}
?>