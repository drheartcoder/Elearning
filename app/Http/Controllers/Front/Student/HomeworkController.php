<?php
namespace App\Http\Controllers\Front\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\StudentService;

use App\Models\UsersModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkimagesModel;
use App\Models\SubjectModel;
use App\Models\GradeModel;
use App\Models\StudentProgramQuestionModel;
use App\Models\LessonModel;

use Validator;
use Response;
use Session;
use flash;
use Excel;
use Auth;
use DB;

class HomeworkController extends Controller
{
	public function __construct(
                                NotificationService $notification_service,
                                LanguageService     $language_service,
                                StudentService      $student_service
                                )
    {

        $this->NotificationService           = $notification_service;
        $this->StudentService                = $student_service;
        $this->LanguageService               = $language_service;
        
        $this->UsersModel                    = new UsersModel();
        $this->HomeworkModel                 = new HomeworkModel();
        $this->HomeworkimagesModel           = new HomeworkimagesModel();
        $this->SubjectModel                  = new SubjectModel();
        $this->GradeModel                    = new GradeModel();
        $this->StudentProgramQuestionModel   = new StudentProgramQuestionModel();
        $this->LessonModel                   = new LessonModel();

        $this->homework_file_base_img_path   = base_path().config('app.project.img_path.homework_file');
        $this->homework_file_public_img_path = url('/').config('app.project.img_path.homework_file');
    }

    /**
    * Function  : index($enc_program_id)
    * Author    : Akshay Garje
    * Date      : 09/08/2018
    * @return [view] [Return view of Home work]
    */

    public function index(Request $request, $enc_class_id = false, $enc_program_id = false)
    {
        $arr_homework = $arr_pagination = $arr_subject = $arr_grade = $arr_program = $arr_lesson = $arr_lesson_id = [];
        $subject_id   = $grade_id       = $program_id  = $lesson_id = '';
        $subject_id   = $grade_id = '';
        $reset_link   = url('/').'/student/homework';
        $user_id      = Auth::user()->id;

        $arr_program  = $this->StudentProgramQuestionModel->whereHas('program_details',function($query){
                                                $query->where('approve_status','approved')->where('status','1');
                                                $query->whereHas('subjectData');
                                            })
                                            ->whereHas('lessonData')
                                            ->with('lessonData')
                                            ->with(['program_details'=>function($query){
                                                $query->where('approve_status','approved')->where('status','1');
                                                $query->with('subjectData');
                                                $query->with('lessonData');
                                            }])
                                          ->where('student_id',$user_id)
                                          ->groupBy('program_id')
                                          ->get();

        if(isset($arr_program) && count($arr_program)>0)
        {
            $arr_program = $arr_program->toArray();
            foreach ($arr_program as $key => $value) 
            {
                if(isset($value['program_details']['lesson_data']) && count($value['program_details']['lesson_data'])>0)
                {
                    foreach ($value['program_details']['lesson_data'] as $_key => $lesson) 
                    {
                        $total_count          = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                            ->where('lesson_id',$lesson['id'])
                                                                            ->where('student_id',$user_id)
                                                                            ->count();

                        $current_status_count = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                            ->where('lesson_id',$lesson['id'])
                                                                            ->where('student_id',$user_id)
                                                                            ->where('is_answer','yes')
                                                                            ->count();

                        if($total_count == $current_status_count)
                        {
                            array_push($arr_lesson_id, $lesson['id']);
                        }
                    }
                }
            }
        }

        $obj_homework = $this->HomeworkimagesModel->with(['homeworkData' => function($query) use ($user_id,$arr_lesson_id){
                                                        $query->where('status','1');
                                                        $query->whereIn('lesson_id', $arr_lesson_id);
                                                        $query->with(['program_assign' => function($sub_query) use ($user_id){
                                                            $sub_query->where('student_id',$user_id);
                                                        }]);
                                                    }])
                                                  ->whereHas("homeworkData", function($query) use($user_id,$arr_lesson_id) {
                                                        $query->where('status','1');
                                                        $query->whereIn('lesson_id', $arr_lesson_id);
                                                        $query->whereHas("program_assign", function($sub_query) use($user_id) {
                                                            $sub_query->where('student_id',$user_id);
                                                        });
                                                    });
        // get only selected programs homework
        if($enc_program_id != '' && !empty($enc_program_id))
        {
            $program_id   = base64_decode($enc_program_id);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use($program_id) {
                                            $query->where('program_id', $program_id);
                                        });
            $reset_link = url('/').'/student/homework/'.$enc_class_id.'/'.$enc_program_id;
        }

        if( isset($_GET['subject']) && !empty($_GET['subject']) )
        {
            $subject_id   = base64_decode($_GET['subject']);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use ($subject_id) {
                                            $query->where('subject_id', $subject_id);
                                        });

            $obj_grade = $this->GradeModel->where('status', '1')->where('subject', $subject_id)->get();
            if($obj_grade)
            {
                $arr_grade = $obj_grade->toArray();
            }
        }

        if( isset($_GET['program']) && !empty($_GET['program']) )
        {
            $program_id   = base64_decode($_GET['program']);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use ($program_id) {
                                            $query->where('program_id', $program_id);
                                        });

            if(count($arr_program)>0)
            {

                if(isset($arr_program) && count($arr_program)>0)
                {
                    foreach ($arr_program as $key => $value) {
                        if($value['program_id']==$program_id)
                        {
                            array_push($arr_subject, $value['program_details']['subject_data']);
                            if(isset($value['program_details']['lesson_data']) && count($value['program_details']['lesson_data'])>0)
                            {
                                foreach ($value['program_details']['lesson_data'] as $_key => $lesson) {
                                    $total_count            = StudentProgramQuestionModel::where('program_id',$program_id)
                                                                                         ->where('lesson_id',$lesson['id'])
                                                                                         ->where('student_id',$user_id)
                                                                                         ->count();

                                    $current_status_count   = StudentProgramQuestionModel::where('program_id',$program_id)
                                                                                         ->where('lesson_id',$lesson['id'])
                                                                                         ->where('student_id',$user_id)
                                                                                         ->where('is_answer','yes')
                                                                                         ->count();
                                    
                                    if($total_count == $current_status_count){
                                        array_push($arr_lesson, $lesson);
                                    }
                                }
                            }    
                        }
                    }
                }
            }
        }
        else
        {
            $obj_subject = $this->SubjectModel->where('status', '1')->get();
            if($obj_subject)
            {
                $arr_subject = $obj_subject->toArray();
            }
        }

        if( isset($_GET['lesson']) && !empty($_GET['lesson']) )
        {
            $lesson_id    = base64_decode($_GET['lesson']);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use ($lesson_id) {
                                            $query->where('lesson_id', $lesson_id);
                                        });
        }

        $obj_homework = $obj_homework->paginate(16);
        if($obj_homework)
        {
            $arr_homework   = $obj_homework->toArray();
            $arr_pagination = $obj_homework->links();
        }

        $data['arr_lesson']                    = $arr_lesson;
        $data['arr_program']                   = $arr_program;
        $data['arr_homework']                  = $arr_homework;
        $data['arr_pagination']                = $arr_pagination;
        $data['arr_subject']                   = $arr_subject;
        $data['arr_grade']                     = $arr_grade;
        $data['search_subject_id']             = $subject_id;
        $data['search_grade_id']               = $grade_id;
        $data['reset_link']                    = $reset_link;

        $data['search_subject_id']             = base64_encode($subject_id);
        $data['search_grade_id']               = base64_encode($grade_id);
        $data['search_program_id']             = base64_encode($program_id);
        $data['search_lesson_id']              = base64_encode($lesson_id);

        $data['user_type']                     = 'student';
        $data['parentTitle']                   =  trans('parent.Dashboard');
        $data['pageTitle']                     =  trans('parent.Homework');
        $data['middleContent']                 = 'student.homework.index';

        $data['homework_file_base_img_path']   = $this->homework_file_base_img_path;
        $data['homework_file_public_img_path'] = $this->homework_file_public_img_path;

        return view('front.layout.master')->with($data);
    }

}
