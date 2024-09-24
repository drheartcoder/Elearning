<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\HomeworkModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\ProgramModel;
use App\Models\LessonModel;
use App\Models\HomeworkimagesModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;

class HomeworkController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                HomeworkModel       $homework_model,
                                HomeworkimagesModel $homeworkimages_model,
                                GradeModel          $grade_model,
                                SubjectModel        $subject_model,
                                ProgramModel        $program_model,
                                LessonModel         $lesson_model
                                )
	{
        $this->arr_view_data                 = [];
        $this->BaseModel                     = $homework_model;
        $this->HomeworkModel                 = $homework_model;
        $this->HomeworkimagesModel           = $homeworkimages_model;
        $this->GradeModel                    = $grade_model;
        $this->SubjectModel                  = $subject_model;
        $this->ProgramModel                  = $program_model;
        $this->LessonModel                   = $lesson_model;

        $this->module_title                  = "Homework";
        $this->module_icon                   = "fa fa-book";
        $this->module_view_folder            = "admin.homework";
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/homework");
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');

        $this->homework_file_base_img_path   = base_path().config('app.project.img_path.homework_file');
        $this->homework_file_public_img_path = url('/').config('app.project.img_path.homework_file');
	}

    public function index()
    {
        $this->arr_view_data['page_title']          = "Manage Homework";
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage Homework";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }


    public function load_data(Request $request)
    {
        $userId      = login_user_id('admin');
        $SubjectData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        
        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "subject";
        }
        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "grade";
        }
        if($request->input('order')[0]['column'] == 5) 
        {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data = $this->HomeworkModel->with(['programData' => function($programDataQuery) {
                                                $programDataQuery->select('id','unique_id','name')
                                                                 ->where('status', '=', '1');
                                            }, 'lessonData' => function($lessonDataQuery) {
                                                $lessonDataQuery->select('id','name','program_id');
                                            }, 'subjectData' => function($subjectDataQuery) {
                                                $subjectDataQuery->select('id')
                                                            ->with(['subjectTranslationData'=>function($subjectTranslationDataQuery) {
                                                                    $subjectTranslationDataQuery->select('id','subject_id','name')
                                                                                                ->where('locale', '=', 'en'); 
                                                            }])
                                                            ->where('status', '=', '1');
                                            }, 'gradeData' => function($gradeDataQuery){
                                                $gradeDataQuery->select('id')
                                                               ->with([ 'gradeTraslationData'=>function($gradeTraslationDataQuery) {
                                                                    $gradeTraslationDataQuery->select('id', 'grade_id', 'name')
                                                                                             ->where('locale', '=', 'en');
                                                                }])
                                                               ->where('status', '=', '1');
                                            }, 'homeworkImagesData' => function($textbookImagesDataQuery){
                                                $textbookImagesDataQuery->select(DB::raw('count(id) as allFilesCount, homework_id'))->groupBy('homework_id');
                                            }])
                                        ->orderBy('id', 'DESC');

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                $q->where('name', 'like', '%'.$keyword.'%')
                    ->orWhereHas("programData", function($query) use ($keyword){
                        $query->whereRaw("(name LIKE '%".$keyword."%' OR unique_id LIKE '%".$keyword."%' )");
                    })
                    ->orWhereHas("lessonData", function($query) use ($keyword){
                        $query->where('name', 'like','%'.$keyword.'%');
                    })
                    ->orWhereHas("subjectData", function($query) use ($keyword){
                        $query->whereHas("subjectTranslationData", function($query1) use ($keyword){
                            $query1->where('name', 'like','%'.$keyword.'%');
                        });
                    })
                    ->orWhereHas("gradeData", function($query) use ($keyword){
                        $query->whereHas("gradeTraslationData", function($query1) use ($keyword){
                            $query1->where('name', 'like','%'.$keyword.'%');
                        });
                    });
            });
        }

        $count   = count($obj_data->get());

        if(($order == 'ASC' || $order =='') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {                
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
        }
        if($order != '' && $column != '' )
        {
            $obj_data = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {            
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }
        }

        $materialData            = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;

        if(count($materialData) > 0)
        {
            $i = 0;
            foreach($materialData as $row)
            {
                $build_active_btn = $build_holiday_btn = $build_view_action = '';

                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }
                 /*Changes Done by Kavita*/
                if($row['is_holiday'] != null && $row['is_holiday'] == "no")
                {   
                    $build_holiday_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Add Holiday Homework" href="'.$this->module_url_path.'/AddHolidayHomework/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to add this record in holiday homewok ?\')" ><i class="fa fa-times"></i></a>';
                }
                elseif($row['is_holiday'] != null && $row['is_holiday'] == "yes")
                {
                   $build_holiday_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Remove Holiday Homework" href="'.$this->module_url_path.'/RemoveHolidayHomework/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to  remove this record from holiday homework ?\')" ><i class="fa fa-check"></i></a>';      
                }

                $edit_href         = $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $view_href         = $this->module_url_path.'/view/'.base64_encode($row['id']);
                $delete_href       = $this->module_url_path.'/delete/'.base64_encode($row['id']);

                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >edit </i></a>';
                
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

                $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';
                        
                $unique_id     = $program_name = $lesson_name = $subject = $grade = '';
                $allFilesCount = 0;
                
                if( isset($row['programData']) && count($row['programData']) > 0 )
                {
                    $unique_id    = isset($row['programData']['unique_id']) && $row['programData']['unique_id'] != '' ? $row['programData']['unique_id'] : "N/A";
                    $program_name = isset($row['programData']['name']) && $row['programData']['name'] != '' ? $row['programData']['name'] : "N/A";
                }

                if( isset($row['lessonData']) && count($row['lessonData']) > 0 )
                {
                    $lesson_name = isset($row['lessonData']['name']) && $row['lessonData']['name'] != '' ? $row['lessonData']['name'] : "N/A";
                }

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

                if(isset($row['homeworkImagesData']))
                {
                    if(count($row['homeworkImagesData']) > 0)
                    {
                        if(isset($row['homeworkImagesData'][0]))
                        {
                            if(count($row['homeworkImagesData'][0]['allFilesCount']) > 0)
                            {
                                if(isset($row['homeworkImagesData'][0]['allFilesCount']))
                                {
                                    $allFilesCount = $row['homeworkImagesData'][0]['allFilesCount'];
                                }
                            }
                        }
                    }
                }

                $final_array[$i][1] = isset($row['name']) && $row['name'] != '' ? ucfirst($row['name']) : "NA";
                $final_array[$i][2] = $subject;
                $final_array[$i][3] = $grade;
                $final_array[$i][4] = $unique_id;
                $final_array[$i][5] = $program_name;
                $final_array[$i][6] = $lesson_name;
                $final_array[$i][7] = $allFilesCount;
                $final_array[$i][8] = $build_holiday_btn;
                $final_array[$i][9] = $build_active_btn;
                $final_array[$i][10] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;      
    }
    /*Changes done by Kavita*/
    public function AddHolidayHomework($enc_id = false)
    {
        $homeworkId = base64_decode($enc_id);
        if (isset($homeworkId) && $homeworkId != '') 
        {
            $res = $this->BaseModel->where('id', '=', $homeworkId)
                                             ->update(['is_holiday' => 'yes']);

            if ($res) 
            {
                Session::flash('success', 'Record successfully added in holiday homework.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error', 'Opps, Problem occured while adding holiday homework .');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while adding holiday homework.');
            return redirect()->back();
        }
    }
    public function RemoveHolidayHomework($enc_id = false)
    {
        $homeworkId = base64_decode($enc_id);
        if (isset($homeworkId) && $homeworkId != '') 
        {
            $res = $this->BaseModel->where('id', '=', $homeworkId)
                                             ->update(['is_holiday' => 'no']);

            if ($res) 
            {
                Session::flash('success', 'Record successfully remove from holiday homework.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error', 'Opps, Problem occured while removing from holiday homework.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while removing from holiday homework.');
            return redirect()->back();
        }
    }
    /*End */
    public function delete($enc_id = '')
    {
        if($enc_id == '')
        {
            return redirect()->back();
        }

        $homeworkId = base64_decode($enc_id);
        $isExist    = $this->BaseModel->where('id', '=', $homeworkId)->count();
        if($isExist == 0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
        $result = $this->BaseModel->where('id', '=', $homeworkId)->delete();
        if($result)
        {
            $arrHomeworkFiles = [];
            $arrHomeworkFiles = $this->HomeworkimagesModel->where('homework_id', '=', $homeworkId)->get();
            if(count($arrHomeworkFiles) > 0)
            {
                $arrHomeworkFiles = $arrHomeworkFiles->toArray();
                foreach ($arrHomeworkFiles as $arrHomeworkFilesVal) {
                    if(isset($arrHomeworkFilesVal['file']) && $arrHomeworkFilesVal['file']!='')
                    {
                        if(file_exists($this->homework_file_base_img_path.$arrHomeworkFilesVal['file']))
                        {
                            @unlink($this->homework_file_base_img_path.$arrHomeworkFilesVal['file']);
                        }
                    }
                }
                $resultFiles = $this->HomeworkimagesModel->where('homework_id', '=', $homeworkId)->delete();
            }
            Session::flash('success', 'Record deleted successfully.');
            return redirect($this->module_url_path);
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while deleting a record.');
            return redirect()->back();
        }
    }

    public function dileteFile($homework_id = '',$file_id = '')
    {
        if($homework_id=='' && $file_id=='')
        {
            return redirect()->back();
        }

        $homeworkId = base64_decode($homework_id);
        $fileId     = base64_decode($file_id);
        $arrFile = $this->HomeworkimagesModel->where('id', '=', $fileId)->first();
        if(count($arrFile) > 0)
        {
            $result = $this->HomeworkimagesModel->where('id', '=', $fileId)->delete();
            if($result)
            {
                if(isset($arrFile['file']) && $arrFile['file']!='')
                {
                    if(file_exists($this->homework_file_base_img_path.$arrFile['file']))
                    {
                        @unlink($this->homework_file_base_img_path.$arrFile['file']);
                    }
                }
                Session::flash('success', 'Record deleted successfully.');
                return redirect($this->module_url_path.'/edit/'.base64_encode($homeworkId));
            }
            else
            {
                Session::flash('error', 'Oops, Problem occured while deleting a record.');
                return redirect()->back();    
            }
        }
        else
        {   
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
    }

    public function edit($enc_id = '')
    {
        if($enc_id == '')
        {
            return redirect()->back();
        }

        $homeworkId = base64_decode($enc_id);
        $isExist    = $this->BaseModel->where('id', $homeworkId)->count();
        if($isExist == 0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }

        $arrHomework = [];
        $arrHomework = $this->BaseModel->where('id', '=', $homeworkId)
                                        ->with(['programData' => function($programDataQuery) {
                                                $programDataQuery->select('id','unique_id','name')
                                                                 ->where('status', '=', '1');
                                                },'subjectData'=>function($subjectDataQuery){ 
                                                    $subjectDataQuery->select('id')
                                                                ->with([
                                                                    'subjectTranslationData'=>function($subjectTranslationDataQuery){ 
                                                                        $subjectTranslationDataQuery->select('id','subject_id','name')
                                                                                                    ->where('locale', '=', 'en');
                                                                    }])
                                                                ->where('status', '=', '1');
                                                },
                                                'gradeData'=>function($gradeDataQuery){
                                                    $gradeDataQuery->select('id')
                                                                   ->with([
                                                                    'gradeTraslationData'=>function($gradeTraslationDataQuery){ 
                                                                        $gradeTraslationDataQuery->select('id', 'grade_id', 'name')
                                                                                                 ->where('locale', '=', 'en');
                                                                    }])
                                                                   ->where('status', '=', '1');
                                                },
                                                'homeworkImagesData'
                                                ])
                                       ->first();
        if(count($arrHomework) > 0)
        {
            $arrHomework = $arrHomework->toArray();
        }

        $this->arr_view_data['page_title']           = $this->module_title.' Details';
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = 'Manage '.$this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path.'/edit/'.$enc_id;
        $this->arr_view_data['base_module_url_path'] = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     = 'Edit Homework';
        $this->arr_view_data['sub_module_icon']      = 'fa fa-pencil';
        $this->arr_view_data['homeworkId']           = $homeworkId;
        $this->arr_view_data['arrHomework']          = $arrHomework;

        $this->arr_view_data['homework_file_base_img_path']   = $this->homework_file_base_img_path;
        $this->arr_view_data['homework_file_public_img_path'] = $this->homework_file_public_img_path;
        
        
        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function update($enc_id = '',Request $request)
    {
        if($enc_id=='')
        {
            return redirect()->back();
        }

        $homeworkId = base64_decode($enc_id);

        $arr_rules['textbookName'] = 'required';

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $isExist = $this->HomeworkModel->where('id', '=', $homeworkId)->count();
        if($isExist == 0)
        {
            Session::flash('Record not found.');
            return redirect()->back();
        }
        $slug = str_slug($request->input('textbookName'));
        $statusTextbookModel = $this->HomeworkModel->where('id', '=', $homeworkId)->update(['name'=>$request->input('textbookName'), 'slug'=>$slug]);
        if($request->file('files1'))
        {
            $files = $request->file('files1');
            foreach($files as $imageKey => $file)
            {
                $file_extension = strtolower($file->getClientOriginalExtension());
                if(in_array($file_extension,['png','jpg','jpeg','mp4','docx','xlsx','pdf','pptx']))
                {
                    $file_name         = time().uniqid().'.'.$file_extension;
                    $isUpload          = $file->move($this->homework_file_base_img_path, $file_name);
                    if($isUpload)
                    {
                        $arr_img_data['homework_id']= $homeworkId;
                        $arr_img_data['file']       = $file_name;
                        $statusImage = $this->HomeworkimagesModel->create($arr_img_data);
                    }
                }
                else
                {
                    return redirect()->back()->with('error','Invalid File type, please select valid image file')->withInput();  
                }
            }
        }

        if($statusTextbookModel)
        {
            Session::flash('success','Record updated successfully.');
            return redirect($this->module_url_path.'/edit/'.base64_encode($homeworkId));
        }
        else if($statusImage)
        {
            Session::flash('success','Record updated successfully.');
            return redirect($this->module_url_path.'/edit/'.base64_encode($homeworkId));   
        }
        else
        {
            Session::flash('warning', 'There is no change in submitted values.');
            return redirect()->back();
        }

        /*dd("END");*/
    }

    public function view($program_id = '',$enc_id = '')
    {
        if($program_id=='' && $enc_id=='')
        {
            return redirect()->back();
        }

        $programId = base64_decode($program_id);
        $homeworkId = base64_decode($enc_id);

        $isExist = $this->BaseModel->where('id', '=', $homeworkId)->count();
        if($isExist==0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
        $arrHomework = [];
        $arrHomework = $this->BaseModel->where('id', '=', $homeworkId)
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
                                                'homeworkImagesData'
                                                ])
                                       ->first();
        if(count($arrHomework) > 0)
        {
            $arrHomework = $arrHomework->toArray();
        }
    }

	public function create()
	{
		$arr_subject = '';
        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }

        $this->arr_view_data['arr_subject']         = $arr_subject;

        $this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "icon-home2";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage Homework";
        $this->arr_view_data['sub_module_title']    = "Add Homework";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['module_url']          = $this->module_url_path;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
        $arr_data  = $form_data = $arr_lang = $arr_rules = array();
        $file_name = '';
        $form_data = $request->all();

        $arr_rules['subject']      = "required";
        $arr_rules['grade']        = "required";
        $arr_rules['program']      = "required";
        $arr_rules['lesson']       = "required";
        $arr_rules['textbookName'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('error', 'All the fileds are required.');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $textbookName = $request->input('textbookName');
        $subject_id   = $request->input('subject');
        $grade_id     = $request->input('grade');
        $program_id   = $request->input('program');
        $lesson_id    = $request->input('lesson');
        $files        = $request->file('files');

        $count = 1;
        for($i=0;$i<count($textbookName);$i++)
        {
            $arr_data['program_id'] =  $program_id;
            $arr_data['lesson_id']  =  $lesson_id;
            $arr_data['name']       =  $textbookName[$i];
            $arr_data['slug']       =  str_slug($textbookName[$i]);
            $arr_data['subject_id'] =  $subject_id;
            $arr_data['grade_id']   =  $grade_id;
            $status = $this->BaseModel->create($arr_data);
            if($status)
            {
                $homeworkId = $status['id'];
                if($request->file('files'.$count))
                {
                    $files = $request->file('files'.$count);
                    foreach($files as $imageKey => $file)
                    {
                        $file_extension = strtolower($file->getClientOriginalExtension());
                        if(in_array($file_extension,['png','jpg','jpeg','mp4','docx','xlsx','pdf','pptx']))
                        {
                            $file_name         = time().uniqid().'.'.$file_extension;
                            $isUpload          = $file->move($this->homework_file_base_img_path, $file_name);
                            if($isUpload)
                            {
                                $arr_img_data['homework_id'] = $homeworkId;
                                $arr_img_data['file']        = $file_name;
                                $statusImage = $this->HomeworkimagesModel->create($arr_img_data);
                            }
                        }
                        else
                        {
                            return redirect()->back()->with('error','Invalid File type, please select valid image file')->withInput();  
                        }
                    }
                }
            }
            $count++;
        }
        Session::flash('success', 'Homework added successfully.');
        return redirect($this->module_url_path);
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
        $resp['status'] = 'fail';
        $strHTML = ''; 
        if($request->input('grade'))
        {
            $arrProgram = [];
            $arrProgram = $this->ProgramModel->where('grade', '=', $request->input('grade'))
                                             ->where('approve_status', '=', 'approved')
                                             ->where('status', '=', '1')
                                             ->get();
            if(count($arrProgram) > 0)
            {
                $arrProgram = $arrProgram->toArray();
            }
            if(count($arrProgram) > 0)
            {
                foreach ($arrProgram as $arrProgramVal) {
                    if(isset($arrProgramVal['id']) && $arrProgramVal['id']!='')
                    {
                        $programName = '';
                        
                        $programName = $arrProgramVal['name'];

                        $strHTML.='<option value="'.$arrProgramVal['id'].'">'.$programName.'</option>';
                    }
                }
                $resp['status']  = 'success';
                $resp['strHTML'] = $strHTML;
            }
        }
        return json_encode($resp);
    }


    public function getLesson(Request $request)
    {
        $resp['status'] = 'fail';
        $strHTML = ''; 
        if($request->input('program'))
        {
            $arrLesson = [];
            $arrLesson = $this->LessonModel->where('program_id', '=', $request->input('program'))->get();
            if(count($arrLesson) > 0)
            {
                $arrLesson = $arrLesson->toArray();
            }
            if(count($arrLesson) > 0)
            {
                foreach ($arrLesson as $arrLessonVal) {
                    if(isset($arrLessonVal['id']) && $arrLessonVal['id']!='')
                    {
                        $lessonName = '';
                        
                        $lessonName = $arrLessonVal['name'];

                        $strHTML.='<option value="'.$arrLessonVal['id'].'">'.$lessonName.'</option>';
                    }
                }
                $resp['status']  = 'success';
                $resp['strHTML'] = $strHTML;
            }
        }
        return json_encode($resp);
    }



}
