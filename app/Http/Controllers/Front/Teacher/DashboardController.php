<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\UsersModel;
use App\Models\ClassroomsModel;
use App\Models\ClassroomsTranslationModel;
use App\Models\ProgramModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\ClassroomStudentModel;

use Validator;
use Response;
use Session;
use flash;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct(NotificationService $notification_service)
    {
        $this->NotificationService        = $notification_service;
        $this->LanguageService            = new LanguageService();
        $this->ClassroomsModel            = new ClassroomsModel();
        $this->ClassroomsTranslationModel = new ClassroomsTranslationModel();
        $this->UsersModel                 = new UsersModel();
        $this->ProgramModel               = new ProgramModel();
        $this->SubjectModel               = new SubjectModel();
        $this->SubjectTranslationModel    = new SubjectTranslationModel();
        $this->GradeModel                 = new GradeModel();
        $this->GradeTranslationModel      = new GradeTranslationModel();
        $this->ClassroomStudentModel      = new ClassroomStudentModel();
        $this->module_url_path            = url('/').'/teacher';
    }


    /*
    | Function  : Get all the classes data added by this teacher along with subject, grade, program
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Get all the classes data added by this teacher along with subject, grade, program
    */

    public function index()
    {
        $teacher_id              = Auth::user()->id;
        $class_count             = $this->get_class_count($teacher_id);
        $student_count           = $this->get_student_count($teacher_id);
        $transfer_count          = $this->get_transfer_class_count($teacher_id);
        $str_class_wise_student  = $this->get_student_class_wise($teacher_id);

        $data['str_class_wise_student']  = $str_class_wise_student;
        $data['transfer_count']          = $transfer_count;
        $data['student_count']           = $student_count;
        $data['class_count']             = $class_count;
        $data['parentTitle']             = trans('parent.Dashboard');
        $data['pageTitle']               = trans('parent.Dashboard');
        $data['user_type']               = 'teacher';
        $data['current_date']            =  date("Y-M-d");
        $data['pageTitle']               = trans('parent.Dashboard');
        $data['middleContent']           = 'teacher.dashboard';
        $data['module_url_path']         = $this->module_url_path;    

        return view('front.layout.master')->with($data);
    }// end Index
    public function get_class_count($teacher_id)
    {
        $class_count = $this->ClassroomsModel->where('status','=','1')
                                                ->where('deleted_at','=',NULL)
                                                ->where('teacher_id','=',$teacher_id)
                                                ->where('is_transfer','no')
                                                ->count();
                                     
        return $class_count;
    }
    public function get_student_count($teacher_id)
    {
        $student_count = $this->ClassroomStudentModel->where('teacher_id',$teacher_id)
                                                       ->where('is_active','=','active')
                                                       ->whereHas('student_data')
                                                       //->where('classroom_id', $class_id)
                                                      ->count();

        return $student_count;
    }
    public function get_transfer_class_count($teacher_id)
    {
        $transfer_class_count = $this->ClassroomsModel->where('teacher_id',$teacher_id)
                                                      ->where('is_transfer','yes')
                                                      ->count();

        return $transfer_class_count;
    }
    public function get_student_class_wise($teacher_id)
    {
        $arr_class = $arr_student_class = $arr_data_set = $arr_label = [];
        $obj_class = $this->ClassroomsModel->where('status','=','1')
                                                ->where('deleted_at','=',NULL)
                                                ->where('teacher_id','=',$teacher_id)
                                                ->where('is_transfer','no')
                                                ->select('id','name','teacher_id','subject_id')
                                                ->orderBy('id','=','desc')
                                                ->get();
        if($obj_class)
        {
            $arr_class = $obj_class->toArray();
        }
        if(isset($arr_class) && sizeof($arr_class)>0)
        {
             $caption = trans('teacher.Class_Wise_Report');
             $xaxisname = trans('teacher.Classes');

             $arr_student_class['chart'] = ["caption"=>$caption,"subcaption"=> '', "xaxisname"=> $xaxisname,"yaxisname"=> trans('teacher.No_of_Student'),"formatnumberscale"=> "1","theme"=> "fusion", "drawcrossline"=> "1"];
            foreach ($arr_class as $key => $value) 
            {
                $student_count = 0;
                $class_id      = isset($value['id'])?$value['id']:'';
                $class_name    = isset($value['name'])?$value['name']:'';
                $student_count = $this->ClassroomStudentModel->where('teacher_id',$teacher_id)
                                                      ->where('classroom_id',$class_id)
                                                      ->count();

                //$arr_student_class[$key]['label'] = $class_name;                                   
                //$arr_student_class[$key]['data'] = $student_count;     
                if($student_count!=0)
                {
                     $arr_data_set['data'][]["value"]   = $student_count;
                     $arr_label['category'][]["label"]  = $class_name;
                }
               
            }
        }
        $arr_student_class['categories'][] = $arr_label;
        $arr_student_class['dataset'][]    = $arr_data_set;
        return json_encode($arr_student_class);
    }
    public function class_list(Request $request)
    {
        $arr_classes = $arr_pagination = $arr_subject = $arr_grade = $arr_program = []; $keyword = '';
        $teacher_id  = Auth::user()->id;
        $keyword     = $request->input('keyword');

        $obj_classes = $this->ClassroomsModel->select('classroom.*','share_class.id as share_class_id','share_class.to_teacher_id','share_class.from_teacher_id')
                                             ->join('share_class','share_class.classroom_id','=','classroom.id','left')
                                             ->whereRaw("(
                                                            classroom.status = '1' AND
                                                            classroom.deleted_at IS NULL AND
                                                            (
                                                                is_transfer = 'no' AND (to_teacher_id = ".$teacher_id." OR teacher_id = ".$teacher_id.")
                                                            )
                                                            OR
                                                            (
                                                                is_transfer = 'no' AND teacher_id = ".$teacher_id." AND to_teacher_id != '0'
                                                            )
                                                        )")
                                            ->with('program_details')
                                            ->with(['subject_details' => function($query){
                                                $query->where('status', '1');
                                            }])
                                            ->with(['grade_details' => function($query){
                                                $query->where('status', '1');
                                            }])
                                            ->with(['program_details' => function($query){
                                                $query->where('status', '1');
                                            }])
                                            ->with(['share_class_data' => function($query) use($teacher_id) {
                                                /*$query->where('status', 'active');*/
                                            }])
                                            /*->whereHas("share_class_data", function($query){
                                                $query->where('status', 'active');
                                            })*/
                                            ->where('classroom.is_transfer', 'no')
                                            ->where('classroom.status', '1')
                                            /*->where('teacher_id', $teacher_id)*/
                                            ->groupBy('classroom.id')
                                            ->orderBy('classroom.created_at','DESC');
                                
        if($keyword!=null && $keyword!='')
        {   
            $obj_classes = $obj_classes->where(function($q)use($keyword)
            {
                $q->whereRaw("( classroom.name LIKE '%".$keyword."%' OR classroom.class_enrollment_code LIKE '%".$keyword."%')");
                $q->orWhereHas('subject_data', function($query)use($keyword){
                                                    $query->whereRaw("(name LIKE '%".$keyword."%')");
                                                });
                $q->orWhereHas('grade_data', function($query)use($keyword){
                                                    $query->whereRaw("(name LIKE '%".$keyword."%')");
                                                });    
            }); 
        }

        $obj_classes = $obj_classes->paginate(10);

        if($obj_classes)
        {
            $arr_pagination = $obj_classes->links();
            $arr_classes    = $obj_classes->toArray();
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

        $obj_program = $this->ProgramModel->where('status', '1')->where('approve_status', 'approved')->get();
        if($obj_program)
        {
            $arr_program = $obj_program->toArray();
        }
        $incentive_amount = get_incentive_amount($teacher_id);

        $data['incentive_amount'] = $incentive_amount;
        $data['arr_pagination']   = $arr_pagination;
        $data['arr_classes']      = $arr_classes;
        $data['arr_subject']      = $arr_subject;
        $data['arr_grade']        = $arr_grade;
        $data['arr_program']      = $arr_program;
        $data['current_date']     = date("Y-M-d");
        $data['pageTitle']        = trans('teacher.My_Classes');
        $data['middleContent']    = 'teacher.my-class.index';
        $data['user_type']        = 'teacher';
        $data['parentTitle']      = trans('parent.Dashboard');    
        return view('front.layout.master')->with($data);
    }

    /*
    | Function  : Get all the classes data added by this teacher along with subject, grade, program
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Get all the classes data added by this teacher along with subject, grade, program
    */

    public function AddMyClass(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['class_name'] = "required";
        $arr_rules['subject']    = "required";
        $arr_rules['grade']      = "required";
        $arr_rules['end_date']   = "required";
        /*$arr_rules['program']    = "required";*/

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', trans('parent.All_fields_are_required'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher_id                        = Auth::user()->id;
        $teacher_first_name                = Auth::user()->first_name;
        $teacher_last_name                 = Auth::user()->last_name;
        $user_type                         = 'teacher';
        $form_data                         = $request->all();

        $arr_user['teacher_id']            = $teacher_id;
        $arr_user['name']                  = isset($form_data['class_name']) ? ucfirst($form_data['class_name']) : '';
        $arr_user['slug']                  = isset($form_data['class_name']) ? str_slug($form_data['class_name']) : '';
        $arr_user['subject_id']            = isset($form_data['subject']) ? $form_data['subject'] : '';
        $arr_user['grade_id']              = isset($form_data['grade']) ? $form_data['grade'] : '';
        $arr_user['start_date']            = isset($form_data['start_date']) ? date('Y-m-d', strtotime($form_data['start_date'])) : null;
        $arr_user['end_date']              = isset($form_data['end_date']) ? date('Y-m-d', strtotime($form_data['end_date'])) : null;
        $arr_user['program_id']            = isset($form_data['program']) ? $form_data['program'] : null;
        $arr_user['status']                = '1';
        $arr_user['class_enrollment_code'] = GenerateEnrollmentCode();

        $is_added                          = $this->ClassroomsModel->create($arr_user);

        if($is_added)
        {
            // Store notification for admin
            $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has added new class';
            $arr_noti['from_user_id'] = $teacher_id;
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = "/admin/classrooms/view/".base64_encode($is_added->id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            // Store notification for teacher
            $arr_noti['message']      = trans('teacher.new_class_add_success');
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $teacher_id;
            $arr_noti['url']          = '/'.$user_type."/dashboard";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success', trans('teacher.new_class_add_success'));
            return redirect()->back();
        }
        else
        {
            Session::flash('error', trans('teacher.new_class_add_error'));
            return redirect()->back();
        }

    } // end AddMyClass


    /*
    | Function  : Delete selected class
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Success or Error
    */

    public function DeleteMyClass(Request $request)
    {
        $form_data          = $request->all();
        $class_id           = isset($form_data['delete_class_id']) ? base64_decode($form_data['delete_class_id']) : '';
        $teacher_id         = Auth::user()->id;
        $teacher_first_name = Auth::user()->first_name;
        $teacher_last_name  = Auth::user()->last_name;

        if(!empty($class_id) && !empty($teacher_id))
        {
            $is_deleted = $this->ClassroomsModel->where('id', $class_id)->where('teacher_id', $teacher_id)->delete();
            if($is_deleted)
            {
                // Store notification for admin
                $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has deleted a class';
                $arr_noti['from_user_id'] = $teacher_id;
                $arr_noti['to_user_id']   = 1;
                $arr_noti['url']          = "/admin/classrooms";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                // Store notification for teacher
                $arr_noti['message']      = trans('teacher.new_class_delete_success');
                $arr_noti['from_user_id'] = 1;
                $arr_noti['to_user_id']   = $teacher_id;
                $arr_noti['url']          = "/teacher/dashboard";
                $arr_noti['is_read']      = "0";
                $status                   = $this->NotificationService->send_notification($arr_noti);

                Session::flash('success', trans('teacher.new_class_delete_success'));
                return redirect()->back();
            }
            else
            {
                Session::flash('error', trans('teacher.new_class_delete_error'));
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error',trans('parent.something_went_wrong'));
            return redirect()->back();
        }

    } // end DeleteMyClass


    /*
    | Function  : Update class data
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Success or Error
    */

    public function UpdateMyClass(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['class_name'] = "required";
        $arr_rules['subject']    = "required";
        $arr_rules['grade']      = "required";
        $arr_rules['end_date']   = "required";
        /*$arr_rules['program']    = "required";*/

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', 'All fields are required.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher_id             = Auth::user()->id;
        $teacher_first_name     = Auth::user()->first_name;
        $teacher_last_name      = Auth::user()->last_name;
        $user_type              = 'teacher';
        $form_data              = $request->all();

        $class_id               = isset($form_data['class_id']) ? base64_decode($form_data['class_id']) : '';
        //$arr_user['teacher_id'] = $teacher_id;
        $arr_user['name']       = isset($form_data['class_name']) ? ucfirst($form_data['class_name']) : '';
        //$arr_user['slug']       = isset($form_data['class_name']) ? str_slug($form_data['class_name']) : '';
        $arr_user['subject_id'] = isset($form_data['subject']) ? $form_data['subject'] : '';
        $arr_user['grade_id']   = isset($form_data['grade']) ? $form_data['grade'] : '';
        $arr_user['start_date'] = isset($form_data['start_date']) ? date('Y-m-d', strtotime($form_data['start_date'])) : null;
        $arr_user['end_date']   = isset($form_data['end_date']) ? date('Y-m-d', strtotime($form_data['end_date'])) : null;
        $arr_user['program_id'] = isset($form_data['program']) ? $form_data['program'] : null;

        $is_updated             = $this->ClassroomsModel->where('id', $class_id)->update($arr_user);

        if($is_updated)
        {
            // Store notification for admin
            $arr_noti['message']      = $teacher_first_name.' '.$teacher_last_name.' has updated a class';
            $arr_noti['from_user_id'] = $teacher_id;
            $arr_noti['to_user_id']   = 1;
            $arr_noti['url']          = "/admin/classrooms/view/".base64_encode($class_id);
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            // Store notification for teacher
            $arr_noti['message']      = trans('teacher.class_update_success');
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $teacher_id;
            $arr_noti['url']          = '/'.$user_type."/dashboard";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success', trans('teacher.class_update_success'));
            return redirect()->back();
        }
        else
        {
            Session::flash('error', trans('teacher.class_update_error'));
            return redirect()->back();
        }

    } // end UpdateMyClass


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 05/07/2018
    | Output    : Success or Error
    */

    public function GetGrade(Request $request)
    {
        $form_data  = $request->all();
        $subject_id = isset($form_data['subject_id']) && !empty($form_data['subject_id']) ? $form_data['subject_id'] : '';
        $grade_id   = isset($form_data['grade_id']) && !empty($form_data['grade_id']) ? $form_data['grade_id'] : '';

        return getGradeOptions($subject_id, $grade_id);
    } // end GetGrade
}
