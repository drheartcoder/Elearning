<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;
use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;

use App\Models\ClassroomsModel;
use App\Models\ClassroomsTranslationModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\ClassroomStudentModel;
use App\Models\UsersModel;
use App\Models\ShareClassModel;
use App\Models\ProgramModel;


use App\Common\Traits\MultiActionTrait;

use Validator;
use Session;
use flash;
use Excel;
use DB;
//use DataTables;

class ClassroomsController extends Controller
{
    use MultiActionTrait;
    public function __construct(
                                    EmailService               $email_service,
                                    LanguageService            $language_service,
                                    NotificationService        $notification_service,
                                    ClassroomsModel            $classroom_model,
                                    GradeModel                 $grade_model,
                                    SubjectModel               $subject_model,
                                    ProgramModel               $program,
                                    ClassroomsTranslationModel $classroom_translation_model
                                )
    {
        $this->auth                       = auth()->guard('admin');
        $this->arr_view_data              = [];
        $this->BaseModel                  = $classroom_model;
        $this->ClassroomsModel            = $classroom_model;
        $this->ClassroomsTranslationModel = $classroom_translation_model;
        $this->GradeModel                 = $grade_model;
        $this->SubjectModel               = $subject_model;
        $this->ClassroomStudentModel      = new ClassroomStudentModel();
        $this->UsersModel                 = new UsersModel();
        $this->ShareClassModel            = new ShareClassModel();
        $this->ProgramModel               = $program;

        $this->EmailService               = $email_service;
        $this->LanguageService            = $language_service;
        $this->NotificationService        = $notification_service;

        $this->module_title               = "Classrooms";
        $this->module_icon                = "fa fa-bank";
        $this->module_view_folder         = "admin.classrooms";
        $this->admin_url_path             = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug           = config('app.project.admin_panel_slug');
        $this->module_url_path            = url(config('app.project.admin_panel_slug')."/classrooms");

        DB::connection()->enableQueryLog();
    }

    public function index()
    {
        $this->arr_view_data['page_title']           = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;

        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function load_data(Request $request)
    {
        $SubjectData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        $end_date    = $request->input('end_date');
        
        if($request->input('order')[0]['column'] == 1)
        {
            $column = "class_enrollment_code";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "user_name";
        }
        if($request->input('order')[0]['column'] == 4)
        {
            $column = "subject_name";
        }
        if($request->input('order')[0]['column'] == 5)
        {
            $column = "grade_name";
        }
        if($request->input('order')[0]['column'] == 6) 
        {
            $column = "end_date";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data = $this->BaseModel->with(['user_data' => function($query){
                                        $query->select('id', 'user_type', 'first_name', 'last_name', 'email');
                                    }])
                                     ->with(['subject_data' => function($query){
                                        $query->select('id', 'name as subject_name', 'locale', 'subject_id');
                                    }])
                                     ->with(['grade_data' => function($query){
                                        $query->select('id', 'name as grade_name', 'locale', 'grade_id');
                                    },'class_student_data']);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {

                                $q->orWhere('class_enrollment_code', 'like','%'.$keyword.'%')
                                ->orWhereHas("subject_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("grade_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("user_data", function($query) use ($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                                });

                            });
        }
        if(isset($end_date) && $end_date != "")
        {
            $obj_data = $obj_data->whereDate('end_date', '=', date('Y-m-d', strtotime($end_date)) );
        }

        $count = count($obj_data->get());

        if(($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data   = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
        }
        if( $order !='' && $column!='' )
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
        }  

        if(($order =='ASC' || $order =='') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }
        if($order != '' && $column != '' )
        {
            if($column == 'name')
            {
                $obj_data = $obj_data->whereHas('classroom_translation', function ($query) use ($column,$order)
                {
                    $query->orderBy($column, $order);
                    if($_GET['length']!='-1')
                    {
                        $query->limit($_GET['length'])->offset($_GET['start']);
                    }    
                });
            }
            elseif($column == 'user_name')
            {
                $obj_data = $obj_data->whereHas('user_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('first_name', $order);
                    if($_GET['length']!='-1')
                    {
                        $query->limit($_GET['length'])->offset($_GET['start']);
                    }    
                });
            }
            elseif($column == 'subject_name')
            {
                $obj_data = $obj_data->whereHas('subject_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order);
                    if($_GET['length']!='-1')
                    {
                        $query->limit($_GET['length'])->offset($_GET['start']);
                    }    
                });
            }
            elseif($column == 'grade_name')
            {
                $obj_data = $obj_data->whereHas('grade_data', function ($query) use ($column,$order)
                {
                    $query->orderBy('name', $order);
                    if($_GET['length']!='-1')
                    {
                        $query->limit($_GET['length'])->offset($_GET['start']);
                    }    
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }
        //dd($obj_data->get()->toArray());

        $SubscriptionPlanData    = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($SubscriptionPlanData) > 0)
        {
            $i = 0;

            foreach($SubscriptionPlanData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';                    
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action    = '';

            
                $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $delete_href   =  $this->module_url_path.'/delete/'.base64_encode($row['id']);
                $view_href     =  $this->module_url_path.'/view/'.base64_encode($row['id']);
                $share_href    =  $this->module_url_path.'/share/'.base64_encode($row['id']);
                $transfer_href =  $this->module_url_path.'/transfer/'.base64_encode($row['id']);
                //$edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row['id']);

                $build_view_action .= '&nbsp;<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="fa fa-pencil" ></i></a>';

                $build_view_action  .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';

                if(isset($row->class_student_data) && sizeof($row->class_student_data)==0)
                {
                    $build_view_action .= '&nbsp;<a class="btn btn-link btn-info btn-just-icon like" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')" href="'.$delete_href.'" title="Delete"><i class="fa fa-trash"></i></a>';

                }
                /*$build_view_action   .= '&nbsp;<a class="btn btn-outline btn-info btn-circle show-tooltip" href="'.$edit_href.'" title="Edit"><i class="fa fa-pencil" ></i></a>';
               */

                $build_view_action   .= '<a href="javascript:void(0);" class="btn btn-link btn-info btn-just-icon like" data-toggle="dropdown">
                                            <i class="material-icons">chat</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="javascript:void(0);" class="btn btn-link btn-info like transfer_class" data-toggle="modal" data-target="#transfer_modal" data-class_id="'.base64_encode($row['id']).'" ><i class="material-icons">swap_horiz</i> Transfer</a></li>
                                            <li><a href="javascript:void(0);" class="btn btn-link btn-info like share_class" data-toggle="modal" data-target="#share_modal" data-class_id="'.base64_encode($row['id']).'" ><i class="material-icons">share</i> Share</a></li>
                                        </ul>';
                
                $first_name = isset($row['user_data']['first_name']) && $row['user_data']['first_name'] != '' ? ucfirst($row['user_data']['first_name']) : "";
                $last_name = isset($row['user_data']['last_name']) && $row['user_data']['last_name'] != '' ? ucfirst($row['user_data']['last_name']) : "";

                $final_array[$i][0]   = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                
                $final_array[$i][1]   = isset($row['class_enrollment_code']) && $row['class_enrollment_code'] != '' ? $row['class_enrollment_code'] : "NA";
                $final_array[$i][2]   = isset($row['name']) && $row['name'] != '' ? $row['name'] : "NA";
                $final_array[$i][3]   = $first_name .' '.$last_name;
                $final_array[$i][4]   = isset($row['subject_data']['subject_name']) && $row['subject_data']['subject_name'] != '' ? $row['subject_data']['subject_name'] : "NA";
                $final_array[$i][5]   = isset($row['grade_data']['grade_name']) && $row['grade_data']['grade_name'] != '' ? $row['grade_data']['grade_name'] : "NA";
                $final_array[$i][6]   = isset($row['end_date']) && $row['end_date'] != '' ? get_added_on_date($row['end_date']) : "NA";
                $final_array[$i][7]   = $build_active_btn;
                $final_array[$i][8]   = $build_view_action;
                
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    }
    public function edit($enc_id = null)
    {
        $arr_classrooms = $arr_program = $arr_grade = $arr_subject = [];
        $id = base64_decode($enc_id);
        $obj_classroom = $this->BaseModel->where('id',$id)->first();
        if (isset($obj_classroom) && count($obj_classroom)>0) 
        {
            $arr_classrooms = $obj_classroom->toArray();
        }

        $subject_obj = $this->SubjectModel->with('subject_traslation')->where('status','1')->get();
        if(count($subject_obj)>0)
        {
            $arr_subject = $subject_obj->toArray();
        } 
        //dd($arr_subject);
        $grade_obj = $this->GradeModel->with('grade_traslation')
                                      ->where('subject',$arr_classrooms['subject_id'])
                                      ->where('status','1')->get();
        if(count($grade_obj)>0)
        {
            $arr_grade = $grade_obj->toArray();
        }        

        $program_obj = $this->ProgramModel
                            ->where('subject',$arr_classrooms['subject_id'])
                            ->where('grade',$arr_classrooms['grade_id'])
                            ->where('status','1')->get();

        if(count($program_obj)>0)
        {
            $arr_program = $program_obj->toArray();
        }  

        $this->arr_view_data['arr_classrooms']       =  $arr_classrooms;
        $this->arr_view_data['subject_arr']          =  $arr_subject;
        $this->arr_view_data['arr_grade']            =  $arr_grade;
        $this->arr_view_data['arr_program']          =  $arr_program;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
        $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     = 'Edit '.$this->module_title;
        $this->arr_view_data['sub_module_icon']      = 'fa fa-pencil';
        $this->arr_view_data['module_url_path']      = $this->module_url_path;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }
    public function getGrade(Request $request)
    {
        $resp['status'] = 'fail';
        $strHTML = ''; 
        if($request->input('subject'))
        {
            $arrGrade = [];
            $arrGrade = $this->GradeModel->where('subject', '=', $request->input('subject'))
                                         ->with([
                                            'gradeTraslationData'=>function($gradeTraslationDataQuery){ $gradeTraslationDataQuery->select('id', 'grade_id', 'name')->where('locale', '=', 'en')->orderBy('name', 'ASC');  }
                                         ])
                                         ->where('status', '=', '1')
                                         ->get();
            if(count($arrGrade) > 0)
            {
                $arrGrade = $arrGrade->toArray();
            }
            if(count($arrGrade) > 0)
            {
                $strHTML.='<option value="">Select Grade</option>';
                foreach ($arrGrade as $arrGradeVal) {
                    if(isset($arrGradeVal['id']) && $arrGradeVal['id']!='')
                    {
                        $gradeName = '';
                        if(isset($arrGradeVal['grade_traslation_data']))
                        {
                            if(count($arrGradeVal['grade_traslation_data']) > 0)
                            {
                                if(isset($arrGradeVal['grade_traslation_data'][0]['name']))
                                {
                                  $gradeName = $arrGradeVal['grade_traslation_data'][0]['name'];
                                }
                            }
                        }

                        $strHTML.='<option value="'.$arrGradeVal['id'].'">'.$gradeName.'</option>';
                    }
                }
                $resp['status']  = 'success';
                $resp['strHTML'] = $strHTML;
            }
        }
        return json_encode($resp);
    }
    public function getProgram(Request $request)
    {
        $html        = '';
        $arr_program = [];
        $subject_id = $request->input('subject');
        $grade_id = $request->input('grade');

        $obj_program = ProgramModel::where('subject', $subject_id)->where('grade', $grade_id)->where('status', '1')->where('approve_status', 'approved')->get();
        if(isset($obj_program) && count($obj_program)>0)
        {
            $arr_program = $obj_program->toArray();

            $html .= '<option value="">Select Program</option>';
            foreach ($arr_program as $key => $program)
            {
                $html .= '<option value="'.$program['id'].'">'.$program['name'].'</option>';
            }
        }
        else
        {
            $html = '<option value="">No Program Available</option>';
        }

        $resp['status']  = 'success';
        $resp['strHTML'] = $html;
        return json_encode($resp);
    }
    public function update(Request $request)
    {
        $arr_user = $form_data = $arr_rules = array();

        $arr_rules['class_name'] = "required";
        $arr_rules['subject']    = "required";
        $arr_rules['grade']      = "required";
        $arr_rules['end_date']   = "required";

        $validator = Validator::make($request->all() , $arr_rules);
        if ($validator->fails())
        {
            Session::flash('error', 'All fields are required.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user_type              = 'teacher';
        $form_data              = $request->all();

        $arr_user['name']       = isset($form_data['class_name']) ? ucfirst($form_data['class_name']) : '';
        $arr_user['subject_id'] = isset($form_data['subject']) ? $form_data['subject'] : '';
        $arr_user['grade_id']   = isset($form_data['grade']) ? $form_data['grade'] : '';
        $arr_user['end_date']   = isset($form_data['end_date']) ? date('Y-m-d', strtotime($form_data['end_date'])) : null;
        $arr_user['program_id'] = isset($form_data['program']) ? $form_data['program'] : null;

        $is_updated = $this->ClassroomsModel->where('id', $form_data['class_id'])->update($arr_user);
        if ($is_updated) 
        {
             // Store notification for teacher
            $arr_noti['message']      = 'Admin has successfully updated your"'.ucfirst($form_data['class_name']).'" class';
            $arr_noti['from_user_id'] = 1;
            $arr_noti['to_user_id']   = $form_data['teacher_id'];
            $arr_noti['url']          = $user_type."/dashboard";
            $arr_noti['is_read']      = "0";
            $status                   = $this->NotificationService->send_notification($arr_noti);

            Session::flash('success','Class updated successfully');
            return redirect()->back();
        }
        else
        {
            Session::flash('error', 'Error occured while class updation');
            return redirect()->back();
        }
    }
    public function view($enc_id = null)
    {
       if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_classroom = [];
            $obj_classroom = $this->BaseModel->where('id',$id)
                                             ->with('user_data','grade_details','grade_details.grade_traslation','subject_details','subject_details.subject_traslation','transfer_user_details')
                                             ->first();
            if($obj_classroom)
            {
                $arr_classroom = $obj_classroom->toArray();
            }
            //dd($arr_classroom);

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']             = $arr_lang;
            $this->arr_view_data['id']                   = base64_encode($id);
            $this->arr_view_data['arr_classroom']        = $arr_classroom;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           = $this->module_url_path;
            $this->arr_view_data['sub_module_title']     = 'View '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      = 'fa fa-eye';
            $this->arr_view_data['module_url_path']      = $this->module_url_path;

            $this->arr_view_data['student_module_path']  = $this->module_url_path.'/view/'.$enc_id;
            $this->arr_view_data['student_module_title'] = 'Manage Students';
            $this->arr_view_data['student_module_icon']  = 'fa fa-users';

            return view($this->module_view_folder.'.view',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/manage');
        }
    }

    /*
    | Function  : Delete record.
    | Author    : Deepak Salunke
    | Date      : 20 June, 2018
    */

    public function delete($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' Deleted Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title.' Deletion ');
        }

        return redirect()->back();
    }

    /*
    | Function  : Delete record.
    | Author    : Deepak Salunke
    | Date      : 20 June, 2018
    */
    
    public function perform_delete($id)
    {
        $is_translation_available = '';

        $delete = $this->BaseModel->where('id',$id)->delete();
        if($delete)
        {
            $is_translation_available = $this->ClassroomsTranslationModel->where('classroom_id',$id);

            if($is_translation_available)
            {
                $is_translation_available->delete();
            }

            return TRUE;
        }

        return FALSE;
    }



    public function LoadStudents(Request $request)
    {
        
        $StudentListData = $final_array = [];

        $enc_class_id    = $request->input('enc_class_id');
        $class_id        = base64_decode($enc_class_id);

        $enc_teacher_id  = $request->input('enc_teacher_id');
        $teacher_id      = base64_decode($enc_teacher_id);

        $column          = '';
        $keyword         = $request->input('keyword');
        $join_date       = $request->input('join_date');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "first_name";
        }
        if($request->input('order')[0]['column'] == 2)
        {
            $column = "last_name";
        }
        if($request->input('order')[0]['column'] == 3)
        {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                ->where('teacher_id', $teacher_id)
                                                ->with(['student_data' => function($query){
                                                    $query->select('id', 'first_name', 'last_name', 'pin');
                                                }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->whereHas('student_data', function($query) use($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' OR pin LIKE '%".$keyword."%' )");
                                });
        }
        if(isset($join_date) && $join_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date("c", strtotime($join_date)));
        }

        $count = count($obj_data->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            if($column == 'first_name' || $column == 'last_name')
            {
                $obj_data = $obj_data->whereHas('student_data', function($query) use($column, $order) {
                                       $query->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
                                    });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column, $order)->limit($_GET['length'])->offset($_GET['start']);
            }
        }

        $StudentListData         = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($StudentListData) > 0)
        {
            $i = 0;

            foreach($StudentListData as $row)
            {
                $build_view_action = $build_active_btn = '';

                if($row->is_active != null && $row->is_active == "block")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/students/activate/'.$enc_class_id.'/'.base64_encode($row->student_id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row->is_active != null && $row->is_active == "active")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/students/deactivate/'.$enc_class_id.'/'.base64_encode($row->student_id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $view_href          = $this->admin_url_path.'/users/student/view/'.base64_encode($row->student_id);

                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View"><i class="material-icons" >visibility </i></a>';

                $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->student_id).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';

                $final_array[$i][1] = isset($row->student_data->pin) && $row->student_data->pin != '' ? $row->student_data->pin : "NA";
                $final_array[$i][2] = isset($row->student_data->first_name) && $row->student_data->first_name != '' ? ucfirst($row->student_data->first_name) : "NA";
                $final_array[$i][3] = isset($row->student_data->last_name) && $row->student_data->last_name != '' ? ucfirst($row->student_data->last_name) : "NA";
                $final_array[$i][4] = isset($row->created_at) && $row->created_at != '' ? get_added_on_date_time($row->created_at) : "NA";
                $final_array[$i][5] = $build_active_btn;
                $final_array[$i][6] = $build_view_action;
              
                $i++;
            }
        }

        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit; 

    } // end LoadStudents



    public function StudentsMultiAction(Request $request)
    {
        $arr_rules                   = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";
        $arr_rules['enc_class_id']   = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails()) {
            Session::flash('Please Select Students To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');
        $enc_class_id   = $request->input('enc_class_id');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0) {
            Session::flash('error', 'Problem Occurred, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action == "activate") {
               $resActive = $this->StudentPerformActivate( base64_decode($enc_class_id), base64_decode($record_id) ); 
               Session::flash('success', 'Students Deactivated Successfully');
            }
            elseif($multi_action == "deactivate") {
               $resDeactive = $this->StudentPerformDeactivate( base64_decode($enc_class_id), base64_decode($record_id));   
               Session::flash('success', 'Students Activated Successfully');
            }
        }      
        return redirect()->back();

    } // end StudentsMultiAction


    public function StudentActivate($enc_class_id = FALSE, $enc_id = FALSE)
    {
        if(!$enc_id && !$enc_class_id) {
            return redirect()->back();
        }

        if( $this->StudentPerformActivate( base64_decode( $enc_class_id ), base64_decode( $enc_id ) ) ) {
            Session::flash('success', 'Student Activated Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Problem Occured While Student Activation ');
        }

        return redirect()->back();
    }

    public function StudentDeactivate($enc_class_id = FALSE, $enc_id = FALSE)
    {
        if(!$enc_id && !$enc_class_id) {
            return redirect()->back();
        }

        if( $this->StudentPerformDeactivate( base64_decode( $enc_class_id ), base64_decode( $enc_id ) ) ) {
            Session::flash('success', 'Student Deactivated Successfully');
        } else {
            Session::flash('error', 'Problem Occured While Student Deactivation ');
        }

        return redirect()->back();
    }

    public function StudentPerformActivate($class_id, $stud_id)
    {
        $responce = $this->ClassroomStudentModel->where('classroom_id',$class_id)->where('student_id',$stud_id)->first();

        if($responce) {
            return $responce->update(['is_active'=>'active']);
        }

        return FALSE;
    }

    public function StudentPerformDeactivate($class_id, $stud_id)
    {
        $responce = $this->ClassroomStudentModel->where('classroom_id',$class_id)->where('student_id',$stud_id)->first();

        if($responce) {
            return $responce->update(['is_active'=>'block']);
        }

        return FALSE;
    }


    public function TransferClass(Request $request)
    {
        $arr_rules['transfer_email'] = 'required|email';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {            
            Session::flash('error', 'Email is required.');
            return redirect()->back();
        }

        $form_data = $request->all();
        $class_id  = isset($form_data['enc_class_id']) && !empty($form_data['enc_class_id']) ? base64_decode($form_data['enc_class_id']) : '';
        $email     = isset($form_data['transfer_email']) && !empty($form_data['transfer_email']) ? $form_data['transfer_email'] : '';

        $class_data = $this->ClassroomsModel->where('id', $class_id)
                                            ->with('user_data')
                                            ->first();

        $check_email_exist = $this->UsersModel->where('email',$email)
                                              ->where('user_type','teacher')
                                              ->first();

        if(isset($check_email_exist) && count($check_email_exist)>0)
        {
            if($check_email_exist['id'] != $class_data['teacher_id'])
            {   
                if($class_data['transfer_id'] != null)
                {
                    Session::flash('error',"You have already transfer this class.");
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
                    

                    $obj_transfer_info = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                                     ->where('teacher_id', $class_data['teacher_id'])
                                                                     ->get();
                    if($obj_transfer_info)
                    {
                        $transfer_info = $obj_transfer_info->toArray(); 

                        foreach ($transfer_info as $key => $value) 
                        {
                            $insert_arr['classroom_id'] = $value['classroom_id'];
                            $insert_arr['student_id']   = $value['student_id'];
                            $insert_arr['teacher_id']   = $check_email_exist['id'];

                            $this->ClassroomStudentModel->create($insert_arr);
                        }

                        // from admin to old teacher
                        $arr_noti['message']      = 'Admin has transfered your '.ucfirst($class_data['name']).' class successfully.';
                        $arr_noti['from_user_id'] = $this->auth->user()->id;
                        $arr_noti['to_user_id']   = $check_email_exist['id'];
                        $arr_noti['url']          = '/teacher/dashboard';
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        // from old teacher to new teacher
                        $arr_noti['message']      = $class_data['user_data']['first_name'].' '.$class_data['user_data']['last_name'].' has transfered '.ucfirst($class_data['name']).' class successfully.';
                        $arr_noti['from_user_id'] = $class_data['teacher_id'];
                        $arr_noti['to_user_id']   = $check_email_exist['id'];
                        $arr_noti['url']          = '/teacher/dashboard';
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        Session::flash('success',"Class transfered successfully.");
                        return redirect()->back();
                    }
                 }   
            }
            else
            {
                Session::flash('error',"Can't transfer class with same owner and transfer teacher.");
                return redirect()->back();
            }
            
        }
        else
        {   
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

            Session::flash('success',"Invitation mail sent.");
            return redirect()->back();                        
        }

    } // end TransferClass



    public function ShareClass(Request $request)
    {
        $arr_rules = []; $share_info = []; $share_class_info = []; $links = '';

        $arr_rules['share_email'] = 'required|email';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('error', 'Email is required.');
            return redirect()->back();
        }

        $form_data = $request->all();
        $class_id  = isset($form_data['enc_class_id']) && !empty($form_data['enc_class_id']) ? base64_decode($form_data['enc_class_id']) : '';
        $email     = isset($form_data['share_email']) && !empty($form_data['share_email']) ? $form_data['share_email'] : '';

        $class_data = $this->ClassroomsModel->where('id',$class_id)
                                            ->with('user_data')
                                            ->first();

        $check_email_exist = $this->UsersModel->where('email', $email)
                                              ->where('user_type', 'teacher')
                                              ->first();

        if(isset($check_email_exist) && count($check_email_exist) > 0)
        {
            if($check_email_exist['id'] != $class_data['teacher_id'])
            {
                $check_already_share = $this->ShareClassModel->where('to_teacher',$email)
                                                             ->where('from_teacher_id', $class_data['teacher_id'])
                                                             ->where('classroom_id',$class_id)
                                                             ->first();
                
                if(isset($check_already_share) && count($check_already_share)>0)
                {
                    Session::flash('error',"You have already share this class.");
                    return redirect()->back();
                }
                else    
                {
                    $this->ShareClassModel->create([
                                                        'to_teacher'      => $email,
                                                        'from_teacher_id' => $class_data['teacher_id'],
                                                        'classroom_id'    => $class_id,
                                                        'to_teacher_id'   => $check_email_exist['id']
                                                    ]);

                    $obj_share_info = $this->ClassroomStudentModel->where('classroom_id', $class_id)
                                                                  ->where('teacher_id', $class_data['teacher_id'])
                                                                  ->get();

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

                        // from admin to old teacher
                        $arr_noti['message']      = 'Admin has shared your '.ucfirst($class_data['name']).' class successfully.';
                        $arr_noti['from_user_id'] = $this->auth->user()->id;
                        $arr_noti['to_user_id']   = $class_data['teacher_id'];
                        $arr_noti['url']          = "/teacher/dashboard";
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        // from old teacher to new teacher
                        $arr_noti['message']      = $class_data['user_data']['first_name'].' '.$class_data['user_data']['last_name'].' has shared '.ucfirst($class_data['name']).' class successfully.';
                        $arr_noti['from_user_id'] = $class_data['teacher_id'];
                        $arr_noti['to_user_id']   = $check_email_exist['id'];
                        $arr_noti['url']          = "/teacher/dashboard";
                        $arr_noti['is_read']      = "0";
                        $status                   = $this->NotificationService->send_notification($arr_noti);

                        Session::flash('success',"Class shared successfully.");
                        return redirect()->back();
                    }
                 }   
            }
            else
            {
                Session::flash('error',"Can't share class with same owner and share teacher.");
                return redirect()->back();
            }
        }
        else
        {
            $check_already_share = $this->ShareClassModel->where('to_teacher', $email)
                                                         ->where('from_teacher_id', $this->auth->user()->id)
                                                         ->where('classroom_id',$class_id)
                                                         ->first();
                
            if(isset($check_already_share) && count($check_already_share) > 0)
            {
                Session::flash('error',"You have already share this class.");
                return redirect()->back();
            }
            else    
            {
                $this->ShareClassModel->create([
                                                    'to_teacher'      => $email,
                                                    'from_teacher_id' => $this->auth->user()->id,
                                                    'classroom_id'    => $class_id
                                                ]);

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

                Session::flash('success',"Invitation mail sent.");
                return redirect()->back();
            }    
        }

    } // end ShareClass


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_users = [];

        $form_data    = $request->all();
        $keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $search_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        $obj_data = $this->BaseModel->with(['user_data' => function($query){
                                        $query->select('id', 'user_type', 'first_name', 'last_name', 'email');
                                    }])
                                    ->with(['transfer_user_details' => function($query){
                                        $query->select('id', 'user_type', 'first_name', 'last_name', 'email');
                                    }])
                                    ->with(['subject_data' => function($query){
                                        $query->select('id', 'name as subject_name', 'locale', 'subject_id');
                                    }])
                                    ->with(['grade_data' => function($query){
                                        $query->select('id', 'name as grade_name', 'locale', 'grade_id');
                                    }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {

                                $q->orWhere('class_enrollment_code', 'like','%'.$keyword.'%')
                                ->orWhereHas("subject_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("grade_data", function($query) use ($keyword){
                                    $query->where('name', 'like','%'.$keyword.'%');
                                })
                                ->orWhereHas("user_data", function($query) use ($keyword){
                                    $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                                });

                            });
        }
        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('end_date', '=', date('Y-m-d', strtotime($search_date)) );
        }

        $obj_data = $obj_data->get();

        if($obj_data)
        {
            $arr_value = $obj_data->toArray();
            /*dd($arr_value);*/

            // build data array to export
            foreach ($arr_value as $key => $value) 
            {
                $first_name = isset($value['user_data']['first_name']) ? ucfirst($value['user_data']['first_name']) : '';
                $last_name  = isset($value['user_data']['last_name']) ? ucfirst($value['user_data']['last_name']) : '';

                $data['Sr. No.']         = ( $key + 1 );
                $data['Enrollment Code'] = isset($value['class_enrollment_code']) ? $value['class_enrollment_code'] : '';
                $data['Class Name']      = isset($value['name']) ? $value['name'] : '';
                $data['Class Owner']     = $first_name.' '.$last_name;
                $data['Email']           = isset($value['user_data']['email']) ? $value['user_data']['email'] : '';
                $data['Subject']         = isset($value['subject_data']['subject_name']) ? ucfirst($value['subject_data']['subject_name']) : '';
                $data['Grade']           = isset($value['grade_data']['grade_name']) ? ucfirst($value['grade_data']['grade_name']) : '';
                $data['End Date']        = isset($value['end_date']) ? get_added_on_date($value['end_date']) : 'NA';
                $data['Transfer']        = isset($value['is_transfer']) ? ucfirst($value['is_transfer']) : '';

                if($data['Transfer'] == 'Yes') {
                    $transfer_first_name = isset($value['transfer_user_details']['first_name']) ? ucfirst($value['transfer_user_details']['first_name']) : '';
                    $transfer_last_name  = isset($value['transfer_user_details']['last_name']) ? ucfirst($value['transfer_user_details']['last_name']) : '';
                    $transfer_email      = isset($value['transfer_user_details']['email']) ? $value['transfer_user_details']['email'] : '';
                }
                else {
                    $transfer_first_name = 'NA';
                    $transfer_last_name  = '';
                    $transfer_email      = 'NA';
                }
                $data['Transfer User Name']  = $transfer_first_name.' '.$transfer_last_name;
                $data['Transfer User Email'] = $transfer_email;

                array_push($export_array, $data);
            }
        }

        $data = $export_array;
        //$type = 'XLSX';
        $type = 'CSV';

        return Excel::create('Classrooms Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Classrooms Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Classrooms Report');

            $excel->sheet('Classrooms Report', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

    }
    public function delete_classroom($enc_class_id)
    {
        $class_id = $status= '';
        if(isset($enc_class_id) &&$enc_class_id!="")
        {
            $class_id = base64_decode($enc_class_id);
            $status   = $this->ClassroomsModel->where('id','=',$class_id)->delete();
        }
        if($status)
        {
            Session::flash('success','Classroom deleted successfully.');
        }
        else
        {
             Session::flash('error','Error occure wwhile delete a record');
        }
        return redirect()->back();
    }
}
