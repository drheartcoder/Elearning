<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\EmailService;
use App\Models\UsersModel;
use App\Models\NotificationsModel;
use App\Models\StudentProgramQuestionModel;
use App\Models\GradeModel;
use App\Models\ProgramModel;
use App\Models\LessonModel;
use App\Models\UserLoginHistoryModel;

use Validator;
use Session;
use Hash;
use DB;
use Auth;

class CommonController extends Controller
{
  	function __construct(
                            UsersModel         $users_model,
                            NotificationsModel $notifications_model,
                            EmailService       $email_service
                        )
    {
        $this->UsersModel                  = $users_model;
        $this->EmailService                = $email_service;
        $this->NotificationsModel          = $notifications_model;
        $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
        $this->GradeModel                  = new GradeModel();
        $this->ProgramModel                = new ProgramModel();
        $this->LessonModel                 = new LessonModel();
        $this->UserLoginHistoryModel       = new UserLoginHistoryModel();
    }  

    public function check_email_duplicate(Request $request)
    {
        $data = [];
        $email          =   $request->input('email');
        $user_id        =   base64_decode($request->input('user_id'));
        if(!empty($email))
        {
            if ($user_id != '') 
            {
                $result = $this->UsersModel->where('email', $email)->where('id', '!=',$user_id)
                                                                   ->where('deleted_at','=',null)
                                                                   ->count();
            }
            else
            {
                $result = $this->UsersModel->where('email', $email)->where('deleted_at','=',null)->count();
            }
            if($result>0)
            {
                $data['status']='exist';
                $data['msg']='The email address you entered is already exists !';
            }
            else
            {
                $data['status']='allow';
                $data['msg']='Email address is available !';
            }
            
        }
        else
        {
            $data['status']='null';
            $data['msg']='Please enter email address';
        }
        echo json_encode($data);
        exit;
    }

    /*
    | Function  : Set notification status as read.
    | Name      : Deepak Bari
    | Date      : 18 June, 2018
    */

    public function read(Request $request)
    {
        $login_user_id = '';               
        $user_type = $request->input('user_type');        

        if(isset($user_type) && $user_type==true)
        {
            $user = auth()->guard($user_type)->user();            
            if(isset($user) && $user==true)
            {   
                $login_user_id    = $user['id'];
                $notification_count = $this->NotificationsModel->where('to_user_id',$login_user_id)->where('is_read','0')->count();  
                return $notification_count;                         
            }
            else
            {
                return 'logout';
            }    
        }
        else
        {
            return 'logout';
        }
    }


    public function get_notifications(Request $request)
    {
        //Check User
        $user = Auth::user();

        if(isset($user) && $user==true)
        {
            $user_id    = $user['id'];
            
            $notification_count = $this->NotificationsModel->where('to_user_id',$user_id)->where('is_read','0')->count(); 
            
            return $notification_count;
        }
        else
        {
            return "logout";
        }
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/07/2018
    | Output    : Success or Error
    */

    public function GetGrade(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id']) && !empty($form_data['grade_id']) ? $form_data['grade_id'] : '';

        return getGradeOptions($subject_id, $grade_id);
    } // end GetGrade



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/07/2018
    | Output    : Success or Error
    */

    public function GetProgram(Request $request)
    {
        $form_data  = $request->all();
       
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id']) && !empty($form_data['grade_id']) ? $form_data['grade_id'] : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';

        return getProgramOptions($subject_id, $grade_id, $program_id);
    } // end GetProgram



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/07/2018
    | Output    : Success or Error
    */

    public function GetEncGrade(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? $form_data['grade_id']   : '';

        return getEncGradeOptions($subject_id, $grade_id);
    } // end GetEncGrade



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/07/2018
    | Output    : Success or Error
    */

    public function GetEncProgram(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? $form_data['grade_id']   : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';

        return getEncProgramOptions($subject_id, $grade_id, $program_id);
    } // end GetEncProgram


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/07/2018
    | Output    : Success or Error
    */

    public function GetEncLesson(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? $form_data['grade_id']   : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';
        $lesson_id  = isset($form_data['lesson_id'])  && !empty($form_data['lesson_id'])  ? $form_data['lesson_id']  : '';

        return getEncLessonOptions($subject_id, $grade_id, $program_id, $lesson_id);
    } // end GetEncLesson



    public function getEncStundentLessonOptions(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? $form_data['grade_id']   : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';
        $lesson_id  = isset($form_data['lesson_id'])  && !empty($form_data['lesson_id'])  ? $form_data['lesson_id']  : '';

        return getEncStundentLessonOptions($subject_id, $grade_id, $program_id, $lesson_id);
    } // end GetEncLesson



    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Success or Error
    */

    public function DuplicateEmail(Request $request)
    {
		/*$num   = $this->BaseModel->where('email', $email)->withTrashed()->count();*/
		$email = $request->input('email');
		$num   = $this->UsersModel->where('email', $email);

		if( Auth::user() )
		{
			$num = $num->where('id','!=', Auth::user()->id);
		}
		$num = $num->count();

		if($num > 0)
		{
			return Response::json('error');
		}
		else
		{
			return Response::json('success');
		}

    } // end DuplicateEmail



    /*
    | Function  :
    | Author    : Deepak Arvind Salunke
    | Date      : 12/07/2018
    | Output    : Success or Error
    */

    public function DuplicateMobile(Request $request)
    {
		/*$num   = $this->BaseModel->where('contact', $mobile)->withTrashed()->count();*/
		$mobile = $request->input('mobile');
		$num    = $this->UsersModel->where('contact', $mobile);

		if( Auth::user() )
		{
			$num = $num->where('id','!=', Auth::user()->id);
		}
		$num = $num->count();

		if($num > 0)
		{
			return Response::json('error');
		}
		else
		{
			return Response::json('success');
		}

    } // end DuplicateMobile



    /*
    | Function  : 
    | Author    : Akshay Garje
    | Date      : 09/08/2018
    | Output    : Get Subject List
    */

    public function getSubject(Request $request)
    {
        $form_data   = $request->all();
        $program_id  = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';
        $student_id  = Auth::user()->id;
        $arr_program = $arr_subject = [];   
        $html        = '';     

        if( $program_id != '' && $student_id != '' )
        {
            $program_id = base64_decode($program_id);

            $arr_program = $this->StudentProgramQuestionModel->whereHas('program_details',function($query){
                                    $query->where('approve_status','approved')->where('status','1');
                                    $query->whereHas('subjectData');
                                })
                                ->with(['program_details'=>function($query){
                                    $query->where('approve_status','approved')->where('status','1');
                                    $query->with('subjectData');
                                }])
                                ->where('student_id',$student_id)
                                ->where('program_id',$program_id)
                                ->groupBy('program_id')
                                ->get();
            
            if( count( $arr_program ) > 0 )
            {
                $arr_program = $arr_program->toArray();
                if(isset($arr_program) && count($arr_program)>0)
                {
                    foreach ($arr_program as $key => $value) 
                    {
                        $total_count          = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                            ->where('lesson_id',$value['lesson_id'])
                                                                            ->where('student_id',$student_id)
                                                                            ->count();

                        $current_status_count = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                            ->where('lesson_id',$value['lesson_id'])
                                                                            ->where('student_id',$student_id)
                                                                            ->where('is_answer','yes')
                                                                            ->count();
                        
                        if($total_count == $current_status_count)
                        {
                            $html .= '<option value="'.base64_encode($value['program_details']['subject_data']['id']).'" selected>'.$value['program_details']['subject_data']['name'].'</option>';
                        }
                    }
                }
            }
            if($html == '')
            {
                $html = '<option value="">'.trans('parent.No_Subject_available').'</option>';
            }
        }
        return $html;
    }




    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/07/2018
    | Output    : Success or Error
    */

    public function GetEncHomeworkGrade(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? base64_decode($form_data['subject_id']) : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? base64_decode($form_data['grade_id'])   : '';
        $user       = isset($form_data['user'])       && !empty($form_data['user'])       ? $form_data['user']                      : '';
        $user_id    = Auth::user()->id;
        $html       = '';

        if($user == 'parent') 
        {  }
        else if($user == 'teacher') 
        {  }

        $obj_grade = $this->GradeModel->where('subject', $subject_id)
                                      ->where('status', '1')
                                      ->get();
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
    } // end GetEncHomeworkGrade



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/07/2018
    | Output    : Success or Error
    */

    public function GetEncHomeworkProgram(Request $request)
    {
        $arr_student_id = []; $html = '';

        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? base64_decode($form_data['subject_id']) : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? base64_decode($form_data['grade_id'])   : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? base64_decode($form_data['program_id']) : '';
        $user       = isset($form_data['user'])       && !empty($form_data['user'])       ? $form_data['user']                      : '';
        $user_id    = Auth::user()->id;


        if($user == 'parent') 
        {
            $getKids = getParentsAddedStudent($user_id);
            if( count($getKids) > 0 && !empty($getKids) ) 
            {
                foreach ($getKids as $key => $kids) 
                {
                    $arr_student_id[] = $kids['id'];
                }
            }
        }
        else if($user == 'teacher') 
        {
            $getStudents = getTeachersAllStudents($user_id);
            if( count($getStudents) > 0 && !empty($getStudents) ) 
            {
                foreach ($getStudents as $key => $stud) 
                {
                    $arr_student_id[] = $stud['id'];
                }
            }
        }

        $obj_student_programs  = $this->StudentProgramQuestionModel->with(['program_details'=>function($query){
                                                                        $query->where('approve_status','approved')
                                                                              ->where('status','1');
                                                                    }])
                                                                    ->whereHas('program_details', function($query) use ($subject_id, $grade_id){
                                                                        $query->where('approve_status','approved')
                                                                              ->where('status','1')
                                                                              ->where('subject',$subject_id)
                                                                              ->where('grade',$grade_id);
                                                                    })
                                                                    ->whereIn('student_id', $arr_student_id)
                                                                    ->groupBy('program_id')
                                                                    ->get();

        if(isset($obj_student_programs) && count($obj_student_programs) > 0)
        {
            $arr_student_programs = $obj_student_programs->toArray();

            $html .= '<option value="">'.trans('parent.Select_Program').'</option>';

            foreach ($arr_student_programs as $key => $program)
            {
                if( count($program['program_details']) > 0 && !empty( $program['program_details'] ) )
                {
                    if($program_id == $program['program_details']["id"])
                    {
                        $selected = "selected";
                    }
                    else
                    {
                        $selected = "";
                    }

                    $html .= '<option value="'.base64_encode($program['program_details']['id']).'" '.$selected.'>'.$program['program_details']['name'].'</option>';
                }
            }
        }
        else
        {
            $html = '<option value="">'.trans('parent.No_Program_available').'</option>';
        }

        return $html;
    } // end GetEncHomeworkProgram


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 24/07/2018
    | Output    : Success or Error
    */

    public function GetEncHomeworkLesson(Request $request)
    {
        $arr_lesson = $arr_student_id = $arr_total_count = $arr_current_status_count = [];

        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? base64_decode($form_data['subject_id']) : '';
        $grade_id   = isset($form_data['grade_id'])   && !empty($form_data['grade_id'])   ? base64_decode($form_data['grade_id'])   : '';
        $program_id = isset($form_data['program_id']) && !empty($form_data['program_id']) ? base64_decode($form_data['program_id']) : '';
        $lesson_id  = isset($form_data['lesson_id'])  && !empty($form_data['lesson_id'])  ? base64_decode($form_data['lesson_id'])  : '';
        $user       = isset($form_data['user'])       && !empty($form_data['user'])       ? $form_data['user']                      : '';
        $user_id    = Auth::user()->id;
        $html       = '';


        if($user == 'parent') 
        {
            $getKids = getParentsAddedStudent($user_id);
            if( count($getKids) > 0 && !empty($getKids) ) 
            {
                foreach ($getKids as $key => $kids) 
                {
                    $arr_student_id[] = $kids['id'];
                }
            }
        }
        else if($user == 'teacher') 
        {
            $getStudents = getTeachersAllStudents($user_id);
            if( count($getStudents) > 0 && !empty($getStudents) ) 
            {
                foreach ($getStudents as $key => $stud) 
                {
                    $arr_student_id[] = $stud['id'];
                }
            }
        }


        $obj_program = $this->StudentProgramQuestionModel->with(['program_details'=>function($query) use ($program_id){
                                                            $query->where('approve_status','approved')
                                                                  ->where('status','1')
                                                                  ->with('lessonData')
                                                                  ->whereHas('lessonData',function($query1) use ($program_id){
                                                                        $query1->where('program_id',$program_id);
                                                                   });
                                                        }])
                                                        ->whereHas('program_details',function($query) use ($subject_id, $grade_id){
                                                            $query->where('approve_status','approved')
                                                                  ->where('status','1')
                                                                  ->where('subject',$subject_id)
                                                                  ->where('grade',$grade_id);
                                                        })
                                                        ->whereIn('student_id', $arr_student_id)
                                                        ->groupBy('program_id')
                                                        ->get();

        if($obj_program)
        {
            $arr_program = $obj_program->toArray();

            if(count($arr_program)>0)
            {
                if(isset($arr_program) && count($arr_program)>0)
                {
                    foreach ($arr_program as $key => $value)
                    {
                        if($value['program_id'] == $program_id)
                        {
                            if(isset($value['program_details']['lesson_data']) && count($value['program_details']['lesson_data'])>0)
                            {
                                foreach ($value['program_details']['lesson_data'] as $_key => $lesson) 
                                {
                                    $total_count          = StudentProgramQuestionModel::where('program_id',$program_id)
                                                                                        ->where('lesson_id',$lesson['id'])
                                                                                        ->where('student_id',$value['student_id'])
                                                                                        ->count();

                                    $current_status_count = StudentProgramQuestionModel::where('program_id',$program_id)
                                                                                        ->where('lesson_id',$lesson['id'])
                                                                                        ->where('student_id',$value['student_id'])
                                                                                        ->where('is_answer','yes')
                                                                                        ->count();

                                    if($total_count == $current_status_count)
                                    {
                                        array_push($arr_lesson, $lesson);
                                    }
                                }
                            }    
                        }
                    }
                }
            }
        }
        
        if( isset($arr_lesson) && count($arr_lesson) > 0 && !empty($arr_lesson) )
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
    } // end GetEncHomeworkLesson


    public function LogoutDaily()
    {
        $status = '';
        $arr_time_data  = [];
        $current_date   = date('Y-m-d');
        $current_time   = date('H:i:s');
        $time = 0;

        $user = Auth::user();

        if(isset($user) && $user==true)
        {
            $user_id         = $user['id'];
            $time_in_seconds = 0;
            $obj_user_login =  $this->UserLoginHistoryModel->where('user_id','=',$user_id)
                                                            ->whereDate('login_date','=',$current_date)
                                                            ->join('users','users.id','=','user_login_history.user_id')
                                                            ->where('users.user_type','student')
                                                            ->first();
            //dd($obj_user_login);
            if($obj_user_login)
            {
                $end_time = isset($obj_user_login->end_time)?$obj_user_login->end_time:'';
                $start_time = isset($obj_user_login->start_time)?$obj_user_login->start_time:'';
                $total_time = isset($obj_user_login->total_time)?$obj_user_login->total_time:''; 
                $time_in_seconds = isset($obj_user_login->time_in_seconds)?$obj_user_login->time_in_seconds:''; 


                $time_diff = gmdate("H:i:s",strtotime($current_time)-strtotime($start_time));
                $diff      = strtotime($current_time)-strtotime($start_time);

                if($total_time!=null && Session::get('is_first_time') == ""){ 
                    Session::put('is_first_time','no'); 
                    Session::put('time_in_seconds',$time_in_seconds); 
                } 
                $time              = (intval(Session::get('time_in_seconds')) + intval($diff));                    
                $secs              = strtotime($time_diff)-strtotime("00:00:00");
                $total_system_time = date("H:i:s",strtotime($total_time)+$secs);

                
                $status     = $this->UserLoginHistoryModel->where('user_id','=',$user_id)
                                                        ->whereDate('login_date','=',$current_date)
                                                        ->update(['end_time'=>$current_time,'total_time'=>$total_system_time,'time_in_seconds'=>$time]);                   
                
            }
            else
            {
                $arr_time_data['user_id']    = $user_id;
                $arr_time_data['login_date'] = $current_date;
                $arr_time_data['start_time'] = $current_time;
                $status = $this->UserLoginHistoryModel->create($arr_time_data);
            }
            return 'success';                
        }
        else
        {
            Auth::logout();
            Session::flush();
            return "logout";
        }
    }    
}
