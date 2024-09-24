<?php
namespace App\Http\Controllers\Front\Teacher;

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
use App\Models\ProgramModel;
use App\Models\LessonModel;
use App\Models\StudentProgramQuestionModel;

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
        $this->ProgramModel                  = new ProgramModel();
        $this->LessonModel                   = new LessonModel();
        $this->StudentProgramQuestionModel   = new StudentProgramQuestionModel();

        $this->homework_file_base_img_path   = base_path().config('app.project.img_path.homework_file');
        $this->homework_file_public_img_path = url('/').config('app.project.img_path.homework_file');
    }

    public function HomeworkList(Request $request, $enc_class_id = false, $enc_program_id = false)
    {
        $arr_homework  = $arr_pagination = $arr_subject = $arr_grade = $arr_program = $arr_lesson = $arr_stud_id = $arr_student_programs = $arr_stud_lesson = $arr_programs_id = $arr_lesson_id = [];
        $subject_id    = $grade_id       = $program_id  = $lesson_id = '';
        $reset_link    = url('/').'/teacher/homework/'.$enc_class_id;
        $user_id       = Auth::user()->id;
        $search_option = 'display: block';

        $getStudents = getTeachersAllStudents($user_id);
        if( count($getStudents) > 0 && !empty($getStudents) ) 
        {
            foreach ($getStudents as $key => $stud) 
            {
                $arr_stud_id[] = $stud['id'];
            }
        }

        $obj_student_programs = $this->StudentProgramQuestionModel->with(['program_details'=>function($query) use ($program_id){
                                                                        $query->where('approve_status','approved')
                                                                              ->where('status','1')
                                                                              ->with('lessonData')
                                                                              ->whereHas('lessonData',function($query1) use ($program_id){
                                                                                    /*$query1->where('program_id',$program_id);*/
                                                                               });
                                                                    }])
                                                                    ->whereHas('program_details',function($query){
                                                                        $query->where('approve_status','approved')
                                                                              ->where('status','1');
                                                                    })
                                                                    ->whereIn('student_id', $arr_stud_id)
                                                                    ->groupBy('program_id')
                                                                    ->get();

        if(isset($obj_student_programs) && count($obj_student_programs)>0)
        {
            $arr_student_programs = $obj_student_programs->toArray();

            if(count($arr_student_programs) > 0)
            {
                if(isset($arr_student_programs) && count($arr_student_programs)>0)
                {
                    foreach ($arr_student_programs as $key => $value) 
                    {
                        if(isset($value['program_details']['lesson_data']) && count($value['program_details']['lesson_data'])>0)
                        {
                            foreach ($value['program_details']['lesson_data'] as $_key => $lesson) 
                            {
                                $total_count          = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                                    ->where('lesson_id',$lesson['id'])
                                                                                    ->where('student_id',$value['student_id'])
                                                                                    ->count();

                                $current_status_count = StudentProgramQuestionModel::where('program_id',$value['program_id'])
                                                                                    ->where('lesson_id',$lesson['id'])
                                                                                    ->where('student_id',$value['student_id'])
                                                                                    ->where('is_answer','yes')
                                                                                    ->count();

                                if($total_count == $current_status_count)
                                {
                                    array_push($arr_stud_lesson, $lesson);
                                }
                            }
                        }
                    }
                }
            }
        }

        if( count($arr_student_programs) > 0 && !empty($arr_student_programs) ) 
        {
            foreach ($arr_student_programs as $key => $stud_programs) 
            {
                $arr_programs_id[] = $stud_programs['program_details']['id'];
            }
        }
        if( count($arr_stud_lesson) > 0 && !empty($arr_stud_lesson) ) 
        {
            foreach ($arr_stud_lesson as $key => $stud_lesson) 
            {
                $arr_lesson_id[] = $stud_lesson['id'];
            }
        }

        $obj_homework = $this->HomeworkimagesModel->with(['homeworkData' => function($query) use ($arr_programs_id, $arr_lesson_id) {
                                                    $query->whereIn('program_id', $arr_programs_id);
                                                    $query->whereIn('lesson_id', $arr_lesson_id);
                                                    $query->where('status','1');
                                                  }])
                                                  ->whereHas("homeworkData.program_assign_by", function($query) use($user_id) {
                                                    $query->where('assigned_by','teacher');
                                                    $query->where('created_by',$user_id);
                                                  });

        // get only selected programs homework
        if($enc_program_id != '' && !empty($enc_program_id))
        {
            $program_id   = base64_decode($enc_program_id);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use($program_id) {
                                            $query->where('program_id', $program_id);
                                        });

            $reset_link    = url('/').'/teacher/homework/'.$enc_class_id.'/'.$enc_program_id;
            $search_option = "display: none";
        }
        else
        {
            $search_option = "display: block";
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

        if( isset($_GET['grade']) && !empty($_GET['grade']) )
        {
            $grade_id     = base64_decode($_GET['grade']);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use ($grade_id) {
                                            $query->where('grade_id', $grade_id);
                                        });

            $obj_stud_programs = $this->StudentProgramQuestionModel->with(['program_details'=>function($query){
                                                                    $query->where('approve_status','approved')
                                                                          ->where('status','1');
                                                                }])
                                                                ->whereHas('program_details', function($query) use ($subject_id, $grade_id) {
                                                                    $query->where('approve_status','approved')
                                                                          ->where('status','1')
                                                                          ->where('subject',$subject_id)
                                                                          ->where('grade',$grade_id);
                                                                })
                                                                ->whereIn('student_id', $arr_stud_id)
                                                                ->groupBy('program_id')
                                                                ->get();

            if(isset($obj_stud_programs) && count($obj_stud_programs) > 0)
            {
                $arr_stud_programs = $obj_stud_programs->toArray();

                foreach ($arr_stud_programs as $key => $stud_programs) 
                {
                    $arr_program[] = $stud_programs['program_details'];
                }
            }
        }

        if( isset($_GET['program']) && !empty($_GET['program']) )
        {
            $program_id   = base64_decode($_GET['program']);
            $obj_homework = $obj_homework->whereHas("homeworkData", function($query) use ($program_id) {
                                            $query->where('program_id', $program_id);
                                        });

            if(count($arr_student_programs) > 0)
            {
                if(isset($arr_student_programs) && count($arr_student_programs)>0)
                {
                    foreach ($arr_student_programs as $key => $value) 
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

        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }

        $data['arr_homework']                  = $arr_homework;
        $data['arr_pagination']                = $arr_pagination;
        $data['arr_subject']                   = $arr_subject;
        $data['arr_grade']                     = $arr_grade;
        $data['arr_program']                   = $arr_program;
        $data['arr_lesson']                    = $arr_lesson;
        $data['search_subject_id']             = base64_encode($subject_id);
        $data['search_grade_id']               = base64_encode($grade_id);
        $data['search_program_id']             = base64_encode($program_id);
        $data['search_lesson_id']              = base64_encode($lesson_id);
        $data['reset_link']                    = $reset_link;
        $data['search_option']                 = $search_option;

        $data['user_type']                     = 'teacher';
        $data['parentTitle']                   = trans('parent.Dashboard');
        $data['pageTitle']                     = trans('parent.Homework');
        $data['middleContent']                 = 'teacher.homework.index';

        $data['homework_file_base_img_path']   = $this->homework_file_base_img_path;
        $data['homework_file_public_img_path'] = $this->homework_file_public_img_path;
        
        return view('front.layout.master')->with($data);
    }

}