<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentProgramQuestionModel;
use App\Models\UserLoginHistoryModel;
use App\Common\Services\StudentPerformanceService;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;
use App\Models\StudentDetailsModel;
use App\Models\ProgramModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\TransactionsModel;
use App\Models\StudentProgramsModel;
use App\Models\ProgramQuestionModel;
use App\Models\ClassroomStudentModel;

use Validator;
use Response;
use Session;
use Config;
use Auth;
use Hash;
use App;
use DB;
class DashboardController extends Controller
{
    public function __construct(StudentPerformanceService $student_performance_service,
                                NotificationService $notification_service)
    {
      $this->module_url_path             = url('/').'/'.config('app.project.parent_panel_slug').'/dashboard';
      $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
      $this->UserLoginHistoryModel       = new UserLoginHistoryModel();
      $this->auth                        = auth()->guard('users');
      $this->per_day_point               = 10;
      $this->StudentPerformanceService   = $student_performance_service;
      $this->NotificationService         = $notification_service;

        $this->LanguageService             = new LanguageService();
        $this->UsersModel                  = new UsersModel();
        $this->StudentDetailsModel         = new StudentDetailsModel();
        $this->ProgramModel                = new ProgramModel();
        $this->SubjectModel                = new SubjectModel();
        $this->SubjectTranslationModel     = new SubjectTranslationModel();
        $this->GradeModel                  = new GradeModel();
        $this->GradeTranslationModel       = new GradeTranslationModel();
        $this->TransactionsModel           = new TransactionsModel();
        $this->StudentProgramsModel        = new StudentProgramsModel();
        $this->ProgramQuestionModel        = new ProgramQuestionModel();
        $this->ClassroomStudentModel       = new ClassroomStudentModel();
    }
    public function index($type='weekly',$selected_year=false,$student_id=false)
    {
        $arr_programs     = $arr_year_range = $arr_program_count = $arr_student = $data=[];
        $parent_id        = Auth::user()->id;
        $arr_student      = get_student_list_by_parent($parent_id);
        $current_year     = get_current_year();
        $incentive_amount = get_incentive_amount($parent_id);
        if(isset($arr_student) && sizeof($arr_student)>0)
        {
            $default_student_id = isset(array_values($arr_student)[0]['student_id'])?array_values($arr_student)[0]['student_id']:'';
          
            if($student_id==false)
            {
                $student_id = $default_student_id;
            }
            else
            {
                $student_id = base64_decode($student_id);
            }
            if($selected_year!=false)
            {
              $default_year = $selected_year;
            }
            else
            {
              $default_year = get_current_year();

            }
            $arr_year_range                    = get_academic_year($student_id);
            $arr_program_count                 = $this->StudentPerformanceService->get_program_count($student_id);
            $total_time_spent                  = $this->StudentPerformanceService->get_total_time_spent($student_id);
            $total_time_spent                  = $this->StudentPerformanceService->get_total_time_spent($student_id);
      
            if(isset($type) && $type=='weekly')
            {
               $arr_weekly_data                = $this->StudentPerformanceService->get_weekly_performance($student_id);
               $data['arr_data']               = $arr_weekly_data;
            }
            elseif(isset($type) && $type=='monthly')
            {
               $arr_monthly_data               = $this->StudentPerformanceService->get_monthly_performance($student_id);
               $data['arr_data']               = $arr_monthly_data;
            }
            elseif(isset($type) && $type=='daily')
            {
               $arr_daily_data                 = $this->StudentPerformanceService->get_daily_performance($student_id);
               $data['arr_data']               = $arr_daily_data;
            }
            elseif(isset($type) && $type=='yearly')
            {
               $arr_yearly_data                = $this->StudentPerformanceService->get_yearly_performance($student_id,$default_year);
               $data['arr_data']               = $arr_yearly_data;
            }
            else
            {
              $arr_weekly_data                = $this->StudentPerformanceService->get_weekly_performance($student_id);
              $data['arr_data']               = $arr_weekly_data;
            }

            $data['student_id']              = $student_id;
            $data['arr_student']             = $arr_student;
            $data['selected_type']           = $type;
            $data['default_year']            = $default_year;    
            $data['arr_year_range']          = $arr_year_range;
            $data['total_time_spent']        = $total_time_spent;
            $data['arr_program_count']       = $arr_program_count;
          
        }        
        else
        {
            $data['message']             = trans('parent.No_Data_Found');
        }
        $data['incentive_amount']        = $incentive_amount;
        $data['module_url_path']         = $this->module_url_path;
        $data['current_year']            = $current_year;
        $data['middleContent']           = 'parent.dashboard';
        $data['user_type']               = 'parent';
        $data['parentTitle']             = trans('parent.Dashboard');
        $data['pageTitle']               = trans('parent.Dashboard');
        return view('front.layout.master')->with($data);
        //return redirect(url('/'));
    } 

    
    /*
    | Function  : Get the children data added by this parent along with grade, program
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Get all the classes data added by this teacher along with subject, grade, program
    */

    public function AddMyChild(Request $request)
    {
        $arr_user = $form_data = $arr_rules = $arr_program_questions = array();
        $child_id = '';

        $arr_rules['child_type'] = "required";
        
        $child_type = $request->input('child_type');
        

        if($child_type == 'not_using_system')
        {
            $arr_rules['new_first_name']  = "required";
            $arr_rules['new_last_name']   = "required";
            $arr_rules['subject'] = "required";
            $arr_rules['grade']   = "required";
            $arr_rules['program'] = "required";
            /*$arr_rules['termsconditions'] = "required";*/
        }
        if($child_type == 'with_using_system')
        {
            $arr_rules['old_first_name']  = "required";
            $arr_rules['old_last_name']   = "required";
            $arr_rules['teacher_email']   = "required";
            $arr_rules['pin']             = "required";
            $arr_rules['subject'] = "required";
            $arr_rules['grade']   = "required";
            $arr_rules['program'] = "required";
            /*$arr_rules['termsconditions'] = "required";*/
        }
        if($child_type == 'using_system')
        {
            $arr_rules['code_teacher_email'] = "required";
            $arr_rules['enrollment_code']    = "required";
        }

        

        //dd($request->all());

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent_id         = Auth::user()->id;
        $parent_first_name = Auth::user()->first_name;
        $parent_last_name  = Auth::user()->last_name;
        $user_type         = 'parent';
        $form_data         = $request->all();

        $subject_id = isset($form_data['subject']) && !empty($form_data['subject']) ? $form_data['subject'] : '';
        $grade_id   = isset($form_data['grade']) && !empty($form_data['grade']) ? $form_data['grade'] : '';
        $program_id = isset($form_data['program']) && !empty($form_data['program']) ? $form_data['program'] : '';

        if($child_type == 'not_using_system')
        {
            $arr_user['user_type']       = 'student';
            $arr_user['first_name']      = isset($form_data['new_first_name']) ? $form_data['new_first_name'] : '';
            $arr_user['last_name']       = isset($form_data['new_last_name']) ? $form_data['new_last_name'] : '';
            $arr_user['pin']             = RandomPin();
            $arr_user['is_active']       = 'active';
            $arr_user['is_verify']       = 'yes';
            $arr_user['remember_token']  = md5(uniqid(rand() , true));
            $arr_user['enrollment_code'] = GenerateEnrollmentCode();

            $is_added = $this->UsersModel->insertGetId($arr_user);

            if($is_added)
            {
                $arr_student['student_id'] = $is_added;
                $arr_student['parent_id']  = $parent_id;
                $arr_student['added_by']   = $parent_id;
                $arr_student['subject_id'] = $subject_id;
                $arr_student['grade_id']   = $grade_id;
                $this->StudentDetailsModel->create($arr_student);

                $arr_program['student_id']  = $is_added;
                $arr_program['program_id']  = $program_id;
                $arr_program['created_by']  = $parent_id;
                $arr_program['assigned_by'] = 'parent';
                $this->StudentProgramsModel->create($arr_program);

                $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                if($obj_program_questions)
                {
                    $arr_program_questions = $obj_program_questions->toArray();

                    foreach ($arr_program_questions as $key => $program_questions)
                    {
                        $arr_question['program_id']  = $program_id;
                        $arr_question['template_id'] = $program_questions['template_id'];
                        $arr_question['lesson_id']   = $program_questions['lesson_id'];
                        $arr_question['question_id'] = $program_questions['question_id'];
                        $arr_question['student_id']  = $is_added;

                        $this->StudentProgramQuestionModel->create($arr_question);
                    }
                }

                // Store notification for admin
                $arr_noti['message']      = $parent_first_name.' '.$parent_last_name.' has added new child';
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/users/student/view/".base64_encode($is_added);
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for parent
                $arr_noti['message']      = trans('parent.You_have_added_a_new_child');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $parent_id;
                $arr_noti['url']          = '/parent/my-kids';
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for Student
                $arr_noti['message']      = trans('parent.You_have_been_successfully_added_by').$parent_first_name.' '.$parent_last_name;
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = $is_added;
                $arr_noti['url']          = "";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);                

                Session::flash('success', trans('parent.new_child_add_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('parent.new_child_add_error'));
                return redirect()->back();
            }
        }


        if($child_type == 'with_using_system')
        {
            $old_first_name = isset($form_data['old_first_name']) && !empty($form_data['old_first_name']) ? $form_data['old_first_name'] : '';
            $old_last_name  = isset($form_data['old_last_name'])  && !empty($form_data['old_last_name'])  ? $form_data['old_last_name']  : '';
            $pin            = isset($form_data['pin'])            && !empty($form_data['pin'])            ? $form_data['pin']            : '';
            $teacher_email  = isset($form_data['teacher_email'])  && !empty($form_data['teacher_email'])  ? $form_data['teacher_email']  : '';

            if(is_numeric($teacher_email))
            {
                $email_mobile = 'contact';
            }
            else
            {
                $email_mobile = 'email';
            }

            $obj_user = $this->UsersModel->where('user_type', 'student')
                                         ->where('pin', $pin)
                                         ->where('first_name', $old_first_name)
                                         ->where('last_name', $old_last_name)
                                         ->with('classes_data.teacher_data')
                                         ->whereHas("classes_data.teacher_data", function($query) use($teacher_email, $email_mobile)
                                         {
                                            $query->select('id', 'first_name', 'last_name', 'email', 'contact');
                                            $query->where($email_mobile, $teacher_email);
                                         })
                                         ->first();
            if($obj_user)
            {
                $arr_user = $obj_user->toArray();

                $child_id       = $arr_user['id'];
                $old_teacher_id = $arr_user['classes_data'][0]['teacher_data']['id'];
                $old_class_id   = $arr_user['classes_data'][0]['classroom_id'];

                $arr_stud['parent_id']  = $parent_id;
                $arr_stud['subject_id'] = $subject_id;
                $arr_stud['grade_id']   = $grade_id;
                $this->StudentDetailsModel->where('student_id', $child_id)->update($arr_stud);

                $count = $this->StudentProgramsModel->where('student_id', $child_id)
                                                    ->where('program_id', $program_id)
                                                    ->where('created_by', $parent_id)
                                                    ->where('assigned_by', 'parent')
                                                    ->count();
                if($count == 0)
                {
                    $this->ClassroomStudentModel->where('classroom_id', $old_class_id)
                                                ->where('teacher_id', $old_teacher_id)
                                                ->where('student_id', $child_id)
                                                ->delete();

                    $arr_program['student_id']  = $child_id;
                    $arr_program['program_id']  = $program_id;
                    $arr_program['created_by']  = $parent_id;
                    $arr_program['assigned_by'] = 'parent';
                    $this->StudentProgramsModel->create($arr_program);

                    $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                    if($obj_program_questions)
                    {
                        $arr_program_questions = $obj_program_questions->toArray();

                        foreach ($arr_program_questions as $key => $program_questions)
                        {
                            $arr_question['program_id']  = $program_id;
                            $arr_question['template_id'] = $program_questions['template_id'];
                            $arr_question['lesson_id']   = $program_questions['lesson_id'];
                            $arr_question['question_id'] = $program_questions['question_id'];
                            $arr_question['student_id']  = $child_id;

                            $this->StudentProgramQuestionModel->create($arr_question);
                        }
                    }

                    Session::flash('success', trans('parent.exist_child_add_success'));
                }
                else
                {
                    Session::flash('success', trans('parent.exist_child_already_add_success'));
                }

                // Store notification for admin
                $arr_noti['message']      = $parent_first_name.' '.$parent_last_name.' has added existing child to his/her account.';
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/users/student";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for parent
                $arr_noti['message']      = trans('parent.You_have_successfully_added_existing_child_to_your_account');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $parent_id;
                $arr_noti['url']          = "/parent/my-kids";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for Student
                $arr_noti['message']      = trans('parent.You_have_been_successfully_added_by').$parent_first_name.' '.$parent_last_name;
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = $child_id;
                $arr_noti['url']          = "";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);               
            }
            else
            {
                Session::flash('error', trans('parent.enterd_student_not_assign'));
            }
            return redirect()->back();
        }
        if($child_type == 'using_system')
        {
            $code_teacher_email = isset($form_data['code_teacher_email']) && !empty($form_data['code_teacher_email']) ? $form_data['code_teacher_email'] : '';
            $enrollment_code    = isset($form_data['enrollment_code'])  && !empty($form_data['enrollment_code'])  ? $form_data['enrollment_code']  : '';

            if(is_numeric($code_teacher_email))
            {
                $email_mobile = 'contact';
            }
            else
            {
                $email_mobile = 'email';
            }

            $obj_user = $this->UsersModel->where('user_type', 'student')
                                         ->where('enrollment_code', $enrollment_code)
                                         ->with(['classes_data.teacher_data','classes_data.class_data','student_details'])
                                         ->whereHas("classes_data.teacher_data", function($query) use($code_teacher_email, $email_mobile)
                                         {
                                            $query->select('id', 'first_name', 'last_name', 'email', 'contact');
                                            $query->where($email_mobile, $code_teacher_email);
                                         })
                                         ->first();
            if($obj_user)
            {
                $arr_user = $obj_user->toArray();
                $child_id       = $arr_user['id'];
                $old_teacher_id = $arr_user['classes_data'][0]['teacher_data']['id'];
                $old_class_id   = $arr_user['classes_data'][0]['classroom_id'];

                $arr_stud['parent_id']  = $parent_id;

                $arr_stud['subject_id'] = isset($arr_user['classes_data'][0]['class_data']['subject_id'])?$arr_user['classes_data'][0]['class_data']['subject_id']:'';

                $arr_stud['grade_id']   = isset($arr_user['classes_data'][0]['class_data']['grade_id'])?$arr_user['classes_data'][0]['class_data']['grade_id']:'';
                
                $this->StudentDetailsModel->where('student_id', $child_id)->update($arr_stud);

                $count = $this->StudentProgramsModel->where('student_id', $child_id)
                                                    ->where('program_id', $program_id)
                                                    ->where('created_by', $parent_id)
                                                    ->where('assigned_by', 'parent')
                                                    ->count();
                if($count == 0)
                {
                    $this->ClassroomStudentModel->where('classroom_id', $old_class_id)
                                                ->where('teacher_id', $old_teacher_id)
                                                ->where('student_id', $child_id)
                                                ->delete();

                    $arr_program['student_id']  = $child_id;
                    $arr_program['program_id']  = $program_id;
                    $arr_program['created_by']  = $parent_id;
                    $arr_program['assigned_by'] = 'parent';
                    $this->StudentProgramsModel->create($arr_program);

                    $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                    if($obj_program_questions)
                    {
                        $arr_program_questions = $obj_program_questions->toArray();

                        foreach ($arr_program_questions as $key => $program_questions)
                        {
                            $arr_question['program_id']  = $program_id;
                            $arr_question['template_id'] = $program_questions['template_id'];
                            $arr_question['lesson_id']   = $program_questions['lesson_id'];
                            $arr_question['question_id'] = $program_questions['question_id'];
                            $arr_question['student_id']  = $child_id;

                            $this->StudentProgramQuestionModel->create($arr_question);
                        }
                    }

                    Session::flash('success', trans('parent.exist_child_add_enrollment_success'));
                }
                else
                {
                    Session::flash('success', trans('parent.exist_child_already_add_enroll_success'));
                }

                // Store notification for admin
                $arr_noti['message']      = $parent_first_name.' '.$parent_last_name.' has added existing child to his/her account using enrollment code.';
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/users/student";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for parent
                $arr_noti['message']      = trans('parent.You_have_successfully_added_existing_child_to_your_account_using_enrollment_code');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $parent_id;
                $arr_noti['url']          = '/parent/my-kids';
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for Student
                $arr_noti['message']      = trans('parent.You_have_been_successfully_added_by').$parent_first_name.' '.$parent_last_name;
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = $child_id;
                $arr_noti['url']          = "";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);                
            }
            else
            {
                Session::flash('error', trans('parent.enterd_student_not_assign_enrollment'));
            }

            return redirect()->back();
        }

    } // end AddMyChild


    /*
    | Function  : Delete selected class
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Success or Error
    */

    public function DeleteMyChild(Request $request)
    {
        $form_data         = $request->all();
        $child_id          = isset($form_data['delete_child_id']) ? base64_decode($form_data['delete_child_id']) : '';
        $parent_id         = Auth::user()->id;
        $parent_first_name = Auth::user()->first_name;
        $parent_last_name  = Auth::user()->last_name;

        if(!empty($child_id) && !empty($parent_id))
        {
            $is_deleted = $this->UsersModel->where('id', $child_id)->delete();
            if($is_deleted)
            {
                $this->StudentDetailsModel->where('student_id', $child_id)->delete();

                // Store notification for admin
                $arr_noti['message']      = $parent_first_name.' '.$parent_last_name.' has deleted a child';
                $arr_noti['from_user_id'] = $parent_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/users/student";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for parent
                $arr_noti['message']      = trans('parent.You_have_successfully_deleted_your_child');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $parent_id;
                $arr_noti['url']          = "/parent/dashboard";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                Session::flash('success', trans('parent.child_data_delete_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('parent.child_data_delete_error'));
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', trans('parent.something_went_wrong'));
            return redirect()->back();
        }

    } // end DeleteMyChild


    /*
    | Function  : Update class data
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Success or Error
    */

    public function UpdateMyChild(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['first_name'] = "required";
        $arr_rules['last_name']  = "required";
        $arr_rules['subject']    = "required";
        $arr_rules['grade']      = "required";
        //$arr_rules['pin']        = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent_id              = Auth::user()->id;
        $parent_first_name      = Auth::user()->first_name;
        $parent_last_name       = Auth::user()->last_name;
        $user_type              = 'parent';
        $form_data              = $request->all();

        $child_id               = isset($form_data['child_id']) ? base64_decode($form_data['child_id']) : '';
        $arr_user['first_name'] = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
        $arr_user['last_name']  = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
        //$arr_user['pin']        = isset($form_data['pin']) ? $form_data['pin'] : '';

        $is_updated             = $this->UsersModel->where('id', $child_id)->update($arr_user);

        if($is_updated)
        {
            $arr_student['subject_id'] = isset($form_data['subject']) ? $form_data['subject'] : '';
            $arr_student['grade_id']   = isset($form_data['grade']) ? $form_data['grade'] : '';
            $this->StudentDetailsModel->where('student_id', $child_id)->update($arr_student);

            // Store notification for admin
            $arr_noti['message']      = $parent_first_name.' '.$parent_last_name.' has updated a child';
            $arr_noti['from_user_id'] = $parent_id;
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = "/admin/users/student/view/".base64_encode($child_id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            // Store notification for parent
            $arr_noti['message']      = trans('parent.You_have_successfully_updated_a_child');
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $parent_id;
            $arr_noti['url']          = "/parent/my-kids";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            // Store notification for student
            $arr_noti['message']      = trans('parent.Your_name').$arr_user['first_name'].' '.$arr_user['last_name'].trans('parent.has_been_updated_by').$parent_first_name.' '.$parent_last_name;
            $arr_noti['from_user_id'] = $parent_id;
            $arr_noti['to_user_id']   = $child_id;
            $arr_noti['url']          = "";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success',trans('parent.child_update_success'));
            return redirect()->back();
        }
        else
        {
            Session::flash('error', trans('parent.child_update_error'));
            return redirect()->back();
        }

    } // end UpdateMyChild


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
    | Date      : 25/07/2018
    | Output    : Success or Error
    */

    public function PinExists(Request $request)
    {
        $form_data  = $request->all();
        $first_name = isset($form_data['first_name']) && !empty($form_data['first_name']) ? $form_data['first_name'] : '';
        $last_name  = isset($form_data['last_name']) && !empty($form_data['last_name']) ? $form_data['last_name'] : '';
        $pin        = isset($form_data['pin']) && !empty($form_data['pin']) ? $form_data['pin'] : '';

        $is_exists  = $this->UsersModel->where('user_type', 'student')
                                        ->where('pin', $pin)
                                        ->where('first_name', $first_name)
                                        ->where('last_name', $last_name)
                                        ->count();

        if($is_exists > 0)
        {
            return 'success';
        }
        else
        {
            return 'error';
        }
    } // end PinExists



    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2018
    | Output    : Success or Error
    */

    public function EnrollmentCodeExists(Request $request)
    {
        $form_data       = $request->all();
        $enrollment_code = isset($form_data['enrollment_code']) && !empty($form_data['enrollment_code']) ? $form_data['enrollment_code'] : '';

        $is_exists = $this->UsersModel->where('user_type', 'student')->where('enrollment_code', $enrollment_code)->count();
        if($is_exists > 0)
        {
            return 'success';
        }
        else
        {
            return 'error';
        }
    } 
}
