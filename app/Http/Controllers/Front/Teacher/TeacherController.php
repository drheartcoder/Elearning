<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\EmailService;

use App\Models\UsersModel;
use App\Models\NotificationsModel;
use App\Models\ClassroomStudentModel;
use App\Models\LanguageModel;
use App\Models\FlyerModel;
use App\Models\CertificateModel;
use App\Models\StudentProgramsModel;
use App\Models\EmailTemplateModel;
use App\Models\StudentProgramQuestionModel;
use App\Models\ClassroomsModel;
use App\Models\ShareClassModel;

use Validator;
use Response;
use Session;
use Paginate;
use flash;
use Auth;
use DB;
use PDF;
use Excel;
class TeacherController extends Controller
{
    public function __construct(NotificationService $notification_service,EmailService $email_service)
    {
        $this->NotificationService         = $notification_service;
        $this->EmailService                = $email_service;
        $this->NotificationsModel          = new NotificationsModel();
        $this->ClassroomStudentModel       = new ClassroomStudentModel();
        $this->LanguageModel               = new LanguageModel();
        $this->FlyerModel                  = new FlyerModel();
        $this->UsersModel                  = new UsersModel();
        $this->StudentProgramsModel        = new StudentProgramsModel();
        $this->EmailTemplateModel          = new EmailTemplateModel();
        $this->CertificateModel            = new CertificateModel();
        $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
        $this->ClassroomsModel             = new ClassroomsModel(); 
        $this->ShareClassModel             = new ShareClassModel(); 

    }


    public function StudentFlyers(Request $request,$enc_id=false)
    {
        $arr_student = []; $links = ''; $lang_arr = [];
        $teacher_id  = Auth::user()->id;
        $class_id    = base64_decode($enc_id,true);

        if($class_id!=false)
        {
            $obj_student = $this->ClassroomStudentModel->with(['student_data' => function($q){
                                                            $q->select('id','first_name','last_name','enrollment_code','pin');
                                                        },
                                                        'subject_parent_data'=>function($q1){

                                                            $q1->with(['parent_data']);
                                                        },
                                                        'class_data'=>function($q1)
                                                        {
                                                            $q1->select('id','class_enrollment_code','name','subject_id','grade_id','teacher_id','program_id');
                                                            $q1->with(['grade_data','subject_data','program_details'=>function($q2){
                                                                    $q2->select('id','user_id','name','description');
                                                                }]);
                                                        }])
                                                        ->where('teacher_id',$teacher_id)
                                                        ->where('classroom_id',$class_id)
                                                        ->orderBy('id','DESC')
                                                        ->Paginate(10);

            if(isset($obj_student) && count($obj_student)>0)
            {
                $arr_student =  $obj_student->toArray();            
                $links       =  $obj_student->links();
            }    
            $lang_arr = $this->LanguageModel->where('status','1')->get();

        }
        else
        {
            return redirect()->back();
        }
        $data['class_id']             = base64_encode($class_id);
        $data['student_arr']          = $arr_student;
        $data['pagination_links_arr'] = $links;        
        $data['lang_arr']             = $lang_arr;        
        $data['enc_id']               = $enc_id;        
        $data['pageTitle']            = trans('teacher.Student_Flyer');
        $data['middleContent']        = 'teacher.my-student.student-flyers';
        $data['user_type']            = 'teacher';
        $data['parentTitle']          = trans('parent.Dashboard'); 
        $data['secondParentTitle']    = trans('teacher.My_Classes');    
        $data['secondParentUrl']      = url('/').'/teacher/class';     
        return view('front.layout.master')->with($data);
    } // end 

    public function SendMultipleFlyers(Request $request)
    {
        $arr_rules = []; $view = '';
        $arr_rules['checked_record'] =  'required';
        $arr_rules['language']       =  'required';
        $arr_rules['enc_class_id']   =  'required';

        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails())
        {
            Session::flash('error',trans('teacher.select_language_and_student'));
            return redirect()->back()->withError($validator)->withInput();
        }
        else
        {
            $checked_record =  $request->input('checked_record');        
            $multi_action   =  $request->input('multi_action');                                        
            $class_id       =  base64_decode($request->input('enc_class_id'));
            $arr_mail_data  = $arr_classroom_details = [];
            $arr_data_all   = '';
            $show_success_msg = false;
            //$str1 = ''; $str = '';
            $arr_classroom_details = $this->ClassroomsModel->where('id',$class_id)
                                                           ->where('teacher_id',Auth::user()->id)
                                                           ->with('grade_details','subject_details','program_details')
                                                           ->first();
            if(isset($arr_classroom_details) && count($arr_classroom_details)>0)
            {
                $arr_classroom_details = $arr_classroom_details->toArray();
                $class_name   = $arr_classroom_details['name'];
                $grade_name   = $arr_classroom_details['grade_details']['name'];
                $subject_name = $arr_classroom_details['subject_details']['name'];
                $program_name = $arr_classroom_details['program_details']['name'];
                
                foreach ($checked_record as $key => $value) 
                {
                    $parent   =  $request->input('parent_'.$value);
                    $language =  $request->input('language');
                    //$str1 = '<html><body>';
                    if($value!='') 
                    {
                        if($multi_action == 'send' && $parent == '0') 
                        {
                            $show_success_msg = true;
                            $user_details_arr = getUserDetails($parent);                                                
                            $flyer_info = $this->FlyerModel->where('template_id','1')->where('locale',$language[$value])->first();
                            $receiver_data = $this->UsersModel->where('id',$value)->select('first_name','pin','enrollment_code')->first(); 

                            if(!empty($request->input('indi_flyer_email')) 
                                && $request->input('indi_flyer_email') !=""){
                            $EMAIL  =  $request->input('indi_flyer_email'); 
                            }
                            else{
                            $EMAIL  =  $user_details_arr['email']; 
                            }
                            $arr_built_content = [
                                                    'USERNAME'      => $receiver_data['first_name'],
                                                    'PIN'           => $receiver_data['pin'],
                                                    'CODE'          => $receiver_data['enrollment_code'],
                                                    'PROJECT_NAME'  => config('app.project.name'),
                                                    'PROJECT_URL'   => url('/'),
                                                    'TEACHER_NAME'  => ucwords(Auth::user()->first_name.' '.Auth::user()->last_name),
                                                    'TEACHER_EMAIL' => Auth::user()->email,
                                                    'CLASS'         => $class_name,
                                                    'GRADE'         => $grade_name,
                                                    'SUBJECT'       => $subject_name,
                                                    'PROGRAM'       => $program_name,
                                                 ];                        
                            $arr_data['arr_built_content'] = $arr_built_content;
                            
                            $content = $flyer_info['template_html'];
                            if (isset($arr_data['arr_built_content']) && sizeof($arr_data['arr_built_content']) > 0) 
                            {
                                foreach ($arr_data['arr_built_content'] as $key => $data) 
                                {
                                    $content = str_replace("##".$key."##",$data,$content);
                                }
                            }

                            $view = view('email.flyer',compact('content'))->with($content);            
                            $html = $view->render();                         

                            $FileName = 'Flyer'.$value.'.pdf';
                            $attachment = $this->generateFlyer($html,$FileName);                                              
                            $arr_built_mail_content = [
                                                          'NAME'           => $receiver_data['first_name'],
                                                          'PROJECT_NAME'   => config('app.project.name')
                                                       ];
                            $arr_mail_data                      = [];
                            $arr_mail_data['email_template_id'] = '4';
                            $arr_mail_data['arr_built_content'] = $arr_built_mail_content;
                            $arr_mail_data['arr_built_content'] = $arr_built_mail_content;
                            $arr_mail_data['attachment']        = $attachment;
                            $arr_mail_data['user']              = ['email'      => $EMAIL];                        
                            $this->EmailService->send_flyer($arr_mail_data);                    
                        }
                        else if($multi_action == 'print')
                        {
                            if($parent != '0')
                            {   
                                $user_details_arr = getUserDetails($parent);                                                
                                $flyer_info = $this->FlyerModel->where('template_id','2')->where('locale',$language[$value])->first();
                                $receiver_data = $this->UsersModel->where('id',$value)->select('first_name','pin')->first();                        
                                $arr_built_content = [
                                                        'USERNAME'     => $receiver_data['first_name'],
                                                        'PIN'          => $receiver_data['pin'],
                                                        'EMAIL'        => $user_details_arr['email'],
                                                        'PROJECT_NAME' => config('app.project.name'),
                                                        'PROJECT_URL'  => url('/'),
                                                        'TEACHER_NAME' => ucwords(Auth::user()->first_name.' '.Auth::user()->last_name),
                                                        'TEACHER_EMAIL'=> Auth::user()->email,
                                                        'CLASS'        => $class_name,
                                                        'GRADE'        => $grade_name,
                                                        'SUBJECT'      => $subject_name,
                                                        'PROGRAM'      => $program_name,
                                                     ];                      

                            }
                            else
                            {                            
                                $flyer_info = $this->FlyerModel->where('template_id','1')->where('locale',$language[$value])->first()->toArray();
                                $receiver_data = $this->UsersModel->where('id',$value)->select('first_name','enrollment_code','pin')->first()->toArray();
                                                      
                                $arr_built_content = [
                                                        'USERNAME'     => $receiver_data['first_name'],
                                                        'PIN'          => $receiver_data['pin'],
                                                        'CODE'         => $receiver_data['enrollment_code'],
                                                        'PROJECT_NAME' => config('app.project.name'),
                                                        'PROJECT_URL'  => url('/'),
                                                        'TEACHER_NAME' => ucwords(Auth::user()->first_name.' '.Auth::user()->last_name),
                                                        'TEACHER_EMAIL' => Auth::user()->email,
                                                        'CLASS'        => $class_name,
                                                        'GRADE'        => $grade_name,
                                                        'SUBJECT'      => $subject_name,
                                                        'PROGRAM'      => $program_name,                                                        
                                                     ];
                            }
                            $arr_data['arr_built_content'] = $arr_built_content;
                            $content = $flyer_info['template_html'];
                            if (isset($arr_data['arr_built_content']) && sizeof($arr_data['arr_built_content']) > 0) 
                            {
                                foreach ($arr_data['arr_built_content'] as $key => $data) 
                                {
                                    $content = str_replace("##".$key."##",$data,$content);
                                }
                            }

                            $view = view('email.flyer',compact('content'))->with($content);
                            $html = $view->render(); 
                            //$arr_data_all .= $html."<div class='break-after:always'></div>";
                            $arr_data_all .=$html;  
                        }
                    }
                    
                }
            //$str = '</body></html>';            
            //dd($str1.$arr_data_all.$str);
                if($multi_action=='print') 
                {                            
                    Session::flash('file',url('/uploads/flyers/Flyer.pdf'));
                    $FileName = 'Flyer.pdf';
                    $this->generateFlyer($arr_data_all,$FileName);                        
                }   

                if ($multi_action=='send') 
                {
                    if($show_success_msg==true)
                    {
                        Session::flash('success',trans('teacher.Flyer_sent_successfully'));                
                    }
                    else
                    {
                        Session::flash('error',trans('teacher.No_parent_found_for_flyer'));                
                    }
                    return redirect()->back();    
                }
            }            
        }
        return redirect()->back();    
    }

    function generateFlyer($arr_mail_data=false,$FileName=false)
    {
        //dd($arr_mail_data);
        $receiver_data =[]; $flyer_info=[]; $html = $view = "";
        if(isset($arr_mail_data) && $arr_mail_data!=false)
        {
            ob_start();          
            $res      = PDF::loadHTML($arr_mail_data)->save(base_path('uploads/flyers/'.$FileName),'F');
            ob_flush();              
            if($FileName=='Flyer.pdf')
            {
                return $res->stream(base_path('uploads/flyers/'.$FileName));      
            }
            else
            {
                return base_path('uploads/flyers/'.$FileName);  
            }
            
        }
    }

    public function StudentCertificates(Request $request,$enc_id=false)
    {
        $arr_student = []; $links = ''; $lang_arr = [];
        $teacher_id  = Auth::user()->id;
        $class_id    = base64_decode($enc_id,true);
        if($class_id!=false)
        {
           // / dd(base64_encode($class_id));
            $obj_student = $this->StudentProgramsModel->with(['program_details'=>function($q) {
                                                       $q->select('id','name','subject','grade');
                                                       $q->with(['subjectData','gradeData']);
                                                    },'student_details'=>function($q) use($class_id)  {
                                                        $q->select('id','first_name','last_name','enrollment_code','pin');
                                                        $q->with(['classes_data'=>function($q1) use($class_id) {
                                                            $q1->where('classroom_id','=',$class_id);
                                                        }]);

                                                    }])->where('created_by',$teacher_id)
                                                    ->orderBy('id','DESC')                             
                                                    ->Paginate(10);

            if(isset($obj_student) && count($obj_student)>0)
            {
                $arr_student =  $obj_student->toArray();                                  
                $links       =  $obj_student->links();
            }    

            $lang_arr = $this->LanguageModel->where('status','1')->get();

        }
        else
        {
            return redirect()->back();
        }
        $data['class_id']             = base64_encode($class_id);
        $data['student_arr']          = $arr_student;
        $data['pagination_links_arr'] = $links;        
        $data['lang_arr']             = $lang_arr;        
        $data['pageTitle']            = trans('teacher.Student_Certificates');
        $data['middleContent']        = 'teacher.my-student.student-certificate';
        
        return view('front.layout.master')->with($data);
    } // end 

    public function PrintMultipleCertificates(Request $request)
    {
        //dd($request->all());
        $arr_mail_data = []; $arr_rules = []; $view = ''; $program_details = []; $arr_data_all='';

        $arr_rules['checked_record'] =  'required';
        $arr_rules['language']       =  'required';
        $arr_rules['program_name']   =  'required';
        $arr_rules['program_id']     =  'required';


        $validator = Validator::make($request->all(),$arr_rules);
        
        if($validator->fails()) 
        {
            Session::flash('error',trans('teacher.select_language_and_student'));
            return redirect()->back()->withError($validator)->withInput();
        } 
        else 
        {
            $checked_record =  $request->input('checked_record');                                                         
            $program_name   =  $request->input('program_name');
            $language       =  $request->input('language');
            $program_id     =  $request->input('program_id');


            foreach ($checked_record as $key => $value) 
            {               
                if($value!='') 
                {
                    $certificate_info = $this->CertificateModel->where('locale',$language[$value])->first();
                    $receiver_data = $this->UsersModel->where('id',$value)->select('first_name','last_name')->first();                                    

                    $obj_program_details = $this->StudentProgramQuestionModel->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(answer_time))) as total_time")->where('program_id',$program_id[$value])->first();
                
                    if(isset($obj_program_details) && count($obj_program_details)>0)
                    {
                        $program_details = $obj_program_details->toArray();                    
                    }

                    $arr_built_content = [
                                            'USERNAME'     => ucwords($receiver_data['first_name'].' '.$receiver_data['last_name']),
                                            'PROGRAM_NAME' => $program_name[$value],
                                            'PROJECT_NAME' => config('app.project.name'),
                                            'PROJECT_URL'  => url('/'),
                                            'TIME'         => isset($program_details['total_time']) ? $program_details['total_time'] : '',
                                            'TEACHER_NAME' => ucfirst(Auth::user()->first_name.' '.Auth::user()->last_name),
                                            'DATE'         => date('d-m-Y'),
                                         ];                                           

                    $arr_data['arr_built_content']  = $arr_built_content;

                    $content = $certificate_info['template_html'];
                
                    if (isset($arr_data['arr_built_content']) && sizeof($arr_data['arr_built_content']) > 0) 
                    {
                        foreach ($arr_data['arr_built_content'] as $key => $data) {
                            $content = str_replace("##".$key."##",$data,$content);
                        }
                    }
                    $view = view('email.certificate',compact('content'))->with($content);            
                    $html = $view->render();            
                    
                }
                $arr_data_all .=$html;  
            }                 
            
            $this->generateCertificate($arr_data_all);                        
            Session::flash('file',url('/uploads/certificates/Certificate.pdf'));            
        }
        return redirect()->back();                            
    } 


    
    public function PrintCertificates($enc_id=false,$enc_program_name=false,$lang=false,$enc_program_id=false)
    {
        $program_details = [];
        if($enc_id==false && $enc_program_name==false && $lang==false && $enc_program_id!=false)
        {
            Session::flash('error','Please select student');
            return redirect()->back();
        } 
        else 
        {
            $student_id   =  base64_decode($enc_id,true);                                                         
            $program_name =  base64_decode($enc_program_name,true);     
            $program_id   =  base64_decode($enc_program_id,true);     

            if($student_id==false && $program_name==false && $lang==false && $program_id==false)
            {
                Session::flash('error',trans('teacher.Please_select_student'));
                return redirect()->back();
            }   
            else
            {
                $certificate_info = $this->CertificateModel->where('locale',$lang)->first();
                $receiver_data = $this->UsersModel->where('id',$student_id)->select('first_name','last_name')->first();                        
                $obj_program_details = $this->StudentProgramQuestionModel->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(answer_time))) as total_time")->where('program_id',$program_id)->first();   
                
                if(isset($obj_program_details) && count($obj_program_details)>0)
                {
                    $program_details = $obj_program_details->toArray();                    
                }    
                
                $arr_built_content = [
                                        'USERNAME'     => ucwords($receiver_data['first_name'].' '.$receiver_data['last_name']),
                                        'PROGRAM_NAME' => $program_name,
                                        'PROJECT_NAME' => config('app.project.name'),
                                        'PROJECT_URL'  => url('/'),
                                        'TIME'         => isset($program_details['total_time']) ? $program_details['total_time'] : '',
                                        'TEACHER_NAME' => ucfirst(Auth::user()->first_name.' '.Auth::user()->last_name),
                                        'DATE'         => date('d-m-Y'),
                                     ];                        
                $arr_data['arr_built_content'] = $arr_built_content;                

                $content = $certificate_info['template_html'];
            
                if (isset($arr_data['arr_built_content']) && sizeof($arr_data['arr_built_content']) > 0) 
                {
                    foreach ($arr_data['arr_built_content'] as $key => $data) {
                        $content = str_replace("##".$key."##",$data,$content);
                    }
                }
                $view = view('email.certificate',compact('content'))->with($content);            
                $html = $view->render();                 

                $this->generateCertificate($html);                        
                Session::flash('file',url('/uploads/certificates/Certificate.pdf'));
            }            
        }    
        return redirect()->back();       
    }

    function generateCertificate($arr_mail_data=false)
    {
        $receiver_data =[]; $flyer_info=[]; $html = $view = "";
        if(isset($arr_mail_data) && $arr_mail_data!=false)
        {
            ob_start();
            $res      = PDF::loadHTML($arr_mail_data)->save(base_path('uploads/certificates/Certificate.pdf'),'F');
            ob_flush();            
            return $res->stream(base_path('uploads/certificates/Certificate.pdf'));      
            /*$view = view('certificate');
            $res      = PDF::loadHTML($html)->save(base_path('uploads/certificates/sample-certificate.pdf'),'F');            
            return base_path('uploads/certificates/sample-certificate.pdf');  */
            
        }
    }

    public function StudentReports(Request $request)
    {            
        $data['pageTitle']            = trans('teacher.Pin');
        $data['middleContent']        = 'teacher.my-student.student-print-report';   
        $data['secondParentTitle']    = trans('teacher.My_Classes');    
        $data['secondParentUrl']      = url('/').'/teacher/class';  
        $data['user_type']            = 'teacher';
        $data['parentTitle']          = trans('parent.Dashboard');

        return view('front.layout.master')->with($data);
    } 

    public function PrintStudentPin(Request $request)
    {
        $student_info=[];
        $class_id = base64_decode($request->input('classid'),true);        
        
        if($class_id!=false)
        {
            $obj_student_info = $this->ClassroomStudentModel->with(['student_data'=>function($q){
                                                                $q->select('id','pin','first_name','last_name');
                                                            }])->where('classroom_id',$class_id)->get();

            if(isset($obj_student_info) && count($obj_student_info)>0)
            {
                $student_info = $obj_student_info->toArray();
                    
                $view = view('student-pin-pdf')->with(['student_info'=>$student_info]);            
                $html = $view->render();                 
                $res  = PDF::loadHTML($html)->save(base_path('uploads/student_pin/student-pin.pdf'),'F');
                $res->stream(base_path('uploads/student_pin/student-pin.pdf'));      
                Session::flash('file',url('/uploads/student_pin/student-pin.pdf'));
            }    
            else
            {
                Session::flash('error',trans('teacher.Please_add_student_this_class'));
            }
        }
        else
        {
            Session::flash('error',trans('parent.something_went_wrong'));
        }    
        return redirect()->back();
    }

    /*public function PrintClassReport(Request $request)
    {   
        $student_info=[];
        $class_id = base64_decode($request->input('classid'),true);        
        
        if($class_id)
        {
            $obj_student_info = $this->ClassroomsModel->with(['class_student_data','class_student_data.student_data'=>function($q){
                                                                $q->select('id','pin','first_name','last_name');
                                                            }])->where('id',$class_id)->first();

            if(isset($obj_student_info) && count($obj_student_info)>0)
            {
                $student_info = $obj_student_info->toArray();                        
                $view = view('student-class-report')->with(['student_info'=>$student_info]);            
                $html = $view->render();                 
                $res  = PDF::loadHTML($html)->save(base_path('uploads/student_pin/student-pin.pdf'),'F');
                $res->stream(base_path('uploads/student_pin/student-pin.pdf'));      
                Session::flash('file',url('/uploads/student_pin/student-pin.pdf'));
            }    
        }         
        else
        {
            Session::flash('error','Something went wrong, Please try again later');
        }    
        return redirect()->back();
    }*/

    public function ShareClass(Request $request,$enc_id=false)
    {
        $arr_rules = []; $share_info = []; $share_class_info = []; $links = '';
        $class_id = base64_decode($enc_id,true);                
        if($class_id!=false)
        {

            $obj_share_class_info = $this->ShareClassModel->with(['class_data'=>function($q){
                                                                    $q->select('id','name');
                                                                  }])->where('classroom_id',$class_id)->Paginate(10);
            if(isset($obj_share_class_info) && count($obj_share_class_info)>0)
            {
                $share_class_info = $obj_share_class_info->toArray();                         
                $links =  $obj_share_class_info->links();          
            }

            if(isset($_POST['btnShareClass']))
            {
                $arr_rules['share_email'] = 'required|email';
                $validator = Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {            
                    return redirect()->back()->withError($validator)->withInput();
                }

                $email    = $request->input('share_email');

                $class_data = $this->ClassroomsModel->where('id',$class_id)->first();                
                
                $check_email_exist = $this->UsersModel->where('email',$email)->where('user_type','teacher')->first();                
                if(isset($check_email_exist) && count($check_email_exist)>0)
                {
                    if($check_email_exist['id']!=Auth::id())
                    {
                        $check_already_share = $this->ShareClassModel->where('to_teacher',$email)->where('from_teacher_id',Auth::id())->where('classroom_id',$class_id)->first();
                        
                        if(isset($check_already_share) && count($check_already_share)>0)
                        {
                            Session::flash('error',trans('teacher.already_share_this_class'));
                            return redirect()->back();
                        }
                        else    
                        {
                            $this->ShareClassModel->create(['to_teacher' => $email,'from_teacher_id' => Auth::id(),'classroom_id' => $class_id,'to_teacher_id'=>$check_email_exist['id']]);                        
                            $obj_share_info = $this->ClassroomStudentModel->where('classroom_id',$class_id)->where('teacher_id',Auth::id())->get();
                            if($obj_share_info)
                            {
                                $share_info = $obj_share_info->toArray(); 

                                foreach ($share_info as $key => $value) 
                                {
                                    $insert_arr['classroom_id'] = $value['classroom_id'];
                                    $insert_arr['student_id']   = $value['student_id'];
                                    $insert_arr['teacher_id']   = $check_email_exist['id'];


                                    $this->ClassroomStudentModel->create($insert_arr);
                                }

                                $arr_noti['message']      = ucwords(Auth::user()->first_name.' '.Auth::user()->last_name).' has shared '.ucfirst($class_data['name']).' class successfully.';
                                $arr_noti['from_user_id'] = Auth::id();
                                $arr_noti['to_user_id']   = $check_email_exist['id'];
                                $arr_noti['url']          = "/teacher/dashboard";
                                $arr_noti['is_read']      = "0";
                                $status                   = $this->NotificationService->send_notification($arr_noti);

                                Session::flash('success',trans('teacher.Class_shared_successfully'));
                                return redirect()->back();
                            }
                         }   
                    }
                    else
                    {
                        Session::flash('error',trans('teacher.cant_share_class_yourself'));
                        return redirect()->back();
                    }
                    
                }
                else
                {
                    $check_already_share = $this->ShareClassModel->where('to_teacher',$email)->where('from_teacher_id',Auth::id())->where('classroom_id',$class_id)->first();
                        
                    if(isset($check_already_share) && count($check_already_share)>0)
                    {
                        Session::flash('error',trans('teacher.already_share_this_class'));
                        return redirect()->back();
                    }
                    else    
                    {
                        $this->ShareClassModel->create(['to_teacher' => $email,'from_teacher_id' => Auth::id(),'classroom_id' => $class_id]);
                        // Send Email
                        $url = '<td class="listed-btn"><a target="_blank" href="'.url('/').'/signup?c='.base64_encode($class_data['class_enrollment_code']).'&e='.base64_encode($email).'&t=share">Join Now</a></td><br/>';
                        $arr_built_content = [
                                                  'NAME'         => 'Dear',
                                                  'PROJECT_URL'  => $url,
                                                  'PROJECT_NAME' => config('app.project.name')
                                             ];

                        $arr_mail_data                      = [];
                        $arr_mail_data['email_template_id'] = '5';
                        $arr_mail_data['arr_built_content'] = $arr_built_content;
                        $arr_mail_data['user']              = ['email' => $email];

                        $email_status  = $this->EmailService->send_mail($arr_mail_data);

                        Session::flash('success',trans('teacher.Invitation_mail_sent'));
                        return redirect()->back();
                    }    
                }                
            }

            $data['share_class_info']     = $share_class_info;
            $data['pagination_links_arr'] = $links;          
            $data['pageTitle']            = trans('teacher.Share_Class');  
                
            $data['user_type']            = 'teacher';
            $data['parentTitle']          = trans('parent.Dashboard'); 
            $data['secondParentTitle']    = trans('teacher.My_Classes');    
            $data['secondParentUrl']      = url('/').'/teacher/class';     

            $data['middleContent']        = 'teacher.my-class.share-class';
            return view('front.layout.master')->with($data);        
        
        }     
        else
        {
            Session::flash('error',trans('teacher.Class_not_found'));
            return redirect()->back();
        }
    }   

    public function TransferedClassListing(Request $request, $enc_id = false)
    {
        $transfer_class_info = []; $links = '';
        $obj_transfer_class_info = $this->ClassroomsModel->with('transfer_user_details')
                                                   ->where('teacher_id',Auth::id())
                                                   ->where('is_transfer','yes')
                                                   ->Paginate(10);

        if(isset($obj_transfer_class_info) && count($obj_transfer_class_info)>0)
        {                
            $transfer_class_info = $obj_transfer_class_info->toArray();                         
            $links =  $obj_transfer_class_info->links();          
        }

        $data['enc_class_id']         = $enc_id;
        $data['transfer_class_info']  = $transfer_class_info;
        $data['pagination_links_arr'] = $links;
        $data['pageTitle']            = trans('teacher.Transfered_Class_Listing');
        $data['middleContent']        = 'teacher.my-class.transfer-class-listing';

        return view('front.layout.master')->with($data);
    }    

    public function TransferClass(Request $request,$enc_id=false)
    {
        $arr_rules = []; $share_info = []; $transfer_class_info = []; $links = '';
        $class_id = base64_decode($enc_id,true);                
        if($class_id!=false)
        {          

            if(isset($_POST['btnTransferClass']))
            {
                $arr_rules['share_email'] = 'required|email';
                $validator = Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {            
                    return redirect()->back()->withError($validator)->withInput();
                }

                $email    = $request->input('share_email');

                $class_data = $this->ClassroomsModel->where('id',$class_id)->first();                
                $check_email_exist = $this->UsersModel->where('email',$email)->where('user_type','teacher')->first();                
                if(isset($check_email_exist) && count($check_email_exist)>0)
                {
                    if($check_email_exist['id']!=Auth::id())
                    {   
                        if($class_data['transfer_id']!=null)
                        {
                            Session::flash('error',trans('teacher.already_transfer_this_class'));
                            return redirect()->back();
                        }
                        else    
                        {
                            $class_data->update(['is_transfer' => 'yes','transfer_id' => $check_email_exist['id']]);

                            $class_data = $this->ClassroomsModel->create([
                                                                            'teacher_id'            => $check_email_exist['id'],
                                                                            'is_transfer'           => 'no',
                                                                            'transfer_id'           => null,
                                                                            'class_enrollment_code' => GenerateEnrollmentCode(),
                                                                            'status'                => '1',
                                                                            'name'                  => $class_data['name'],
                                                                            'slug'                  => $class_data['slug'],
                                                                            'subject_id'            => $class_data['subject_id'],
                                                                            'grade_id'              => $class_data['grade_id'],
                                                                            'start_date'            => $class_data['start_date'],
                                                                            'end_date'              => $class_data['end_date'],
                                                                            'program_id'            => $class_data['program_id'],
                                                                        ]);          
                            

                            $obj_share_info = $this->ClassroomStudentModel->where('classroom_id',$class_id)->where('teacher_id',Auth::id())->get();
                            if($obj_share_info)
                            {
                                $share_info = $obj_share_info->toArray(); 

                                foreach ($share_info as $key => $value) 
                                {
                                    $insert_arr['classroom_id'] = $class_data->id;
                                    $insert_arr['student_id']   = $value['student_id'];
                                    $insert_arr['teacher_id']   = $check_email_exist['id'];


                                    $this->ClassroomStudentModel->create($insert_arr);
                                }

                                $arr_noti['message']      = ucwords(Auth::user()->first_name.' '.Auth::user()->last_name).' has transfered '.ucfirst($class_data['name']).' class successfully.';
                                $arr_noti['from_user_id'] = Auth::id();
                                $arr_noti['to_user_id']   = $check_email_exist['id'];
                                $arr_noti['url']          = "/teacher/dashboard";
                                $arr_noti['is_read']      = "0";
                                $status                   = $this->NotificationService->send_notification($arr_noti);

                                $this->ClassroomStudentModel->where('classroom_id',$class_id)->where('teacher_id',Auth::id())->delete();

                                Session::flash('success',trans('teacher.Class_transfered_successfully'));
                                return redirect(url('/teacher/dashboard'));
                            }
                         }   
                    }
                    else
                    {
                        Session::flash('error',trans('teacher.cant_transfered_class_yourself'));
                        return redirect()->back();
                    }
                    
                }
                else
                {   
                    // Send Email
                    $url = '<td class="listed-btn"><a target="_blank" href="'.url('/').'/signup?c='.base64_encode($class_data['class_enrollment_code']).'&e='.base64_encode($email).'&t=transfer">Join Now</a></td><br/>';
                    $arr_built_content = [
                                              'NAME'         => 'Dear',
                                              'PROJECT_URL'  => $url,
                                              'PROJECT_NAME' => config('app.project.name')
                                         ];

                    $arr_mail_data                      = [];
                    $arr_mail_data['email_template_id'] = '5';
                    $arr_mail_data['arr_built_content'] = $arr_built_content;
                    $arr_mail_data['user']              = ['email' => $email];

                    $email_status  = $this->EmailService->send_mail($arr_mail_data);

                    Session::flash('success',"Invitation mail sent.");
                    return redirect(url('/teacher/dashboard'));                
                }                
            }

            $data['transfer_class_info']  = $transfer_class_info;
            $data['pagination_links_arr'] = $links;          
            $data['pageTitle']     = trans('teacher.Transfer_Class');
            $data['middleContent'] = 'teacher.my-class.transfer-class';

            return view('front.layout.master')->with($data);
        
        }     
        else
        {
            Session::flash('error',trans('teacher.Class_not_found'));
            return redirect()->back();
        }
    }
    public function ExportStudentCertificates(Request $request)
    {
       $form_data = $arr_student = $export_array=$data=[];
       $form_data = $request->all();
       $teacher_id = Auth::user()->id;
       $class_id  = isset($form_data['enc_class_id'])?base64_decode($form_data['enc_class_id']):'';
         $obj_student = $this->StudentProgramsModel->with(['program_details'=>function($q) {
                                                       $q->select('id','name','subject','grade');
                                                       $q->with(['subjectData','gradeData']);
                                                    },'student_details'=>function($q) use($class_id)  {
                                                        $q->select('id','first_name','last_name','enrollment_code','pin');
                                                        $q->with(['classes_data'=>function($q1) use($class_id) {
                                                            $q1->where('classroom_id','=',$class_id);
                                                        }]);

                                                    }])->where('created_by',$teacher_id)
                                                    ->orderBy('id','DESC')->get();



        if($obj_student)
        {
            $arr_student = $obj_student->toArray();

            foreach ($arr_student as $key => $student) 
            {
              if(isset($student['student_details']['classes_data']) && sizeof($student['student_details']['classes_data'])>0)
               {
                    $student_id           = isset($student['student_details']['id'])?$student['student_details']['id']:'NA';
                    $first_name           = isset($student['student_details']['first_name'])? $student['student_details']['first_name']:'NA';
                    $last_name            = isset($student['student_details']['last_name'])? $student['student_details']['last_name']:'NA';
                    $pin                  = isset($student['student_details']['pin'])? $student['student_details']['pin']:'NA';

                    $enrollment_code                  = isset($student['student_details']['enrollment_code'])? $student['student_details']['enrollment_code']:'NA';

                    $registration_date    =  isset($student['created_at'])?$student['created_at']:'NA';

                    $subject_name         = isset($student['program_details']['subject_data']['name'])?$student['program_details']['subject_data']['name']:'';
                    $grade_name           = isset($student['program_details']['grade_data']['name'])?$student['program_details']['grade_data']['name']:'';

                    $program_name = isset($student['program_details']['name'])?$student['program_details']['name']:'';
                    $program_id   = isset($student['program_details']['id'])?$student['program_details']['id']:'';
                    $data[trans('teacher.Sr_No')]              = ($key+1);
                    $data[trans('teacher.Name_Of_Student')]    = $first_name.' '.$last_name;
                    $data[trans('teacher.Pin')]                = $pin;
                    $data[trans('auth.Enrollment_Code')]       = $enrollment_code;
                    $data[trans('parent.Subject')]             = $subject_name;
                    $data[trans('parent.Grade')]               = $grade_name;
                    $data[trans('parent.Program_Name')]        = $program_name;
                    $data[trans('parent.Status')]              = trans('parent.'.checkProgramStatus($program_id,$student_id));
                    $data[trans('teacher.Registration_Date')]  = $registration_date;
                    array_push($export_array,$data);

               }
                
            }
            $data = $export_array;
            if(isset($data) && sizeof($data)>0)
            {
                $type = 'CSV';
                $report_name  = ' Student Certificate Report';
                return Excel::create($report_name, function($excel) use ($data,$report_name) {

                    // Set the title
                    $excel->setTitle($report_name);

                    // Chain the setters
                    $excel->setCreator(config('app.project.name'))
                          ->setCompany(config('app.project.name'));

                    // Call them separately
                    $excel->setDescription($report_name);

                    $excel->sheet($report_name, function($sheet) use ($data)
                    {
                        $sheet->fromArray($data);
                    });

                })->download($type);
            }
            else
            {
                Session::flash('error','No data found');
            }

        }
        else
        {
            Session::flash('error','No data found');
        }
        return redirect()->back();
       

    }
}
