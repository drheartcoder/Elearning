<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Models\GradeModel;
use App\Models\GradeTranslationModel;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class GradeController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                LanguageService         $language_service,
                                GradeModel              $grade_model,
                                GradeTranslationModel   $grade_translation,
                                SubjectModel            $subject_model,
                                SubjectTranslationModel $subject_translation
                                )
	{
        $this->arr_view_data           = [];
        $this->LanguageService         = $language_service;
        $this->GradeModel              = $grade_model;
        $this->BaseModel               = $this->GradeModel;
        $this->GradeTranslationModel   = $grade_translation;
        $this->SubjectModel            = $subject_model;        
        $this->SubjectTranslationModel = $subject_translation;
        
        $this->module_title          = "Grade";
        $this->module_icon           = "fa fa-graduation-cap";
        $this->module_view_folder    = "admin.grade";
        $this->admin_url_path        = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug      = config('app.project.admin_panel_slug');
        $this->module_url_path       = url(config('app.project.admin_panel_slug')."/grade");
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
        $grade_name  = $request->input('grade_name');
        
        if ($request->input('order')[0]['column'] == 1) {
            $column = "grade_name";
        }

        if($request->input('order')[0]['column'] == 2) {
            $column = "grade_name";
        }

        if($request->input('order')[0]['column'] == 3) {
            $column = "subject_translation.name";
        }

        if($request->input('order')[0]['column'] == 4) {
            $column = "grade.created_at";
        }

        if($request->input('order')[0]['column'] == 5) {
            $column = "grade.status";
        }

        $order = strtoupper($request->input('order')[0]['dir']);

        $arr_data          = [];
        $arr_search_column = $request->input('column_filter');

        $obj_data = DB::table('grade')
                    ->select('grade.id',
                             'grade.status',
                             'grade_translation.name as grade_name',
                             'grade_translation.locale',
                             'grade.created_at',
                             'subject_translation.name AS subject_name'
                            )
                    ->join('grade_translation', 'grade_translation.grade_id', '=', 'grade.id', 'left')
                    ->join('subject', 'grade.subject', '=', 'subject.id')
                    ->join('subject_translation', 'subject.id', '=', 'subject_translation.subject_id', 'left')
                    ->where('grade.deleted_at', '=', null)
                    ->where('subject_translation.locale', '=', "en")
                    ->groupBy('grade.id');

        if($grade_name == "") {
            $obj_data = $obj_data->where('grade_translation.locale','=','en');                                    
        }            

        if (isset($grade_name) && $grade_name != "") {
            $obj_data = $obj_data->where('grade_translation.name','=',$grade_name);
        }
        
        $count = count($obj_data->get());

        if(($order == 'ASC' || $order == '') && $column == '') 
        {
            $obj_data   = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }        
        }

        if( $order != '' && $column != '' ) 
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            } 
        }

        $SubjectData = $obj_data->get();

        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if (count($SubjectData) > 0) {
            $i = 0;

            foreach ($SubjectData as $row) {

                if ($row->status != null && $row->status == "0") {
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" 
                   onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row->status != null && $row->status == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action =''; 
                $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                $build_view_action .= '&nbsp;<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="fa fa-pencil" ></i></a>';

                $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 
                
                /*$delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                $build_view_action .= '&nbsp;<a class="btn btn-circle btn-danger btn-outline show-tooltip" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="fa fa-trash" ></i></a>'; */


                $final_array[$i][0] = '<div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>';


                if ($row->locale=='en') {
                    $final_array[$i][1] = isset($row->grade_name) && $row->grade_name!=''?$row->grade_name:"N/A";
                    $final_array[$i][2] = isset($row->id) && get_grade_translation($row->id,'cn')!=false?get_grade_translation($row->id,'cn'):"N/A";
                } else {
                    $final_array[$i][1] = isset($row->id) && get_grade_translation($row->id,'en')!=false?get_grade_translation($row->id,'en'):"N/A";
                    $final_array[$i][2] = isset($row->grade_name) && $row->grade_name!=''?$row->grade_name:"N/A";
                }    
                
                $final_array[$i][3] = (isset($row->subject_name) && $row->subject_name != '') ? $row->subject_name : "N/A";

                $final_array[$i][4] = isset($row->created_at) && $row->created_at!=''?get_added_on_date_time($row->created_at):"N/A";
                $final_array[$i][5] = $build_active_btn;
                $final_array[$i][6] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;      
    }

	public function create()
	{
        $arr_lang = []; $subject_arr = [];   

        $subject_obj = $this->SubjectModel->with('subject_traslation')->where('status','1')->get();
        if(count($subject_obj)>0)
        {
            $subject_arr = $subject_obj->toArray();
        }        
        $arr_lang                               	 = $this->LanguageService->get_all_language();
 
        $this->arr_view_data['arr_lang']            = $arr_lang;
        $this->arr_view_data['subject_arr']         = $subject_arr;
        $this->arr_view_data['page_title']          = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Add '.$this->module_title;
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';
        
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug; 

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
    {
        $form_data                              = $arr_data = $arr_lang = $arr_rules = array();
        $form_data                              = $request->all();
        $arr_lang                               = $this->LanguageService->get_all_language();
        /*validate fields*/
        if(isset($arr_lang) && sizeof($arr_lang)>0)
        {
            foreach ($arr_lang as $key => $value) 
            {

                $arr_rules['grade_name_'.$value['locale']] = "required";
                $arr_rules['subject']                      = 'required';      
                /*check duplication of page title*/
                $locale     = isset($value['locale'])?$value['locale']:'';
                $lang_title = isset($value['title'])?$value['title']:'';

                $is_exists  = $this->GradeTranslationModel
                                    ->join('grade','grade.id','=','grade_translation.grade_id')
                                    ->where('name',$form_data['grade_name_'.$locale])
                                    ->where('subject',$request->input('subject'))
                                    ->count();
                if($is_exists>0)
                {
                    Session::flash('error','This grade is already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }
        $validator                              = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['status']  = 1;
        $arr_data['subject'] = $request->input('subject');
        $status    = $this->BaseModel->create($arr_data);

        $arr_lang  = $this->LanguageService->get_all_language();
        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale = isset($lang['locale'])?$lang['locale']:'';
                    $name   = isset($form_data['grade_name_'.$locale])?$form_data['grade_name_'.$locale]:'';
                
                    if($name!="")
                    {
                        $translation           = $status->translateOrNew($lang['locale']);
                        $translation->grade_id = $status->id;
                        $translation->name     = $name;
                        $translation->save();
                    }
                    
                }
            }
            Session::flash('success',$this->module_title.'(s) created successfully');
        }
        else
        {
            Session::flash('error','Problem occured, while creating '.$this->module_title);
        }
       return redirect()->back();
    }  

    public function edit($enc_id=null)
    {
        $subject_arr = []; $arr_grade = []; $arr_lang = array();
        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $obj_grade = $this->GradeModel->where('id',$id)
                                                      ->with('grade_traslation')
                                                      ->first();
            if($obj_grade)
            {
                $arr_grade = $obj_grade->toArray();
                $arr_grade['grade_traslation'] = $this->LanguageService->arrange_locale_wise($arr_grade['grade_traslation']);
            }

            $arr_lang = $this->LanguageService->get_all_language();

            $subject_obj = $this->SubjectModel->with('subject_traslation')->where('status','1')->get();
            if(count($subject_obj)>0)
            {
                $subject_arr = $subject_obj->toArray();
            }        

            $this->arr_view_data['subject_arr']         = $subject_arr;
            $this->arr_view_data['arr_lang']            = $arr_lang;
            $this->arr_view_data['id']                  = base64_encode($id);
            $this->arr_view_data['arr_grade']           = $arr_grade;
            $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
            $this->arr_view_data['page_title']          = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']  = "fa fa-home";
            $this->arr_view_data['parent_module_title'] = "Dashboard";
            $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']         = $this->module_icon;
            $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']          =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']    =  'Edit '.$this->module_title;
            $this->arr_view_data['sub_module_icon']     =  'fa fa-pencil-square-o';
            
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            return view($this->module_view_folder.'.edit',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/manage');
        }
    }

    public function update(Request $request)
    {
        $arr_rules = $arr_lang = [];
        $form_data            = $arr_data = array();
        $form_data            = $request->all();
        
        $grade_id = isset($form_data['grade_id'])?base64_decode($form_data['grade_id']):'';

         if(isset($grade_id) && !empty($grade_id))
         {
                $arr_lang             = $this->LanguageService->get_all_language();

                if(isset($arr_lang) && sizeof($arr_lang)>0)
                {
                    foreach ($arr_lang as $key => $value) 
                    {
                        $arr_rules['grade_name_'.$value['locale']] = "required";
                        $arr_rules['subject']                      = 'required';      

                        $grade_name = $form_data['grade_name_'.$value['locale']];
                        $lang_title = isset($value['title'])?$value['title']:'';

                        $is_grade_name_exists = $this->GradeTranslationModel
                                                        ->join('grade','grade.id','=','grade_translation.grade_id')
                                                        ->where('name','=',$grade_name)
                                                        ->where('subject',$request->input('subject'))
                                                        ->where('grade_id','<>',$grade_id)                                                        
                                                        ->count();
                                                        //dd($is_grade_name_exists);
                        if($is_grade_name_exists>0)
                        {
                            Session::flash('error','This grade is already exist for '.$lang_title.' language.');      
                            return redirect()->back()->withInput($form_data);
                        }
                    }
                }

                $validator = Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                

                $obj_grade = $this->GradeModel->where('id',$grade_id)->first();
                if($obj_grade)
                {
                    $obj_grade->update(['subject' => $request->input('subject')]);
                    if(isset($arr_lang) && sizeof($arr_lang)>0)
                    {
                        foreach ($arr_lang as $key => $lang) 
                        {
                            $locale                        = isset($lang['locale'])?$lang['locale']:'';
                            $subject_name                  = isset($form_data['grade_name_'.$locale])?$form_data['grade_name_'.$locale]:'';  
                          
                            $translation                   = $obj_grade->getTranslation($lang['locale']);
                            if($translation)
                            {
                                $translation->grade_id   = $grade_id;
                                $translation->name    = $subject_name;
                                $status = $translation->save();
                            }
                            else
                            {
                                $translation = $obj_grade->getNewTranslation($lang['locale']);
                                $translation->grade_id   = $grade_id;
                                $translation->name    = $subject_name;
                                $status = $translation->save();
                            }
                        }
                    } 
                }
                if($status)
                {
                    Session::flash('success',str_singular($this->module_title).' details updated successfully.');
                   
                }
                else
                {
                    Session::flash('error','Problem occured while updating '.str_singular($this->module_title));
                }
                return redirect()->back();
         }
         else
         {
              Session::flash('error','Problem occured while updating '.str_singular($this->module_title));
         }
    } 
}
