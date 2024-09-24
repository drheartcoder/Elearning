<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\LanguageService;
use App\Common\Services\NotificationService;
use App\Common\Services\ProgramService;

use App\Models\UsersModel;
use App\Models\ProgramModel;
use App\Models\ProgramQuestionModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\TemplateModel;
use App\Models\LessonModel;
use App\Models\ProgramReasonModel;
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
use App\Models\TemplatePreview1Model;
use App\Models\TemplatePreview2Model;
use App\Models\TemplatePreview3Model;
use App\Models\TemplatePreview4Model;
use App\Models\TemplatePreview5Model;
use App\Models\TemplatePreview6Model;
use App\Models\TemplatePreview7Model;
use App\Models\TemplatePreview8Model;
use App\Models\TemplatePreview9Model;
use App\Models\TemplatePreview10Model;
use App\Models\TemplatePreview11Model;
use App\Models\TemplatePreview12Model;
use App\Models\TemplatePreview13Model;
use App\Models\TemplatePreview14Model;
use App\Models\TemplatePreview15Model;
use App\Models\TemplatePreview16Model;
use App\Models\TemplatePreview17Model;
use App\Models\TemplatePreview18Model;
use App\Models\TemplatePreview19Model;
use App\Models\TemplatePreview20Model;
use App\Models\TemplatePreview21Model;
use App\Models\TemplatePreview22Model;
use App\Models\TemplatePreview23Model;
use App\Models\TemplatePreview24Model;
use App\Models\TemplatePreview25Model;
use App\Models\TemplatePreview26Model;
use App\Models\TemplatePreview27Model;
use App\Models\TemplatePreview28Model;
use App\Models\TemplatePreview29Model;
use App\Models\TemplatePreview30Model;
use App\Models\TemplatePreview31Model;
use App\Models\TemplatePreview32Model;
use App\Models\TemplatePreview33Model;
use App\Models\TemplatePreview34Model;
use App\Models\TemplatePreview35Model;
use App\Models\TemplatePreview36Model;
use App\Models\TemplatePreview37Model;
use App\Models\TemplatePreview38Model;
use App\Models\TemplatePreview39Model;
use App\Models\TemplatePreview40Model;
use App\Models\TemplatePreview41Model;
use App\Models\TemplatePreview42Model;
use App\Models\TemplatePreview43Model;
use App\Models\TemplatePreview44Model;
use App\Models\TemplatePreview45Model;
use App\Models\TemplatePreview46Model;
use App\Models\TemplatePreview47Model;
use App\Models\TemplatePreview48Model;
use App\Models\TemplatePreview49Model;
use App\Models\TemplatePreview50Model;


use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
use paginate;
use Image;
use auth;

class ProgramController extends Controller
{
    use MultiActionTrait;
	public function __construct(NotificationService $notification_service)
	{
        $this->arr_view_data              = [];
        $this->module_title               = "Program";
        $this->module_icon                = "fa fa-tasks";
        $this->module_view_folder         = "supervisor.program";
        $this->program_view_folder        = "backend_program";
        $this->supervisor_url_path        = url(config('app.project.supervisor_panel_slug'));
        $this->supervisor_panel_slug      = config('app.project.supervisor_panel_slug');
        $this->module_url_path            = url(config('app.project.supervisor_panel_slug')."/program");

        $this->creator_module_url_path    = url(config('app.project.creator_panel_slug')."/program");

        $this->LanguageService            = new LanguageService();

        $this->template_js_path           = url('/').'/js/admin/template/';

        $this->NotificationService        = $notification_service;
        $this->ProgramService             = new ProgramService();
        $this->auth                       = auth()->guard('supervisor');
        
        $this->UsersModel                 = new UsersModel();
        $this->BaseModel                  = new ProgramModel();
        $this->ProgramModel               = new ProgramModel();
        $this->ProgramQuestionModel       = new ProgramQuestionModel();
        $this->SubjectModel               = new SubjectModel();
        $this->SubjectTranslationModel    = new SubjectTranslationModel();
        $this->GradeModel                 = new GradeModel();
        $this->GradeTranslationModel      = new GradeTranslationModel();
        $this->TemplateModel              = new TemplateModel();
        $this->LessonModel                = new LessonModel();
        $this->ProgramReasonModel         = new ProgramReasonModel();
        $this->Template1Model             = new Template1Model();
        $this->Template2Model             = new Template2Model();
        $this->Template3Model             = new Template3Model();
        $this->Template4Model             = new Template4Model();
        $this->Template5Model             = new Template5Model();
        $this->Template6Model             = new Template6Model();
        $this->Template7Model             = new Template7Model();
        $this->Template8Model             = new Template8Model();
        $this->Template9Model             = new Template9Model();
        $this->Template10Model            = new Template10Model();
        $this->Template11Model            = new Template11Model();
        $this->Template12Model            = new Template12Model();
        $this->Template13Model            = new Template13Model();
        $this->Template14Model            = new Template14Model();
        $this->Template15Model            = new Template15Model();
        $this->Template16Model            = new Template16Model();
        $this->Template17Model            = new Template17Model();
        $this->Template18Model            = new Template18Model();
        $this->Template19Model            = new Template19Model();
        $this->Template20Model            = new Template20Model();
        $this->Template21Model            = new Template21Model();
        $this->Template22Model            = new Template22Model();
        $this->Template23Model            = new Template23Model();
        $this->Template24Model            = new Template24Model();
        $this->Template25Model            = new Template25Model();
        $this->Template26Model            = new Template26Model();
        $this->Template27Model            = new Template27Model();
        $this->Template28Model            = new Template28Model();
        $this->Template29Model            = new Template29Model();
        $this->Template30Model            = new Template30Model();
        $this->Template31Model            = new Template31Model();
        $this->Template32Model            = new Template32Model();
        $this->Template33Model            = new Template33Model();
        $this->Template34Model            = new Template34Model();
        $this->Template35Model            = new Template35Model();
        $this->Template36Model            = new Template36Model();
        $this->Template37Model            = new Template37Model();
        $this->Template38Model            = new Template38Model();
        $this->Template39Model            = new Template39Model();
        $this->Template40Model            = new Template40Model();
        $this->Template41Model            = new Template41Model();
        $this->Template42Model            = new Template42Model();
        $this->Template43Model            = new Template43Model();
        $this->Template44Model            = new Template44Model();
        $this->Template45Model            = new Template45Model();
        $this->Template46Model            = new Template46Model();
        $this->Template47Model            = new Template47Model();
        $this->Template48Model            = new Template48Model();
        $this->Template49Model            = new Template49Model();
        $this->Template50Model            = new Template50Model();

        $this->TemplatePreview1Model      = new TemplatePreview1Model();
        $this->TemplatePreview2Model      = new TemplatePreview2Model();
        $this->TemplatePreview3Model      = new TemplatePreview3Model();
        $this->TemplatePreview4Model      = new TemplatePreview4Model();
        $this->TemplatePreview5Model      = new TemplatePreview5Model();
        $this->TemplatePreview6Model      = new TemplatePreview6Model();
        $this->TemplatePreview7Model      = new TemplatePreview7Model();
        $this->TemplatePreview8Model      = new TemplatePreview8Model();
        $this->TemplatePreview9Model      = new TemplatePreview9Model();
        $this->TemplatePreview10Model     = new TemplatePreview10Model();
        $this->TemplatePreview11Model     = new TemplatePreview11Model();
        $this->TemplatePreview12Model     = new TemplatePreview12Model();
        $this->TemplatePreview13Model     = new TemplatePreview13Model();
        $this->TemplatePreview14Model     = new TemplatePreview14Model();
        $this->TemplatePreview15Model     = new TemplatePreview15Model();
        $this->TemplatePreview16Model     = new TemplatePreview16Model();
        $this->TemplatePreview17Model     = new TemplatePreview17Model();
        $this->TemplatePreview18Model     = new TemplatePreview18Model();
        $this->TemplatePreview19Model     = new TemplatePreview19Model();
        $this->TemplatePreview20Model     = new TemplatePreview20Model();
        $this->TemplatePreview21Model     = new TemplatePreview21Model();
        $this->TemplatePreview22Model     = new TemplatePreview22Model();
        $this->TemplatePreview23Model     = new TemplatePreview23Model();
        $this->TemplatePreview24Model     = new TemplatePreview24Model();
        $this->TemplatePreview25Model     = new TemplatePreview25Model();
        $this->TemplatePreview26Model     = new TemplatePreview26Model();
        $this->TemplatePreview27Model     = new TemplatePreview27Model();
        $this->TemplatePreview28Model     = new TemplatePreview28Model();
        $this->TemplatePreview29Model     = new TemplatePreview29Model();
        $this->TemplatePreview30Model     = new TemplatePreview30Model();
        $this->TemplatePreview31Model     = new TemplatePreview31Model();
        $this->TemplatePreview32Model     = new TemplatePreview32Model();
        $this->TemplatePreview33Model     = new TemplatePreview33Model();
        $this->TemplatePreview34Model     = new TemplatePreview34Model();
        $this->TemplatePreview35Model     = new TemplatePreview35Model();
        $this->TemplatePreview36Model     = new TemplatePreview36Model();
        $this->TemplatePreview37Model     = new TemplatePreview37Model();
        $this->TemplatePreview38Model     = new TemplatePreview38Model();
        $this->TemplatePreview39Model     = new TemplatePreview39Model();
        $this->TemplatePreview40Model     = new TemplatePreview40Model();
        $this->TemplatePreview41Model     = new TemplatePreview41Model();
        $this->TemplatePreview42Model     = new TemplatePreview42Model();
        $this->TemplatePreview43Model     = new TemplatePreview43Model();
        $this->TemplatePreview44Model     = new TemplatePreview44Model();
        $this->TemplatePreview45Model     = new TemplatePreview45Model();
        $this->TemplatePreview46Model     = new TemplatePreview46Model();
        $this->TemplatePreview47Model     = new TemplatePreview47Model();
        $this->TemplatePreview48Model     = new TemplatePreview48Model();
        $this->TemplatePreview49Model     = new TemplatePreview49Model();
        $this->TemplatePreview50Model     = new TemplatePreview50Model();
         
        $this->template_base_img_path     = base_path().config('app.project.img_path.template_image');
        $this->template_public_img_path   = url('/').config('app.project.img_path.template_image');
        $this->default_base_img_path      = base_path().config('app.project.img_path.default_image');
        $this->default_public_img_path    = url('/').config('app.project.img_path.default_image');
     
        $this->question_image_base_path   = base_path().config('app.project.img_path.question_image');
        $this->question_image_public_path = url('/').config('app.project.img_path.question_image');

        $this->question_image_thumb_base_path   = base_path().config('app.project.img_path.question_image_thumb');
        $this->question_image_thumb_public_path = url('/').config('app.project.img_path.question_image_thumb');
     
        $this->question_video_base_path   = base_path().config('app.project.img_path.question_video');
        $this->question_video_public_path = url('/').config('app.project.img_path.question_video');
        $this->question_audio_base_path   = base_path().config('app.project.img_path.question_audio');
        $this->question_audio_public_path = url('/').config('app.project.img_path.question_audio');
	}

    public function index()
    {
        $this->arr_view_data['page_title']           = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['supervisor_panel_slug']= $this->supervisor_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function load_data(Request $request)
    {
        /*$userId = login_user_id('creator');*/
        $SubjectData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        
        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 4) 
        {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');
        
        $arr_programers_details = $arr_programers = [];
        $str_programers = "";
        $arr_programers_details = $this->UsersModel->where('reporting_to',$this->auth->id())->get();
        if(count($arr_programers_details)>0){
            $arr_programers_details = $arr_programers_details->toArray();
            foreach ($arr_programers_details as $key => $val) {
                 array_push($arr_programers, $val['id']);
            }
        }
        $obj_data          = $this->BaseModel->select('id','user_id','name','slug','subject','grade','status','approve_status','is_holiday_program','created_at')
                                             ->with([
                                                'subjectData'=>function($subjectDataQuery){ 
                                                    $subjectDataQuery->select('id')
                                                                ->with([
                                                                    'subjectTranslationData'=>function($subjectTranslationDataQuery){ $subjectTranslationDataQuery->select('id','subject_id','name')->where('locale', '=', 'en'); }
                                                                    ])
                                                                 ->where('status', '=', '1');
                                                },
                                                'gradeData'=>function($gradeDataQuery){
                                                    $gradeDataQuery->select('id')
                                                                   ->with([
                                                                    'gradeTraslationData'=>function($gradeTraslationDataQuery){ $gradeTraslationDataQuery->select('id', 'grade_id', 'name')->where('locale', '=', 'en');  }
                                                                    ])
                                                                   ->where('status', '=', '1');
                                                }
                                                ])
                                             ->whereIn('user_id',$arr_programers)
                                             /*->where('status', '=', 1)*/
                                             ->orderBy('id', 'DESC');  
        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where('name', 'like', '%'.$keyword.'%');                                
        }

        $count        = count($obj_data->get());
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        
        if (($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        
        if($order != '' && $column != '' )
        {
           $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        
        $ProgramData             = $obj_data->get();
        //dd($ProgramData);
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($ProgramData) > 0)
        {
            //dump($ProgramData->toArray());
            $i = 0;
            foreach($ProgramData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                 $build_holiday_btn = '';
                  /*Changes Done by Kavita*/
                if($row['is_holiday_program'] != null && $row['is_holiday_program'] == "no")
                {   
                    $build_holiday_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Add Challenge Homework" href="'.$this->module_url_path.'/AddHolidayProgram/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to add this record in challenge program ?\')" ><i class="fa fa-times"></i></a>';
                }
                elseif($row['is_holiday_program'] != null && $row['is_holiday_program'] == "yes")
                {
                   $build_holiday_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Remove Challenge Homework" href="'.$this->module_url_path.'/RemoveHolidayProgram/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to  remove this record from challenge program ?\')" ><i class="fa fa-check"></i></a>';      
                }                

                $build_view_action = '';
                $edit_href         = $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $view_href         = $this->module_url_path.'/view/'.base64_encode($row['id']);
                $delete_href       = $this->module_url_path.'/delete/'.base64_encode($row['id']);

                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';
                /*$build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';*/
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

                $approveUrl = $rejectUrl = 'javascript:void(0);';
                $approveUrl = $this->module_url_path.'/approveProgramStatus/'.base64_encode($row['id']);
                $rejectUrl  = $this->module_url_path.'/rejectProgramStatus/'.base64_encode($row['id']);
                $build_approve_action_btn = '';
                if(isset($row['approve_status']) && $row['approve_status']!='')
                {
                    if($row['approve_status']=='pending')
                    {
                        //Pending
                        $build_approve_action_btn.='<a href="'.$approveUrl.'" class="btn btn-success" onclick="return confirm_action(this,event,\'Do you really want to approve this record ?\')" >Approve ?</a>';
                        $build_approve_action_btn.='<a href="javascript:void(0);" data-programId="'.base64_encode($row['id']).'" data-url="'.$rejectUrl.'" class="btn btn-danger rejectProgram" >Reject ?</a>';
                    }
                    else if($row['approve_status']=='approved')
                    {
                        //Approved
                        $build_approve_action_btn = '<a style="color: #fff" class="btn btn-success">Approved</a>';
                    }
                    else if($row['approve_status']=='disapproved')
                    {
                        //Disapproved
                        $build_approve_action_btn = '<a style="color: #fff" class="btn btn-danger">Disapproved</a>';
                    }
                }

                $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                $subject = $grade = '';
                if(isset($row['subjectData']))
                {
                    if(count($row['subjectData']) > 0)
                    {
                        if(isset($row['subjectData']['subjectTranslationData']))
                        {
                            if(count($row['subjectData']['subjectTranslationData']) > 0)
                            {
                                if(isset($row['subjectData']['subjectTranslationData'][0]['name']))
                                {
                                    $subject = $row['subjectData']['subjectTranslationData'][0]['name'];
                                }
                            }
                        }
                    }
                }
                if(isset($row['gradeData']))
                {
                    if(count($row['gradeData']) > 0)
                    {
                        if(isset($row['gradeData']['gradeTraslationData']))
                        {
                            if(count($row['gradeData']['gradeTraslationData']) > 0)
                            {
                                if(isset($row['gradeData']['gradeTraslationData'][0]['name']))
                                {
                                    $grade = $row['gradeData']['gradeTraslationData'][0]['name'];
                                }
                            }
                        }
                    }
                }

                

                $final_array[$i][1] = isset($row['name']) && $row['name'] != '' ? ucfirst($row['name']) : "NA";
                $final_array[$i][2] = $subject;
                $final_array[$i][3] = $grade;
                $final_array[$i][4] = isset($row['created_at']) && $row['created_at'] != '' ? get_added_on_date_time($row['created_at']) : "NA";
                /*$final_array[$i][5] = isset($row['approve_status']) ? ucfirst($row['approve_status']) : "NA";*/
                $final_array[$i][5] = $build_approve_action_btn;
                $final_array[$i][6] = $build_holiday_btn;
                $final_array[$i][7] = $build_active_btn;
                $final_array[$i][8] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

     /*Changes done by Kavita*/
    public function AddHolidayProgram($enc_id = false)
    {
        $programId = base64_decode($enc_id);
        if (isset($programId) && $programId != '') 
        {
            $res = $this->BaseModel->where('id', '=', $programId)
                                             ->update(['is_holiday_program' => 'yes']);

            if ($res) 
            {
                Session::flash('success', 'Record successfully added in challenge program.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error', 'Opps, Problem occured while adding challenge program .');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while adding challenge program.');
            return redirect()->back();
        }
    }
    public function RemoveHolidayProgram($enc_id = false)
    {
        $programId = base64_decode($enc_id);
        if (isset($programId) && $programId != '') 
        {
            $res = $this->BaseModel->where('id', '=', $programId)
                                             ->update(['is_holiday_program' => 'no']);

            if ($res) 
            {
                Session::flash('success', 'Record successfully remove from challenge program.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error', 'Opps, Problem occured while removing from challenge program.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while removing from challenge program.');
            return redirect()->back();
        }
    }
        
    public function getGrade(Request $request)
    {
        /*dd($request->all());*/
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

    public function deleteProgramQuestionModel($programId='', $templateId='', $lessonId='', $questionId='')
    {
        $deleteProgramQuestionModel = 'false';
        if($programId!='' && $templateId!='' && $lessonId!='' && $questionId!='')
        {
            $isExist = $this->ProgramQuestionModel->where('program_id', '=', $programId)
                                                  ->where('template_id', '=', $templateId)
                                                  ->where('lesson_id', '=', $lessonId)
                                                  ->where('question_id', '=', $questionId)
                                                  ->count();
            if($isExist > 0)
            {
                $deleteProgramQuestionModel = $this->ProgramQuestionModel->where('program_id', '=', $programId)
                                                                         ->where('template_id', '=', $templateId)
                                                                         ->where('lesson_id', '=', $lessonId)
                                                                         ->where('question_id', '=', $questionId)
                                                                         ->delete();
            }
            
        }
        return $deleteProgramQuestionModel;
    }

    public function questionDelete($programId,$templateId)
    {
        $questionDelete = false;
        if($programId!='' && $templateId!='')
        {
            $modelName = 'Template'.$templateId.'Model';
            /* Template : 1 */
            if($templateId == 1)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'lesson_id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                                
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                                if($questionDelete)
                                {
                                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($programId, $templateId, $arrQuestionVal['lesson_id'], $arrQuestionVal['id']);
                                }
                            }           
                        }
                    }
                }
            }
            /* Template : 2 */
            else if($templateId == 2)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }           
                        }
                    }
                }
            }
            /* Template : 3 */
            else if($templateId == 3)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }       
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 4 */
            else if($templateId == 4)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 5 */
            else if($templateId == 5)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 6 */
            else if($templateId == 6)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 7 */
            else if($templateId == 7)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 8 */
            else if($templateId == 8)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 9)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 10 */
            else if($templateId == 10)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 11 */
            else if($templateId == 11)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file'/*, 'horn'*/)->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 12 */
            else if($templateId == 12)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 13 */
            else if($templateId == 13)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 14 */
            else if($templateId == 14)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 15 */
            else if($templateId == 15)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 16 */
            else if($templateId == 16)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 17)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 18 */
            else if($templateId == 18)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 19 */
            else if($templateId == 19)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 20 */
            else if($templateId == 20)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 21 */
            else if($templateId == 21)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 22 */
            else if($templateId == 22)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 23 */
            else if($templateId == 23)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 24 */
            else if($templateId == 24)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 25 */
            else if($templateId == 25)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 26 */
            else if($templateId == 26)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 27 */
            else if($templateId == 27)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 28 */
            else if($templateId == 28)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 29 */
            else if($templateId == 29)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 30 */
            else if($templateId == 30)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 31 */
            else if($templateId == 31)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 32 */
            else if($templateId == 32)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 33 */
            else if($templateId == 33)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 34 */
            else if($templateId == 34)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 35 */
            else if($templateId == 35)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 36 */
            else if($templateId == 36)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 37 */
            else if($templateId == 37)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 38 */
            else if($templateId == 38)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 39 */
            else if($templateId == 39)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 40 */
            else if($templateId == 40)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 41 */
            else if($templateId == 41)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 42 */
            else if($templateId == 42)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 43 */
            else if($templateId == 43)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 44 */
            else if($templateId == 44)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 45 */
            else if($templateId == 45)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 46 */
            else if($templateId == 46)
            {

                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 48 */
            else if($templateId == 48)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 49 */
            else if($templateId == 49)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 50 */
            else if($templateId == 50)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
        }
        return $questionDelete;
    }

    public function delete($enc_id='')
    {
        if($enc_id=='')
        {
            return redirect()->back();
        }
        $programId = base64_decode($enc_id);
        $isExist = $this->BaseModel->where('id', '=', $programId)->count();
        if($isExist > 0)
        {
            $arrProgram = [];
            $arrProgram = $this->BaseModel->where('id', '=', $programId)->first();
            if(count($arrProgram) > 0)
            {
                $arrProgram = $arrProgram->toArray();
            }
            if(count($arrProgram) > 0)
            {
                /* QUESTION : DELETE (from ALL TEMPLATE tables) */
                if(isset($arrProgram['template_id']) && $arrProgram['template_id']!='')
                {
                    $arrTemplateId = [];
                    $arrTemplateId = explode(',', $arrProgram['template_id']);
                    if(count($arrTemplateId) > 0)
                    {
                        foreach ($arrTemplateId as $arrTemplateIdVal)
                        {
                            if($arrTemplateIdVal!='')
                            {
                                $resultQuestionDelete = $this->questionDelete($programId,$arrTemplateIdVal);
                            }   
                        }
                    }
                }
                
                /* LESSON : DELETE */
                $isLessonExist = $this->LessonModel->where('program_id', '=', $programId)->count();
                if($isLessonExist > 0)
                {
                    $resultLessonDelete = $this->LessonModel->where('program_id', '=', $programId)->delete();
                }

                /*PROGRAM : DELETE*/
                $resultProgramDelete = $this->BaseModel->where('id', '=', $programId)->delete();
                if($resultProgramDelete)
                {
                    Session::flash('success', 'Record deleted successfully.');
                    return redirect($this->module_url_path);
                }
                else
                {
                    Session::flash('error', 'Problem occured while deleting a record.');
                    return redirect()->back();
                }
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();   
        }
    }

    public function view($enc_id='')
    {
        /*dd(base64_encode(2));*/
        if($enc_id == '')
        {
            return redirect()->back();
        }
        /*$userId = login_user_id('creator');*/
        $programId = base64_decode($enc_id);
        $isExist = $this->ProgramModel->where('id', '=', $programId)/*->where('user_id', '=', $userId)*/->count();
        if($isExist==0)
        {
            return redirect($this->module_url_path);
        }

        $arrTemplateId = [];
        $arrProgramTemplateId = $this->ProgramModel->select('template_id')->where('id', '=', $programId)/*->where('user_id', '=', $userId)*/->first();
        if(count($arrProgramTemplateId) > 0)
        {
            $arrProgramTemplateId = $arrProgramTemplateId->toArray();
            if(isset($arrProgramTemplateId['template_id']) && $arrProgramTemplateId['template_id']!='')
            {
                $arrTemplateId = makeTemplateIdArray($arrProgramTemplateId['template_id']);
            }
        }
        
        $arrProgram = [];
        $arrProgramSql = $this->BaseModel->select('id', 'user_id', 'unique_id', 'name', 'slug', 'description', 'subject', 'grade', 'template_id', 'status', 'approve_status', 'created_at')
                                         ->with([
                                                'subjectData'=>function($subjectDataQuery){ 
                                                    $subjectDataQuery->select('id')
                                                                ->with([
                                                                    'subjectTranslationData'=>function($subjectTranslationDataQuery){ $subjectTranslationDataQuery->select('id','subject_id','name')->where('locale', '=', 'en'); }
                                                                    ])
                                                                 ->where('status', '=', '1');
                                                },
                                                'gradeData'=>function($gradeDataQuery){
                                                    $gradeDataQuery->select('id')
                                                                   ->with([
                                                                    'gradeTraslationData'=>function($gradeTraslationDataQuery){ $gradeTraslationDataQuery->select('id', 'grade_id', 'name')->where('locale', '=', 'en');  }
                                                                    ])
                                                                   ->where('status', '=', '1');
                                                },  
                                              'student_assign_program' => function($query){ 
                                                    $query->select('id','program_id','template_id','student_id');
                                                }]);
                                $arrProgramSql->where('id', '=', $programId)/*->where('user_id', '=', $userId)*/;
                                /*if(count($arrTemplateId) > 0)
                                {
                                    foreach ($arrTemplateId as $arrTemplateIdVal)
                                    {
                                        $templateName = 'template'.$arrTemplateIdVal;
                                        $arrProgramSql->with([
                                            'template'.$arrTemplateIdVal=>function($template1Query){ $template1Query->select('id', 'program_id', 'lesson_id', 'question', 'status', 'created_at') 
                                            ]);
                                    }
                                }*/
        $arrProgram = $arrProgramSql->first();
        if(count($arrProgram) > 0)
        {
            $arrProgram = $arrProgram->toArray();
        }
        
        $arrQuestion = $arrQuestionPagination = [];
        $arrQuestion = $this->ProgramQuestionModel->select('id','program_id','template_id','lesson_id','question_id')
                                                  ->with([
                                                    'programData'=>function($programDataQuery){
                                                        $programDataQuery->select('id','name');
                                                    },
                                                    'lessonData'=>function($lessonDataQuery){
                                                        $lessonDataQuery->select('id','name');
                                                    }
                                                    ])
                                                  ->where('program_id', '=', $programId)
                                                  //->orderBy('id', 'DESC')
                                                  ->paginate(20);
        if(count($arrQuestion) > 0)
        {
            $arrQuestionPagination = $arrQuestion->links();
            $arrQuestion = $arrQuestion->toArray();
        }

        $arrLesson = [];
        $arrLesson = $this->LessonModel->where('program_id', '=', $programId)
                                       ->get();
        if(count($arrLesson) > 0)
        {
            $arrLesson = $arrLesson->toArray();
        }

        $this->arr_view_data['page_title']                   = $this->module_title.' Details';
        $this->arr_view_data['parent_module_icon']           = "fa fa-home";
        $this->arr_view_data['parent_module_title']          = "Dashboard";
        $this->arr_view_data['parent_module_url']            = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']                  = $this->module_icon;
        $this->arr_view_data['module_title']                 = 'Manage '.$this->module_title;
        $this->arr_view_data['module_url_path']              = $this->module_url_path.'/view/'.$enc_id;
        $this->arr_view_data['base_module_url_path']         = $this->module_url_path;
        $this->arr_view_data['supervisor_panel_slug']        = $this->supervisor_panel_slug;

        $this->arr_view_data['module_url']                   = $this->module_url_path;
        $this->arr_view_data['sub_module_title']             = 'View '.$this->module_title;
        $this->arr_view_data['sub_module_icon']              = 'fa fa-eye';

        $this->arr_view_data['arrProgram']                   = $arrProgram;
        $this->arr_view_data['arrTemplateId']                = $arrTemplateId;
        $this->arr_view_data['arrQuestion']                  = $arrQuestion;
        $this->arr_view_data['arrQuestionPagination']        = $arrQuestionPagination;
        $this->arr_view_data['arrLesson']                    = $arrLesson;
        $this->arr_view_data['programId']                    = $programId;

        return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    public function edit($enc_id='')
    {
        if($enc_id == '')
        {
            return redirect()->back();
        }
        /*$userId = login_user_id('creator');*/
        $programId = base64_decode($enc_id);
        $isExist = $this->ProgramModel->where('id', '=', $programId)/*->where('user_id', '=', $userId)*/->count();
        if($isExist==0)
        {
            return redirect()->back();
        }

        $arrProgram = $this->BaseModel/*->where('user_id', '=', $userId)*/->where('id', '=', $programId)->first();
        if(count($arrProgram) == 0)
        {
            return redirect()->back();   
        }
        $arrProgram = $arrProgram->toArray();
        /*dd($arrProgram);*/

        $arrGrade = $arrSubject = [];
        $subjectId = '';
        if(count($arrProgram) > 0)
        {
            if(isset($arrProgram['subject']) && $arrProgram['subject']!='')
            {
                $subjectId = $arrProgram['subject'];
            }
        }
        $arrGrade = $this->GradeModel->select('id')->where('subject', '=', $subjectId)->where('status', '=', '1')->get();
        if(count($arrGrade) > 0)
        {
            $arrGrade = $arrGrade->toArray();
        }
        $arrSubject = $this->SubjectModel->select('id')->where('status', '=', '1')->get();
        if(count($arrSubject) > 0)
        {
            $arrSubject = $arrSubject->toArray();
        }

        //dd($arrProgram);

        $this->arr_view_data['page_title']             = $this->module_title.' Details';
        $this->arr_view_data['parent_module_icon']     = "fa fa-home";
        $this->arr_view_data['parent_module_title']    = "Dashboard";
        $this->arr_view_data['parent_module_url']      = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']            = $this->module_icon;
        $this->arr_view_data['module_title']           = 'Manage '.$this->module_title;
        $this->arr_view_data['module_url_path']        = $this->module_url_path.'/edit/'.$enc_id;
        $this->arr_view_data['base_module_url_path']   = $this->module_url_path;
        $this->arr_view_data['supervisor_panel_slug']  = $this->supervisor_panel_slug;

        $this->arr_view_data['module_url']             = $this->module_url_path;
        $this->arr_view_data['sub_module_title']       = 'Edit '.$this->module_title;
        $this->arr_view_data['sub_module_icon']        = 'fa fa-pencil';

        $this->arr_view_data['arrProgram']             = $arrProgram;
        $this->arr_view_data['arrSubject']             = $arrSubject;
        $this->arr_view_data['arrGrade']               = $arrGrade;
        $this->arr_view_data['programId']              = $programId;

        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function update($enc_id='', Request $request)
    {
        if($enc_id=='')
        {
            return redirect()->back();
        }
        $programId = base64_decode($enc_id);
        
        $arr_rules['subject'] = 'required';
        $arr_rules['grade'] = 'required';
        $arr_rules['name'] = 'required';
        $arr_rules['description'] = 'required';
        
        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            return redirect()->back->withInput()->withErrors($validator);
        }

        $arr_data['subject'] = $request->input('subject');
        $arr_data['grade'] = $request->input('grade');
        $arr_data['name'] = trim(ucfirst($request->input('name')));
        $arr_data['slug'] = str_replace(' ', '-', trim(ucfirst($request->input('name'))));
        $arr_data['description'] = trim(ucfirst($request->input('description')));

        $result = $this->BaseModel->where('id', '=', $programId)->update($arr_data);
        if($result)
        {
            Session::flash('success','Record updated successfully.');
            return redirect($this->module_url_path.'/edit/'.base64_encode($programId));
        }
        else
        {
            Session::flash('error','Oops, problem occurred while updating a program.Please try again');
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function activateQuestion($enc_id='', $template_id='', $id='')
    {
        if($enc_id=='' && $template_id=='' && $id=='')
        {
            return redirect()->back();
        }
        $programId  = base64_decode($enc_id);
        $questionId = base64_decode($id);
        /*dd($programId, $template_id, $questionId);*/
        $moduleName = 'Template'.$template_id.'Model';
        $isExist = $this->$moduleName->where('id', '=', $questionId)->count();
        if($isExist == 1)
        {
            $result = $this->$moduleName->where('id', '=', $questionId)->update(['status'=>'1']);
            if($result)
            {
                Session::flash('success', 'Record Activated Successfully.');
                return redirect($this->module_url_path.'/view/'.base64_encode($programId));
            }
            else
            {
                Session::flash('error', 'Problem Occured While Activate a Record.');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
    }

    public function deactivateQuestion($enc_id='', $template_id='', $id='')
    {
        if($enc_id=='' && $template_id=='' && $id=='')
        {
            return redirect()->back();
        }
        $programId  = base64_decode($enc_id);
        $questionId = base64_decode($id);
        /*dd($programId, $template_id, $questionId);*/
        $moduleName = 'Template'.$template_id.'Model';

        $isExist = $this->$moduleName->where('id', '=', $questionId)->count();
        if($isExist == 1)
        {
            $result = $this->$moduleName->where('id', '=', $questionId)->update(['status'=>'0']);
            if($result)
            {
                Session::flash('success', 'Record Deactivated Successfully.');
                return redirect($this->module_url_path.'/view/'.base64_encode($programId));
            }
            else
            {
                Session::flash('error', 'Problem Occured While Deactivate a Record.');
                return redirect()->back();       
            }   
        }
        else
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
    }

    public function deleteQuestion($enc_id='', $template_id='', $id='')
    {
        if($enc_id=='' && $template_id=='' && $id=='')
        {
            return redirect()->back();
        }
        $programId  = base64_decode($enc_id);
        $questionId = base64_decode($id);
        /*dd($programId, $template_id, $questionId);*/
        $moduleName = 'Template'.$template_id.'Model';
        $isExist = $this->$moduleName->where('id', '=', $questionId)->count();
        if($isExist == 1)
        {
            $result = $this->questionSingleDelete($questionId,$template_id);
            if($result)
            {
                Session::flash('success', 'Record Deleted Successfully.');
                return redirect($this->module_url_path.'/view/'.base64_encode($programId));
            }
            else
            {
                Session::flash('error', 'Problem Occured While Delete a Record.');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
    }

    public function questionSingleDelete($questionId,$templateId)
    {
        $questionSingleDelete = false;
        if($questionId!='' && $templateId!='')
        {
            $modelName = 'Template'.$templateId.'Model';
            /* Template : 1 */
            if($templateId == 1)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'file_type', 'file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();

                    if(isset($arrQuestion['file_type']))
                    {
                        if($arrQuestion['file_type']=='image')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                        else if($arrQuestion['file_type']=='video')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_video_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 2 */
            else if($templateId == 2)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'file_type', 'file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    
                    if(isset($arrQuestion['file_type']))
                    {
                        if($arrQuestion['file_type']=='image')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                        else if($arrQuestion['file_type']=='video')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_video_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 3 */
            else if($templateId == 3)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 4 */
            else if($templateId == 4)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'horn')->where('id', '=', $questionId)->first();
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 5 */
            else if($templateId == 5)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'file_type', 'file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();

                    if(isset($arrQuestion['file_type']))
                    {
                        if($arrQuestion['file_type']=='image')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                        else if($arrQuestion['file_type']=='video')
                        {
                            if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                            {
                                if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                {
                                    @unlink($this->question_video_base_path.$arrQuestion['file']);
                                }
                            }   
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 6 */
            else if($templateId == 6)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                    {
                        if(file_exists($this->question_video_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_video_base_path.$arrQuestion['question_file']);
                        }
                    }   
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 7 */
            else if($templateId == 7)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 8 */
            else if($templateId == 8)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 9 */
            else if($templateId == 9)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 10 */
            else if($templateId == 10)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 11 */
            else if($templateId == 11)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file'/*, 'horn'*/)->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 12 */
            else if($templateId == 12)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 13 */
            else if($templateId == 13)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                        }
                    }
                    if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 14 */
            else if($templateId == 14)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                        }
                    }
                    if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 15 */
            else if($templateId == 15)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 16 */
            else if($templateId == 16)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 17 */
            else if($templateId == 17)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 18 */
            else if($templateId == 18)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                        }
                    }
                    if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 19 */
            else if($templateId == 19)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                        }
                    }
                    if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 20 */
            else if($templateId == 20)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 21 */
            else if($templateId == 21)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 22 */
            else if($templateId == 22)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 23 */
            else if($templateId == 23)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 24 */
            else if($templateId == 24)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 25 */
            else if($templateId == 25)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_video_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_video_base_path.$arrQuestion['question_1_file']);
                        }
                    }   
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 26 */
            else if($templateId == 26)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 27 */
            else if($templateId == 27)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 28 */
            else if($templateId == 28)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 29 */
            else if($templateId == 29)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 30 */
            else if($templateId == 30)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 31 */
            else if($templateId == 31)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 32 */
            else if($templateId == 32)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 33 */
            else if($templateId == 33)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 34 */
            else if($templateId == 34)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                        }
                    }   
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 35 */
            else if($templateId == 35)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }   
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }   
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 36 */
            else if($templateId == 36)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 37 */
            else if($templateId == 37)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }
                    if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                        }
                    }
                    if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                        }
                    }
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 38 */
            else if($templateId == 38)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 39 */
            else if($templateId == 39)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 40 */
            else if($templateId == 40)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 41 */
            else if($templateId == 41)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 42 */
            else if($templateId == 42)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 43 */
            else if($templateId == 43)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                        }
                    }   
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 44 */
            else if($templateId == 44)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 45 */
            else if($templateId == 45)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_1_file', 'question_2_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                        }
                    }
                    if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                        }
                    }   
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 46 */
            else if($templateId == 46)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'question_file', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                        }
                    }
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 48 */
            else if($templateId == 48)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 49 */
            else if($templateId == 49)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    /*if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }*/
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
            /* Template : 50 */
            else if($templateId == 50)
            {
                $arrQuestion = [];
                $arrQuestion = $this->$modelName->select('id', 'program_id', 'lesson_id', 'horn')->where('id', '=', $questionId)->first();
                
                if(count($arrQuestion) > 0)
                {
                    $arrQuestion = $arrQuestion->toArray();
                    if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                    {
                        if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                        {
                            @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                        }
                    }
                }
                $questionSingleDelete = $this->$modelName->where('id', '=', $questionId)->delete();
                if($questionSingleDelete)
                {
                    $resultDeleteProgramQuestionModel = $this->deleteProgramQuestionModel($arrQuestion['program_id'], $templateId, $arrQuestion['lesson_id'], $questionId);
                    $arrQuestionCnt = $this->$modelName->where('program_id', '=', $arrQuestion['program_id'])->count();
                    if($arrQuestionCnt == 0)
                    {
                        $result = $this->removeProgramTemplateId($arrQuestion['program_id'], $templateId);
                    }
                }
            }
        }
        return $questionSingleDelete;   
    }

    public function removeProgramTemplateId($programId='', $templateId)
    {
        $removeProgramTemplateId = false;
        if($programId!='' && $templateId!='')
        {
            $arrProgram = $this->BaseModel->where('id', '=', $programId)->first();
            if(count($arrProgram) > 0)
            {
                if(isset($arrProgram['template_id']))
                {
                    $arrTemplateID = makeTemplateIdArray($arrProgram['template_id']);
                    $strTemplateId = '';
                    foreach ($arrTemplateID as $arrTemplateIDVal)
                    {
                        if($arrTemplateIDVal!=$templateId)       
                        {
                            $strTemplateId.=$arrTemplateIDVal.',';
                        }
                    }
                    $strTemplateId = trim($strTemplateId,',');
                    /*if($strTemplateId!='')
                    {*/
                        $removeProgramTemplateId = $this->BaseModel->where('id', '=', $programId)->update(['template_id'=>$strTemplateId]);
                    /*}*/
                }
            }
        }
        return $removeProgramTemplateId;
    }

    public function viewLesson($program_id, $lesson_id)
    {
        if($program_id=='' || $lesson_id=='')
        {
            return redirect()->back();   
        }
        $programId = base64_decode($program_id);
        $lessonId = base64_decode($lesson_id);

        $isExist = $this->LessonModel->where('program_id', '=', $programId)->where('id', '=', $lessonId)->count();
        if($isExist==0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
        $arrLesson = [];
        $arrLesson = $this->LessonModel->select('id','name','program_id','created_at')
                                       ->with([
                                        'programData'=>function($programDataQuery){
                                            $programDataQuery->select('id', 'name');
                                        }
                                        ])
                                       ->where('program_id', '=', $programId)
                                       ->where('id', '=', $lessonId)
                                       ->first();
        if(count($arrLesson) > 0)
        {
            $arrLesson = $arrLesson->toArray();
        }
        /*dd($arrLesson);*/
        $arrQuestion = $arrQuestionPagination = [];
        $arrQuestion = $this->ProgramQuestionModel->select('id','program_id','template_id','lesson_id','question_id')
                                                  ->with([
                                                    'programData'=>function($programDataQuery){
                                                        $programDataQuery->select('id','name');
                                                    },
                                                    'lessonData'=>function($lessonDataQuery){
                                                        $lessonDataQuery->select('id','name');
                                                    }
                                                    ])
                                                  ->where('program_id', '=', $programId)
                                                  ->where('lesson_id', '=', $lessonId)
                                                  //->orderBy('id', 'DESC')
                                                  ->paginate(20);
        if(count($arrQuestion) > 0)
        {
            $arrQuestionPagination = $arrQuestion->links();
            $arrQuestion = $arrQuestion->toArray();
        }
        /*dd($arrQuestion['total']);*/
        $this->arr_view_data['page_title']                   = 'Lesson Details';
        $this->arr_view_data['parent_module_icon']           = "fa fa-home";
        $this->arr_view_data['parent_module_title']          = "Dashboard";
        $this->arr_view_data['parent_module_url']            = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']                  = $this->module_icon;
        $this->arr_view_data['module_title']                 = 'Manage '.$this->module_title;
        $this->arr_view_data['module_url_path']              = $this->module_url_path.'/lesson/view/'.$program_id.'/'.$lesson_id;
        $this->arr_view_data['base_module_url_path']         = $this->module_url_path;
        $this->arr_view_data['supervisor_panel_slug']        = $this->supervisor_panel_slug;

        $this->arr_view_data['module_url']                   = $this->module_url_path;
        $this->arr_view_data['sub_module_title']             = 'View Lesson';
        $this->arr_view_data['sub_module_icon']              = 'fa fa-eye';

        $this->arr_view_data['arrLesson']                    = $arrLesson;
        $this->arr_view_data['arrQuestion']                  = $arrQuestion;
        $this->arr_view_data['arrQuestionPagination']        = $arrQuestionPagination;
        $this->arr_view_data['programId']                    = $programId;
        $this->arr_view_data['lessonId']                     = $lessonId;

        return view($this->module_view_folder.'.lesson_view',$this->arr_view_data);
    }

    public function updateLesson($program_id='', $lesson_id='', Request $request)
    {
        if($program_id=='' || $lesson_id=='')
        {
            return json_encode([
                'errors' => 'error',
                'code' => 422,
                'status' => 'error',
            ]);
        }

        $programId = base64_decode($program_id);
        $lessonId = base64_decode($lesson_id);

        $arr_rules['name'] = 'required';

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            return json_encode([
                'errors' => $validator->errors()->getMessages(),
                'code' => 422,
                'status' => 'fail',
            ]);
        }

        $isExist = $this->LessonModel->where('name', '=', $request->input('name'))
                                     ->where('program_id', '=', $programId)
                                     ->where('id', '<>', $lessonId)
                                     ->count();
        if($isExist==0)
        {
            $result = $this->LessonModel->where('id', '=', $lessonId)->update(['name'=>ucfirst($request->input('name'))]);
            if($result)
            {
                $resp['status'] = 'success';
            }
            else
            {
                $resp['status'] = 'fail';
            }
        }
        return response()->json($resp);
    }

    public function editQuestion($program_id='',$template_id='',$question_id='')
    {
        if($program_id=='' && $template_id=='' && $question_id=='')
        {
            /*return redirect()->back();*/
            return redirect($this->module_url_path.'/view/'.$program_id);
        }
        $programId  = base64_decode($program_id);
        $questionId = base64_decode($question_id);
        $moduleName = 'Template'.$template_id.'Model';
        $isExist = $this->$moduleName->where('id', '=', $questionId)->count();
        if($isExist == 0)
        {
            Session::flash('error', 'Record not found.');
            /*return redirect()->back();*/
            return redirect($this->module_url_path.'/view/'.$program_id);
        }
        $arrQuestion = [];
        $arrQuestion = $this->$moduleName->where('id', '=', $questionId)->first();
        if(count($arrQuestion) > 0)
        {
            $arrQuestion = $arrQuestion->toArray();
        }

        $this->arr_view_data['page_title']                = "Edit Question";
        $this->arr_view_data['parent_module_icon']        = "fa fa-home";
        $this->arr_view_data['parent_module_title']       = "Dashboard";
        $this->arr_view_data['parent_module_url']         = url('/').'/supervisor/dashboard';
        $this->arr_view_data['module_icon']               = $this->module_icon;
        $this->arr_view_data['module_title']              = "Manage Program";
        $this->arr_view_data['module_url']                = $this->module_url_path;
        $this->arr_view_data['sub_module_title']          = 'Edit Question';
        $this->arr_view_data['sub_module_icon']           = 'fa fa-plus';
        $this->arr_view_data['module_url_path']           = $this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId);
        $this->arr_view_data['supervisor_panel_slug']     = $this->supervisor_panel_slug;
        $this->arr_view_data['role_slug']                 = $this->supervisor_panel_slug;
        
        $this->arr_view_data['arrQuestion']               = $arrQuestion;
        $this->arr_view_data['programId']                 = $programId;
        $this->arr_view_data['templateId']                = $template_id;
        $this->arr_view_data['questionId']                = $questionId;

        $this->arr_view_data['default_base_img_path']     = $this->default_base_img_path;
        $this->arr_view_data['default_public_img_path']   = $this->default_public_img_path;
        $this->arr_view_data['template_base_img_path']    = $this->template_base_img_path;
        $this->arr_view_data['template_public_img_path']  = $this->template_public_img_path;

        $this->arr_view_data['question_image_base_path']  = $this->question_image_base_path;
        $this->arr_view_data['question_image_public_path']= $this->question_image_public_path;
        $this->arr_view_data['question_video_base_path']  = $this->question_video_base_path;
        $this->arr_view_data['question_video_public_path']= $this->question_video_public_path;
        $this->arr_view_data['question_audio_base_path']  = $this->question_audio_base_path;
        $this->arr_view_data['question_audio_public_path']= $this->question_audio_public_path;

        return view($this->program_view_folder.'.template_'.$template_id.'_edit',$this->arr_view_data);
        
    }

    public function updateQuestion($program_id='',$template_id='',$question_id='', Request $request)
    {

        if($program_id!='' && $template_id!='' && $question_id!='')
        {
            $created_by = Session('loggedinId');
            $programId = base64_decode($program_id);
            $questionId = base64_decode($question_id);
            $modelName = 'Template'.$template_id.'Model';
            $isQuestionExist = $this->$modelName->where('id', '=', $questionId)->count();
            if(count($isQuestionExist)==0)
            {
                Session::flash('error', 'Record not found');
                return redirect($this->module_url_path.'/view/'.base64_encode($programId));
            }

            $arrQuestion = [];
            $arrQuestion = $this->$modelName->where('id', '=', $questionId)->first();
            if(count($arrQuestion) > 0)
            {
                $arrQuestion = $arrQuestion->toArray();
            }

            /*Delete Temp Question*/
            $this->deleteTempQuestion($programId,$template_id,$created_by);
            
            /*TEMPLATE : 1*/
            if($template_id==1)
            {

                /*dump($request->all());
                dd($arrQuestion);*/
                $isUpload = 0;
                $arr_rules['direction'] = 'required';
                $arr_rules['fileType'] = 'required';
                $arr_rules['question'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if(isset($arrQuestion['file_type']))
                {
                    if($arrQuestion['file_type'] != $request->input('fileType'))
                    {
                        if($request->input('fileType')=='image')
                        {
                            if(!$request->hasFile('imgFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                        else if($request->input('fileType')=='video')
                        {
                            if(!$request->hasFile('vdoFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                    }
                }

                if($request->hasFile('imgFile'))
                {
                    $fileName = $request->file('imgFile');
                    $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['png','jpg','jpeg']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $imageThumb = Image::make($request->file('imgFile'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('vdoFile'))
                {
                    $fileName = $request->file('vdoFile');
                    $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp4']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question']        = trim($request->input('direction'));
                $arr_data['file_type'] = trim($request->input('fileType'));
                $arr_data['question_text'] = trim($request->input('question'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */

                $result = DB::table('template_1')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    if($isUpload == 1)
                    {
                        if(isset($arrQuestion['file_type']) && $arrQuestion['file_type']!='')
                        {
                            if($arrQuestion['file_type']=='image')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                            if($arrQuestion['file_type']=='video')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                        }
                    }
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 2*/
            if($template_id==2)
            {
                /*dump($request->all());*/
                $isUpload = 0;
                $arr_rules['direction'] = 'required';
                $arr_rules['fileType'] = 'required';
                $arr_rules['question'] = 'required';   
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                } 

                if(isset($arrQuestion['file_type']))
                {
                    if($arrQuestion['file_type'] != $request->input('fileType'))
                    {
                        if($request->input('fileType')=='image')
                        {
                            if(!$request->hasFile('imgFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                        else if($request->input('fileType')=='video')
                        {
                            if(!$request->hasFile('vdoFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                    }
                }

                if(!$request->input('blankLetter'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                
                if(!$request->input('chkBlankLetter'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                $strAns = '';
                if(count($request->input('blankLetter')) > 0)
                {
                    foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                    {
                        if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                        {
                            $strAns.=0;
                        }
                        else
                        {
                            $strAns.=1;
                        }
                    }
                }
                if($strAns=='')
                {
                    return json_encode([
                            'errors' => 'chkBlankLetter',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                }
                else
                {
                    $arr_data['answer_position'] = $strAns;
                }
                
                if($request->hasFile('imgFile'))
                {
                    $fileName = $request->file('imgFile');
                    $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['png','jpg','jpeg']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $imageThumb = Image::make($request->file('imgFile'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('vdoFile'))
                {
                    $fileName = $request->file('vdoFile');
                    $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp4']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question']        = trim($request->input('direction'));
                $arr_data['file_type'] = trim($request->input('fileType'));
                $arr_data['question_text'] = trim($request->input('question'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_2')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    if($isUpload == 1)
                    {
                        if(isset($arrQuestion['file_type']) && $arrQuestion['file_type']!='')
                        {
                            if($arrQuestion['file_type']=='image')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                            if($arrQuestion['file_type']=='video')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                        }
                    }

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 3*/
            if($template_id==3)
            {
                /*dd($request->all());*/
                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/
                $arr_rules['direction'] = 'required';
                $arr_rules['answer'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['question2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion1',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion2',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question']        = trim($request->input('direction'));
                $arr_data['answer']          = trim(strtoupper($request->input('answer')));
                $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
                $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_3')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 4*/
            if($template_id==4)
            {
                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = 0;*/
                $arr_rules['direction'] = 'required';
                $arr_rules['answer'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['question3'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion1',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion2',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion1',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question']        = trim($request->input('direction'));
                $arr_data['answer']          = trim(ucwords($request->input('answer')));
                $arr_data['question_1_text'] = trim(ucwords($request->input('question1')));
                $arr_data['question_2_text'] = trim(ucwords($request->input('question2')));
                $arr_data['question_3_text'] = trim(ucwords($request->input('question3')));
                
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_4')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 5*/
            if($template_id==5)
            {
                //dd($request->all());
                $isUpload = 0;
                $arr_rules['fileType'] = 'required';
                $arr_rules['direction'] = 'required';
                $arr_rules['option1'] = 'required';
                $arr_rules['option2'] = 'required';
                $arr_rules['rdoOption'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if(isset($arrQuestion['file_type']))
                {
                    if($arrQuestion['file_type'] != $request->input('fileType'))
                    {
                        if($request->input('fileType')=='image')
                        {
                            if(!$request->hasFile('imgFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                        else if($request->input('fileType')=='video')
                        {
                            if(!$request->hasFile('vdoFile'))
                            {
                                Session::flash('error', 'Please select a file.');
                                return redirect()->back()->withInput();
                            }
                        }
                    }
                }

                if($request->hasFile('imgFile'))
                {
                    $fileName = $request->file('imgFile');
                    $fileExtension = strtolower($request->file('imgFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['png','jpg','jpeg']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $imageThumb = Image::make($request->file('imgFile'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('imgFile')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('vdoFile'))
                {
                    $fileName = $request->file('vdoFile');
                    $fileExtension = strtolower($request->file('vdoFile')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp4']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('vdoFile')->move($this->question_video_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['file'] = $fileName;
                            $isUpload = 1;
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                
                $arr_data['file_type'] = trim($request->input('fileType'));
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['option1'] = trim(ucwords($request->input('option1')));
                $arr_data['option2'] = trim(ucwords($request->input('option2')));
                $arr_data['answer'] = trim($request->input('rdoOption'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                 
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_5')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    if($isUpload == 1)
                    {
                        if(isset($arrQuestion['file_type']) && $arrQuestion['file_type']!='')
                        {
                            if($arrQuestion['file_type']=='image')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                            if($arrQuestion['file_type']=='video')
                            {
                                if(isset($arrQuestion['file']) && $arrQuestion['file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestion['file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestion['file']);
                                    }
                                }
                            }
                        }
                    }

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 6*/
            if($template_id==6)
            {
                /*dd($request->all());*/
                /*$isUploadFLQuestion1 = 0;*/
                $arr_rules['direction'] = 'required';
                $arr_rules['option1'] = 'required';
                $arr_rules['option2'] = 'required';
                $arr_rules['rdoOption'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flQuestion'))
                {
                    $fileName = $request->file('flQuestion');
                    $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp4']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;
                        $isUpload = $request->file('flQuestion')->move($this->question_video_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_video_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_video_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion1',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                
                $arr_data['question']        = trim($request->input('direction'));
                $arr_data['option1']         = trim($request->input('option1'));
                $arr_data['option2']         = trim($request->input('option2'));
                $arr_data['answer']          = $request->input('rdoOption');
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_6')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_video_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_video_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 7*/
            if($template_id==7)
            {
                /*dd($request->all());*/
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['answer3']   = 'required';
                $arr_rules['answer4']   = 'required';
                $arr_rules['answer5']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = $isUploadFLQuestion5 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(210,210);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;
                            if($isUploadFLQuestion1 == 1)
                            {*/
                                if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                    }
                                }
                            /*}*/
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(210,210);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;
                            if($isUploadFLQuestion2 == 1)
                            {*/
                                if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                    }
                                }
                            /*}*/
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(210,210);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;
                            if($isUploadFLQuestion3 == 1)
                            {*/
                                if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                    }
                                }
                            /*}*/
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(210,210);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;
                            if($isUploadFLQuestion4 == 1)
                            {*/
                                if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                    }
                                }
                            /*}*/
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(210,210);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            /*$isUploadflQuestion5 = 1;
                            if($isUploadFLQuestion5 == 1)
                            {*/
                                if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                    }
                                }
                            /*}*/
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question']     = trim($request->input('direction'));
                $arr_data['answer1']      = trim($request->input('answer1'));
                $arr_data['answer2']      = trim($request->input('answer2'));
                $arr_data['answer3']      = trim($request->input('answer3'));
                $arr_data['answer4']      = trim($request->input('answer4'));
                $arr_data['answer5']      = trim($request->input('answer5'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_7')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion5 == 1)
                    {
                        if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                            }
                            if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 8*/
            if($template_id==8)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['answer2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_text'] = trim($request->input('question1'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                $arr_data['question_2_text'] = trim($request->input('question2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_8')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 9*/
            if($template_id==9)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question'] = 'required';
                $arr_rules['option1'] = 'required';
                $arr_rules['option2'] = 'required';
                $arr_rules['option3'] = 'required';
                $arr_rules['option4'] = 'required';
                $arr_rules['rdoOption'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_text'] = trim($request->input('question'));
                $arr_data['option1'] = trim($request->input('option1'));
                $arr_data['option2'] = trim($request->input('option2'));
                $arr_data['option3'] = trim($request->input('option3'));
                $arr_data['option4'] = trim($request->input('option4'));
                $arr_data['answer'] = trim($request->input('rdoOption'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_9')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 10*/
            if($template_id==10)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question'] = 'required';
                $arr_rules['option1'] = 'required';
                $arr_rules['option2'] = 'required';
                $arr_rules['rdoOption'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion = 0;*/

                if($request->hasFile('flQuestion'))
                {
                    $fileName = $request->file('flQuestion');
                    $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_text'] = trim($request->input('question'));
                $arr_data['option1'] = trim($request->input('option1'));
                $arr_data['option2'] = trim($request->input('option2'));
                $arr_data['answer'] = trim($request->input('rdoOption'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_10')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 11*/
            if($template_id==11)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['answer2'] = 'required';
                $arr_rules['answer3'] = 'required';
                $arr_rules['answer4'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        
                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;
                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;
                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;
                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(270,270);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question']     = trim($request->input('direction'));
                $arr_data['answer1']      = trim($request->input('answer1'));
                $arr_data['answer2']      = trim($request->input('answer2'));
                $arr_data['answer3']      = trim($request->input('answer3'));
                $arr_data['answer4']      = trim($request->input('answer4'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                 /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_11')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 12*/
            if($template_id==12)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['answer2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                $isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['answer1'] = trim(strtoupper($request->input('answer1')));
                $arr_data['answer2'] = trim(strtoupper($request->input('answer2')));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_12')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 13*/
            if($template_id==13)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['answer2'] = 'required';
                $arr_rules['answer3'] = 'required';
                $arr_rules['answer4'] = 'required';
                $arr_rules['answer5'] = 'required';
                $arr_rules['answer6'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = $isUploadFLQuestion5 = $isUploadFLQuestion6 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            /*$isUploadflQuestion5 = 1;*/
                            if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion6'))
                {
                    $fileName = $request->file('flQuestion6');
                    $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'6.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion6'));
                        $imageThumb->resize(165,165);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_6_file'] = $fileName;
                            /*$isUploadflQuestion6 = 1;*/
                            if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question']     = trim($request->input('direction'));
                $arr_data['answer1']      = trim($request->input('answer1'));
                $arr_data['answer2']      = trim($request->input('answer2'));
                $arr_data['answer3']      = trim($request->input('answer3'));
                $arr_data['answer4']      = trim($request->input('answer4'));
                $arr_data['answer5']      = trim($request->input('answer5'));
                $arr_data['answer6']      = trim($request->input('answer6'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                 /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_13')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion5 == 1)
                    {
                        if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion6 == 1)
                    {
                        if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 14*/
            if($template_id==14)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['answer2'] = 'required';
                $arr_rules['answer3'] = 'required';
                $arr_rules['answer4'] = 'required';
                $arr_rules['answer5'] = 'required';
                $arr_rules['answer6'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = $isUploadFLQuestion5 = $isUploadFLQuestion6 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            /*$isUploadflQuestion5 = 1;*/
                            if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion6'))
                {
                    $fileName = $request->file('flQuestion6');
                    $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'6.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion6'));
                        $imageThumb->resize(200,138);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_6_file'] = $fileName;
                            /*$isUploadflQuestion6 = 1;*/
                            if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question']     = trim($request->input('direction'));
                $arr_data['answer1']      = trim($request->input('answer1'));
                $arr_data['answer2']      = trim($request->input('answer2'));
                $arr_data['answer3']      = trim($request->input('answer3'));
                $arr_data['answer4']      = trim($request->input('answer4'));
                $arr_data['answer5']      = trim($request->input('answer5'));
                $arr_data['answer6']      = trim($request->input('answer6'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                 /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_14')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion5 == 1)
                    {
                        if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion6 == 1)
                    {
                        if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 15*/
            if($template_id==15)
            {
                /*dd($request->all());*/
                $arr_rules['direction'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['rdoQuestion1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['rdoQuestion2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if(!$request->input('rdoQuestion1Text') || !$request->input('rdoQuestion2Text'))
                {
                    Session::flash('error', 'Please Select the checkbox which you want to show.');
                    return redirect()->back()->withInput();
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_text'] = trim(strtoupper($request->input('question1')));
                $strQuestion_1_answer_position = $question_1_answer = '';
                if($request->input('rdoQuestion1Text'))
                {
                    if(count($request->input('rdoQuestion1Text')) > 0)
                    {
                        foreach ($request->input('rdoQuestion1Text') as $rdoQuestion1TextKey=>$rdoQuestion1TextVal)
                        {
                            if($rdoQuestion1TextKey==$request->input('rdoQuestion1'))
                            {
                                $question_1_answer = $rdoQuestion1TextVal;
                                $strQuestion_1_answer_position.=0;
                            }
                            else
                            {
                                $strQuestion_1_answer_position.=1;
                            }
                        }
                    }
                }
                $arr_data['question_1_answer'] = $question_1_answer;
                $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;
                $arr_data['question_2_text'] = trim(strtoupper($request->input('question2')));
                $strQuestion_2_answer_position = $question_2_answer = '';
                if($request->input('rdoQuestion2Text'))
                {
                    if(count($request->input('rdoQuestion2Text')) > 0)
                    {
                        foreach ($request->input('rdoQuestion2Text') as $rdoQuestion2TextKey=>$rdoQuestion2TextVal)
                        {
                            if($rdoQuestion2TextKey==$request->input('rdoQuestion2'))
                            {
                                $question_2_answer = $rdoQuestion2TextVal;
                                $strQuestion_2_answer_position.=0;
                            }
                            else
                            {
                                $strQuestion_2_answer_position.=1;
                            }
                        }
                    }
                }
                $arr_data['question_2_answer'] = $question_2_answer;
                $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_15')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 16*/
            if($template_id==16)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['answer1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['answer2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);

                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                $isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_text'] = trim($request->input('question1'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                $arr_data['question_2_text'] = trim($request->input('question2'));
                $arr_data['answer2'] = trim($request->input('answer2'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_16')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 17*/
            if($template_id==17)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['option1_1'] = 'required';
                $arr_rules['option1_2'] = 'required';
                $arr_rules['option1_3'] = 'required';
                $arr_rules['rdoOption1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['option2_1'] = 'required';
                $arr_rules['option2_2'] = 'required';
                $arr_rules['option2_3'] = 'required';
                $arr_rules['rdoOption2'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_text'] = trim($request->input('question1'));
                $arr_data['question_1_option1'] = trim($request->input('option1_1'));
                $arr_data['question_1_option2'] = trim($request->input('option1_2'));
                $arr_data['question_1_option3'] = trim($request->input('option1_3'));
                $arr_data['question_1_answer'] = $request->input('rdoOption1');
                $arr_data['question_2_text'] = trim($request->input('question2'));
                $arr_data['question_2_option1'] = trim($request->input('option2_1'));
                $arr_data['question_2_option2'] = trim($request->input('option2_2'));
                $arr_data['question_2_option3'] = trim($request->input('option2_3'));
                $arr_data['question_2_answer'] = $request->input('rdoOption2');
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_17')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 18*/
            if($template_id==18)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['question5']   = 'required';
                $arr_rules['question6']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if(!$request->input('blankLetter1'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter1'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('blankLetter2'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter2'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('blankLetter3'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter3'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('blankLetter4'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter4'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('blankLetter5'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter5'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('blankLetter6'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                if(!$request->input('chkBlankLetter6'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = $isUploadFLQuestion5 = $isUploadFLQuestion6 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            /*$isUploadflQuestion5 = 1;*/
                            if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion6'))
                {
                    $fileName = $request->file('flQuestion6');
                    $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'6.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion6'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_6_file'] = $fileName;
                            /*$isUploadflQuestion6 = 1;*/
                            if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
    
                $arr_data['question_1_text'] = trim($request->input('question1'));
                $strQuestion_1_answer_position = $question_1_answer = '';
                $arrChkBlankLetter1 = [];
                if($request->input('chkBlankLetter1'))
                {
                    if(count($request->input('chkBlankLetter1')) > 0)
                    {
                        $arrChkBlankLetter1 = $request->input('chkBlankLetter1');
                    }     
                }
                if($request->input('blankLetter1'))
                {
                    if(count($request->input('blankLetter1')) > 0)
                    {
                        foreach ($request->input('blankLetter1') as $blankLetter1Key=>$blankLetter1Val)
                        {
                            if(in_array($blankLetter1Key, $arrChkBlankLetter1))
                            {
                                $question_1_answer.=$blankLetter1Val;
                                $strQuestion_1_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_1_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_1_answer'] = $question_1_answer;
                $arr_data['question_1_answer_position'] = $strQuestion_1_answer_position;

                $arr_data['question_2_text'] = trim($request->input('question2'));
                $strQuestion_2_answer_position = $question_2_answer = '';
                $arrChkBlankLetter2 = [];
                if($request->input('chkBlankLetter2'))
                {
                    if(count($request->input('chkBlankLetter2')) > 0)
                    {
                        $arrChkBlankLetter2 = $request->input('chkBlankLetter2');
                    }     
                }
                if($request->input('blankLetter2'))
                {
                    if(count($request->input('blankLetter2')) > 0)
                    {
                        foreach ($request->input('blankLetter2') as $blankLetter2Key=>$blankLetter2Val)
                        {
                            if(in_array($blankLetter2Key, $arrChkBlankLetter2))
                            {
                                $question_2_answer.=$blankLetter2Val;
                                $strQuestion_2_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_2_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_2_answer'] = $question_2_answer;
                $arr_data['question_2_answer_position'] = $strQuestion_2_answer_position;

                $arr_data['question_3_text'] = trim($request->input('question3'));
                $strQuestion_3_answer_position = $question_3_answer = '';
                $arrChkBlankLetter3 = [];
                if($request->input('chkBlankLetter3'))
                {
                    if(count($request->input('chkBlankLetter3')) > 0)
                    {
                        $arrChkBlankLetter3 = $request->input('chkBlankLetter3');
                    }     
                }
                if($request->input('blankLetter3'))
                {
                    if(count($request->input('blankLetter3')) > 0)
                    {
                        foreach ($request->input('blankLetter3') as $blankLetter3Key=>$blankLetter3Val)
                        {
                            if(in_array($blankLetter3Key, $arrChkBlankLetter3))
                            {
                                $question_3_answer.=$blankLetter3Val;
                                $strQuestion_3_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_3_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_3_answer'] = $question_3_answer;
                $arr_data['question_3_answer_position'] = $strQuestion_3_answer_position;

                $arr_data['question_4_text'] = trim($request->input('question4'));
                $strQuestion_4_answer_position = $question_4_answer = '';
                $arrChkBlankLetter4 = [];
                if($request->input('chkBlankLetter4'))
                {
                    if(count($request->input('chkBlankLetter4')) > 0)
                    {
                        $arrChkBlankLetter4 = $request->input('chkBlankLetter4');
                    }     
                }
                if($request->input('blankLetter4'))
                {
                    if(count($request->input('blankLetter4')) > 0)
                    {
                        foreach ($request->input('blankLetter4') as $blankLetter4Key=>$blankLetter4Val)
                        {
                            if(in_array($blankLetter4Key, $arrChkBlankLetter4))
                            {
                                $question_4_answer.=$blankLetter4Val;
                                $strQuestion_4_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_4_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_4_answer'] = $question_4_answer;
                $arr_data['question_4_answer_position'] = $strQuestion_4_answer_position;

                $arr_data['question_5_text'] = trim($request->input('question5'));
                $strQuestion_5_answer_position = $question_5_answer = '';
                $arrChkBlankLetter5 = [];
                if($request->input('chkBlankLetter5'))
                {
                    if(count($request->input('chkBlankLetter5')) > 0)
                    {
                        $arrChkBlankLetter5 = $request->input('chkBlankLetter5');
                    }     
                }
                if($request->input('blankLetter5'))
                {
                    if(count($request->input('blankLetter5')) > 0)
                    {
                        foreach ($request->input('blankLetter5') as $blankLetter5Key=>$blankLetter5Val)
                        {
                            if(in_array($blankLetter5Key, $arrChkBlankLetter5))
                            {
                                $question_5_answer.=$blankLetter5Val;
                                $strQuestion_5_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_5_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_5_answer'] = $question_5_answer;
                $arr_data['question_5_answer_position'] = $strQuestion_5_answer_position;

                $arr_data['question_6_text'] = trim($request->input('question6'));
                $strQuestion_6_answer_position = $question_6_answer = '';
                $arrChkBlankLetter6 = [];
                if($request->input('chkBlankLetter6'))
                {
                    if(count($request->input('chkBlankLetter6')) > 0)
                    {
                        $arrChkBlankLetter6 = $request->input('chkBlankLetter6');
                    }     
                }
                if($request->input('blankLetter6'))
                {
                    if(count($request->input('blankLetter6')) > 0)
                    {
                        foreach ($request->input('blankLetter6') as $blankLetter6Key=>$blankLetter6Val)
                        {
                            if(in_array($blankLetter6Key, $arrChkBlankLetter6))
                            {
                                $question_6_answer.=$blankLetter6Val;
                                $strQuestion_6_answer_position.=0;   
                            }
                            else
                            {
                                $strQuestion_6_answer_position.=1;   
                            }
                        }
                    }
                }
                $arr_data['question_6_answer'] = $question_6_answer;
                $arr_data['question_6_answer_position'] = $strQuestion_6_answer_position;
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_18')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion5 == 1)
                    {
                        if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion6 == 1)
                    {
                        if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 19*/
            if($template_id==19)
            {
                /*dd($request->all());*/
                $arr_rules['direction'] = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['answer3']   = 'required';
                $arr_rules['answer4']   = 'required';
                $arr_rules['answer5']   = 'required';
                $arr_rules['answer6']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = $isUploadFLQuestion5 = $isUploadFLQuestion6 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            /*$isUploadFLQuestion3 = 1;*/
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadflQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            /*$isUploadflQuestion5 = 1;*/
                            if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion6'))
                {
                    $fileName = $request->file('flQuestion6');
                    $fileExtension = strtolower($request->file('flQuestion6')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'6.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion6'));
                        $imageThumb->resize(185,121);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion6')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_6_file'] = $fileName;
                            /*$isUploadflQuestion6 = 1;*/
                            if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_6_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_6_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_answer'] = trim($request->input('answer1'));
                $arr_data['question_2_answer'] = trim($request->input('answer2'));
                $arr_data['question_3_answer'] = trim($request->input('answer3'));
                $arr_data['question_4_answer'] = trim($request->input('answer4'));
                $arr_data['question_5_answer'] = trim($request->input('answer5'));
                $arr_data['question_6_answer'] = trim($request->input('answer6'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_19')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion5 == 1)
                    {
                        if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion6 == 1)
                    {
                        if(isset($arrQuestion['question_6_file']) && $arrQuestion['question_6_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_6_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_6_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 20*/
            if($template_id==20)
            {
                $arr_rules['direction']   = 'required';
                $arr_rules['option1_1']   = 'required';
                $arr_rules['option1_2']   = 'required';
                $arr_rules['option1_3']   = 'required';
                $arr_rules['rdoOption1']   = 'required';
                $arr_rules['option2_1']   = 'required';
                $arr_rules['option2_2']   = 'required';
                $arr_rules['option2_3']   = 'required';
                $arr_rules['rdoOption2']   = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_option1'] = trim($request->input('option1_1'));
                $arr_data['question_1_option2'] = trim($request->input('option1_2'));
                $arr_data['question_1_option3'] = trim($request->input('option1_3'));
                $arr_data['question_1_answer'] = trim($request->input('rdoOption1'));
                $arr_data['question_2_option1'] = trim($request->input('option2_1'));
                $arr_data['question_2_option2'] = trim($request->input('option2_2'));
                $arr_data['question_2_option3'] = trim($request->input('option2_3'));
                $arr_data['question_2_answer'] = trim($request->input('rdoOption2'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_20')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/
                    
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 21*/
            if($template_id==21)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['answer3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['answer4']   = 'required';
                $arr_rules['question5']   = 'required';
                $arr_rules['answer5']   = 'required';
                $arr_rules['question6']   = 'required';
                $arr_rules['answer6']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('answer4'));
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('answer5'));
                $arr_data['question_6'] = trim($request->input('question6'));
                $arr_data['answer_6'] = trim($request->input('answer6'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_21')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 22*/
            if($template_id==22)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['answer2']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_22')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 23*/
            if($template_id==23)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_23')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 24*/
            if($template_id==24)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['answer3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['answer4']   = 'required';
                /*$arr_rules['question5']   = 'required';
                $arr_rules['answer5']   = 'required';
                $arr_rules['question6']   = 'required';
                $arr_rules['answer6']   = 'required';
                $arr_rules['question7']   = 'required';
                $arr_rules['answer7']   = 'required';
                $arr_rules['question8']   = 'required';
                $arr_rules['answer8']   = 'required';*/
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('answer4'));
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('answer5'));
                $arr_data['question_6'] = trim($request->input('question6'));
                $arr_data['answer_6'] = trim($request->input('answer6'));
                $arr_data['question_7'] = trim($request->input('question7'));
                $arr_data['answer_7'] = trim($request->input('answer7'));
                $arr_data['question_8'] = trim($request->input('question8'));
                $arr_data['answer_8'] = trim($request->input('answer8'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_24')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 25*/
            if($template_id==25)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = 0;*/

                if($request->hasFile('flQuestion'))
                {
                    $fileName = $request->file('flQuestion');
                    $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp4']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;
                        $isUpload = $request->file('flQuestion')->move($this->question_video_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_video_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_video_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        return json_encode([
                            'errors' => 'flQuestion1',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                    }
                }
                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_25')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_video_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_video_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 26*/
            if($template_id==26)
            {
                $arr_rules['direction'] = 'required';
                $arr_rules['question1'] = 'required';
                $arr_rules['option1_1'] = 'required';
                $arr_rules['option1_2'] = 'required';
                $arr_rules['option1_3'] = 'required';
                $arr_rules['rdoOption1'] = 'required';
                $arr_rules['question2'] = 'required';
                $arr_rules['option2_1'] = 'required';
                $arr_rules['option2_2'] = 'required';
                $arr_rules['option2_3'] = 'required';
                $arr_rules['rdoOption2'] = 'required';
                $arr_rules['question3'] = 'required';
                $arr_rules['option3_1'] = 'required';
                $arr_rules['option3_2'] = 'required';
                $arr_rules['option3_3'] = 'required';
                $arr_rules['rdoOption3'] = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1_text'] = trim($request->input('question1'));
                $arr_data['question_1_option1'] = trim($request->input('option1_1'));
                $arr_data['question_1_option2'] = trim($request->input('option1_2'));
                $arr_data['question_1_option3'] = trim($request->input('option1_3'));
                $arr_data['question_1_answer'] = $request->input('rdoOption1');
                $arr_data['question_2_text'] = trim($request->input('question2'));
                $arr_data['question_2_option1'] = trim($request->input('option2_1'));
                $arr_data['question_2_option2'] = trim($request->input('option2_2'));
                $arr_data['question_2_option3'] = trim($request->input('option2_3'));
                $arr_data['question_2_answer'] = $request->input('rdoOption2');
                $arr_data['question_3_text'] = trim($request->input('question3'));
                $arr_data['question_3_option1'] = trim($request->input('option3_1'));
                $arr_data['question_3_option2'] = trim($request->input('option3_2'));
                $arr_data['question_3_option3'] = trim($request->input('option3_3'));
                $arr_data['question_3_answer'] = $request->input('rdoOption3');
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_26')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 27*/
            if($template_id==27)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['answer3']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_27')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 28*/
            if($template_id==28)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['rdoOption1']   = 'required';
                /*$arr_rules['question2']   = 'required';
                $arr_rules['rdoOption2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['rdoOption3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['rdoOption4']   = 'required';
                $arr_rules['question5']   = 'required';
                $arr_rules['rdoOption5']   = 'required';*/
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('rdoOption1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('rdoOption2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('rdoOption3'));
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('rdoOption4'));
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('rdoOption5'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_28')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 29*/
            if($template_id==29)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['answer']      = 'required|max:1';
                $arr_rules['question1']   = 'required';
                /*$arr_rules['question2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['question5']   = 'required';*/
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['answer'] = trim($request->input('answer'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['question_5'] = trim($request->input('question5'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_29')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 30*/
            if($template_id==30)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['answer2']   = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['answer3']   = 'required';
                $arr_rules['question4']   = 'required';
                $arr_rules['answer4']   = 'required';
                $arr_rules['question5']   = 'required';
                $arr_rules['answer5']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
                $arr_data['question_4'] = trim($request->input('question4'));
                $arr_data['answer_4'] = trim($request->input('answer4'));
                $arr_data['question_5'] = trim($request->input('question5'));
                $arr_data['answer_5'] = trim($request->input('answer5'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_30')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 31*/
            if($template_id==31)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question']   = 'required';
                $arr_rules['answer']      = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                $arr_data['answer'] = trim($request->input('answer'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_31')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 32*/
            if($template_id==32)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question']   = 'required';
                $arr_rules['answer']      = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                $arr_data['answer'] = trim($request->input('answer'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_32')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 33*/
            if($template_id==33)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
    
                $arr_rules['digit1_1']   = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
    
                if($request->input('digit1_1')!='')
                {
                    $arr_data['digit1_1']   = trim($request->input('digit1_1'));
                    $arr_data['operator1']  = trim($request->input('operator1'));
                    $arr_data['digit1_2']   = trim($request->input('digit1_2'));
                    $arr_data['answer1']    = trim($request->input('answer1'));
                }

                if($request->input('digit2_1')!='')
                {
                    $arr_data['digit2_1']   = trim($request->input('digit2_1'));
                    $arr_data['operator2']  = trim($request->input('operator2'));
                    $arr_data['digit2_2']   = trim($request->input('digit2_2'));
                    $arr_data['answer2']    = trim($request->input('answer2'));
                }

                if($request->input('digit3_1')!='')
                {
                    $arr_data['digit3_1']   = trim($request->input('digit3_1'));
                    $arr_data['operator3']  = trim($request->input('operator3'));
                    $arr_data['digit3_2']   = trim($request->input('digit3_2'));
                    $arr_data['answer3']    = trim($request->input('answer3'));
                }
                
                if($request->input('digit4_1')!='')
                {
                    $arr_data['digit4_1']   = trim($request->input('digit4_1'));
                    $arr_data['operator4']  = trim($request->input('operator4'));
                    $arr_data['digit4_2']   = trim($request->input('digit4_2'));
                    $arr_data['answer4']    = trim($request->input('answer4'));
                }

                if($request->input('digit5_1')!='')
                {
                    $arr_data['digit5_1']   = trim($request->input('digit5_1'));
                    $arr_data['operator5']  = trim($request->input('operator5'));
                    $arr_data['digit5_2']   = trim($request->input('digit5_2'));
                    $arr_data['answer5']    = trim($request->input('answer5'));
                }

                if($request->input('digit6_1')!='')
                {
                    $arr_data['digit6_1']   = trim($request->input('digit6_1'));
                    $arr_data['operator6']  = trim($request->input('operator6'));
                    $arr_data['digit6_2']   = trim($request->input('digit6_2'));
                    $arr_data['answer6']    = trim($request->input('answer6'));
                }

                if($request->input('digit7_1')!='')
                {
                    $arr_data['digit7_1']   = trim($request->input('digit7_1'));
                    $arr_data['operator7']  = trim($request->input('operator7'));
                    $arr_data['digit7_2']   = trim($request->input('digit7_2'));
                    $arr_data['answer7']    = trim($request->input('answer7'));
                }

                if($request->input('digit8_1')!='')
                {
                    $arr_data['digit8_1']   = trim($request->input('digit8_1'));
                    $arr_data['operator8']  = trim($request->input('operator8'));
                    $arr_data['digit8_2']   = trim($request->input('digit8_2'));
                    $arr_data['answer8']    = trim($request->input('answer8'));
                }

                if($request->input('digit9_1')!='')
                {
                    $arr_data['digit9_1']   = trim($request->input('digit9_1'));
                    $arr_data['operator9']  = trim($request->input('operator9'));
                    $arr_data['digit9_2']   = trim($request->input('digit9_2'));
                    $arr_data['answer9']    = trim($request->input('answer9'));
                }

                if($request->input('digit10_1')!='')
                {
                    $arr_data['digit10_1']  = trim($request->input('digit10_1'));
                    $arr_data['operator10'] = trim($request->input('operator10'));
                    $arr_data['digit10_2']  = trim($request->input('digit10_2'));
                    $arr_data['answer10']   = trim($request->input('answer10'));
                }

                if($request->input('digit11_1')!='')
                {
                    $arr_data['digit11_1']  = trim($request->input('digit11_1'));
                    $arr_data['operator11'] = trim($request->input('operator11'));
                    $arr_data['digit11_2']  = trim($request->input('digit11_2'));
                    $arr_data['answer11']   = trim($request->input('answer11'));
                }            

                if($request->input('digit12_1')!='')
                {            
                    $arr_data['digit12_1']  = trim($request->input('digit12_1'));
                    $arr_data['operator12'] = trim($request->input('operator12'));
                    $arr_data['digit12_2']  = trim($request->input('digit12_2'));
                    $arr_data['answer12']   = trim($request->input('answer12'));
                }

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_33')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 34*/
            if($template_id==34)
            {
                /*dd($request->all());*/
                $arr_rules['direction']  = 'required';
                $arr_rules['digit1_1']   = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = 0;*/

                if($request->hasFile('flQuestion'))
                {
                    $fileName = $request->file('flQuestion');
                    $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion'));
                        $imageThumb->resize(583,560);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['digit1_1'] = trim($request->input('digit1_1'));
                $arr_data['operator1'] = trim($request->input('operator1'));
                $arr_data['digit1_2'] = trim($request->input('digit1_2'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_34')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 35*/
            if($template_id==35)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                
                $arr_rules['digit1_1']   = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';
                $arr_rules['chkBlankLetter_1'] = 'required';

                /*$arr_rules['digit2_1']   = 'required';
                $arr_rules['operator2']  = 'required';
                $arr_rules['digit2_2']   = 'required';
                $arr_rules['answer2']    = 'required';
                $arr_rules['chkBlankLetter_2'] = 'required';

                $arr_rules['digit3_1']   = 'required';
                $arr_rules['operator3']  = 'required';
                $arr_rules['digit3_2']   = 'required';
                $arr_rules['answer3']    = 'required';
                $arr_rules['chkBlankLetter_3'] = 'required';

                $arr_rules['digit4_1']   = 'required';
                $arr_rules['operator4']  = 'required';
                $arr_rules['digit4_2']   = 'required';
                $arr_rules['answer4']    = 'required';
                $arr_rules['chkBlankLetter_4'] = 'required';

                $arr_rules['digit5_1']   = 'required';
                $arr_rules['operator5']  = 'required';
                $arr_rules['digit5_2']   = 'required';
                $arr_rules['answer5']    = 'required';
                $arr_rules['chkBlankLetter_5'] = 'required';*/

                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion5'))
                {
                    $fileName = $request->file('flQuestion5');
                    $fileExtension = strtolower($request->file('flQuestion5')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'5.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion5'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion5')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_5_file'] = $fileName;
                            if(isset($arrQuestion['question_5_file']) && $arrQuestion['question_5_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_5_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_5_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_5_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }                                           
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));

                $arr_data['digit1_1'] = trim($request->input('digit1_1'));
                $arr_data['operator1'] = trim($request->input('operator1'));
                $arr_data['digit1_2'] = trim($request->input('digit1_2'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                $answer1Position = null;
                if($request->input('chkBlankLetter_1'))
                {
                    if(count($request->input('chkBlankLetter_1')) > 0)
                    {
                        for ($i=1; $i <= 3; $i++)
                        { 
                            if(in_array($i, $request->input('chkBlankLetter_1')))
                            {
                                $answer1Position.='0';   
                            }
                            else
                            {
                                $answer1Position.='1';
                            }
                        }
                    }
                }
                $arr_data['answer1Position'] = $answer1Position;

                if($request->has('digit2_1') && $request->input('digit2_1')!=''){
                    $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                    $arr_data['operator2'] = trim($request->input('operator2'));
                    $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                    $arr_data['answer2'] = trim($request->input('answer2'));
                    $answer2Position = null;
                    if($request->input('chkBlankLetter_2'))
                    {
                        if(count($request->input('chkBlankLetter_2')) > 0)
                        {
                            for ($i=1; $i <= 3; $i++)
                            { 
                                if(in_array($i, $request->input('chkBlankLetter_2')))
                                {
                                    $answer2Position.='0';   
                                }
                                else
                                {
                                    $answer2Position.='1';
                                }
                            }
                        }
                    }
                    $arr_data['answer2Position'] = $answer2Position;
                }

                if($request->has('digit3_1') && $request->input('digit3_1')!=''){
                    $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                    $arr_data['operator3'] = trim($request->input('operator3'));
                    $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                    $arr_data['answer3'] = trim($request->input('answer3'));
                    $answer3Position = null;
                    if($request->input('chkBlankLetter_3'))
                    {
                        if(count($request->input('chkBlankLetter_3')) > 0)
                        {
                            for ($i=1; $i <= 3; $i++)
                            { 
                                if(in_array($i, $request->input('chkBlankLetter_3')))
                                {
                                    $answer3Position.='0';   
                                }
                                else
                                {
                                    $answer3Position.='1';
                                }
                            }
                        }
                    }
                    $arr_data['answer3Position'] = $answer3Position;
                }
                
                if($request->has('digit4_1') && $request->input('digit4_1')!=''){
                    $arr_data['digit4_1'] = trim($request->input('digit4_1'));
                    $arr_data['operator4'] = trim($request->input('operator4'));
                    $arr_data['digit4_2'] = trim($request->input('digit4_2'));
                    $arr_data['answer4'] = trim($request->input('answer4'));
                    $answer4Position = null;
                    if($request->input('chkBlankLetter_4'))
                    {
                        if(count($request->input('chkBlankLetter_4')) > 0)
                        {
                            for ($i=1; $i <= 3; $i++)
                            { 
                                if(in_array($i, $request->input('chkBlankLetter_4')))
                                {
                                    $answer4Position.='0';   
                                }
                                else
                                {
                                    $answer4Position.='1';
                                }
                            }
                        }
                    }
                    $arr_data['answer4Position'] = $answer4Position;
                }
                
                if($request->has('digit5_1') && $request->input('digit5_1')!=''){
                    $arr_data['digit5_1'] = trim($request->input('digit5_1'));
                    $arr_data['operator5'] = trim($request->input('operator5'));
                    $arr_data['digit5_2'] = trim($request->input('digit5_2'));
                    $arr_data['answer5'] = trim($request->input('answer5'));
                    $answer5Position = null;
                    if($request->input('chkBlankLetter_5'))
                    {
                        if(count($request->input('chkBlankLetter_5')) > 0)
                        {
                            for ($i=1; $i <= 3; $i++)
                            { 
                                if(in_array($i, $request->input('chkBlankLetter_5')))
                                {
                                    $answer5Position.='0';   
                                }
                                else
                                {
                                    $answer5Position.='1';
                                }
                            }
                        }
                    }
                    $arr_data['answer5Position'] = $answer5Position;
                }

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                $result = DB::table('template_35')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 36*/
            if($template_id==36)
            {
                /*dd($request->all());*/
                $arr_rules['direction']  = 'required';
                $arr_rules['answer']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['answer'] = trim($request->input('answer'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_36')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 37*/
            if($template_id==37)
            {
                /*dd($request->all());*/
                $arr_rules['direction']  = 'required';

                $arr_rules['digit1_1']   = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';
                /*$arr_rules['duration'] = 'required';*/

                if($request->hasFile('flQuestion2'))
                {
                    $arr_rules['digit2_1']   = 'required';
                    $arr_rules['operator2']  = 'required';
                    $arr_rules['digit2_2']   = 'required';
                    $arr_rules['answer2']    = 'required';                
                }
                if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
                {
                    $arr_rules['digit2_1']   = 'required';
                    $arr_rules['operator2']  = 'required';
                    $arr_rules['digit2_2']   = 'required';
                    $arr_rules['answer2']    = 'required';                   
                }

                if($request->hasFile('flQuestion3'))
                {
                    $arr_rules['digit3_1']   = 'required';
                    $arr_rules['operator3']  = 'required';
                    $arr_rules['digit3_2']   = 'required';
                    $arr_rules['answer3']    = 'required';                
                }
                if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
                {
                    $arr_rules['digit3_1']   = 'required';
                    $arr_rules['operator3']  = 'required';
                    $arr_rules['digit3_2']   = 'required';
                    $arr_rules['answer3']    = 'required';                   
                }

                if($request->hasFile('flQuestion4'))
                {
                    $arr_rules['digit4_1']   = 'required';
                    $arr_rules['operator4']  = 'required';
                    $arr_rules['digit4_2']   = 'required';
                    $arr_rules['answer4']    = 'required';                
                }
                if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
                {
                    $arr_rules['digit4_1']   = 'required';
                    $arr_rules['operator4']  = 'required';
                    $arr_rules['digit4_2']   = 'required';
                    $arr_rules['answer4']    = 'required';                   
                }

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = $isUploadFLQuestion3 = $isUploadFLQuestion4 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(504,67);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(504,67);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion3'))
                {
                    $fileName = $request->file('flQuestion3');
                    $fileExtension = strtolower($request->file('flQuestion3')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'3.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion3'));
                        $imageThumb->resize(504,67);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion3')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_3_file'] = $fileName;
                            $isUploadFLQuestion3 = 1;
                            if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_3_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_3_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion4'))
                {
                    $fileName = $request->file('flQuestion4');
                    $fileExtension = strtolower($request->file('flQuestion4')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'4.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion4'));
                        $imageThumb->resize(504,67);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);
                        
                        $isUpload = $request->file('flQuestion4')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_4_file'] = $fileName;
                            /*$isUploadFLQuestion4 = 1;*/
                            if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_4_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_4_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));

                $arr_data['digit1_1'] = trim($request->input('digit1_1'));
                $arr_data['operator1'] = trim($request->input('operator1'));
                $arr_data['digit1_2'] = trim($request->input('digit1_2'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                if($request->input('digit2_1'))
                {
                    $arr_data['digit2_1'] = trim($request->input('digit2_1'));
                }
                if($request->input('operator2'))
                {
                    $arr_data['operator2'] = trim($request->input('operator2'));
                }
                if($request->input('digit2_2'))
                {
                    $arr_data['digit2_2'] = trim($request->input('digit2_2'));
                }
                if($request->input('answer2'))
                {
                    $arr_data['answer2'] = trim($request->input('answer2'));
                }

                if($request->input('digit3_1'))
                {
                    $arr_data['digit3_1'] = trim($request->input('digit3_1'));
                }
                if($request->input('operator3'))
                {
                    $arr_data['operator3'] = trim($request->input('operator3'));
                }
                if($request->input('digit3_2'))
                {
                    $arr_data['digit3_2'] = trim($request->input('digit3_2'));
                }
                if($request->input('answer3'))
                {
                    $arr_data['answer3'] = trim($request->input('answer3'));
                }

                if($request->input('digit4_1'))
                {
                    $arr_data['digit4_1'] = trim($request->input('digit4_1'));
                }
                if($request->input('operator4'))
                {
                    $arr_data['operator4'] = trim($request->input('operator4'));
                }
                if($request->input('digit4_2'))
                {
                    $arr_data['digit4_2'] = trim($request->input('digit4_2'));
                }
                if($request->input('answer4'))
                {
                    $arr_data['answer4'] = trim($request->input('answer4'));
                }
                
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_37')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion3 == 1)
                    {
                        if(isset($arrQuestion['question_3_file']) && $arrQuestion['question_3_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_3_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_3_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion4 == 1)
                    {
                        if(isset($arrQuestion['question_4_file']) && $arrQuestion['question_4_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_4_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_4_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 38*/
            if($template_id==38)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(498,384);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $question2 = null;
                if($request->input('question2'))
                {
                    $question2 = $request->input('question2');
                }
                $arr_data['question_2'] = $question2;
                $answer2 = null;
                if($request->input('answer2'))
                {
                    $answer2 = $request->input('answer2');
                }
                $arr_data['answer_2'] = $answer2;
                $question3 = null;
                if($request->input('question3'))
                {
                    $question3 = $request->input('question3');    
                }
                $arr_data['question_3'] = $question3;
                $answer3 = null;
                if($request->input('answer3'))
                {
                    $answer3 = $request->input('answer3');
                }
                $arr_data['answer_3'] = $answer3;
                $question4 = null;
                if($request->input('question4'))
                {
                    $question4 = $request->input('question4');
                }
                $arr_data['question_4'] = $question4;
                $answer4 = null;
                if($request->input('answer4'))
                {
                    $answer4 = $request->input('answer4');
                }
                $arr_data['answer_4'] = $answer4;

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_38')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
                
            }
            /*TEMPLATE : 39*/
            if($template_id==39)
            {
                $arr_rules['direction']   = 'required';
                $arr_rules['duration']    = 'required';
                
                $arr_rules['digit1_1']   = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';

                if($request->input('digit2_1') || $request->input('operator2') || $request->input('digit2_2') || $request->input('answer2'))
                {
                    $arr_rules['digit2_1']   = 'required';
                    $arr_rules['operator2']  = 'required';
                    $arr_rules['digit2_2']   = 'required';
                    $arr_rules['answer2']    = 'required';
                }

                if($request->input('digit3_1') || $request->input('operator3') || $request->input('digit3_2') || $request->input('answer3'))
                {
                    $arr_rules['digit3_1']   = 'required';
                    $arr_rules['operator3']  = 'required';
                    $arr_rules['digit3_2']   = 'required';
                    $arr_rules['answer3']    = 'required';
                }


                if($request->input('digit4_1') || $request->input('operator4') || $request->input('digit4_2') || $request->input('answer4'))
                {
                    $arr_rules['digit4_1']   = 'required';
                    $arr_rules['operator4']  = 'required';
                    $arr_rules['digit4_2']   = 'required';
                    $arr_rules['answer4']    = 'required';
                }

                if($request->input('digit5_1') || $request->input('operator5') || $request->input('digit5_2') || $request->input('answer5'))
                {
                    $arr_rules['digit5_1']   = 'required';
                    $arr_rules['operator5']  = 'required';
                    $arr_rules['digit5_2']   = 'required';
                    $arr_rules['answer5']    = 'required';
                }

                if($request->input('digit6_1') || $request->input('operator6') || $request->input('digit6_2') || $request->input('answer6'))
                {
                    $arr_rules['digit6_1']   = 'required';
                    $arr_rules['operator6']  = 'required';
                    $arr_rules['digit6_2']   = 'required';
                    $arr_rules['answer6']    = 'required';
                }

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
    
                $arr_data['digit1_1'] = trim($request->input('digit1_1'));
                $arr_data['operator1'] = trim($request->input('operator1'));
                $arr_data['digit1_2'] = trim($request->input('digit1_2'));
                $arr_data['answer1'] = trim($request->input('answer1'));

                $digit2_1 = null;
                if($request->input('digit2_1'))
                {
                    $digit2_1 = trim($request->input('digit2_1'));
                }
                $arr_data['digit2_1'] = $digit2_1;
                $operator2 = null;
                if($request->input('operator2'))
                {
                    $operator2 = trim($request->input('operator2'));
                }
                $arr_data['operator2'] = $operator2;
                $digit2_2 = null;
                if($request->input('digit2_2'))
                {
                    $digit2_2 = trim($request->input('digit2_2'));
                }
                $arr_data['digit2_2'] = $digit2_2;
                $answer2 = null;
                if($request->input('answer2'))
                {
                    $answer2 = trim($request->input('answer2'));
                }
                $arr_data['answer2'] = $answer2;

                $digit3_1 = null;
                if($request->input('digit3_1'))
                {
                    $digit3_1 = trim($request->input('digit3_1'));
                }
                $arr_data['digit3_1'] = $digit3_1;
                $operator3 = null;
                if($request->input('operator3'))
                {
                    $operator3 = trim($request->input('operator3'));
                }
                $arr_data['operator3'] = $operator3;
                $digit3_2 = null;
                if($request->input('digit3_2'))
                {
                    $digit3_2 = trim($request->input('digit3_2'));
                }
                $arr_data['digit3_2'] = $digit3_2;
                $answer3 = null;
                if($request->input('answer3'))
                {
                    $answer3 = trim($request->input('answer3'));
                }
                $arr_data['answer3'] = $answer3;
                
                $digit4_1 = null;
                if($request->input('digit4_1'))
                {
                    $digit4_1 = trim($request->input('digit4_1'));
                }
                $arr_data['digit4_1'] = $digit4_1;
                $operator4 = null;
                if($request->input('operator4'))
                {
                    $operator4 = trim($request->input('operator4'));
                }
                $arr_data['operator4'] = $operator4;
                $digit4_2 = null;
                if($request->input('digit4_2'))
                {
                    $digit4_2 = trim($request->input('digit4_2'));
                }
                $arr_data['digit4_2'] = $digit4_2;
                $answer4 = null;
                if($request->input('answer4'))
                {
                    $answer4 = trim($request->input('answer4'));
                }
                $arr_data['answer4'] = $answer4;

                $digit5_1 = null;
                if($request->input('digit5_1'))
                {
                    $digit5_1 = trim($request->input('digit5_1'));
                }
                $arr_data['digit5_1'] = $digit5_1;
                $operator5 = null;
                if($request->input('operator5'))
                {
                    $operator5 = trim($request->input('operator5'));
                }
                $arr_data['operator5'] = $operator5;
                $digit5_2 = null;
                if($request->input('digit5_2'))
                {
                    $digit5_2 = trim($request->input('digit5_2'));
                }
                $arr_data['digit5_2'] = $digit5_2;
                $answer5 = null;
                if($request->input('answer5'))
                {
                    $answer5 = trim($request->input('answer5'));
                }
                $arr_data['answer5'] = $answer5;

                $digit6_1 = null;
                if($request->input('digit6_1'))
                {
                    $digit6_1 = trim($request->input('digit6_1'));
                }
                $arr_data['digit6_1'] = $digit6_1;
                $operator6 = null;
                if($request->input('operator6'))
                {
                    $operator6 = trim($request->input('operator6'));
                }
                $arr_data['operator6'] = $operator6;
                $digit6_2 = null;
                if($request->input('digit6_2'))
                {
                    $digit6_2 = trim($request->input('digit6_2'));
                }
                $arr_data['digit6_2'] = $digit6_2;
                $answer6 = null;
                if($request->input('answer6'))
                {
                    $answer6 = trim($request->input('answer6'));
                }
                $arr_data['answer6'] = $answer6;

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_39')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 40*/
            if($template_id==40)
            {
                $arr_rules['direction']   = 'required';
    
                $arr_rules['question1_1']   = 'required';
                $arr_rules['question1_2']   = 'required';
                $arr_rules['operator1']   = 'required';

                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));

                $arr_data['question1_1'] = trim($request->input('question1_1'));
                $arr_data['question1_2'] = trim($request->input('question1_2'));
                $arr_data['answer_1'] = trim($request->input('operator1'));
                
                $arr_data['question2_1'] = trim($request->input('question2_1',''));
                $arr_data['question2_2'] = trim($request->input('question2_2',''));
                $arr_data['answer_2'] = trim($request->input('operator2',''));

                $arr_data['question3_1'] = trim($request->input('question3_1',''));
                $arr_data['question3_2'] = trim($request->input('question3_2',''));
                $arr_data['answer_3'] = trim($request->input('operator3',''));

                $arr_data['question4_1'] = trim($request->input('question4_1',''));
                $arr_data['question4_2'] = trim($request->input('question4_2',''));
                $arr_data['answer_4'] = trim($request->input('operator4',''));

                $arr_data['question5_1'] = trim($request->input('question5_1',''));
                $arr_data['question5_2'] = trim($request->input('question5_2',''));
                $arr_data['answer_5'] = trim($request->input('operator5',''));
                
                $arr_data['question6_1'] = trim($request->input('question6_1',''));
                $arr_data['question6_2'] = trim($request->input('question6_2',''));
                $arr_data['answer_6'] = trim($request->input('operator6',''));

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_40')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 41*/
            if($template_id==41)
            {
                $arr_rules['direction']     = 'required';
                $arr_rules['question1_1']   = 'required';
                $arr_rules['question1_2']   = 'required';
                $arr_rules['operator1']     = 'required';


                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question']    = trim($request->input('direction'));

                $arr_data['question1_1'] = trim($request->input('question1_1',''));
                $arr_data['question1_2'] = trim($request->input('question1_2',''));
                $arr_data['answer_1']    = trim($request->input('operator1',''));
                
                $arr_data['question2_1'] = trim($request->input('question2_1',''));
                $arr_data['question2_2'] = trim($request->input('question2_2',''));
                $arr_data['answer_2']    = trim($request->input('operator2',''));

                $arr_data['question3_1'] = trim($request->input('question3_1',''));
                $arr_data['question3_2'] = trim($request->input('question3_2',''));
                $arr_data['answer_3']    = trim($request->input('operator3',''));

                $question4_1 = null;
                if($request->input('question4_1'))
                {
                    $question4_1 = $request->input('question4_1');
                }
                $arr_data['question4_1'] = $question4_1;
                $question4_2 = null;
                if($request->input('question4_2'))
                {
                    $question4_2 = $request->input('question4_2');
                }
                $arr_data['question4_2'] = $question4_2;
                $operator4 = null;
                if($request->input('operator4'))
                {
                    $operator4 = $request->input('operator4');
                }
                $arr_data['answer_4'] = $operator4;

                $question5_1 = null;
                if($request->input('question5_1'))
                {
                    $question5_1 = $request->input('question5_1');
                }
                $arr_data['question5_1'] = $question5_1;
                $question5_2 = null;
                if($request->input('question5_2'))
                {
                    $question5_2 = $request->input('question5_2');
                }
                $arr_data['question5_2'] = $question5_2;
                $operator5 = null;
                if($request->input('operator5'))
                {
                    $operator5 = $request->input('operator5');
                }
                $arr_data['answer_5'] = $operator5;
                
                $question6_1 = null;
                if($request->input('question6_1'))
                {
                    $question6_1 = $request->input('question6_1');
                }
                $arr_data['question6_1'] = $question6_1;
                $question6_2 = null;
                if($request->input('question6_2'))
                {
                    $question6_2 = $request->input('question6_2');
                }
                $arr_data['question6_2'] = $question6_2;
                $operator6 = null;
                if($request->input('operator6'))
                {
                    $operator6 = $request->input('operator6');
                }
                $arr_data['answer_6'] = $operator6;

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_41')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 42*/
            if($template_id==42)
            {
                $arr_rules['direction']   = 'required';
    
                $arr_rules['question1_1']   = 'required';
                $arr_rules['answer1_1']   = 'required';
                $arr_rules['answer1_2']   = 'required';
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));

                $arr_data['question1'] = trim($request->input('question1_1'));
                $arr_data['answer1'] = trim($request->input('answer1_1','')).','.trim($request->input('answer1_2',''));

                $arr_data['question2'] = trim($request->input('question2_1',''));
                $arr_data['answer2'] = trim($request->input('answer2_1','')).','.trim($request->input('answer2_2',''));
                
                $arr_data['question3'] = trim($request->input('question3_1',''));
                $arr_data['answer3'] = trim($request->input('answer3_1','')).','.trim($request->input('answer3_2',''));

                $question4 = null;
                if($request->input('question4_1'))
                {
                    $question4 = $request->input('question4_1');
                }
                $arr_data['question4'] = $question4;
                $answer4 = null;
                if($request->input('answer4_1') && $request->input('answer4_2'))
                {
                    $answer4 = $request->input('answer4_1').','.$request->input('answer4_2');
                }
                $arr_data['answer4'] = $answer4;
                
                $question5 = null;
                if($request->input('question5_1'))
                {
                    $question5 = $request->input('question5_1');
                }
                $arr_data['question5'] = $question5;
                $answer5 = null;
                if($request->input('answer5_1') && $request->input('answer5_2'))
                {
                    $answer5 = $request->input('answer5_1').','.$request->input('answer5_2');
                }
                $arr_data['answer5'] = $answer5;

                $question6 = null;
                if($request->input('question6_1'))
                {
                    $question6 = $request->input('question6_1');
                }
                $arr_data['question6'] = $question6;
                $answer6 = null;
                if($request->input('answer6_1') && $request->input('answer6_2'))
                {
                    $answer6 = $request->input('answer6_1').','.$request->input('answer6_2');
                }
                $arr_data['answer6'] = $answer6;

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_42')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 43*/
            if($template_id==43)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']      = 'required';
                /*$arr_rules['question2']   = 'required';
                $arr_rules['answer2']      = 'required';
                $arr_rules['question3']   = 'required';
                $arr_rules['answer3']      = 'required';*/
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = 0;*/

                if($request->hasFile('flQuestion'))
                {
                    $fileName = $request->file('flQuestion');
                    $fileExtension = strtolower($request->file('flQuestion')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion'));
                        $imageThumb->resize(570,540);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1'] = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2'));
                $arr_data['answer_2'] = trim($request->input('answer2'));
                $arr_data['question_3'] = trim($request->input('question3'));
                $arr_data['answer_3'] = trim($request->input('answer3'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_43')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 44*/
            if($template_id==44)
            {
                /*dd($request->all());*/
                $arr_rules['direction']  = 'required';
                $arr_rules['digit1_1']   = 'required';
                $arr_rules['row']        = 'required';
                $arr_rules['column']     = 'required';
                $arr_rules['operator1']  = 'required';
                $arr_rules['digit1_2']   = 'required';
                $arr_rules['answer1']    = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['digit1_1'] = trim($request->input('digit1_1'));
                $arr_data['table_from'] = trim($request->input('row'));
                $arr_data['table_to'] = trim($request->input('column'));
                $arr_data['operator1'] = trim($request->input('operator1'));
                $arr_data['digit1_2'] = trim($request->input('digit1_2'));
                $arr_data['answer1'] = trim($request->input('answer1'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_44')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 45*/
            if($template_id==45)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
    
                $arr_rules['question1_1']   = 'required';
                $arr_rules['answer1_1']      = 'required';
                /*$arr_rules['question1_2']   = 'required';
                $arr_rules['answer1_2']      = 'required';
                $arr_rules['question1_3']   = 'required';
                $arr_rules['answer1_3']      = 'required';*/

                $arr_rules['question2_1']   = 'required';
                $arr_rules['answer2_1']      = 'required';
                /*$arr_rules['question2_2']   = 'required';
                $arr_rules['answer2_2']      = 'required';
                $arr_rules['question2_3']   = 'required';
                $arr_rules['answer2_3']      = 'required';*/
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = $isUploadFLQuestion2 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(429,269);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_1_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_1_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_1_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                if($request->hasFile('flQuestion2'))
                {
                    $fileName = $request->file('flQuestion2');
                    $fileExtension = strtolower($request->file('flQuestion2')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'2.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion2'));
                        $imageThumb->resize(429,269);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion2')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_2_file'] = $fileName;
                            /*$isUploadFLQuestion2 = 1;*/
                            if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_2_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_2_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));

                $arr_data['question1_1'] = trim($request->input('question1_1'));
                $arr_data['answer1_1'] = trim($request->input('answer1_1'));
                $arr_data['question1_2'] = trim($request->input('question1_2'));
                $arr_data['answer1_2'] = trim($request->input('answer1_2'));
                $arr_data['question1_3'] = trim($request->input('question1_3'));
                $arr_data['answer1_3'] = trim($request->input('answer1_3'));

                $arr_data['question2_1'] = trim($request->input('question2_1'));
                $arr_data['answer2_1'] = trim($request->input('answer2_1'));
                $arr_data['question2_2'] = trim($request->input('question2_2'));
                $arr_data['answer2_2'] = trim($request->input('answer2_2'));
                $arr_data['question2_3'] = trim($request->input('question2_3'));
                $arr_data['answer2_3'] = trim($request->input('answer2_3'));

                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_45')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_1_file']) && $arrQuestion['question_1_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_1_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_1_file']);
                            }
                        }
                    }
                    if($isUploadFLQuestion2 == 1)
                    {
                        if(isset($arrQuestion['question_2_file']) && $arrQuestion['question_2_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_2_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_2_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 46*/
            if($template_id==46)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['answer1']   = 'required';

                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*$isUploadFLQuestion1 = 0;*/

                if($request->hasFile('flQuestion1'))
                {
                    $fileName = $request->file('flQuestion1');
                    $fileExtension = strtolower($request->file('flQuestion1')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['jpg','jpeg','png']))
                    {
                        $fileName = date('dmY').time().'1.'.$fileExtension;

                        $imageThumb = Image::make($request->file('flQuestion1'));
                        $imageThumb->resize(570,442);
                        $imageThumb->save($this->question_image_thumb_base_path.$fileName);

                        $isUpload = $request->file('flQuestion1')->move($this->question_image_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['question_file'] = $fileName;
                            /*$isUploadFLQuestion1 = 1;*/
                            if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                            {
                                if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                                }
                                if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_file']))
                                {
                                    @unlink($this->question_image_thumb_base_path.$arrQuestion['question_file']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error','Invalid file type');
                        return redirect()->back()->withInput();
                    }
                }
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question']   = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question1'));
                $arr_data['answer_1']   = trim($request->input('answer1'));
                $arr_data['question_2'] = trim($request->input('question2',''));
                $arr_data['answer_2']   = trim($request->input('answer2',''));
                $arr_data['question_3'] = trim($request->input('question3',''));
                $arr_data['answer_3']   = trim($request->input('answer3',''));
                $arr_data['question_4'] = trim($request->input('question4',''));
                $arr_data['answer_4']   = trim($request->input('answer4',''));
                $arr_data['question_5'] = trim($request->input('question5',''));
                $arr_data['answer_5']   = trim($request->input('answer5',''));
                $arr_data['question_6'] = trim($request->input('question6',''));
                $arr_data['answer_6']   = trim($request->input('answer6',''));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_46')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    /*if($isUploadFLQuestion1 == 1)
                    {
                        if(isset($arrQuestion['question_file']) && $arrQuestion['question_file']!='')
                        {
                            if(file_exists($this->question_image_base_path.$arrQuestion['question_file']))
                            {
                                @unlink($this->question_image_base_path.$arrQuestion['question_file']);
                            }
                        }
                    }*/

                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 47*/
            if($template_id==47)
            {
                /*dump($request->all());*/
                $arr_rules['direction'] = 'required';
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                } 

                if(!$request->input('chkBlankLetter'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                if(!$request->input('question'))
                {
                    Session::flash('error', 'Please enter all question values.');
                    return redirect()->back();
                }

                $strQuestionText = $strAnswerText = '';
                if($request->input('question'))
                {
                    if(count($request->input('question')) > 0)
                    {
                        $arrCnt = 1;
                        foreach ($request->input('question') as $questionVal)
                        {
                            if($request->input('chkBlankLetter'))
                            {
                                if(count($request->input('chkBlankLetter')) > 0)
                                {
                                    if(in_array($arrCnt, $request->input('chkBlankLetter')))
                                    {
                                        $strAnswerText.='0'.',';
                                    }
                                    else
                                    {
                                        $strAnswerText.='1'.',';
                                    }
                                }
                            }
                            else
                            {
                                $strAnswerText.='1'.',';
                            }
                            $strQuestionText.=$questionVal.',';
                            $arrCnt++;
                        }
                    }   
                }
                $strQuestionText = rtrim($strQuestionText, ',');
                $strAnswerText   = rtrim($strAnswerText, ',');

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_text'] = $strQuestionText;
                $arr_data['answer']        = $strAnswerText;
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }
                /*dd($arr_data);*/
                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_47')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }

            }
            /*TEMPLATE : 48*/
            if($template_id==48)
            {
                /*dump($request->all());*/
                $arr_rules['direction'] = 'required';
                $arr_rules['question'] = 'required';   
                /*$arr_rules['duration'] = 'required';*/

                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                } 

                if(!$request->input('blankLetter'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }
                
                if(!$request->input('chkBlankLetter'))
                {
                    Session::flash('error', 'Please checked atleast one checkbox.');
                    return redirect()->back();
                }

                $strAns = '';
                if(count($request->input('blankLetter')) > 0)
                {
                    foreach ($request->input('blankLetter') as $blankLetterKey => $blankLetterVal)
                    {
                        if(in_array($blankLetterKey, $request->input('chkBlankLetter')))
                        {
                            $strAns.=0;
                        }
                        else
                        {
                            $strAns.=1;
                        }
                    }
                }
                if($strAns=='')
                {
                    return json_encode([
                            'errors' => 'chkBlankLetter',
                            'code' => 422,
                            'status' => 'fail',
                        ]);
                }
                else
                {
                    $arr_data['answer_position'] = $strAns;
                }
                
                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                
                $result = DB::table('template_48')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 49*/
            if($template_id==49)
            {
                $arr_rules['direction']   = 'required';
                $arr_rules['question']   = 'required';
                $arr_rules['option_1']   = 'required';
                $arr_rules['rdoOption']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/
                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = trim($request->input('question'));
                $arr_data['option_1'] = trim($request->input('option_1',''));
                $arr_data['option_2'] = trim($request->input('option_2',''));
                $arr_data['option_3'] = trim($request->input('option_3',''));
                $arr_data['option_4'] = trim($request->input('option_4',''));
                $arr_data['answer'] = trim($request->input('rdoOption'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_49')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
            /*TEMPLATE : 50*/
            if($template_id==50)
            {
                /*dd($request->all());*/
                $arr_rules['direction']   = 'required';
                $arr_rules['question1']   = 'required';
                $arr_rules['question2']   = 'required';
                $arr_rules['option_1']   = 'required';
                $arr_rules['rdoOption1']   = 'required';
                /*$arr_rules['duration'] = 'required';*/
                
                $validator = Validator::make($request->all(), $arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withInput()->withErrors($validator);
                }

                /*if($request->hasFile('flHorn'))
                {
                    $fileName = $request->file('flHorn');
                    $fileExtension = strtolower($request->file('flHorn')->getClientOriginalExtension());
                    if(in_array($fileExtension, ['mp3','wave','m4a']))
                    {
                        $fileName = date('dmY').time().'.'.$fileExtension;
                        $isUpload = $request->file('flHorn')->move($this->question_audio_base_path, $fileName);
                        if($isUpload)
                        {
                            $arr_data['horn'] = $fileName;
                            if(isset($arrQuestion['horn']) && $arrQuestion['horn']!='')
                            {
                                if(file_exists($this->question_audio_base_path.$arrQuestion['horn']))
                                {
                                    @unlink($this->question_audio_base_path.$arrQuestion['horn']);
                                }
                            }
                        }
                    }
                    else
                    {
                        Session::flash('error', 'Invalid file type.');
                        return redirect()->back()->withInput();
                    }
                }*/

                $arr_data['question'] = trim($request->input('direction'));
                $arr_data['question_1'] = date('H:i', strtotime($request->input('question1')));
                $arr_data['question_2'] = date('H:i', strtotime($request->input('question2')));
                $arr_data['option_1'] = trim($request->input('option_1',''));
                $arr_data['option_2'] = trim($request->input('option_2',''));
                $arr_data['option_3'] = trim($request->input('option_3',''));
                $arr_data['option_4'] = trim($request->input('option_4',''));
                $arr_data['answer'] = trim($request->input('rdoOption1'));
                if($request->input('duration'))
                {
                    $arr_data['duration'] = gmdate('H:i:s', $request->input('duration'));
                }

                /*$result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);*/

                /**
                 * USED a DB Query : Because it get actualy hit to Database or not
                 * Purpose of PROGRAM-APPROVE STATUS change as pending or not
                 */
                $result = DB::table('template_50')->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    //$resultChangeProgramApproveStatus = $this->changeProgramApproveStatus($programId);

                    Session::flash('success', 'Record updated successfully.');
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$template_id.'/'.base64_encode($questionId));
                }
                else
                {
                    Session::flash('warning', 'There is no change in submitted values.');
                    return redirect()->back();
                }
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function deleteQuestionOption($program_id='',$template_id='',$question_id='', $option='')
    {
        if($program_id!='' && $template_id!='' && $question_id!='' && $option!='')
        {
            $programId = base64_decode($program_id);
            $templateId = base64_decode($template_id);
            $questionId = base64_decode($question_id);
            /*dd($programId,$templateId,$questionId,$file_type,$file,$file_name);*/
            $modelName = 'Template'.$templateId.'Model';
            $isQuestionExist = $this->$modelName->where('id', '=', $questionId)->count();
            if($isQuestionExist == 1)
            {
                $arrQuestion = $this->$modelName->where('id', '=', $questionId)
                                                ->first();
                /*dd($arrQuestion->toArray());*/
                if($option==2)
                {
                    $arr_data['question_2_file'] = null;
                    $arr_data['digit2_1'] = null;
                    $arr_data['operator2'] = null;
                    $arr_data['digit2_2'] = null;
                    $arr_data['answer2'] = null;
                }
                if($option==3)
                {
                    $arr_data['question_3_file'] = null;
                    $arr_data['digit3_1'] = null;
                    $arr_data['operator3'] = null;
                    $arr_data['digit3_2'] = null;
                    $arr_data['answer3'] = null;
                }
                if($option==4)
                {
                    $arr_data['question_4_file'] = null;
                    $arr_data['digit4_1'] = null;
                    $arr_data['operator4'] = null;
                    $arr_data['digit4_2'] = null;
                    $arr_data['answer4'] = null;
                }
                $result = $this->$modelName->where('id', '=', $questionId)->update($arr_data);
                if($result)
                {
                    if(isset($arrQuestion['question_'.$option.'_file']))
                    {
                        if(file_exists($this->question_image_base_path.$arrQuestion['question_'.$option.'_file']))
                        {
                            @unlink($this->question_image_base_path.$arrQuestion['question_'.$option.'_file']);
                        }
                        if(file_exists($this->question_image_thumb_base_path.$arrQuestion['question_'.$option.'_file']))
                        {
                            @unlink($this->question_image_thumb_base_path.$arrQuestion['question_'.$option.'_file']);
                        }
                    }
                    return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$templateId.'/'.base64_encode($questionId));
                }
            }
            else
            {
                Session::flash('error','File not found.');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error','Problem occured while deleting an option.');
            return redirect()->back();
        }
    }

    public function deleteQuestionFile($program_id='',$template_id='',$question_id='', $file_type='', $file='', $file_name='')
    {
        if($program_id!='' && $template_id!='' && $question_id!='' && $file_type!='' && $file!='' && $file_name!='')
        {
            $programId = base64_decode($program_id);
            $templateId = base64_decode($template_id);
            $questionId = base64_decode($question_id);
            /*dd($programId,$templateId,$questionId,$file_type,$file,$file_name);*/
            $modelName = 'Template'.$templateId.'Model';
            $isQuestionExist = $this->$modelName->where('id', '=', $questionId)->count();
            if($isQuestionExist == 1)
            {
                if($file_type=='image')
                {
                    if(file_exists($this->question_image_base_path.$file_name))
                    {
                        @unlink($this->question_image_base_path.$file_name);

                        if(file_exists($this->question_image_thumb_base_path.$file_name))
                        {
                            @unlink($this->question_image_thumb_base_path.$file_name);
                        }

                        Session::flash('success','File deleted successfully.');
                        return redirect($this->module_url_path.'/question/edit/'.base64_encode($programId).'/'.$templateId.'/'.base64_encode($questionId));
                    }
                    else
                    {
                        Session::flash('error','File not found.');
                        return redirect()->back();
                    }
                }
            }
            else
            {
                Session::flash('error','File not found.');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error','Problem occured while deleting a file.');
            return redirect()->back();
        }
    }

    public function approveProgramStatus($enc_id='')
    {
        if($enc_id!='')
        {
            $programId = base64_decode($enc_id);
            $isExist = $this->BaseModel->where('id', '=', $programId)->count();
            if($isExist==0)
            {
                session::flash('error', 'Record not found.');
                return redirect()->back();
            }
            else
            {
                $result = $this->BaseModel->where('id', '=', $programId)->update(['approve_status'=>'approved']);
                if($result)
                {
                    $resultSendNotification = $this->sendNotification($programId,'approved');

                    session::flash('success', 'Record updated successfully.');   
                    return redirect($this->module_url_path);
                }
                else
                {
                    session::flash('error', 'Problem occured while updating a record.');
                    return redirect()->back();
                }
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    public function rejectProgramStatus($enc_id='', Request $request)
    {
        $userId = login_user_id('supervisor');
        
        $resp['status'] = 'error';

        if($enc_id=='')
        {
            return json_encode([
                'errors' => 'error',
                'code' => 422,
                'status' => 'error',
            ]);
        }
        
        $programId = base64_decode($enc_id);

        $arr_rules['reason'] = 'required';

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            return json_encode([
                'errors' => $validator->errors()->getMessages(),
                'code' => 422,
                'status' => 'fail',
            ]);
        }

        $isExist = $this->BaseModel->where('id', '=', $programId)->count();
        if($isExist==0)
        {
            return json_encode([
                'errors' => 'Record not found',
                'code' => 422,
                'status' => 'not_found',
            ]);
        }
        else
        {
            $result = $this->BaseModel->where('id', '=', $programId)->update(['approve_status'=>'disapproved']);
            if($result)
            {
                $arr_data['user_id']    = $userId;
                $arr_data['program_id'] = $programId;
                $arr_data['reason']     = trim($request->input('reason'));

                $resultReason = $this->ProgramReasonModel->create($arr_data);

                $resultSendNotification = $this->sendNotification($programId,'disapproved');

                $resp['status'] = 'success';
            }
            else
            {
                $resp['status'] = 'fail';
            }
        }
        return response()->json($resp);
    }

    public function sendNotification($programId='', $notifyType='')
    {
        $sendNotification = false;
        if($programId!='' && $notifyType!='')
        {
            $arrProgram = $this->BaseModel->select('user_id','name')->where('id', '=', $programId)->first();
            if(count($arrProgram) > 0)
            {
                if(isset($arrProgram['name']) && $arrProgram['name']!='')
                {
                    $programName = $arrProgram['name'];
                }
            }

            $userId = login_user_id('supervisor');
            $loggedUserName = 'Supervisor';
            $loggedUserName = $this->auth->user()->first_name;
            $loggedUserName.=' '.$this->auth->user()->last_name;
            $message = '';
            if($notifyType=='approved')
            {
                $message = 'Program "'.$programName.'" approved by "'.$loggedUserName.'".';
            }
            else if($notifyType=='disapproved')
            {
                $message = 'Program "'.$programName.'" rejected by "'.$loggedUserName.'".';
            }
            $url = 'javascript:void(0);';
            if($programId!='')
            {
                $url = '/'.config('app.project.creator_panel_slug')."/program/view/".base64_encode($programId);
            }
            $arr_noti['message']      = $message;
            $arr_noti['from_user_id'] = $userId;
            $arr_noti['to_user_id']   = $arrProgram['user_id'];
            $arr_noti['url']          = $url;
            $arr_noti['is_read']      = "0";
            $sendNotification         = $this->NotificationService->send_notification($arr_noti); 
        }
        return $sendNotification;
    }
     public function deleteTempQuestion($programId,$templateId,$created_by)
    {
        $questionDelete = false;
        if($programId!='' && $templateId!='' && $created_by!='' )
        {
            $modelName = 'TemplatePreview'.$templateId.'Model';
            /* Template : 1 */
            if($templateId == 1)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'lesson_id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->where('created_by', '=', $created_by)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                                
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }           
                        }
                    }
                }
            }
            /* Template : 2 */
            else if($templateId == 2)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }           
                        }
                    }
                }
            }
            /* Template : 3 */
            else if($templateId == 3)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }       
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 4 */
            else if($templateId == 4)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 5 */
            else if($templateId == 5)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'file_type', 'file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['file_type']))
                                {
                                    if($arrQuestionVal['file_type']=='image')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_image_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_base_path.$arrQuestionVal['file']);
                                            }
                                            if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_image_thumb_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                    else if($arrQuestionVal['file_type']=='video')
                                    {
                                        if(isset($arrQuestionVal['file']) && $arrQuestionVal['file']!='')
                                        {
                                            if(file_exists($this->question_video_base_path.$arrQuestionVal['file']))
                                            {
                                                @unlink($this->question_video_base_path.$arrQuestionVal['file']);
                                            }
                                        }   
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }
                }
            }
            /* Template : 6 */
            else if($templateId == 6)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 7 */
            else if($templateId == 7)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 8 */
            else if($templateId == 8)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 9)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 10 */
            else if($templateId == 10)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 11 */
            else if($templateId == 11)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file'/*, 'horn'*/)->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 12 */
            else if($templateId == 12)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 13 */
            else if($templateId == 13)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 14 */
            else if($templateId == 14)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 15 */
            else if($templateId == 15)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 16 */
            else if($templateId == 16)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 9 */
            else if($templateId == 17)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 18 */
            else if($templateId == 18)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 19 */
            else if($templateId == 19)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'question_5_file', 'question_6_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_5_file']) && $arrQuestionVal['question_5_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_5_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_6_file']) && $arrQuestionVal['question_6_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_6_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 20 */
            else if($templateId == 20)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 21 */
            else if($templateId == 21)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 22 */
            else if($templateId == 22)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 23 */
            else if($templateId == 23)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 24 */
            else if($templateId == 24)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 25 */
            else if($templateId == 25)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_video_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_video_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 26 */
            else if($templateId == 26)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 27 */
            else if($templateId == 27)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 28 */
            else if($templateId == 28)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 29 */
            else if($templateId == 29)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 30 */
            else if($templateId == 30)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 31 */
            else if($templateId == 31)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 32 */
            else if($templateId == 32)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 33 */
            else if($templateId == 33)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 34 */
            else if($templateId == 34)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 35 */
            else if($templateId == 35)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 36 */
            else if($templateId == 36)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 37 */
            else if($templateId == 37)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'question_3_file', 'question_4_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_3_file']) && $arrQuestionVal['question_3_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_3_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_4_file']) && $arrQuestionVal['question_4_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_4_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 38 */
            else if($templateId == 38)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 39 */
            else if($templateId == 39)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 40 */
            else if($templateId == 40)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 41 */
            else if($templateId == 41)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 42 */
            else if($templateId == 42)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 43 */
            else if($templateId == 43)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 44 */
            else if($templateId == 44)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 45 */
            else if($templateId == 45)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_1_file', 'question_2_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_1_file']) && $arrQuestionVal['question_1_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_1_file']);
                                    }
                                }
                                if(isset($arrQuestionVal['question_2_file']) && $arrQuestionVal['question_2_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_2_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 46 */
            else if($templateId == 46)
            {

                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'question_file', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['question_file']) && $arrQuestionVal['question_file']!='')
                                {
                                    if(file_exists($this->question_image_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_base_path.$arrQuestionVal['question_file']);
                                    }
                                    if(file_exists($this->question_image_thumb_base_path.$arrQuestionVal['question_file']))
                                    {
                                        @unlink($this->question_image_thumb_base_path.$arrQuestionVal['question_file']);
                                    }
                                }
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 48 */
            else if($templateId == 48)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 49 */
            else if($templateId == 49)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                /*if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }*/
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
            /* Template : 50 */
            else if($templateId == 50)
            {
                $isTemplateExist = $this->$modelName->where('program_id', '=', $programId)->count();
                if($isTemplateExist > 0)
                {
                    $arrQuestion = [];
                    $arrQuestion = $this->$modelName->select('id', 'horn')->where('program_id', '=', $programId)->get();
                    if(count($arrQuestion) > 0)
                    {
                        $arrQuestion = $arrQuestion->toArray();
                        foreach ($arrQuestion as $arrQuestionVal)
                        {
                            if(isset($arrQuestionVal['id']) && $arrQuestionVal['id']!='')
                            {
                                if(isset($arrQuestionVal['horn']) && $arrQuestionVal['horn']!='')
                                {
                                    if(file_exists($this->question_audio_base_path.$arrQuestionVal['horn']))
                                    {
                                        @unlink($this->question_audio_base_path.$arrQuestionVal['horn']);
                                    }
                                }
                                $questionDelete = $this->$modelName->where('id', '=', $arrQuestionVal['id'])->delete();
                            }
                        }
                    }

                }
            }
        }
        return $questionDelete;
    }
    public function export($enc_program_id)
    {
        $program_id = '';
        if(isset($enc_program_id) && $enc_program_id!="")
        {
            $program_id = base64_decode($enc_program_id);
            $this->ProgramService->export_program($program_id);
        }
        else
        {
            Session::flash('error','Error occured while export data');
        }
        return redirect()->back();
    }
}
