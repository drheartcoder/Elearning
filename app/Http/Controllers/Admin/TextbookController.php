<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TextbookModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\TextbookimagesModel;
use App\Models\ProgramModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTab

class TextbookController extends Controller
{
   use MultiActionTrait;
	public function __construct(
                                TextbookModel       $textbook_model,
                                TextbookimagesModel $textbookimages_model,
                                GradeModel          $grade_model,
                                SubjectModel        $subject_model,
                                ProgramModel        $program_model
                                )
	{
        $this->arr_view_data                 = [];
        $this->BaseModel                     = $textbook_model;
        $this->TextbookModel                 = $textbook_model;
        $this->TextbookimagesModel           = $textbookimages_model;
        $this->GradeModel                    = $grade_model;
        $this->SubjectModel                  = $subject_model;
        $this->ProgramModel                  = $program_model;

        $this->module_title                  = "Textbook";
        $this->module_icon                   = "fa fa-book";
        $this->module_view_folder            = "admin.textbook";
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/material");
        $this->program_module_url_path       = url(config('app.project.admin_panel_slug'));

        $this->admin_panel_slug              = config('app.project.admin_panel_slug');

        $this->textbook_file_base_img_path   = base_path().config('app.project.img_path.textbook_file');
        $this->textbook_file_public_img_path = url('/').config('app.project.img_path.textbook_file');
	}

    public function index()
    {
        $this->arr_view_data['page_title']          = "Manage Material";
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage Material";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);

    }

    public function load_data(Request $request)
    {
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

        $obj_data = $this->TextbookModel->with(['subjectData'=>function($subjectDataQuery){ 
                                            $subjectDataQuery->select('id')
                                                            ->with([
                                                                'subjectTranslationData' => function($subjectTranslationDataQuery){ 
                                                                    $subjectTranslationDataQuery->select('id','subject_id','name')
                                                                                                ->where('locale', '=', 'en');
                                                            }])
                                                            ->where('status', '=', '1');
                                            },'gradeData'=>function($gradeDataQuery){
                                                $gradeDataQuery->select('id')
                                                               ->with([
                                                                'gradeTraslationData' => function($gradeTraslationDataQuery){ 
                                                                    $gradeTraslationDataQuery->select('id', 'grade_id', 'name')
                                                                                             ->where('locale', '=', 'en');
                                                                }])
                                                               ->where('status', '=', '1');
                                            },'textbookImagesData'=>function($textbookImagesDataQuery){
                                                $textbookImagesDataQuery->select(DB::raw('count(id) as allFilesCount, textbook_id'))->groupBy('textbook_id');
                                            }])
                                        ->orderBy('id', 'DESC');

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                $q->where('name', 'like', '%'.$keyword.'%')
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
        $count = count($obj_data->get());

        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

        if(($order =='ASC' || $order =='') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        
        if($order != '' && $column != '' )
        {
           $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        
        $materialData            = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($materialData) > 0)
        {
            $i = 0;
            foreach($materialData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action = '';
                $edit_href         = $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $view_href         = $this->module_url_path.'/view/'.base64_encode($row['id']);
                $delete_href       = $this->module_url_path.'/delete/'.base64_encode($row['id']);

                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$edit_href.'" title="View Details"><i class="material-icons" >edit </i></a>';
                
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

                $final_array[$i][0] = '<div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>';

                $subject = $grade = '';
                $allFilesCount = 0;

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
                if(isset($row['textbookImagesData']))
                {
                    if(count($row['textbookImagesData']) > 0)
                    {
                        if(isset($row['textbookImagesData'][0]))
                        {
                            if(count($row['textbookImagesData'][0]['allFilesCount']) > 0)
                            {
                                if(isset($row['textbookImagesData'][0]['allFilesCount']))
                                {
                                    $allFilesCount = $row['textbookImagesData'][0]['allFilesCount'];
                                }
                            }
                        }
                    }
                }

                $final_array[$i][1] = isset($row['name']) && $row['name'] != '' ? ucfirst($row['name']) : "NA";
                $final_array[$i][2] = $subject;
                $final_array[$i][3] = $grade;
                $final_array[$i][4] = $allFilesCount;
                $final_array[$i][5] = $build_active_btn;
                $final_array[$i][6] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

    public function delete($enc_id = '')
    {
        if($enc_id == '')
        {
            return redirect()->back();
        }

        $textbookId = base64_decode($enc_id);
        $isExist = $this->BaseModel->where('id', '=', $textbookId)->count();
        if($isExist==0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }

        $result = $this->BaseModel->where('id', '=', $textbookId)->delete();
        if($result)
        {
            $arrMaterialFiles = [];
            $arrMaterialFiles = $this->TextbookimagesModel->where('textbook_id', '=', $textbookId)->get();
            if(count($arrMaterialFiles) > 0)
            {
                $arrMaterialFiles = $arrMaterialFiles->toArray();
                foreach ($arrMaterialFiles as $arrMaterialFilesVal) {
                    if(isset($arrMaterialFilesVal['file']) && $arrMaterialFilesVal['file']!='')
                    {
                        if(file_exists($this->textbook_file_base_img_path.$arrMaterialFilesVal['file']))
                        {
                            @unlink($this->textbook_file_base_img_path.$arrMaterialFilesVal['file']);
                        }
                    }
                }
                $resultFiles = $this->TextbookimagesModel->where('textbook_id', '=', $textbookId)->delete();
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

    public function dileteFile($textbook_id = '',$file_id = '')
    {
        if($textbook_id=='' && $file_id=='')
        {
            return redirect()->back();
        }

        $textbookId = base64_decode($textbook_id);
        $fileId     = base64_decode($file_id);
        $arrFile    = $this->TextbookimagesModel->where('id', '=', $fileId)->first();
        if(count($arrFile) > 0)
        {
            $result = $this->TextbookimagesModel->where('id', '=', $fileId)->delete();
            if($result)
            {
                if(isset($arrFile['file']) && $arrFile['file']!='')
                {
                    if(file_exists($this->textbook_file_base_img_path.$arrFile['file']))
                    {
                        @unlink($this->textbook_file_base_img_path.$arrFile['file']);
                    }
                }
                Session::flash('success', 'Record deleted successfully.');
                return redirect($this->module_url_path.'/edit/'.base64_encode($textbookId));
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
        if($enc_id=='')
        {
            return redirect()->back();
        }

        $textbookId = base64_decode($enc_id);
        $isExist    = $this->BaseModel->where('id', '=', $textbookId)->count();
        if($isExist==0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
        $arrMaterial = [];
        $arrMaterial = $this->BaseModel->where('id', '=', $textbookId)
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
                                                'textbookImagesData'
                                                ])
                                       ->first();
        if(count($arrMaterial) > 0)
        {
            $arrMaterial = $arrMaterial->toArray();
        }

        $arr_subject = '';
        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }

        $arr_grade = '';
        $obj_grade = $this->GradeModel->where('status', '1')->where('subject', $arrMaterial['subject_id'])->get();
        if($obj_grade)
        {
            $arr_grade = $obj_grade->toArray();
        }

        $this->arr_view_data['arr_subject']                   = $arr_subject;
        $this->arr_view_data['arr_grade']                     = $arr_grade;

        $this->arr_view_data['page_title']                    = $this->module_title.' Details';
        $this->arr_view_data['parent_module_icon']            = "fa fa-home";
        $this->arr_view_data['parent_module_title']           = "Dashboard";
        $this->arr_view_data['parent_module_url']             = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']                   = $this->module_icon;
        $this->arr_view_data['module_title']                  = 'Manage Material';
        $this->arr_view_data['module_url_path']               = $this->module_url_path.'/edit/'.$enc_id;
        $this->arr_view_data['base_module_url_path']          = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']              = $this->admin_panel_slug;
        $this->arr_view_data['module_url']                    = $this->module_url_path;
        $this->arr_view_data['sub_module_title']              = 'Edit Material';
        $this->arr_view_data['sub_module_icon']               = 'fa fa-pencil';
        $this->arr_view_data['textbookId']                    = $textbookId;
        $this->arr_view_data['arrMaterial']                   = $arrMaterial;

        $this->arr_view_data['textbook_file_base_img_path']   = $this->textbook_file_base_img_path;
        $this->arr_view_data['textbook_file_public_img_path'] = $this->textbook_file_public_img_path;
        
        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function update($enc_id = '',Request $request)
    {
        if($enc_id == '')
        {
            return redirect()->back();
        }
        
        $textbookId = base64_decode($enc_id);

        $arr_rules['textbookName'] = 'required';
        $arr_rules['subject']      = "required";
        $arr_rules['grade']        = "required";
        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            Session::flash('error', 'All the fileds are required.');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $isExist = $this->TextbookModel->where('id', '=', $textbookId)->count();
        if($isExist == 0)
        {
            Session::flash('Record not found.');
            return redirect()->back();
        }

        $slug = str_slug($request->input('textbookName'));
        $statusTextbookModel = $this->TextbookModel->where('id', '=', $textbookId)->update(['name'=>$request->input('textbookName'), 'slug'=>$slug, 'subject_id' => $request->input('subject'), 'grade_id' => $request->input('grade')]);
        if($request->file('files1'))
        {
            $files = $request->file('files1');
            foreach($files as $imageKey => $file)
            {
                $file_extension = strtolower($file->getClientOriginalExtension());
                if(in_array($file_extension,['png','jpg','jpeg','mp4','docx','xlsx','pdf','pptx']))
                {
                    $file_name = time().uniqid().'.'.$file_extension;
                    $isUpload  = $file->move($this->textbook_file_base_img_path, $file_name);
                    if($isUpload)
                    {
                        $arr_img_data['textbook_id']= $textbookId;
                        $arr_img_data['file']       = $file_name;
                        $statusImage = $this->TextbookimagesModel->create($arr_img_data);
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
            return redirect($this->module_url_path.'/edit/'.base64_encode($textbookId));
        }
        else if($statusImage)
        {
            Session::flash('success','Record updated successfully.');
            return redirect($this->module_url_path.'/edit/'.base64_encode($textbookId));   
        }
        else
        {
            Session::flash('warning', 'There is no change in submitted values.');
            return redirect()->back();
        }
    }

    public function view($enc_id = '')
    {
        if($enc_id=='')
        {
            return redirect()->back();
        }

        $textbookId = base64_decode($enc_id);

        $isExist = $this->BaseModel->where('id', '=', $textbookId)->count();
        if($isExist==0)
        {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }
        $arrMaterial = [];
        $arrMaterial = $this->BaseModel->where('id', '=', $textbookId)
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
                                                'textbookImagesData'
                                                ])
                                       ->first();
        if(count($arrMaterial) > 0)
        {
            $arrMaterial = $arrMaterial->toArray();
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
        $this->arr_view_data['module_title']        = "Manage Material";
        $this->arr_view_data['sub_module_title']    = "Add Material";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['module_url']          = $this->module_url_path;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
        $arr_data  = $form_data = $arr_lang = $arr_rules = array();
        $file_name = '';

        $form_data                 = $request->all();
        $arr_rules['subject']      = "required";
        $arr_rules['grade']        = "required";
        $arr_rules['textbookName'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             Session::flash('error', 'All the fileds are required.');
             return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $textbookName = $request->input('textbookName');
        $subject_id   = $request->input('subject');
        $grade_id     = $request->input('grade');
        $files        = $request->file('files');

        $count = 1;
        for($i=0;$i<count($textbookName);$i++)
        {
            $arr_data['program_id'] =  '0';
            $arr_data['lesson_id']  =  '0';
            $arr_data['name']       =  $textbookName[$i];
            $arr_data['slug']       =  str_slug($textbookName[$i]);
            $arr_data['subject_id'] =  $subject_id;
            $arr_data['grade_id']   =  $grade_id;
            $status = $this->BaseModel->create($arr_data);
            if($status)
            {
                $textbookId = $status['id'];
                if($request->file('files'.$count))
                {
                    $files = $request->file('files'.$count);
                    foreach($files as $imageKey => $file)
                    {
                        $file_extension = strtolower($file->getClientOriginalExtension());
                        if(in_array($file_extension,['png','jpg','jpeg','mp4','docx','xlsx','pdf','pptx']))
                        {
                            $file_name = time().uniqid().'.'.$file_extension;
                            $isUpload  = $file->move($this->textbook_file_base_img_path, $file_name);
                            if($isUpload)
                            {
                                $arr_img_data['textbook_id'] = $textbookId;
                                $arr_img_data['file']        = $file_name;
                                $statusImage = $this->TextbookimagesModel->create($arr_img_data);
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
        Session::flash('success', 'Material added successfully.');
        return redirect()->back();
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
}
