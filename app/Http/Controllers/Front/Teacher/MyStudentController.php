<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\StudentService;
use App\Common\Services\ReportService;

use App\Models\UsersModel;
use App\Models\ClassroomsModel;
use App\Models\ClassroomsTranslationModel;
use App\Models\ProgramModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\ClassroomStudentModel;
use App\Models\StudentDetailsModel;
use App\Models\StudentProgramQuestionModel;
use App\Models\StudentProgramsModel;
use App\Models\ProgramQuestionModel;

use Validator;
use Response;
use Session;
use flash;
use Excel;
use Auth;
use DB;

class MyStudentController extends Controller
{
    public function __construct(NotificationService $notification_service,StudentService $student_service,ReportService $report_service)
    {
        $this->NotificationService         = $notification_service;
        $this->StudentService              = $student_service;
        $this->ReportService               = $report_service;
        
        $this->UsersModel                  = new UsersModel();
        $this->LanguageService             = new LanguageService();
        $this->ClassroomsModel             = new ClassroomsModel();
        $this->ClassroomsTranslationModel  = new ClassroomsTranslationModel();
        $this->ProgramModel                = new ProgramModel();
        $this->SubjectModel                = new SubjectModel();
        $this->SubjectTranslationModel     = new SubjectTranslationModel();
        $this->GradeModel                  = new GradeModel();
        $this->GradeTranslationModel       = new GradeTranslationModel();
        $this->ClassroomStudentModel       = new ClassroomStudentModel();
        $this->StudentDetailsModel         = new StudentDetailsModel();
        $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
        $this->StudentProgramsModel        = new StudentProgramsModel();
        $this->ProgramQuestionModel        = new ProgramQuestionModel();
        $this->module_url_path             = url('/').'/teacher/my-student';
    }


    /*
    | Function  : Get all the classes data added by this teacher along with subject, grade, program
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Get all the classes data added by this teacher along with subject, grade, program
    */

    public function AddMyStudent(Request $request)
    {
        $arr_user   = $form_data = $arr_rules = $arr_class = array();
        $is_updated = $is_added  = false;
        $teacher_grade_id = $teacher_subject_id = '';
        $student_type = $request->input('student_type');

        if($student_type == 'new_student')
        {
            $arr_rules['student_first_name'] = "required|array|min:1";
            $arr_rules['student_last_name']  = "required|array|min:1";
            $arr_rules['student_pin']        = "required|array|min:1";
        }
        else if($student_type == 'transfer_from_another')
        {
            $arr_rules['old_teacher_email'] = "required|array|min:1";
            $arr_rules['old_student_pin']   = "required|array|min:1";
        }
        else if($student_type == 'existing_student')
        {
            $arr_rules['pin'] = "required|array|min:1";
        }

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_are_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher_id         = Auth::user()->id;
        $teacher_first_name = Auth::user()->first_name;
        $teacher_last_name  = Auth::user()->last_name;
        $teacher_email      = Auth::user()->email;
        $teacher_contact    = Auth::user()->contact;
        $user_type          = 'student';
        $form_data          = $request->all();

        $class_id           = isset($form_data['class_id']) && !empty($form_data['class_id']) ? base64_decode($form_data['class_id']) : '';
        $grade_id           = isset($form_data['grade_id']) && !empty($form_data['grade_id']) ? $form_data['grade_id'] : '';
        $subject_id         = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $program_id         = isset($form_data['program_id']) && !empty($form_data['program_id']) ? $form_data['program_id'] : '';
        $obj_class          = $this->ClassroomsModel->where('id', $class_id)->first();
        if($obj_class)
        {
            $arr_class = $obj_class->toArray();
        }

        // To add new student
        if($student_type == 'new_student')
        {
            $student_first_name = isset($form_data['student_first_name']) && sizeof($form_data['student_first_name']) > 0 ? $form_data['student_first_name'] : '';
            $student_last_name  = isset($form_data['student_last_name']) && sizeof($form_data['student_last_name']) > 0 ? $form_data['student_last_name'] : '';
            $student_pin        = isset($form_data['student_pin']) && sizeof($form_data['student_pin']) > 0 ? $form_data['student_pin'] : '';

            $obj_teacher  = $this->ClassroomsModel->where('id','=',$class_id)->where('teacher_id','=',$teacher_id)->first();
            if($obj_teacher)
            {
                $teacher_grade_id   = isset($obj_teacher->grade_id)?$obj_teacher->grade_id:'';
                $teacher_subject_id = isset($obj_teacher->subject_id)?$obj_teacher->subject_id:'';

            }

            foreach ($student_first_name as $key => $data)
            {
                $arr_user['user_type']       = $user_type;
                $arr_user['first_name']      = isset($data) ? ucfirst($data) : '';
                $arr_user['last_name']       = isset($student_last_name[$key]) ? ucfirst($student_last_name[$key]) : '';
                $arr_user['email']           = '';
                $arr_user['contact']         = '';
                $arr_user['password']        = '';
                $arr_user['pin']             = isset($student_pin[$key]) ? $student_pin[$key] : '';
                $arr_user['is_active']       = 'active';
                $arr_user['is_verify']       = 'yes';
                $arr_user['remember_token']  = md5(uniqid(rand() , true));
                $arr_user['enrollment_code'] = GenerateEnrollmentCode();

                if($arr_user['first_name'] != '' && $arr_user['last_name'] != '' )
                {
                    $is_added                  = $this->UsersModel->insertGetId($arr_user);

                    $arr_student['student_id'] = $is_added;
                    $arr_student['parent_id']  = '';
                    $arr_student['added_by']   = $teacher_id;
                    $arr_student['subject_id'] = $teacher_subject_id;
                    $arr_student['grade_id']   = $teacher_grade_id;
                    $this->StudentDetailsModel->create($arr_student);

                    $arr_class_student['classroom_id'] = $class_id;
                    $arr_class_student['teacher_id']   = $teacher_id;
                    $arr_class_student['student_id']   = $is_added;
                    $this->ClassroomStudentModel->create($arr_class_student);

                    if(!empty($program_id) && $program_id != '')
                    {
                        $arr_program['student_id']  = $is_added;
                        $arr_program['program_id']  = $program_id;
                        $arr_program['created_by']  = $teacher_id;
                        $arr_program['assigned_by'] = 'teacher';
                        $this->StudentProgramsModel->create($arr_program);

                        $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                        if($obj_program_questions)
                        {
                            $arr_program_questions = $obj_program_questions->toArray();

                            foreach ($arr_program_questions as $pkey => $program_questions)
                            {
                                $arr_question['program_id']  = $program_id;
                                $arr_question['template_id'] = $program_questions['template_id'];
                                $arr_question['lesson_id']   = $program_questions['lesson_id'];
                                $arr_question['question_id'] = $program_questions['question_id'];
                                $arr_question['student_id']  = $is_added;

                                $this->StudentProgramQuestionModel->create($arr_question);
                            }
                        }
                    }
                    

                    // Store notification for admin
                    $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has added new student, '.$data.' '.$student_last_name[$key];
                    $arr_noti['from_user_id'] = $teacher_id;
                    $arr_noti['to_user_id']   = 1;
                    $arr_noti['url']          = "/admin/users/student/view/".base64_encode($is_added);
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);

                    // Store notification for teacher
                    $arr_noti['message']      = trans('teacher.You_have_successfully_added_new_student').$data.' '.$student_last_name[$key];
                    $arr_noti['from_user_id'] = 1;
                    $arr_noti['to_user_id']   = $teacher_id;
                    $arr_noti['url']          = '/teacher/my-student/'.base64_encode($class_id);
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);

                    if(count($arr_class)>0){
                        // Store notification for Student
                        $arr_noti['message']      = trans('teacher.You_have_successfully_added_to_class').$arr_class['name'].' by '.$teacher_first_name.' '.$teacher_last_name;
                        $arr_noti['from_user_id'] = $teacher_id;
                        $arr_noti['to_user_id']   = $is_added;
                        $arr_noti['url']          = "";
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);
                    }
                }
            }

            if($is_added)
            {
                Session::flash('success', trans('teacher.New_Student_add_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('teacher.New_Student_add_error'));
                return redirect()->back();
            }
        }


        // To Transfer Student from another Class
        if($student_type == 'transfer_from_another')
        {
            $old_teacher_email = isset($form_data['old_teacher_email']) && sizeof($form_data['old_teacher_email']) > 0 ? $form_data['old_teacher_email'] : '';
            $old_student_pin   = isset($form_data['old_student_pin'])   && sizeof($form_data['old_student_pin'])   > 0 ? $form_data['old_student_pin']   : '';

            foreach ($old_student_pin as $key => $data)
            {
                $t_email = $old_teacher_email[$key];
                $student_id = '';

                if(is_numeric($t_email))
                {
                    $email_mobile = 'contact';
                }
                else
                {
                    $email_mobile = 'email';
                }

                $obj_user = $this->UsersModel->where('user_type', 'student')
                                             ->where('pin', $data)
                                             ->with('classes_data.teacher_data')
                                             ->whereHas("classes_data.teacher_data", function($query) use($t_email, $email_mobile)
                                             {
                                                $query->select('id', 'first_name', 'last_name', 'email', 'contact');
                                                $query->where($email_mobile, $t_email);
                                             })
                                             ->first();

                if($obj_user)
                {
                    $arr_user = $obj_user->toArray();

                    $student_id         = $arr_user['id'];
                    $student_first_name = $arr_user['first_name'];
                    $student_last_name  = $arr_user['last_name'];
                    $old_teacher_id     = $arr_user['classes_data'][0]['teacher_data']['id'];
                    $old_class_id       = $arr_user['classes_data'][0]['classroom_id'];

                    $arr_stud['subject_id'] = $subject_id;
                    $arr_stud['grade_id']   = $grade_id;
                    $is_updated             = $this->StudentDetailsModel->where('student_id', $student_id)->update($arr_stud);

                    $class_count = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                               ->where('teacher_id', $teacher_id)
                                                               ->where('student_id', $student_id)
                                                               ->count();
                    if($class_count == 0)
                    {
                        $delete = $this->ClassroomStudentModel->where('classroom_id', $old_class_id)
                                                              ->where('teacher_id', $old_teacher_id)
                                                              ->where('student_id', $student_id)
                                                              ->delete();

                        $arr_class_student['classroom_id'] = $class_id;
                        $arr_class_student['teacher_id']   = $teacher_id;
                        $arr_class_student['student_id']   = $student_id;
                        $create = $this->ClassroomStudentModel->create($arr_class_student);

                        if(!empty($program_id) && $program_id != '')
                        {
                            $count = $this->StudentProgramsModel->where('student_id', $student_id)
                                                                ->where('program_id', $program_id)
                                                                ->where('created_by', $teacher_id)
                                                                ->where('assigned_by', 'teacher')
                                                                ->count();
                            if($count == 0)
                            {
                                $arr_program['student_id']  = $student_id;
                                $arr_program['program_id']  = $program_id;
                                $arr_program['created_by']  = $teacher_id;
                                $arr_program['assigned_by'] = 'teacher';
                                $this->StudentProgramsModel->create($arr_program);

                                $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                                if($obj_program_questions)
                                {
                                    $arr_program_questions = $obj_program_questions->toArray();

                                    foreach ($arr_program_questions as $pkey => $program_questions)
                                    {
                                        $arr_question['program_id']  = $program_id;
                                        $arr_question['template_id'] = $program_questions['template_id'];
                                        $arr_question['lesson_id']   = $program_questions['lesson_id'];
                                        $arr_question['question_id'] = $program_questions['question_id'];
                                        $arr_question['student_id']  = $student_id;

                                        $this->StudentProgramQuestionModel->create($arr_question);
                                    }
                                }
                            }
                        }

                        // Store notification for admin
                        $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has transfer student, '.$student_first_name.' '.$student_last_name;
                        $arr_noti['from_user_id'] = $teacher_id;
                        $arr_noti['to_user_id']   = 1;
                        $arr_noti['url']          = "/admin/users/student/view/".base64_encode($student_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        // Store notification for teacher
                        $arr_noti['message']      = trans('teacher.You_have_successfully_transfer_student').$student_first_name.' '.$student_last_name;
                        $arr_noti['from_user_id'] = 1;
                        $arr_noti['to_user_id']   = $teacher_id;
                        $arr_noti['url']          = "/teacher/my-student/".base64_encode($class_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);
                    }
                    else
                    {
                        // Store notification for teacher
                        $arr_noti['message']      = $student_first_name.' '.$student_last_name.trans('teacher.student_already_exists_in_your_class');
                        $arr_noti['from_user_id'] = 1;
                        $arr_noti['to_user_id']   = $teacher_id;
                        $arr_noti['url']          = "/teacher/my-student/".base64_encode($class_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);
                    }
                }
                else
                {
                    // Store notification for teacher
                    $arr_noti['message'] = "Entered email/mobile, ".$old_teacher_email[$key].trans('teacher.doesnt_belong_to_this_pin').$data.trans('teacher.or_vice_versa');
                    $arr_noti['from_user_id'] = 1;
                    $arr_noti['to_user_id']   = $teacher_id;
                    $arr_noti['url']          = "";
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);
                }
                
                if(count($arr_class)>0 && $student_id!=''){
                    // Store notification for Student
                    $arr_noti['message']      = trans('teacher.You_have_successfully_transfered_to_class').$arr_class['name'];
                    $arr_noti['from_user_id'] = $teacher_id;
                    $arr_noti['to_user_id']   = $student_id;
                    $arr_noti['url']          = "";
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);
                }
            }

            if($is_updated)
            {
                Session::flash('success', trans('teacher.transfer_existed_child_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('parent.something_went_wrong'));
                return redirect()->back();
            }
        }


        // To Existing Student with Enrollment Code
        if($student_type == 'existing_student')
        {
            $parent_teacher_email = isset($form_data['parent_teacher_email']) && sizeof($form_data['parent_teacher_email']) > 0 ? $form_data['parent_teacher_email'] : '';
            $pin                  = isset($form_data['pin']) && sizeof($form_data['pin']) > 0 ? $form_data['pin'] : '';
            
            foreach ($pin as $key => $data)
            {   
                $student_id = '';
                $obj_user = $this->UsersModel->where('user_type', 'student')->where('pin', $data);

                if( $parent_teacher_email[$key] != '' && !empty($parent_teacher_email[$key]) && isset($parent_teacher_email[$key]) )
                {
                    $pt_user_type = '';
                    $pt_email     = $parent_teacher_email[$key];

                    if(is_numeric($pt_email)) {
                        $email_mobile = 'contact';
                    } else {
                        $email_mobile = 'email';
                    }

                    $obj_pt_user = $this->UsersModel->where('email', $pt_email)->select('id', 'email', 'user_type')->first();
                    if($obj_pt_user) {
                        $arr_pt_user  = $obj_pt_user->toArray();

                        $pt_user_type = $arr_pt_user['user_type'];
                    }

                    if($pt_user_type == 'parent') {
                        $table = 'student_details.parent_data';
                    } else {
                        $table = 'classes_data.teacher_data';
                    }

                    $obj_user = $obj_user->with($table)
                                         ->whereHas($table, function($query) use($pt_email, $email_mobile)
                                        {
                                            $query->select('id', 'first_name', 'last_name', 'email', 'contact');
                                            $query->where($email_mobile, $pt_email);
                                        });
                }
                
                $obj_user = $obj_user->first();

                if($obj_user)
                {
                    $arr_user = $obj_user->toArray();

                    $student_id         = $arr_user['id'];
                    $student_first_name = $arr_user['first_name'];
                    $student_last_name  = $arr_user['last_name'];

                    $arr_stud['subject_id'] = $subject_id;
                    $arr_stud['grade_id']   = $grade_id;
                    $is_updated = $this->StudentDetailsModel->where('student_id', $student_id)->update($arr_stud);

                    $class_count = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                               ->where('teacher_id', $teacher_id)
                                                               ->where('student_id', $student_id)
                                                               ->count();

                    if($class_count == 0)
                    {
                        $arr_class_student['classroom_id'] = $class_id;
                        $arr_class_student['teacher_id']   = $teacher_id;
                        $arr_class_student['student_id']   = $student_id;
                        $this->ClassroomStudentModel->create($arr_class_student);

                        if(!empty($program_id) && $program_id != '')
                        {
                            $count = $this->StudentProgramsModel->where('student_id', $student_id)
                                                                ->where('program_id', $program_id)
                                                                ->where('created_by', $teacher_id)
                                                                ->where('assigned_by', 'teacher')
                                                                ->count();
                            if($count == 0)
                            {
                                $arr_program['student_id']  = $student_id;
                                $arr_program['program_id']  = $program_id;
                                $arr_program['created_by']  = $teacher_id;
                                $arr_program['assigned_by'] = 'teacher';
                                $this->StudentProgramsModel->create($arr_program);

                                $obj_program_questions = $this->ProgramQuestionModel->where('program_id', $program_id)->get();
                                if($obj_program_questions)
                                {
                                    $arr_program_questions = $obj_program_questions->toArray();

                                    foreach ($arr_program_questions as $pkey => $program_questions)
                                    {
                                        $arr_question['program_id']  = $program_id;
                                        $arr_question['template_id'] = $program_questions['template_id'];
                                        $arr_question['lesson_id']   = $program_questions['lesson_id'];
                                        $arr_question['question_id'] = $program_questions['question_id'];
                                        $arr_question['student_id']  = $student_id;

                                        $this->StudentProgramQuestionModel->create($arr_question);
                                    }
                                }
                            }
                        }

                        // Store notification for admin
                        $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has added existing student, '.$student_first_name.' '.$student_last_name;
                        $arr_noti['from_user_id'] = $teacher_id;
                        $arr_noti['to_user_id']   = 1;
                        $arr_noti['url']          = "/admin/users/student/view/".base64_encode($student_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        // Store notification for teacher
                        $arr_noti['message']      = trans('teacher.You_have_successfully_added_existing_student').$student_first_name.' '.$student_last_name;
                        $arr_noti['from_user_id'] = 1;
                        $arr_noti['to_user_id']   = $teacher_id;
                        $arr_noti['url']          = "/teacher/my-student/".base64_encode($class_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);
                    }
                    else
                    {
                        // Store notification for teacher
                        $arr_noti['message']      = $student_first_name.' '.$student_last_name.trans('teacher.student_already_exists_in_your_class');
                        $arr_noti['from_user_id'] = 1;
                        $arr_noti['to_user_id']   = $teacher_id;
                        $arr_noti['url']          = "/teacher/my-student/".base64_encode($class_id);
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);
                    }
                }
                else
                {
                    if( $parent_teacher_email[$key] != '' && !empty($parent_teacher_email[$key]) && isset($parent_teacher_email[$key]) )
                    {
                        $arr_noti['message'] = trans('teacher.Entered_email_mobile').$parent_teacher_email[$key].trans('teacher.doesnt_belong_to_this_pin_or_entered_pin').$data.trans('teacher.doesnt_exists');
                    }
                    else
                    {
                        $arr_noti['message'] = trans('teacher.Entered_pin').$data.trans('teacher.doesnt_exists');
                    }

                    // Store notification for teacher
                    $arr_noti['from_user_id'] = 1;
                    $arr_noti['to_user_id']   = $teacher_id;
                    $arr_noti['url']          = "";
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);
                }
                if(count($arr_class)>0 && $student_id!=''){
                    // Store notification for Student
                    $arr_noti['message']      = trans('teacher.You_have_successfully_added_to_class').$arr_class['name'].' by '.$teacher_first_name.' '.$teacher_last_name;
                    $arr_noti['from_user_id'] = $teacher_id;
                    $arr_noti['to_user_id']   = $student_id;
                    $arr_noti['url']          = "";
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);
                }
            }

            if($is_updated)
            {
                Session::flash('success', trans('parent.exist_child_add_enrollment_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('parent.something_went_wrong'));
                return redirect()->back();
            }

        }

    } // end AddMyStudent


    /*
    | Function  : Get add new student form fields
    | Author    : Deepak Arvind Salunke
    | Date      : 06/07/2018
    | Output    : Show add new student form fields
    */

    public function AddMyNewStudentForm(Request $request)
    {
        $errors    = [];
        $html      = '';
        $form_data = $request->all();
        $count     = isset($form_data['count']) ? $form_data['count'] : '';

        if($count)
        {
            $html .= '<div class="form-group removeclass'.$count.'"><div class="row add_student_row"><div class="col-sm-4 col-md-4 col-lg-4"><div class="form-group"><label>First Name</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field alphabets" id="student_first_name_'.$count.'" name="student_first_name[]" placeholder="Enter First Name" maxlength="50" data-count="'.$count.'" data-name="first name" data-email="no">';
            $html .= '</div><div class="error" id="err_student_first_name_'.$count.'">';
            $html .= '</div></div></div><div class="col-sm-4 col-md-4 col-lg-4"><div class="form-group"><label>Last Name</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field alphabets" id="student_last_name_'.$count.'" name="student_last_name[]" placeholder="Enter Last Name" maxlength="50" data-count="'.$count.'" data-name="last name" data-email="no">';
            $html .= '</div><div class="error" id="err_student_last_name_'.$count.'" >';
            $html .= '</div></div></div><div class="col-sm-4 col-md-4 col-lg-4"><div class="form-group"><label>PIN</label><div class="name-field">';
            $html .= '<input type="text" class="form-control digits input_field" id="student_pin_'.$count.'" name="student_pin[]" maxlength="4" placeholder="Enter PIN" value="'.RandomPin().'" readonly data-count="'.$count.'" data-name="student pin" data-email="no">';
            $html .= '</div><div class="error" id="err_student_pin_'.$count.'">';
            $html .= '</div></div></div></div>';
            $html .= '<a type="button" class="remove-btn-block btn_remove_student" data-count="'.$count.'">Remove Student</a>';
            $html .= '<div class="error last_count_error"></div>';
            $html .= '<div class="clear"></div></div>';
        }
        else
        {
            $html .= '<div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><div class="form-group">Something went wrong!</div></div></div>';
        }

        echo $html;

    } // end AddMyStudentForm


    /*
    | Function  : Get add transfer student form fields
    | Author    : Deepak Arvind Salunke
    | Date      : 07/07/2018
    | Output    : Show add transfer student form fields
    */

    public function AddMyTransferStudentForm(Request $request)
    {
        $errors    = [];
        $html      = '';
        $form_data = $request->all();
        $count     = isset($form_data['count']) ? $form_data['count'] : '';

        if($count)
        {
            $html .= '<div class="form-group removeclass'.$count.'"><div class="row add_student_row"><div class="col-sm-6 col-md-6 col-lg-6"><div class="form-group"><label>Teacher Email</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field" id="teacher_email_'.$count.'" name="teacher_email[]" placeholder="Enter Teacher Email" maxlength="250" data-count="'.$count.'" data-name="teacher email" data-email="yes">';
            $html .= '</div><div class="error" id="err_teacher_email_'.$count.'"></div>';
            $html .= '</div></div><div class="col-sm-6 col-md-6 col-lg-6"><div class="form-group"><label>PIN</label><div class="name-field">';
            $html .= '<input type="text" class="form-control digits input_field" id="student_pin_'.$count.'" name="student_pin[]" maxlength="4" placeholder="Enter PIN" value="'.RandomPin().'" readonly data-count="'.$count.'" data-name="stuend pin" data-email="no">';
            $html .= '</div><div class="error" id="err_student_pin_'.$count.'"></div>';
            $html .= '</div></div><div class="col-sm-6 col-md-6 col-lg-6"><div class="form-group"><label>First Name</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field alphabets" id="student_first_name_'.$count.'" name="student_first_name[]" placeholder="Enter First Name" maxlength="50" data-count="'.$count.'" data-name="first name" data-email="no">';
            $html .= '</div><div class="error" id="err_student_first_name_'.$count.'"></div>';
            $html .= '</div></div><div class="col-sm-6 col-md-6 col-lg-6"><div class="form-group"><label>Last Name</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field alphabets" id="student_last_name_'.$count.'" name="student_last_name[]" placeholder="Enter Last Name" maxlength="50" data-count="'.$count.'" data-name="last name" data-email="no">';
            $html .= '</div><div class="error" id="err_student_last_name_'.$count.'" ></div>';
            $html .= '</div></div></div><a type="button" class="remove-btn-block btn_remove_student" data-count="'.$count.'">Remove Student</a><div class="error last_count_error"></div><div class="clear"></div></div>';
        }
        else
        {
            $html .= '<div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><div class="form-group">Something went wrong!</div></div></div>';
        }

        echo $html;

    } // end AddMyTransferStudentForm


    /*
    | Function  : check if email exists or not
    | Author    : Deepak Arvind Salunke
    | Date      : 29/06/2018
    | Output    : Success or Error
    */

    public function CheckTeacherEmail(Request $request)
    {
        $email = $request->input('email');
        $num   = $this->UsersModel->where('user_type', 'teacher')->where('email', $email)->count();
        if($num > 0)
        {
            //return Response::json('error');
            echo "error";
        }
        else
        {
            //return Response::json('success');
            echo "success";
        }
    } // end DuplicateEmail


    /*
    | Function  : Get add existing student form fields
    | Author    : Deepak Arvind Salunke
    | Date      : 07/07/2018
    | Output    : Show add existing student form fields
    */

    public function AddMyExistingStudentForm(Request $request)
    {
        $errors    = [];
        $html      = '';
        $form_data = $request->all();
        $count     = isset($form_data['count']) ? $form_data['count'] : '';

        if($count)
        {
            $html .= '<div class="form-group removeclass'.$count.'"><div class="row add_student_row"><div class="col-sm-12 col-md-12 col-lg-12"><div class="form-group"><label>Enrollment Code</label><div class="name-field">';
            $html .= '<input type="text" class="form-control input_field digits" id="enrollment_code_'.$count.'" name="enrollment_code[]" placeholder="Enter Enrollment Code" data-count="'.$count.'" data-name="enrollment code">';
            $html .= '</div><div class="error" id="err_enrollment_code_'.$count.'"></div>';
            $html .= '</div></div></div><a type="button" class="remove-btn-block btn_remove_student" data-count="'.$count.'">Remove Student</a><div class="error last_count_error"></div><div class="clear"></div></div>';
        }
        else
        {
            $html .= '<div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><div class="form-group">Something went wrong!</div></div></div>';
        }

        echo $html;

    } // end AddMyExistingStudentForm


    public function GetStudentPin()
    {
        echo RandomPin();
        /*return Response::json( RandomPin() );*/
    }



    /*
    | Function  : Get list of all the student present in selected class
    | Author    : Deepak Arvind Salunke
    | Date      : 20/07/2018
    | Output    : Show list of all the student present in selected class
    */

    public function MyStudentList(Request $request,$enc_id=false)
    {
        if($enc_id)
        {
            $arr_student = $arr_pagination = $arr_class = $arr_subject = $arr_grade = $arr_program = [];
            $expired     = 'yes';

            $teacher_id   = Auth::user()->id;
            $class_id     = base64_decode($enc_id);
            $keyword      = $request->input('keyword');
            $current_date = date("Y-m-d");

            // Edit Data Get
            $obj_class = $this->ClassroomsModel->where('id', $class_id)
                                               ->select('id','name','slug','teacher_id','subject_id','grade_id','program_id','end_date')
                                               ->with(['grade_data' => function($query) {
                                                    $query->select('id','grade_id','name','locale');
                                                    $query->where('locale',\App::getLocale());
                                                }])
                                               ->with(['subject_data' => function($query) {
                                                    $query->select('id','subject_id','name','locale');
                                                    $query->where('locale',\App::getLocale());
                                                }])
                                               ->first();
            if($obj_class)
            {
                $arr_class = $obj_class->toArray();
                
                if(strtotime($current_date) <= strtotime($arr_class['end_date']))
                {
                    $expired = "no";
                }
            }

            $obj_subject = $this->SubjectModel->where('status', '1')->get();
            if($obj_subject)
            {
                $arr_subject = $obj_subject->toArray();
            }

            $obj_grade = $this->GradeModel->where('status', '1')->get();
            if($obj_grade)
            {
                $arr_grade = $obj_grade->toArray();
            }

                
            // Student Listing 
            $obj_student = $this->ClassroomStudentModel->where('teacher_id', $teacher_id)
                                                       ->where('classroom_id', $class_id)
                                                       ->with(['student_data' => function($query){
                                                            $query->select('id','user_type','first_name','last_name','pin');
                                                        }])
                                                       ->orderBy('id','DESC');
            
            if($keyword!=null && $keyword!='')
            {
                $obj_student = $obj_student->whereHas('student_data', function($query)use($keyword){
                                                $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR pin = '".$keyword."')");
                                            });
            }

            $obj_student = $obj_student->paginate(10);

            if($obj_student)
            {
                $arr_student    = $obj_student->toArray();                
                $arr_pagination = $obj_student->links();
            }
            
            
            $data['module_url_path']=  $this->module_url_path;
            $data['arr_class']      = $arr_class;
            $data['arr_student']    = $arr_student;
            $data['arr_pagination'] = $arr_pagination;

            $data['arr_subject']    = $arr_subject;
            $data['arr_grade']      = $arr_grade;
            $data['arr_program']    = $arr_program;
            $data['expired']        = $expired;

            $data['user_type']      = 'teacher';
            $data['parentTitle']    = trans('home.Dashboard');
            $data['pageTitle']      = trans('teacher.My_Students');
            $data['secondParentTitle']   = trans('teacher.My_Classes');    
            $data['secondParentUrl']     = url('/').'/teacher/class';    
            $data['middleContent']  = 'teacher.my-student.index';
            
            return view('front.layout.master')->with($data);
        }
        else
        {
            return redirect()->back();
        }
    } // end MyStudentList



    /*
    | Function  : Update selected student data
    | Author    : Deepak Arvind Salunke
    | Date      : 20/07/2018
    | Output    : Success or Error
    */

    public function UpdateMyStudent(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['first_name'] = "required";
        $arr_rules['last_name']  = "required";
        $arr_rules['grade']      = "required";
        //$arr_rules['pin']        = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_are_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher_id         = Auth::user()->id;
        $teacher_first_name = Auth::user()->first_name;
        $teacher_last_name  = Auth::user()->last_name;

        $form_data = $request->all();
        $user_type = 'teacher';

        $class_id                = isset($form_data['class_id']) ? base64_decode($form_data['class_id']) : '';
        $student_id              = isset($form_data['student_id']) ? base64_decode($form_data['student_id']) : '';
        $arr_user['first_name']  = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
        $arr_user['last_name']   = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
        //$arr_user['pin']         = isset($form_data['pin']) ? $form_data['pin'] : '';
        $is_updated              = $this->UsersModel->where('id', $student_id)->update($arr_user);

        $arr_student['grade_id'] = isset($form_data['grade']) ? $form_data['grade'] : '';
        $is_student_updated      = $this->StudentDetailsModel->where('student_id', $student_id)->update($arr_student);
        if($is_updated)
        {
            // Store notification for admin
            $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has updated a student data, '.$arr_user['first_name'].' '.$arr_user['last_name'];
            $arr_noti['from_user_id'] = $teacher_id;
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = "/admin/users/student/view/".base64_encode($student_id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            // Store notification for teacher
            $arr_noti['message']      = trans('teacher.You_have_successfully_updated_a_student_data').$arr_user['first_name'].' '.$arr_user['last_name'];
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $teacher_id;
            $arr_noti['url']          = "teacher/my-student/".base64_encode($class_id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);
            
            // Store notification for student
            $arr_noti['message']      = trans('teacher.Your_name').$arr_user['first_name'].' '.$arr_user['last_name'].trans('teacher.has_been_updated_by').$teacher_first_name.' '.$teacher_last_name;
            $arr_noti['from_user_id'] = $teacher_id;
            $arr_noti['to_user_id']   = $student_id;
            $arr_noti['url']          = "";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);            

            Session::flash('success', trans('teacher.Student_update_success'));
            return redirect()->back();
        }
        else
        {
            Session::flash('error', trans('teacher.Student_update_error'));
            return redirect()->back();
        }

    } // end UpdateMyStudent



    /*
    | Function  : Remove selected student data from the current class
    | Author    : Deepak Arvind Salunke
    | Date      : 20/07/2018
    | Output    : Success or Error
    */

    public function RemoveMyStudent(Request $request)
    {

        $arr_class          = [];
        $teacher_id         = Auth::user()->id;
        $teacher_first_name = Auth::user()->first_name;
        $teacher_last_name  = Auth::user()->last_name;
        $user_type          = 'teacher';

        $form_data  = $request->all();
        $class_id   = isset($form_data['remove_class_id'])   ? base64_decode($form_data['remove_class_id'])   : '';
        $student_id = isset($form_data['remove_student_id']) ? base64_decode($form_data['remove_student_id']) : '';
        $first_name = isset($form_data['remove_first_name']) ? ucfirst($form_data['remove_first_name'])       : '';
        $last_name  = isset($form_data['remove_last_name'])  ? ucfirst($form_data['remove_last_name'])        : '';

        if(!empty($class_id) && !empty($student_id))
        {
            $is_deleted = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                      ->where('teacher_id', $teacher_id)
                                                      ->where('student_id', $student_id)
                                                      ->delete();

            if($is_deleted)
            {
                // Store notification for admin
                $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has removed a student from class, '.$first_name.' '.$last_name;
                $arr_noti['from_user_id'] = $teacher_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/users/student";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for teacher
                $arr_noti['message']      = trans('teacher.You_have_successfully_removed_a_student_from_your_class').$first_name.' '.$last_name;
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $teacher_id;
                $arr_noti['url']          = "teacher/my-student/".base64_encode($class_id);
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                $obj_student              = $this->ClassroomsModel->where('id',$class_id)->select('id','name')
                                                                  ->first();
                if($obj_student)
                {
                  $arr_class = $obj_student->toArray();
                }
                if(isset($arr_class) && count($arr_class)>0)
                {
                    // Store notification for Student
                    $arr_noti['message']      = trans('teacher.You_have_been_removed_from_class').$arr_class['name'].trans('teacher.by').$teacher_first_name.' '.$teacher_last_name;
                    $arr_noti['from_user_id'] = $teacher_id;
                    $arr_noti['to_user_id']   = $student_id;
                    $arr_noti['url']          = "";
                    $arr_noti['is_read']      = "0";
                    $status                   = $this->NotificationService->send_notification($arr_noti);
                }
                Session::flash('success', $first_name.' '.$last_name.trans('teacher.successfully_removed_from_your_class'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('teacher.Student_remove_error'));
                return redirect()->back();
            }

        }
        else
        {
            Session::flash('error', trans('parent.something_went_wrong'));
            return redirect()->back();
        }

    } // end RemoveMyStudent



    public function MyProgram($enc_class_id = false, $enc_student_id = false)
    {
        if(isset($enc_class_id) && !empty($enc_class_id) && isset($enc_student_id) && !empty($enc_student_id))
        {
            $arr_program = $arr_classes = $arr_student_program = $arr_pagination = $arr_student = [];
            $subject_id  = $grade_id    = $serach_date         = $keyword        = '';

            $data['cancel_link'] = 'javascript:void(0);';

            $teacher_id  = Auth::user()->id;
            $class_id    = isset($enc_class_id)   && !empty($enc_class_id)   ? base64_decode($enc_class_id)   : '';
            $student_id  = isset($enc_student_id) && !empty($enc_student_id) ? base64_decode($enc_student_id) : '';

            $obj_classes = $this->ClassroomsModel->where('id', $class_id)
                                                 ->where('status', '1')
                                                 ->first();
            if($obj_classes)
            {
                $arr_classes = $obj_classes->toArray();

                $subject_id  = $arr_classes['subject_id'];
                $grade_id    = $arr_classes['grade_id'];
            }

            $obj_program = $this->ProgramModel->where('subject', $subject_id)
                                              ->where('grade', $grade_id)
                                              ->where('approve_status', 'approved')
                                              ->where('status', '1')
                                              ->get();
            if($obj_program)
            {
                $arr_program = $obj_program->toArray();
            }

            $obj_student_program = $this->StudentProgramsModel->where('student_id', $student_id)
                                                              ->where('assigned_by', 'teacher')
                                                              ->where('created_by', $teacher_id)
                                                              ->with(['program_details' => function($query){
                                                                $query->select('id','unique_id','name','slug');
                                                              }])
                                                              ->orderBy('id', 'DESC');

            if( isset($_GET['keyword']) && !empty($_GET['keyword']) )
            {
                $keyword             = $_GET['keyword'];
                $obj_student_program = $obj_student_program->whereHas("program_details", function($query) use ($keyword) {
                                                                $query->whereRaw("( name LIKE '%".$keyword."%' )");
                                                            });
                $data['cancel_link'] = url('/').'/teacher/my-student/'.$enc_class_id.'/'.$enc_student_id.'/my-program';
            }

            if( isset($_GET['search']) && !empty($_GET['search']) )
            {
                $serach_date         = $_GET['search'];
                $obj_student_program = $obj_student_program->whereDate('created_at', '=', date('c', strtotime($serach_date)) );
                $data['cancel_link'] = url('/').'/teacher/my-student/'.$enc_class_id.'/'.$enc_student_id.'/my-program';
            }

            $obj_student_program = $obj_student_program->paginate(10);

            if($obj_student_program)
            {
                $arr_student_program = $obj_student_program->toArray();

                foreach ($arr_student_program['data'] as $key => $value) {
                    $arr_student_program['data'][$key]['right_percentage'] = $this->StudentService->CheckRightAnswerPercentage($value['program_id'], $value['student_id']);
                    $arr_student_program['data'][$key]['wrong_percentage'] = $this->StudentService->CheckWrongAnswerPercentage($value['program_id'], $value['student_id']);
                    $arr_student_program['data'][$key]['delay_percentage'] = $this->StudentService->CheckDelayAnswerPercentage($value['program_id'], $value['student_id']);
                    $arr_student_program['data'][$key]['program_status']   = $this->StudentService->CheckProgramStatus($value['program_id'], $value['student_id']);
                }

                $arr_pagination      = $obj_student_program->links();
            }

            $obj_student = $this->UsersModel->where('id', $student_id)->select('id','first_name','last_name')->first();
            if($obj_student)
            {
                $arr_student = $obj_student->toArray();
            }

            $data['arr_student_program'] = $arr_student_program;
            $data['arr_pagination']      = $arr_pagination;
            $data['arr_program']         = $arr_program;
            $data['arr_student']         = $arr_student;

            $data['enc_class_id']        = $enc_class_id;
            $data['enc_student_id']      = $enc_student_id;
            $data['serach_date']         = $serach_date;
            $data['keyword']             = $keyword;
            
            $data['secondParentUrl']     = url('/').'/teacher/my-student/'.$enc_class_id;
            $data['secondParentTitle']   = 'My Students';

            $data['user_type']           = 'teacher';
            $data['parentTitle']         = trans('home.Dashboard');
            $data['pageTitle']           = trans('teacher.My_Programs');
            $data['middleContent']       = 'teacher.my-program.index';
            
            return view('front.layout.master')->with($data);
        }
        else
        {
            Session::flash('error', trans('parent.something_went_wrong'));
            return redirect()->back();
        }

    } //  end MyProgram



    public function CheckEmailCode(Request $request)
    {
        $form_data = $request->all();
        $email     = isset($form_data['email']) && !empty($form_data['email']) ? $form_data['email'] : '';
        $pin       = isset($form_data['pin'])   && !empty($form_data['pin'])   ? $form_data['pin']   : '';

        if(is_numeric($email))
        {
            $email_mobile = 'contact';
        }
        else
        {
            $email_mobile = 'email';
        }

        $obj_user = $this->UsersModel->where($email_mobile, $email)->select('id', 'email', 'contact', 'user_type')->first();
        if($obj_user) {
            $arr_user  = $obj_user->toArray();
            $user_type = $arr_user['user_type'];
        }

        if($user_type == 'parent') {
            $table = 'student_details.parent_data';
        } else {
            $table = 'classes_data.teacher_data';
        }

        $count = $this->UsersModel->where('user_type', 'student')
                                ->where('pin', $pin)
                                ->with($table)
                                ->whereHas($table, function($query) use($email, $email_mobile) {
                                    $query->select('first_name', 'last_name', 'email', 'contact');
                                    $query->where($email_mobile, $email);
                                })
                                ->count();
        
        if($count > 0) {
            echo "success";
        } else {
            echo "error";
        }
    }


    public function CheckEmailData(Request $request)
    {
        $arr_user      = [];
        $form_data     = $request->all();
        $teacher_email = isset($form_data['teacher_email']) && !empty($form_data['teacher_email']) ? $form_data['teacher_email'] : '';
        $student_pin   = isset($form_data['student_pin']) && !empty($form_data['student_pin']) ? $form_data['student_pin'] : '';

        if(is_numeric($teacher_email)) {
            $email_mobile = 'contact';
        } else {
            $email_mobile = 'email';
        }

        $obj_user = $this->UsersModel->where('user_type', 'student')
                                    ->where('pin', $student_pin)
                                    ->with('classes_data.teacher_data')
                                    ->whereHas("classes_data.teacher_data", function($query) use($teacher_email, $email_mobile)
                                    {
                                        $query->select('first_name', 'last_name', 'email', 'contact');
                                        $query->where('email', $teacher_email);
                                    })
                                    ->first();
        
        if($obj_user) {
            $arr_user = $obj_user->toArray();
        }

        return Response::json($arr_user);
    }


    public function ChangeProgram(Request $request)
    {
        $form_data = $arr_rules = array();

        $arr_rules['change_program'] = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('teacher.Select_program_to_assign'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $form_data  = $request->all();
        $teacher_id = Auth::user()->id;
        $teacher_first_name = Auth::user()->first_name;
        $teacher_last_name  = Auth::user()->last_name;
        
        $class_id   = isset($form_data['enc_class_id'])   && !empty($form_data['enc_class_id'])   ? base64_decode($form_data['enc_class_id'])   : '';
        $student_id = isset($form_data['enc_student_id']) && !empty($form_data['enc_student_id']) ? base64_decode($form_data['enc_student_id']) : '';
        $program_id = isset($form_data['change_program']) && !empty($form_data['change_program']) ? $form_data['change_program']                : '';

        $count =  $this->StudentProgramsModel->where('created_by',$teacher_id)
                                             ->where('student_id',$student_id)
                                             ->where('program_id',$program_id)
                                             ->count();

        if($count == 0)
        {
            $arr_program['created_by']  = $teacher_id;
            $arr_program['student_id']  = $student_id;
            $arr_program['program_id']  = $program_id;
            $arr_program['assigned_by'] = 'teacher';
            $is_added = $this->StudentProgramsModel->insert($arr_program);

            if($is_added)
            {
                $program_count = $this->StudentProgramQuestionModel->where('student_id',$student_id)
                                                                    ->where('program_id',$program_id)
                                                                    ->count();
                if($program_count == 0)
                {
                    $obj_program_questions = $this->ProgramQuestionModel->whereHas('programData')->with('programData')->where('program_id', $program_id)->get();
                    if($obj_program_questions)
                    {
                        $arr_program_questions = $obj_program_questions->toArray();
                        
                        foreach ($arr_program_questions as $key => $program_questions)
                        {
                            $arr_question['program_id']  = $program_id;
                            $arr_question['template_id'] = $program_questions['template_id'];
                            $arr_question['lesson_id']   = $program_questions['lesson_id'];
                            $arr_question['question_id'] = $program_questions['question_id'];
                            $arr_question['student_id']  = $student_id;

                            $this->StudentProgramQuestionModel->create($arr_question);
                        }

                        // Store notification for student
                        $arr_noti['message']      = 'A new program : '.$arr_program_questions[0]['program_data']['name'].' is assigned to you by '.$teacher_first_name.' '.$teacher_last_name;
                        $arr_noti['from_user_id'] = $teacher_id;
                        $arr_noti['to_user_id']   = $student_id;
                        $arr_noti['url']          = "/student/program/details";
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);            


                        Session::flash('success',trans('parent.Program_changed_success'));
                    }
                }
                else
                {
                    Session::flash('error',trans('parent.something_went_wrong_assign_program'));
                }
            }
            else
            {
                Session::flash('error',trans('parent.something_went_wrong'));
            }
        }
        else
        {
            Session::flash('error',trans('parent.Program_already_assigned'));
        }

        return redirect()->back();

    } // end ChangeProgram



    public function MyStudentExportCSV(Request $request)
    {
        $class_name   = $subject_name = $grade_name = $program_id = $program_name = $end_date = '';
        $export_array = $arr_student  = $arr_class  = [];

        $form_data  = $request->all();
        $class_id   = isset($form_data['enc_class_id'])   && !empty($form_data['enc_class_id'])   ? base64_decode($form_data['enc_class_id'])   : '';
        $keyword    = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword']                : '';
        $teacher_id = Auth::user()->id;


        // Get class data
        $obj_class = $this->ClassroomsModel->where('id', $class_id)
                                           ->select('id','name','slug','teacher_id','subject_id','grade_id','program_id','end_date')
                                           ->with(['subject_data' => function($query) {
                                                $query->select('id','subject_id','name','locale');
                                                $query->where('locale',\App::getLocale());
                                            }])
                                           ->with(['grade_data' => function($query) {
                                                $query->select('id','grade_id','name','locale');
                                                $query->where('locale',\App::getLocale());
                                            }])
                                           ->with(['program_details' => function($query) {
                                                $query->select('id','unique_id','name','description');
                                            }])
                                           ->first();
        if($obj_class)
        {
            $arr_class    = $obj_class->toArray();

            $class_name   = $arr_class['name'];
            $subject_name = $arr_class['subject_data']['name'];
            $grade_name   = $arr_class['grade_data']['name'];
            $program_id   = $arr_class['program_details']['unique_id'];
            $program_name = $arr_class['program_details']['name'];
            $end_date     = get_added_on_date_time($arr_class['end_date']);
        }

            
        // Student Listing 
        $obj_student = $this->ClassroomStudentModel->where('teacher_id', $teacher_id)
                                                   ->where('classroom_id', $class_id)
                                                   ->with(['student_data' => function($query){
                                                        $query->select('id','user_type','first_name','last_name','pin');
                                                    }])
                                                   ->orderBy('id','DESC');

        if($keyword!=null && $keyword!='')
        {
            $obj_student = $obj_student->whereHas('student_data', function($query)use($keyword){
                                            $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR pin = '".$keyword."')");
                                        });
        }

        $obj_student = $obj_student->get();
        if($obj_student)
        {
            $arr_student = $obj_student->toArray();

            // build data array to export
            foreach ($arr_student as $key => $student) 
            {
                $first_name           = isset($student['student_data']['first_name'])? $student['student_data']['first_name']:'NA';
                $last_name            = isset($student['student_data']['last_name'])? $student['student_data']['last_name']:'NA';
                $pin                  = isset($student['student_data']['pin'])? $student['student_data']['pin']:'NA';

                $data[trans('teacher.Sr_No')]            = ($key+1);
                $data[trans('teacher.Class_Name')]       = $class_name;
                $data[trans('teacher.Name_Of_Student')]  = $first_name.' '.$last_name;
                $data[trans('teacher.Pin')]              = $pin;
                $data[trans('parent.Subject')]           = $subject_name;
                $data[trans('parent.Grade')]             = $grade_name;

                $data[trans('parent.Program_Id')]        = $program_id;
                $data[trans('parent.Program_Name')]      = $program_name;
                $data[trans('teacher.End_Date')]         = $end_date;

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        $type = 'CSV';

        return Excel::create($class_name.' '.trans('teacher.Class_Report'), function($excel) use ($data, $class_name) {

            // Set the title
            $excel->setTitle($class_name.' '.trans('teacher.Class_Report'));

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription($class_name.' '.trans('teacher.Class_Report'));

            $excel->sheet($class_name.' '.trans('teacher.Class_Report'), function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);


    } // end MyStudentExportCSV


    public function MyProgramsExportCSV(Request $request)
    {
        $class_name  = $subject_name = $grade_name          = $first_name   = $last_name = '';
        $arr_classes = $arr_student  = $arr_student_program = $export_array = [];

        $form_data  = $request->all();
        $class_id   = isset($form_data['enc_class_id'])   && !empty($form_data['enc_class_id'])   ? base64_decode($form_data['enc_class_id'])   : '';
        $student_id = isset($form_data['enc_student_id']) && !empty($form_data['enc_student_id']) ? base64_decode($form_data['enc_student_id']) : '';
        $keyword    = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword']                : '';
        $date       = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']                   : '';
        $teacher_id = Auth::user()->id;

        // Get class data
        $obj_classes = $this->ClassroomsModel->where('id', $class_id)
                                             ->where('status', '1')
                                             ->with(['subject_data' => function($query) {
                                                $query->select('id','subject_id','name','locale');
                                                $query->where('locale',\App::getLocale());
                                             }])
                                             ->with(['grade_data' => function($query) {
                                                $query->select('id','grade_id','name','locale');
                                                $query->where('locale',\App::getLocale());
                                             }])
                                             ->first();
        if($obj_classes)
        {
            $arr_classes  = $obj_classes->toArray();

            $class_name   = $arr_classes['name'];
            $subject_name = $arr_classes['subject_data']['name'];
            $grade_name   = $arr_classes['grade_data']['name'];
        }


        // Get student data
        $obj_student = $this->UsersModel->where('id', $student_id)
                                        ->select('id','first_name','last_name','pin')
                                        ->first();
        if($obj_student)
        {
            $arr_student = $obj_student->toArray();

            $first_name = $arr_student['first_name'];
            $last_name  = $arr_student['last_name'];
        }

        // Get student programs data
        $obj_student_program = $this->StudentProgramsModel->where('student_id', $student_id)
                                                          ->where('assigned_by', 'teacher')
                                                          ->where('created_by', $teacher_id)
                                                          ->with(['program_details' => function($query){
                                                            $query->select('id','unique_id','name','description');
                                                          }])
                                                          ->with(['user_details' => function($query){
                                                            $query->select('id','first_name','last_name');
                                                          }])
                                                          ->orderBy('id', 'DESC');

        if($keyword != '')
        {
            $obj_student_program = $obj_student_program->whereHas("program_details", function($query) use ($keyword) {
                                                            $query->whereRaw("( name LIKE '%".$keyword."%' )");
                                                        });
        }

        if($date != '')
        {
            $obj_student_program = $obj_student_program->whereDate('created_at', '=', date('c', strtotime($date)) );
        }

        $obj_student_program = $obj_student_program->get();

        if($obj_student_program)
        {
            $arr_student_program = $obj_student_program->toArray();

            // build data array to export
            foreach ($arr_student_program as $key => $student_program) 
            {
                $program_id                  = isset($student_program['program_id']) ? $student_program['program_id'] : 'NA';
                $student_id                  = isset($student_program['student_id']) ? $student_program['student_id'] : 'NA';

                $assigned_by_fname           = isset($student_program['user_details']['first_name'])? $student_program['user_details']['first_name']:'NA';
                $assigned_by_lname           = isset($student_program['user_details']['last_name'])? $student_program['user_details']['last_name']:'NA';

                $data[trans('teacher.Sr_No')]              = ($key+1);
                $data[trans('teacher.Name_Of_Student')]    = $first_name.' '.$last_name;
                $data[trans('teacher.Class_Name')]         = $class_name;
                $data[trans('parent.Subject')]             = $subject_name;
                $data[trans('parent.Grade')]               = $grade_name;

                $data[trans('parent.Program_Id')]          = isset($student_program['program_details']['unique_id'])? $student_program['program_details']['unique_id']:'NA';
                $data[trans('parent.Program_Name')]        = isset($student_program['program_details']['name'])? $student_program['program_details']['name']:'NA';
                $data[trans('parent.Program_Description')] = isset($student_program['program_details']['description'])? $student_program['program_details']['description']:'NA';

                $data[trans('parent.Assigned_By')]         = $assigned_by_fname.' '.$assigned_by_lname;
                $data[trans('parent.Assigned_Date')]       = isset($student_program['created_at']) ? get_added_on_date_time($student_program['created_at']) : 'NA';
                $data[trans('parent.Status')]              = $this->StudentService->CheckProgramStatus($program_id, $student_id);;

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        $type = 'CSV';

        return Excel::create($first_name.' '.$last_name.' '.trans('parent.Program_Report'), function($excel) use ($data, $first_name, $last_name) {

            // Set the title
            $excel->setTitle($first_name.' '.$last_name.' '.trans('parent.Program_Report'));

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription($first_name.' '.$last_name.' '.trans('parent.Program_Report'));

            $excel->sheet($first_name.' '.$last_name.' '.trans('parent.Program_Report'), function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);


    } // end MyProgramsExportCSV\

    /**
    * Function  : generate_program_report($enc_class_id,$slug,$enc_student_id)
    * Author    : Akshay Garje
    * Date      : 06/09/2018
    * @return [view] [Generate program report]
    */

    public function generate_program_report($enc_class_id, $slug,$enc_student_id)
    {
        $teacher_id = Auth::user()->id;
        if($enc_class_id!='' && $slug!='' && $enc_student_id!='' && $teacher_id!='')
        {
            $student_id = base64_decode($enc_student_id);
            $result = $this->ReportService->create_program_report($slug,$student_id,$teacher_id);
            if($result!='error' && $result!='')
            {
                $result['middleContent']   = 'teacher.my-student.program_report';
                $result['enc_student_id']  = $enc_student_id;
                $result['enc_class_id']    = $enc_class_id;
                $result['student_name']    = ucwords($result['arr_program']['student_data']['first_name']).' '.ucwords($result['arr_program']['student_data']['last_name']);
                return view('front.layout.master')->with($result);
            }
            else
            {
                Session::flash('error', trans('parent.something_went_wrong'));
                return redirect()->back();
            }
        }
    } 
    
    public function TransferStudent(Request $request)
    {
       $arr_old_class = $arr_new_class = [];
       $status = $student_name =  $parent_id = '';
       $form_data            = $arr_transfer_student = $arr_data = $arr_notification = [];
       $form_data            = $request->all();
       $arr_transfer_student = isset($form_data['arr_selected_student'])?$form_data['arr_selected_student']:'';
       $class_enrollment     = trim($request->input('class_enrollment',''));
       $old_class_id         = isset($form_data['old_class_id'])?base64_decode($form_data['old_class_id']):'';
       $obj_class            = $this->ClassroomsModel->where('class_enrollment_code','=',$class_enrollment)
                                                     ->first();

        $classroom_id         = isset($obj_class->id)?$obj_class->id:'';
        $old_class_name       = $this->get_class_info($old_class_id);
        $new_class_name       = $this->get_class_info($classroom_id);

       $arr_data = explode(',',$arr_transfer_student);
       if($obj_class)
       {
            if(isset($obj_class->id) && $obj_class->id!=$old_class_id)
            {
              
                $teacher_id      = isset($obj_class->teacher_id)?$obj_class->teacher_id:'';
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    foreach ($arr_data as $key => $value)
                    {
                        $obj_student = $this->ClassroomStudentModel->where('student_id','=',$value)
                                            ->with(['subject_parent_data.student_data'])
                                            ->first();

                        if($obj_student)
                        {
                            $parent_id = isset($obj_student->subject_parent_data->parent_id)?$obj_student->subject_parent_data->parent_id:'';

                             $parent_id = isset($obj_student->subject_parent_data->parent_id)?$obj_student->subject_parent_data->parent_id:'';

                            $student_first_name =  isset($obj_student->subject_parent_data->student_data->first_name)?$obj_student->subject_parent_data->student_data->first_name:'';

                            $student_last_name =  isset($obj_student->subject_parent_data->student_data->last_name)?$obj_student->subject_parent_data->student_data->last_name:'';

                            $student_name = $student_first_name.' '.$student_last_name;

                            $status = $obj_student->update(['classroom_id'=>$classroom_id,'teacher_id'=>$teacher_id]);

                        }

                        //sent notification to student
                        $arr_notification['message']      = 'You have transfered from '.$old_class_name.' to '.$new_class_name;
                        $arr_notification['from_user_id'] = $teacher_id;
                        $arr_notification['to_user_id']   = $value;
                        $arr_notification['url']          = "";
                        $arr_notification['is_read']      = "0";
                        $status1                          = $this->NotificationService->send_notification($arr_notification);


                        // Store notification for parent
                        if(isset($parent_id) && $parent_id!=0)
                        {
                            $arr_notification = [];
                            $arr_notification['message']      = 'Your child -'.$student_name.' has transfered from '.$old_class_name.' to '.$new_class_name;
                            $arr_notification['from_user_id'] = $teacher_id;
                            $arr_notification['to_user_id']   = $parent_id;
                            $arr_notification['url']          = "";
                            $arr_notification['is_read']      = "0";
                            $status2                          = $this->NotificationService->send_notification($arr_notification);
                        }

                    }
                }
                if($status)
                {
                    Session::flash('success',trans('teacher.Students_are_transfered_successfully'));

                    return redirect()->back();
                }
                else
                {
                     Session::flash('error',trans('teacher.Error_occure_while_transfer_student'));
                }
            }
            else
            {
                Session::flash('error',trans('teacher.You_cannot_transfer_student_in_same_class'));
                return redirect()->back();
            }
       }
       else
       {
            Session::flash('error',trans('teacher.Invalid_Class_id'));
       }
       return redirect()->back();
    }   

    public function get_class_info($class_id)
    {
       $class_name = '';
       $obj_class =  $this->ClassroomsModel->where('id','=',$class_id)->first();
       $class_name = isset($obj_class->name)?$obj_class->name:'';
       return $class_name;
    }
}
