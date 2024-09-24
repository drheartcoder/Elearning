<?php
namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\StudentService;

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
use App\Models\StudentProgramsModel;
use App\Models\ProgramQuestionModel;
use App\Models\StudentProgramQuestionModel;
use App\Common\Services\ReportService;


use Validator;
use Response;
use Session;
use flash;
use Excel;
use Auth;
use DB;
use App;
class StudentController extends Controller
{
	public function __construct(
                                NotificationService $notification_service,
                                LanguageService     $language_service,
                                StudentService      $student_service,
                                ReportService       $reportService
                                )
    {

        $this->NotificationService         = $notification_service;
        $this->StudentService              = $student_service;
        $this->ReportService               = $reportService;
        $this->LanguageService             = $language_service;
        
        $this->UsersModel                  = new UsersModel();
        $this->ClassroomsModel             = new ClassroomsModel();
        $this->ClassroomsTranslationModel  = new ClassroomsTranslationModel();
        $this->ProgramModel                = new ProgramModel();
        $this->SubjectModel                = new SubjectModel();
        $this->SubjectTranslationModel     = new SubjectTranslationModel();
        $this->GradeModel                  = new GradeModel();
        $this->GradeTranslationModel       = new GradeTranslationModel();
        $this->ClassroomStudentModel       = new ClassroomStudentModel();
        $this->StudentDetailsModel         = new StudentDetailsModel();
        $this->StudentProgramsModel        = new StudentProgramsModel();
        $this->ProgramQuestionModel        = new ProgramQuestionModel();
        $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
    }

    public function change_program(Request $request,$stud_id)
    {
    	$arr_data          = $arr_pagination = [];
    	$parent_id         = Auth::user()->id;
        $parent_first_name = Auth::user()->first_name;
        $parent_last_name  = Auth::user()->last_name;
    	$stud_id           = base64_decode($stud_id);
        $locale            = App::getLocale();
        if($stud_id)
        {
        	$student_programs 		= $this->StudentProgramsModel
    						  ->select('program.id','program.name','program.subject','program.grade','student_programs.student_id','student_programs.program_id','student_programs.created_by','student_programs.assigned_by','student_programs.created_at','users.id','users.first_name','users.last_name','users.email','subject_translation.name as subject_name','subject_translation.locale','grade_translation.name as grade_name','grade_translation.locale')

                              ->join('program','program.id','=','student_programs.program_id')
    						  ->join('users','users.id','=','student_programs.created_by')
                              ->join('subject_translation','subject_translation.subject_id','=','program.subject')
                              ->join('grade_translation','grade_translation.grade_id','=','program.grade')
    						  ->where('student_id',$stud_id)
                              ->where('subject_translation.locale',$locale)
                              ->where('grade_translation.locale',$locale)
                              ->orderBy('student_programs.id', 'DESC')->paginate(10);

        	if(count($student_programs)>0)
        	{
        		$arr_pagination           = $student_programs->links();
        		$data['student_programs'] = $student_programs->toArray();
        	}
        	$data['studentDetails']	= $this->UsersModel->where('id',$stud_id)->first()->toArray();

        	$student_programs = $this->StudentDetailsModel->where('parent_id',$parent_id)->where('student_id',$stud_id)->first()->toArray();
            
        	//Student's grade programs
        	$data['grade_program']	= $this->ProgramModel->where('grade',$student_programs['grade_id'])
                                                         ->where('approve_status', 'approved')
                                                         ->where('status', '1')
                                                         ->get()
                                                         ->toArray();

        	if(isset($_POST['btnChangeProgram']))
        	{
        		$validator 	=	Validator::make($request->all(),['program'=>'required']);
        		if($validator->fails())
        		{
        			session::flash('error',$validator->errors()->first());
       				return redirect()->back();
        		}
        		else
        		{
                    $prgramDuplicate = $this->StudentProgramsModel->where('created_by',$parent_id)
                                                                  ->where('student_id',$stud_id)
                                                                  ->where('program_id',$request->input('program'))
                                                                  ->count();

					if($prgramDuplicate == 0)
					{
						$arr_data['created_by']  = $parent_id;
	        			$arr_data['student_id']  = $stud_id;
	        			$arr_data['program_id']  = $request->input('program');
	        			$arr_data['assigned_by'] = 'parent';
	        			$res = $this->StudentProgramsModel->insert($arr_data);
	        			if($res)
	        			{
                            $program_id   = $request->input('program');
                            $program_count = $this->StudentProgramQuestionModel->where('student_id',$stud_id)
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
                                        $arr_question['student_id']  = $stud_id;

                                        $this->StudentProgramQuestionModel->create($arr_question);
                                    }

                                    // Store notification for student
                                    $program_slug = isset($arr_program_questions[0]['program_data']['slug'])?$arr_program_questions[0]['program_data']['slug']:'';

                                    $arr_noti['message']      = trans('teacher.A_new_program').$arr_program_questions[0]['program_data']['name'].trans('teacher.is_assigned_to_you_by').$parent_first_name.' '.$parent_last_name;
                                    $arr_noti['from_user_id'] = $parent_id;
                                    $arr_noti['to_user_id']   = $stud_id;
                                    $arr_noti['url']          = "/student/program/details/".$program_slug;
                                    $arr_noti['is_read']      = "0";
                                    $status                   = $this->NotificationService->send_notification($arr_noti);                                    

                                    session::flash('success',trans('parent.Program_changed_success'));
                                    return redirect()->back();
                                }
                            }
	        			}
	        			else
	        			{
	        				session::flash('error',trans('parent.something_went_wrong_assign_program'));
	        				return redirect()->back();
	        			}
					}
        			else
        			{
        				session::flash('error',trans('parent.Program_already_assigned'));
       					return redirect()->back();
        			}
        		}
        	}
        	$data['arr_pagination'] = $arr_pagination;
            $data['user_type']      = 'parent';
            $data['parentTitle']    = trans('parent.Dashboard');
            $data['pageTitle']      = trans('parent.Change_Program');
            $data['secondParentTitle']   =  trans('parent.My_Kids');  
            $data['secondParentUrl']     = url('/').'/parent/my-kids';    
            $data['middleContent']  = 'parent.my-children.change-program';
            return view('front.layout.master')->with($data);
        }
        else
        {
            return redirect()->back();
        }
    }

    public function my_program($enc_stud_id)
    {
        $arr_data    = [];
        $serach_date = $keyword = '';

        $parent_id   = Auth::user()->id;
        $stud_id     = base64_decode($enc_stud_id);

        $data['cancel_link'] = 'javascript:void(0);';

    	if($stud_id)
    	{
            $obj_student_program = $this->StudentProgramsModel->where('student_id', $stud_id)
                                                              ->with(['program_details' => function($query){
                                                                $query->select('id','unique_id','name','slug','subject','grade');
                                                                $query->with(['subjectData','gradeData']);
                                                              }])
                                                              ->with(['user_details' => function($query){
                                                                $query->select('id','user_type','first_name','last_name','email');
                                                              }])
                                                              ->orderBy('id', 'DESC');

            if( isset($_GET['keyword']) && !empty($_GET['keyword']) )
            {
                $keyword             = $_GET['keyword'];
                $obj_student_program = $obj_student_program->whereHas("program_details", function($query) use ($keyword) {
                                                                $query->whereRaw("( name LIKE '%".$keyword."%' )");
                                                            });
                $data['cancel_link'] = url('/').'/parent/my-program/'.$enc_stud_id;
            }

            if( isset($_GET['search']) && !empty($_GET['search']))
            {
                $serach_date         = $_GET['search'];
                $obj_student_program = $obj_student_program->whereDate('created_at', '=', date('c', strtotime($serach_date)) );
                $data['cancel_link'] = url('/').'/parent/my-program/'.$enc_stud_id;
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
    	}

    	$data['studentDetails']	= $this->UsersModel->where('id',$stud_id)->first()->toArray();

    	$student_programs = $this->StudentDetailsModel->where('parent_id',$parent_id)->where('student_id',$stud_id)->first()->toArray();

    	$data['grade_program']	= $this->ProgramModel->where('grade',$student_programs['grade_id'])
        							                 ->get()
                                                     ->toArray();

        $data['enc_student_id']      = $enc_stud_id;
        $data['keyword']             = $keyword;
        $data['serach_date']         = $serach_date;
        $data['arr_student_program'] = $arr_student_program;
        $data['arr_pagination']      = $arr_pagination;

        $data['user_type']           = 'parent';
        $data['parentTitle']         = trans('parent.Dashboard');
        $data['pageTitle']           = trans('parent.My_Kids_Programs');

        $data['secondParentTitle']   =  trans('parent.My_Kids');  
        $data['secondParentUrl']     = url('/').'/parent/my-kids';    
        
        $data['middleContent']       = 'parent.my-children.my-program';
        
        return view('front.layout.master')->with($data);
    }


    public function MyKidsExportCSV(Request $request)
    {
        $first_name   = $last_name           = $pin         = $subject_name = $grade_name = '';
        $export_array = $arr_student_program = $arr_student = [];

        $form_data   = $request->all();
        $student_id  = isset($form_data['enc_student_id']) && !empty($form_data['enc_student_id']) ? base64_decode($form_data['enc_student_id']) : '';
        $keyword     = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword']                : '';
        $serach_date = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']                   : '';
        $parent_id   = Auth::user()->id;

        
        // Get student data
        $obj_student = $this->StudentDetailsModel->where('parent_id',$parent_id)
                                                 ->where('student_id',$student_id)
                                                 ->with(['user_data' => function($query){
                                                    $query->select('id','first_name','last_name','pin');
                                                 }])
                                                 ->with(['subject_trans' => function($query) {
                                                    $query->select('id','subject_id','name','locale');
                                                    $query->where('locale',\App::getLocale());
                                                 }])
                                                 ->with(['grade_trans' => function($query) {
                                                    $query->select('id','grade_id','name','locale');
                                                    $query->where('locale',\App::getLocale());
                                                 }])
                                                 ->first();
        if($obj_student)
        {
            $arr_student  = $obj_student->toArray();

            $first_name   = $arr_student['user_data']['first_name'];
            $last_name    = $arr_student['user_data']['last_name'];
            $pin          = $arr_student['user_data']['pin'];
            $subject_name = $arr_student['subject_trans']['name'];
            $grade_name   = $arr_student['grade_trans']['name'];
        }

        $obj_student_program = $this->StudentProgramsModel->where('student_id', $student_id)
                                                          ->with(['program_details' => function($query){
                                                            $query->select('id','unique_id','name','description');
                                                          }])
                                                          ->with(['user_details' => function($query){
                                                            $query->select('id','user_type','first_name','last_name','email');
                                                          }])
                                                          ->orderBy('id', 'DESC');

        if( isset($_GET['keyword']) && !empty($_GET['keyword']) )
        {
            $obj_student_program = $obj_student_program->whereHas("program_details", function($query) use ($keyword) {
                                                            $query->whereRaw("( name LIKE '%".$keyword."%' )");
                                                        });
        }
        if( isset($_GET['search']) && !empty($_GET['search']))
        {
            $obj_student_program = $obj_student_program->whereDate('created_at', '=', date('c', strtotime($serach_date)) );
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

                $data[trans('teacher.Sr_No')]                = ($key+1);
                $data[trans('teacher.Name_Of_Student')]      = $first_name.' '.$last_name;
                $data[trans('teacher.Pin')]                  = $pin;
                $data[trans('parent.Subject')]               = $subject_name;
                $data[trans('parent.Grade')]                 = $grade_name;

                $data[trans('parent.Program').'Id']          = isset($student_program['program_details']['unique_id'])? $student_program['program_details']['unique_id']:'NA';
                $data[trans('parent.Program_Name')]          = isset($student_program['program_details']['name'])? $student_program['program_details']['name']:'NA';
                $data[trans('parent.Program_Description')]   = isset($student_program['program_details']['description'])? $student_program['program_details']['description']:'NA';

                $data[trans('parent.Assigned_By')]           = $assigned_by_fname.' '.$assigned_by_lname;
                $data[trans('parent.Assigned_Date')]         = isset($student_program['created_at']) ? get_added_on_date_time($student_program['created_at']) : 'NA';
                $data[trans('parent.Status')]                = trans('parent.'.$this->StudentService->CheckProgramStatus($program_id, $student_id));

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        $type = 'CSV';

        return Excel::create($first_name.' '.$last_name.trans('parent.Program_Report'), function($excel) use ($data, $first_name, $last_name) {

            // Set the title
            $excel->setTitle($first_name.' '.$last_name.trans('parent.Program_Report'));

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription($first_name.' '.$last_name.trans('parent.Program_Report'));

            $excel->sheet($first_name.' '.$last_name.trans('parent.Program_Report'), function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);
    } // end MyKidsExportCSV

    /**
    * Function  : generate_program_report($slug,$enc_student_id)
    * Author    : Akshay Garje
    * Date      : 05/09/2018
    * @return [view] [Generate program report]
    */

    public function generate_program_report($slug,$enc_student_id)
    {
        if($slug!='' && $enc_student_id!='')
        {
            $student_id = base64_decode($enc_student_id);
            $result = $this->ReportService->create_program_report($slug,$student_id);
            if($result!='error' && $result!='')
            {
                $result['middleContent']   = 'parent.my-children.program_report';
                $result['enc_student_id']  = $enc_student_id;
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
    public function delete_program($enc_program_id)
    {
        $obj_program = $status = '';
        $program_id  = '';
        if(isset($enc_program_id) && $enc_program_id!="")
        {
            $program_id = base64_decode($enc_program_id);
        }
        if(isset($program_id) && $program_id!="")
        {
           $obj_program =  $this->StudentProgramsModel->where('id','=',$program_id)
                                                      ->where('assigned_by','=','parent')
                                                      ->first();
        }
        $student_id = isset($obj_program->student_id)?$obj_program->student_id:'';
        $obj_data   =  $this->StudentProgramQuestionModel->where('program_id','=',$program_id)
                                       ->where('student_id','=',$student_id)
                                       ->first();
      
        if($obj_program)
        {
             $status = $obj_program->delete();
            $this->StudentProgramQuestionModel->where('program_id','=',$program_id)
                                       ->where('student_id','=',$student_id)
                                       ->delete();  

           
        }
        if($status)
        {
            Session::flash('success',trans('teacher.Program_deleted_successfully'));
        }         
        else
        {
             Session::flash('error',trans('teacher.Error_occured_while_delete_a_records'));
        }
        return redirect()->back();
    }
}
