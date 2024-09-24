<?php

use App\Models\UsersModel;
use App\Models\NotificationsModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\SubscriptionPlanModel;
use App\Models\StudentDetailsModel;
use App\Models\GlobalSettingModel;
use App\Models\ClassroomsModel;
use App\Models\ClassroomStudentModel;
use App\Models\CurrencyModel;
use App\Models\ProgramModel;
use App\Models\LessonModel;
use App\Models\StudentProgramQuestionModel;

use App\Models\Template1Model;
use App\Models\Template2Model;
use App\Models\Template3Model;
use App\Models\Template4Model;
use App\Models\Template5Model;
use App\Models\Template6Model;
use App\Models\Template7Model;
use App\Models\Template8Model;
use App\Models\Template9Model;
use App\Models\Template10Model;
use App\Models\Template11Model;
use App\Models\Template12Model;
use App\Models\Template13Model;
use App\Models\Template14Model;
use App\Models\Template15Model;
use App\Models\Template16Model;
use App\Models\Template17Model;
use App\Models\Template18Model;
use App\Models\Template19Model;
use App\Models\Template20Model;
use App\Models\Template21Model;
use App\Models\Template22Model;
use App\Models\Template23Model;
use App\Models\Template24Model;
use App\Models\Template25Model;
use App\Models\Template26Model;
use App\Models\Template27Model;
use App\Models\Template28Model;
use App\Models\Template29Model;
use App\Models\Template30Model;
use App\Models\Template31Model;
use App\Models\Template32Model;
use App\Models\Template33Model;
use App\Models\Template34Model;
use App\Models\Template35Model;
use App\Models\Template36Model;
use App\Models\Template37Model;
use App\Models\Template38Model;
use App\Models\Template39Model;
use App\Models\Template40Model;
use App\Models\Template41Model;
use App\Models\Template42Model;
use App\Models\Template43Model;
use App\Models\Template44Model;
use App\Models\Template45Model;
use App\Models\Template46Model;
use App\Models\Template47Model;
use App\Models\Template48Model;
use App\Models\Template49Model;
use App\Models\Template50Model;
use App\Models\TransactionsModel;



function validate_login($type)
{
	$auth = auth()->guard($type); 
	$user_auth = false;
	if($auth->check())
	{
		$user_auth = $auth->check();
	}
	
	return $user_auth;
}

/*
| Author    : Deepak Bari
| Function  : Get login user details.
*/

function login_user_details($type)
{
	return auth()->guard($type)->user();
}

function login_user_id($type)
{
	return auth()->guard($type)->user()->id;
}

function get_unread_notifications($user_id = false)
{
	if($user_id != false)
	{
		$obj_notifications = NotificationsModel::where('to_user_id',$user_id)
		->where('is_read','0')
		->orderBy('created_at','DESC')
		->get();

		if($obj_notifications)
		{
			return $obj_notifications->toArray();
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

// Get Subject Translation
function get_subject_translation($id=false,$lang=false)
{
	$arr_trans=[];
	if($id != false && $lang != false)
	{
		$obj_trans = SubjectTranslationModel::where('locale',$lang)
											->where('subject_id',$id)							
											->first();

		if($obj_trans)
		{
			$arr_trans = $obj_trans->toArray();
			return $arr_trans['name'];

		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}		
}

// Get Grade Translation
function get_grade_translation($id=false,$lang=false)
{
	$arr_trans=[];
	if($id != false && $lang != false)
	{
		$obj_trans = GradeTranslationModel::where('locale',$lang)
											->where('grade_id',$id)							
											->first();

		if($obj_trans)
		{
			$arr_trans = $obj_trans->toArray();
			return $arr_trans['name'];

		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}		
}

/*
| Function  :
| Author    : Deepak Arvind Salunke
| Date      : 29/06/2018
| Output    : Success or Error
*/

function RandomPin()
{
	$random_number = '';
	$digits_needed = 4;
	$count         = 0;
	while ( $count < $digits_needed ) 
	{
		$random_digit = rand(0,9);
		$random_number .= $random_digit;
		$count++;
	}

	$is_pin_exits = UsersModel::where('pin', $random_number)->count();
	if ($is_pin_exits > 0)
	{
		$random_number = RandomPin();
	}

	return $random_number;
} // end RandomPin


/*
| Function  : Generate OTP
| Author    : Deepak Arvind Salunke
| Date      : 11/07/2018
| Output    : Return OTP
*/

function GenerateOTP()
{
	$random_otp    = '';
	$digits_needed = 6;
	$count         = 0;
	while ( $count < $digits_needed ) 
	{
		$random_digit = rand(0,9);
		$random_otp .= $random_digit;
		$count++;
	}

	$is_otp_exits = UsersModel::where('password_reset_code', $random_otp)->count();
	if ($is_otp_exits > 0)
	{
		$random_otp = GenerateOTP();
	}

	return $random_otp;
} // end GenerateOTP




function makeTemplateIdArray($template_id = '')
{
	$makeTemplateIdArray = [];
	if($template_id!='')
	{
		$makeTemplateIdArray = explode(',', $template_id);
	}	
	return $makeTemplateIdArray;
}


// Get Plan Details
function getPlanDetails($id=false)
{
	$pan_details_arr = [];
	$locale = \App::getLocale();
	if($id!=false)
	{
		$pan_details_obj = SubscriptionPlanModel::with(['subscription_plan_translation'=>function($q) use ($locale){
													      	$q->where('locale', $locale);
													      }])->where('id',$id)
															 ->first();	
		if(count($pan_details_obj)>0)															 
		{
			$pan_details_arr = $pan_details_obj->toArray();
		}
	}														 

	return $pan_details_arr;
}

// Get Plan Details
function getUserDetails($id=false)
{
	$user_details_arr=[];
	if($id!=false)
	{
		$user_details_obj = UsersModel::where('id',$id)->first();	
		if(count($user_details_obj)>0)
		{
			$user_details_arr = $user_details_obj->toArray();
		}
	}														 

	return $user_details_arr;
}

function getGlobalSetting()
{
	$arr_global_setting = [];

	$obj_global_setting = GlobalSettingModel::first();
	if($obj_global_setting)
	{
		$arr_global_setting = $obj_global_setting->toArray();
	}

	return $arr_global_setting;
}

// Get all the student added by the Parent
function getParentsAddedStudent($id = false)
{
	$arr_student = [];

	if( $id != false )
	{
		$obj_child = StudentDetailsModel::where('parent_id', $id)
										->select('id', 'parent_id', 'student_id', 'subject_id', 'grade_id')
										->get();
		if($obj_child)
		{
			$arr_child = $obj_child->toArray();

			foreach ($arr_child as $key => $child) 
			{
				$obj_student = UsersModel::where('id',$child['student_id'])
										 ->where('user_type', 'student')
										 ->select('id','user_type','first_name','last_name','pin')
										 ->first();	

				if(count($obj_student) > 0)
				{
					$arr_student[$key] = $obj_student->toArray();
					
					$arr_student[$key]['subject_id'] = $child['subject_id'];
					$arr_student[$key]['grade_id']   = $child['grade_id'];
				}
			}
		}
	}
	
	return $arr_student;
}


// Get all the classes added by the teacher
function getTeachersAddedClasses($id = false)
{
	$arr_classes = [];

	if( $id != false )
	{
		$obj_classes = ClassroomsModel::where('teacher_id', $id)->where('is_transfer', 'no')->where('status', '1')->get();
		if($obj_classes)
		{
			$arr_classes = $obj_classes->toArray();
		}
	}
	
	return $arr_classes;
}

// Get all the classes students under the teacher
function getTeachersAllStudents($id = false)
{
	$arr_students = [];

	if( $id != false )
	{
		$obj_stud = ClassroomStudentModel::where('teacher_id', $id)->where('is_active', 'active')->get();
		if($obj_stud)
		{
			$arr_stud = $obj_stud->toArray();

			foreach ($arr_stud as $key => $stud) 
			{
				$obj_student = UsersModel::where('id',$stud['student_id'])
										 ->where('user_type', 'student')
										 ->select('id','user_type','first_name','last_name','pin')
										 ->first();	

				if(count($obj_student) > 0)
				{
					$arr_students[$key] = $obj_student->toArray();
				}
			}
		}
	}

	return $arr_students;
}


// Get all the student added by the Parent
function getStudentAssginClasses($id = false)
{
	$arr_classes = [];

	if( $id != false )
	{
		$obj_stud = ClassroomStudentModel::where('student_id', $id)->where('is_active', 'active')->get();
		if($obj_stud)
		{
			$arr_stud = $obj_stud->toArray();

			foreach ($arr_stud as $key => $stud) 
			{
				$obj_classes = ClassroomsModel::where('id',$stud['classroom_id'])
											  /*->select('id','user_type','first_name','last_name','pin')*/
											  ->first();	

				if(count($obj_classes) > 0)
				{
					$arr_classes[$key] = $obj_classes->toArray();
				}
			}
		}
	}
	
	return $arr_classes;
}


function getGradeFromSubject($subject_id = false)
{
	$arr_grade = [];
	if($subject_id!=false)
	{
		$obj_grade = GradeModel::where('subject', $subject_id)->where('status','1')->get();
		if($obj_grade)
		{
			$arr_grade = $obj_grade->toArray();
		}
		return $arr_grade;
	}	

	return $arr_grade;
}

// Get Active Plan 
function getActiveMembershipPlan($userid = false)
{
	$obj_transactions = '';
	$arr_transactions = [];
	if($userid!=false)
	{
		$obj_transactions = TransactionsModel::where('user_id', $userid)
 												->where('status', 'active')
                                                ->orderBy('id', 'DESC')
                                                ->first();
		if($obj_transactions)
		{
			 $arr_transactions = $obj_transactions->toArray();
		}	
		return $arr_transactions;	
	}	

	return $arr_transactions;	
}


function getGradeOptions($subject_id = false, $grade_id = false)
{
	$html       = '';
    $arr_grade  = [];

	$obj_grade = GradeModel::where('subject', $subject_id)->where('status', '1')->get();
    if($obj_grade)
    {
        $arr_grade = $obj_grade->toArray();

        $html .= '<option value="">'.trans('parent.Select_Grade').'</option>';
        foreach ($arr_grade as $key => $grade)
        {
            if($grade_id == $grade["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.$grade['id'].'" '.$selected.'>'.$grade['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Grade_available').'</option>';
    }

    return $html;
}

function getProgramOptions($subject_id = false, $grade_id = false, $program_id = false)
{
	$html        = '';
	$arr_program = [];
	
	$obj_program = ProgramModel::where('subject', $subject_id)->where('grade', $grade_id)->where('status', '1')->where('approve_status', 'approved')->get();
	
    if($obj_program)
    {
        $arr_program = $obj_program->toArray();

        $html .= '<option value="">'.trans('parent.Select_Program').'</option>';
        foreach ($arr_program as $key => $program)
        {
            if($program_id == $program["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.$program['id'].'" '.$selected.'>'.$program['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Program_available').'</option>';
    }

    return $html;
}

function getEncGradeOptions($enc_subject_id = false, $enc_grade_id = false)
{
	$html       = '';
	$subject_id = base64_decode($enc_subject_id);
	$grade_id   = base64_decode($enc_grade_id);

	$obj_grade = GradeModel::where('subject', $subject_id)->where('status', '1')->get();
    if($obj_grade)
    {
        $arr_grade = $obj_grade->toArray();

        $html .= '<option value="">'.trans('parent.Select_Grade').'</option>';
        foreach ($arr_grade as $key => $grade)
        {
            if($grade_id == $grade["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.base64_encode($grade['id']).'" '.$selected.'>'.$grade['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Grade_available').'</option>';
    }

    return $html;
}

function getEncProgramOptions($enc_subject_id = false, $enc_grade_id = false, $enc_program_id = false)
{
	$html       = '';
	$subject_id = base64_decode($enc_subject_id);
	$grade_id   = base64_decode($enc_grade_id);
	$program_id = base64_decode($enc_program_id);
	
	$obj_program = ProgramModel::where('subject', $subject_id)->where('grade', $grade_id)->where('status', '1')->where('approve_status', 'approved')->get();
    if($obj_program)
    {
        $arr_program = $obj_program->toArray();

        $html .= '<option value="">'.trans('parent.Select_Program').'</option>';
        foreach ($arr_program as $key => $program)
        {
            if($program_id == $program["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.base64_encode($program['id']).'" '.$selected.'>'.$program['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Program_available').'</option>';
    }

    return $html;
}

function getEncLessonOptions($enc_subject_id = false, $enc_grade_id = false, $enc_program_id = false, $enc_lesson_id = false)
{
	$arr_lesson = [];
	$html       = '';
	$subject_id = base64_decode($enc_subject_id);
	$grade_id   = base64_decode($enc_grade_id);
	$program_id = base64_decode($enc_program_id);
	$lesson_id  = base64_decode($enc_lesson_id);
	
	$obj_lesson = LessonModel::where('program_id', $program_id)->get();
    if($obj_lesson)
    {
        $arr_lesson = $obj_lesson->toArray();
        
        $html .= '<option value="">'.trans('parent.Select_Lesson').'</option>';
        foreach ($arr_lesson as $key => $lesson)
        {
            if($lesson_id == $lesson["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.base64_encode($lesson['id']).'" '.$selected.'>'.$lesson['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Lesson_available').'</option>';
    }

    return $html;
}

function getEncStundentLessonOptions($enc_subject_id = false, $enc_grade_id = false, $enc_program_id = false, $enc_lesson_id = false)
{
	$arr_lesson = [];
	$html       = '';
	$subject_id = base64_decode($enc_subject_id);
	$grade_id   = base64_decode($enc_grade_id);
	$program_id = base64_decode($enc_program_id);
	$lesson_id  = base64_decode($enc_lesson_id);
	
	$arr_lesson = GetCompletedLessons($program_id);
    if($arr_lesson)
    {

        $html .= '<option value="">'.trans('parent.Select_Lesson').'</option>';
        foreach ($arr_lesson as $key => $lesson)
        {
            if($lesson_id == $lesson["id"])
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }

            $html .= '<option value="'.base64_encode($lesson['id']).'" '.$selected.'>'.$lesson['name'].'</option>';
        }
    }
    else
    {
        $html = '<option value="">'.trans('parent.No_Lesson_available').'</option>';
    }

    return $html;
}

function GetCompletedLessons($program_id)
{
	$arr_lessons = [];
	$student_id  = Auth::user()->id;
	if($program_id!='' && $student_id!='')
	{
    	$arr_programs = StudentProgramQuestionModel::where('program_id',$program_id)
                                  ->where('student_id',$student_id)
								  ->whereHas('lessonData')
								  ->with('lessonData')
                                  ->distinct('lesson_id')
                                  ->groupBy('lesson_id')
                                  ->get();

        if(isset($arr_programs) && count($arr_programs)>0)
        {
        	$arr_programs = $arr_programs->toArray();
        	foreach ($arr_programs as $key => $value) {
				$total_count 				 = StudentProgramQuestionModel::where('program_id',$value['program_id'])
																			->where('lesson_id',$value['lesson_id'])
																			->where('student_id',$student_id)
																			->count();

				$current_status_count        = StudentProgramQuestionModel::where('program_id',$value['program_id'])
																			->where('lesson_id',$value['lesson_id'])
																			->where('student_id',$student_id)
																			->where('is_answer','yes')
																			->count();
				
				if($total_count == $current_status_count){
					array_push($arr_lessons, $value['lesson_data']);
				}
        	}
        }

	}
	return $arr_lessons;
}

function GenerateEnrollmentCode()
{
	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 15) as $k) $rand .= $seed[$k];

	$is_code_exits = UsersModel::where('enrollment_code', $rand)->count();
	if ($is_code_exits > 0)
	{
		$rand = GenerateEnrollmentCode();
	}

	return $rand;
}

// Get Currency Code
function getCurrency($id=false)
{
	$currecy_code = [];
	if($id!=false)
	{		
		$currecy_code = CurrencyModel::where('id',$id)->first();

		return $currecy_code;
	}
	return $currecy_code;
}

function getClassData($enc_class_id = false)
{
	$arr_class = [];

	if( isset($enc_class_id) && !empty($enc_class_id) && $enc_class_id != '')
	{
		$class_id  = base64_decode($enc_class_id);
		
		$obj_class = ClassroomsModel::where('id', $class_id)->first();
		if($obj_class)
		{
			$arr_class = $obj_class->toArray();
		}
	}
	return $arr_class;
}

function getQuestionInfo($template_id='',$question_id='')
{
	$getQuestionInfo = [];
	if($template_id!='' && $question_id!='')
	{
		if($template_id==1)
		{
			$getQuestionInfo = Template1Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==2)
		{
			$getQuestionInfo = Template2Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==3)
		{
			$getQuestionInfo = Template3Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==4)
		{
			$getQuestionInfo = Template4Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==5)
		{
			$getQuestionInfo = Template5Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==6)
		{
			$getQuestionInfo = Template6Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==7)
		{
			$getQuestionInfo = Template7Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==8)
		{
			$getQuestionInfo = Template8Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==9)
		{
			$getQuestionInfo = Template9Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==10)
		{
			$getQuestionInfo = Template10Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==11)
		{
			$getQuestionInfo = Template11Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==12)
		{
			$getQuestionInfo = Template12Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==13)
		{
			$getQuestionInfo = Template13Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==14)
		{
			$getQuestionInfo = Template14Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==15)
		{
			$getQuestionInfo = Template15Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==16)
		{
			$getQuestionInfo = Template16Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==17)
		{
			$getQuestionInfo = Template17Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==18)
		{
			$getQuestionInfo = Template18Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==19)
		{
			$getQuestionInfo = Template19Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==20)
		{
			$getQuestionInfo = Template20Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==21)
		{
			$getQuestionInfo = Template21Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==22)
		{
			$getQuestionInfo = Template22Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==23)
		{
			$getQuestionInfo = Template23Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==24)
		{
			$getQuestionInfo = Template24Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==25)
		{
			$getQuestionInfo = Template25Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==26)
		{
			$getQuestionInfo = Template26Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==27)
		{
			$getQuestionInfo = Template27Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==28)
		{
			$getQuestionInfo = Template28Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==29)
		{
			$getQuestionInfo = Template29Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==30)
		{
			$getQuestionInfo = Template30Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==31)
		{
			$getQuestionInfo = Template31Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==32)
		{
			$getQuestionInfo = Template32Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==33)
		{
			$getQuestionInfo = Template33Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==34)
		{
			$getQuestionInfo = Template34Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==35)
		{
			$getQuestionInfo = Template35Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==36)
		{
			$getQuestionInfo = Template36Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==37)
		{
			$getQuestionInfo = Template37Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==38)
		{
			$getQuestionInfo = Template38Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==39)
		{
			$getQuestionInfo = Template39Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==40)
		{
			$getQuestionInfo = Template40Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==41)
		{
			$getQuestionInfo = Template41Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==42)
		{
			$getQuestionInfo = Template42Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==43)
		{
			$getQuestionInfo = Template43Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==44)
		{
			$getQuestionInfo = Template44Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==45)
		{
			$getQuestionInfo = Template45Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==46)
		{
			$getQuestionInfo = Template46Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==47)
		{
			$getQuestionInfo = Template47Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==48)
		{
			$getQuestionInfo = Template48Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==49)
		{
			$getQuestionInfo = Template49Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==50)
		{
			$getQuestionInfo = Template50Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		else if($template_id==51)
		{
			$getQuestionInfo = Template51Model::select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at')->where('id', '=', $question_id)->first();
		}
		if(count($getQuestionInfo) > 0)
		{
			$getQuestionInfo = $getQuestionInfo->toArray();
		}                             
	}
	return $getQuestionInfo;	

}

function get_user_id()
{
	$user_id = null;
	$auth    = auth()->guard('users');
	if($auth)
	{
		$user    = $auth->user();

		if(isset($user->id))
	    {
	        $user_id = $user->id;
	    }
	}
    
    
    return $user_id;
}
function get_months_between_range($year)
{
	$arr_year   = $arr_month =[];
  	$arr_year   = explode('-',$year);
  	$start_date = '1'.'-'.'06'.'-'.$arr_year[0];
  	$end_date   = '31'.'-'.'07'.'-'.$arr_year[1];

  	$start_date = date('Y-m-d',strtotime($start_date));
  	$end_date   = date('Y-m-d',strtotime($end_date));

	$start      = new DateTime($start_date);
	$start->modify('first day of this month');
	$end        = new DateTime($end_date);
	$end->modify('first day of next month');
	$interval   = DateInterval::createFromDateString('1 month');
	$period     = new DatePeriod($start, $interval, $end);

	foreach ($period as $dt) {
	    $arr_month[] = $dt->format("Y-m-d");
	}
	return $arr_month;
}
?>
