<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\HomeworkModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\HomeworkimagesModel;
use App\Models\ProgramModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;

class ProgramHomeworkController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                HomeworkModel            $homework_model,
                                HomeworkimagesModel      $homeworkimages_model,
                                GradeModel               $grade_model,
                                SubjectModel             $subject_model,
                                ProgramModel             $program_model
                                )
	{
        $this->arr_view_data                 = [];
        $this->BaseModel                     = $homework_model;
        $this->HomeworkModel                 = $homework_model;
        $this->HomeworkimagesModel           = $homeworkimages_model;
        $this->GradeModel                    = $grade_model;
        $this->SubjectModel                  = $subject_model;
        $this->ProgramModel                  = $program_model;

        $this->module_title                  = "Homework";
        $this->module_icon                   = "fa fa-book";
        $this->module_view_folder            = "admin.program.homework";
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->module_url_path               = url(config('app.project.admin_panel_slug')."/program/homework/");
        $this->program_module_url_path       = url(config('app.project.admin_panel_slug')."/program");

        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->homework_file_base_img_path   = base_path().config('app.project.img_path.homework_file');
        $this->homework_file_public_img_path = url('/').config('app.project.img_path.homework_file');

        /*DB::connection()->enableQueryLog();*/
	}

	public function index($program_id = '')
    {
        if($program_id=='')
        {
            return redirect()->back();
        }
        $programId = base64_decode($program_id);

        $this->arr_view_data['page_title']               = "Manage Homework";
        $this->arr_view_data['parent_module_icon']       = "fa fa-home";
        $this->arr_view_data['parent_module_title']      = "Dashboard";
        $this->arr_view_data['parent_module_url']        = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']              = $this->module_icon;
        $this->arr_view_data['module_title']             = "Manage Homework";
        $this->arr_view_data['module_url_path']          = $this->module_url_path;
        $this->arr_view_data['program_module_url_path']  = $this->program_module_url_path;
        $this->arr_view_data['admin_panel_slug']         = $this->admin_panel_slug;
        $this->arr_view_data['programId']                = $programId;
        $this->arr_view_data['enc_programId']            = $program_id;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function load_data($program_id='',Request $request)
    {
        $programId = base64_decode($program_id);
        $arrProgramInfo = [];
        $arrProgramInfo = $this->ProgramModel->where('id', '=', $programId)->first();
        
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
        
        $obj_data = $this->HomeworkModel->where('subject_id', '=', $arrProgramInfo['subject'])
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
                                                'homeworkImagesData'=>function($textbookImagesDataQuery){
                                                    $textbookImagesDataQuery->select(DB::raw('count(id) as allFilesCount, homework_id'))->groupBy('homework_id');
                                                }
                                                ])
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
        
        $materialData             = $obj_data->get();
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
                $edit_href         = $this->module_url_path.'/edit/'.base64_encode($programId).'/'.base64_encode($row['id']);
                $view_href         = $this->module_url_path.'/view/'.base64_encode($programId).'/'.base64_encode($row['id']);
                $delete_href       = $this->module_url_path.'/delete/'.base64_encode($programId).'/'.base64_encode($row['id']);

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
                $final_array[$i][4] = $allFilesCount;
                $final_array[$i][5] = $build_active_btn;
                $final_array[$i][6] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

    public function delete($program_id = '',$enc_id = '')
    {
        if($program_id=='' && $enc_id=='')
        {
            return redirect()->back();
        }

        $programId = base64_decode($program_id);
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
            $arrMaterialFiles = $this->HomeworkimagesModel->where('homework_id', '=', $textbookId)->get();
            if(count($arrMaterialFiles) > 0)
            {
                $arrMaterialFiles = $arrMaterialFiles->toArray();
                foreach ($arrMaterialFiles as $arrMaterialFilesVal) {
                    if(isset($arrMaterialFilesVal['file']) && $arrMaterialFilesVal['file']!='')
                    {
                        if(file_exists($this->homework_file_base_img_path.$arrMaterialFilesVal['file']))
                        {
                            @unlink($this->homework_file_base_img_path.$arrMaterialFilesVal['file']);
                        }
                    }
                }
                $resultFiles = $this->HomeworkimagesModel->where('homework_id', '=', $textbookId)->delete();
            }
            Session::flash('success', 'Record deleted successfully.');
            return redirect($this->module_url_path.'/'.base64_encode($programId));
        }
        else
        {
            Session::flash('error', 'Opps, Problem occured while deleting a record.');
            return redirect()->back();
        }
    }

    public function dileteFile($program_id = '',$textbook_id = '',$file_id = '')
    {
        if($program_id=='' && $textbook_id=='' && $file_id=='')
        {
            return redirect()->back();
        }

        $programId  = base64_decode($program_id);
        $textbookId = base64_decode($textbook_id);
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
                return redirect($this->module_url_path.'/edit/'.base64_encode($programId).'/'.base64_encode($textbookId));
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

    public function edit($program_id = '',$enc_id = '')
    {
        if($program_id=='' && $enc_id=='')
        {
            return redirect()->back();
        }

        $programId = base64_decode($program_id);
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
                                                'homeworkImagesData'
                                                ])
                                       ->first();
        if(count($arrMaterial) > 0)
        {
            $arrMaterial = $arrMaterial->toArray();
        }
        
        $this->arr_view_data['page_title']                   = $this->module_title.' Details';
        $this->arr_view_data['parent_module_icon']           = "fa fa-home";
        $this->arr_view_data['parent_module_title']          = "Dashboard";
        $this->arr_view_data['parent_module_url']            = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']                  = $this->module_icon;
        $this->arr_view_data['module_title']                 = 'Manage '.$this->module_title;
        $this->arr_view_data['module_url_path']              = $this->module_url_path.'/edit/'.$enc_id;
        $this->arr_view_data['base_module_url_path']         = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']             = $this->admin_panel_slug;
        $this->arr_view_data['module_url']                   = $this->module_url_path.'/'.base64_encode($programId);
        $this->arr_view_data['sub_module_title']             = 'Edit Homework';
        $this->arr_view_data['sub_module_icon']              = 'fa fa-pencil';
        $this->arr_view_data['programId']                    = $programId;
        $this->arr_view_data['textbookId']                   = $textbookId;
        $this->arr_view_data['arrMaterial']                  = $arrMaterial;
        $this->arr_view_data['homework_file_base_img_path']  = $this->homework_file_base_img_path;
        $this->arr_view_data['homework_file_public_img_path']= $this->homework_file_public_img_path;
        
        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    public function update($program_id = '',$enc_id = '',Request $request)
    {
        if($program_id=='' && $enc_id=='')
        {
            return redirect()->back();
        }
        $programId = base64_decode($program_id);
        $textbookId = base64_decode($enc_id);

        $arr_rules['textbookName'] = 'required';

        $validator = Validator::make($request->all(), $arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $isExist = $this->HomeworkModel->where('id', '=', $textbookId)->count();
        if($isExist == 0)
        {
            Session::flash('Record not found.');
            return redirect()->back();
        }

        $isNameExist = $this->HomeworkModel->where('id', '<>', $textbookId)->where('name', '=', $request->input('textbookName'))->count();
        if($isNameExist > 0)
        {
            Session::flash('error','Name already exist.Please try with another name.');
            return redirect()->back();   
        }
        
        $slug = str_slug($request->input('textbookName'));
        $statusTextbookModel = $this->HomeworkModel->where('id', '=', $textbookId)->update(['name'=>$request->input('textbookName'), 'slug'=>$slug]);
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
                        $arr_img_data['homework_id']= $textbookId;
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
            return redirect($this->module_url_path.'/edit/'.base64_encode($programId).'/'.base64_encode($textbookId));
        }
        else if($statusImage)
        {
            Session::flash('success','Record updated successfully.');
            return redirect($this->module_url_path.'/edit/'.base64_encode($programId).'/'.base64_encode($textbookId));   
        }
        else
        {
            Session::flash('warning', 'There is no change in submitted values.');
            return redirect()->back();
        }
    }
}
