<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Models\QuestionModel;
use App\Models\QuestionTranslationModel;
use App\Models\ProgramModel;
use App\Models\GradeModel;
use App\Models\SubjectModel;
use App\Models\TemplateModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class QuestionController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                    QuestionTranslationModel $question_translation_model,
                                    QuestionModel            $question_model,
                                    LanguageService          $language_service,
                                    ProgramModel            $program_model,
                                    GradeModel              $grade_model,
                                    SubjectModel            $subject_model,
                                    TemplateModel           $template_model
                                )
	{
        $this->arr_view_data            = [];
        $this->module_title             = "Question";
        $this->module_icon              = "fa fa-tasks";
        $this->module_view_folder       = "creator.question";
        $this->creator_url_path         = url(config('app.project.creator_panel_slug'));
        $this->creator_panel_slug       = config('app.project.creator_panel_slug');
        $this->module_url_path          = url(config('app.project.creator_panel_slug')."/question");

        $this->BaseModel                = $question_model;
        $this->QuestionModel            = $question_model;
        $this->QuestionTranslationModel = $question_translation_model;
        $this->LanguageService          = $language_service;
        $this->ProgramModel            = $program_model;
        $this->GradeModel              = $grade_model;
        $this->SubjectModel            = $subject_model;
        $this->TemplateModel           = $template_model;

        DB::connection()->enableQueryLog();
	}

	public function index()
	{
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "icon-home2";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/program-creator/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;

        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['creator_panel_slug']  = $this->creator_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

    public function load_data(Request $request)
    {
        $SubjectData = $final_array = [];
        $column      = '';
        $keyword     = $request->input('keyword');
        
        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "title";
        }
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "description";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = $this->BaseModel;

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->with("question_translation")
                                ->whereHas("question_translation", function($query) use ($keyword){
                                    $query->whereRaw("(title LIKE '%".$keyword."%' OR description LIKE '%".$keyword."%' )");
                                });
        }

        $count = count($obj_data->get());
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        

        if(($order == 'ASC' || $order == '') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        
        if($order != '' && $column != '' )
        {
            if($column == 'title')
            {
                $obj_data = $obj_data->whereHas('question_translation', function ($query) use ($column, $order,$data_length)
                {
                    $query->orderBy($column, $order)->limit($data_length)->offset($_GET['start']);
                });
            }
            elseif($column == 'description')
            {
                $obj_data = $obj_data->whereHas('question_translation', function ($query) use ($column, $order,$data_length)
                {
                    $query->orderBy($column, $order)->limit($data_length)->offset($_GET['start']);
                });
            }
            else
            {
                $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
            }
        }


        $QuestionData             = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($QuestionData) > 0)
        {
            $i = 0;

            foreach($QuestionData as $row)
            {
                if($row['status'] != null && $row['status'] == "0")
                {   
                    $build_active_btn = '<a class="btn btn-sm btn-danger" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="fa fa-lock"></i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1")
                {
                   $build_active_btn = '<a class="btn btn-sm btn-success" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row['id']).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="fa fa-unlock"></i></a>';      
                }

                $build_view_action = '';
                $edit_href         = $this->module_url_path.'/edit/'.base64_encode($row['id']);
                $delete_href       = $this->module_url_path.'/delete/'.base64_encode($row['id']);
                $view_href         = $this->module_url_path.'/view/'.base64_encode($row['id']);

                $build_view_action .= '&nbsp;<a class="btn btn-outline btn-info btn-circle show-tooltip" href="'.$view_href.'" title="View"><i class="fa fa-eye" ></i></a>';
                $build_view_action .= '&nbsp;<a class="btn btn-outline btn-info btn-circle show-tooltip" href="'.$edit_href.'" title="Edit"><i class="fa fa-pencil" ></i></a>';
                $build_view_action .= '&nbsp;<a class="btn btn-circle btn-danger btn-outline show-tooltip" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="fa fa-trash" ></i></a>'; 

                $final_array[$i][0] = "<input type='checkbox' name='checked_record[]' id='checked_record' class='checked_record' value='".base64_encode($row['id'])."'/>";

                $final_array[$i][1] = isset($row['title']) && $row['title'] != '' ? ucfirst($row['title']) : "NA";
                $final_array[$i][2] = isset($row['description']) && $row['description'] != '' ? str_limit(strip_tags($row['description']),  100, '...') : "NA";
                $final_array[$i][3] = isset($row['created_at']) && $row['created_at'] != '' ? get_added_on_date_time($row['created_at']) : "NA";
                $final_array[$i][4] = $build_active_btn;
                $final_array[$i][5] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

    public function load_template($id = null)
    {
        if($id)
        {
            try{
                $this->arr_view_data['arr_lang'] = $this->LanguageService->get_all_language();

                return view('creator.template.template'.$id, $this->arr_view_data);
            }

            catch(\Exception $e){
                echo '<div class="form-group"><label class="control-label col-lg-2"></label><div class="col-lg-5">Error!! Template Not Found</div></div>';
            }

        }
    }

	public function create()
	{
        $arr_lang = array();
        $arr_lang = $this->LanguageService->get_all_language();

        $obj_grade = $this->GradeModel->where('status', '1')->get();
        if($obj_grade)
        {
            $arr_grade = $obj_grade->toArray();
        }

        $obj_subject = $this->SubjectModel->where('status', '1')->get();
        if($obj_subject)
        {
            $arr_subject = $obj_subject->toArray();
        }

        $obj_template = $this->TemplateModel->get();
        if($obj_template)
        {
            $arr_template = $obj_template->toArray();
        }
        
        $obj_program = $this->ProgramModel->where('status', '1')->get();
        if($obj_program)
        {
            $arr_program = $obj_program->toArray();
        }
 
        $this->arr_view_data['arr_lang']            = $arr_lang;
        $this->arr_view_data['arr_grade']           = $arr_grade;
        $this->arr_view_data['arr_subject']         = $arr_subject;
        $this->arr_view_data['arr_template']        = $arr_template;
        $this->arr_view_data['arr_program']         = $arr_program;
        $this->arr_view_data['page_title']          = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "icon-home2";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/program-creator/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Add '.$this->module_title;
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['creator_panel_slug']  = $this->creator_panel_slug;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
    {
        $arr_data  = $form_data = $arr_lang = $arr_rules = array();
        $form_data = $request->all();

        $arr_lang  = $this->LanguageService->get_all_language();

        if(isset($arr_lang) && sizeof($arr_lang)>0)
        {
            foreach ($arr_lang as $key => $value) 
            {
                $arr_rules['question_name_'.$value['locale']]        = "required";
                $arr_rules['question_description_'.$value['locale']] = "required";

                $locale     = isset($value['locale']) ? $value['locale'] : '';
                $lang_title = isset($value['title']) ? $value['title'] : '';

                $is_page_exists = $this->QuestionTranslationModel->where('title', $form_data['question_name_'.$locale])->count();
                if($is_page_exists > 0)
                {
                    Session::flash('error','This question name already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['slug']   = str_slug($form_data['question_name_en']);
        $arr_data['status'] = '1';
        $status             = $this->BaseModel->create($arr_data);
        $question_id         = 'P'.str_pad($status->id, 6, "0", STR_PAD_LEFT);

        $this->BaseModel->where('id', $status->id)->update(array('unique_id' => $question_id));

        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale      = isset($lang['locale']) ? $lang['locale'] : '';
                    $title       = isset($form_data['question_name_'.$locale]) ? $form_data['question_name_'.$locale] : '';
                    $description = isset($form_data['question_description_'.$locale]) ? $form_data['question_description_'.$locale] : '';
                
                    if($title != "" && $description != "")
                    {
                        $translation              = $status->translateOrNew($lang['locale']);
                        $translation->question_id  = $status->id;
                        $translation->title       = $title;
                        $translation->description = $description;
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

    public function edit($enc_id = null)
    {
       if($enc_id)
        {
            $arr_lang = array();
            $id       = base64_decode($enc_id);

            $arr_question = [];
            $obj_question = $this->QuestionModel->where('id',$id)->with('question_translation')->first();
            if($obj_question)
            {
                $arr_question                        = $obj_question->toArray();
                $arr_question['question_translation'] = $this->LanguageService->arrange_locale_wise($arr_question['question_translation']);
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']            = $arr_lang;
            $this->arr_view_data['id']                  = base64_encode($id);
            $this->arr_view_data['arr_question']         = $arr_question;
            $this->arr_view_data['creator_panel_slug']  = $this->creator_panel_slug;
            $this->arr_view_data['page_title']          = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']  = "icon-home2";
            $this->arr_view_data['parent_module_title'] = "Dashboard";
            $this->arr_view_data['parent_module_url']   = url('/').'/program-creator/dashboard';
            $this->arr_view_data['module_icon']         = $this->module_icon;
            $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']          = $this->module_url_path;
            $this->arr_view_data['sub_module_title']    = 'Edit '.$this->module_title;
            $this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';
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
        $arr_rules = $arr_lang = $form_data = $arr_data = array();
        $file_name = $update = '';
        $form_data = $request->all();

        $question_id = isset($form_data['question_id']) ? base64_decode($form_data['question_id']) : '';

        if(isset($question_id) && !empty($question_id))
        {
            $arr_lang = $this->LanguageService->get_all_language();

            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $value) 
                {
                    $arr_rules['question_name_'.$value['locale']]        = "required";
                    $arr_rules['question_description_'.$value['locale']] = "required";

                    $locale     = isset($value['locale']) ? $value['locale'] : '';
                    $lang_title = isset($value['title']) ? $value['title'] : '';

                    $is_exists  = $this->QuestionTranslationModel->where('title', $form_data['question_name_'.$locale])
                                                                ->where('question_id','<>',$question_id)
                                                                ->count();
                    if($is_exists > 0)
                    {
                        Session::flash('error','This question name already exist for '.$lang_title.' language.');      
                        return redirect()->back();
                    }
                }
            }

            $arr_data['slug'] = str_slug($form_data['question_name_en']);
            $status           = $this->BaseModel->where('id',$question_id)->update($arr_data);

            if($status)
            {
                if(isset($arr_lang) && sizeof($arr_lang)>0)
                {
                    $data = $this->BaseModel->where('id',$question_id)->first();
                    foreach ($arr_lang as $key => $lang) 
                    {
                        $locale      = isset($lang['locale']) ? $lang['locale'] : '';
                        $title       = isset($form_data['question_name_'.$locale]) ? $form_data['question_name_'.$locale] : '';
                        $description = isset($form_data['question_description_'.$locale]) ? $form_data['question_description_'.$locale] : '';

                       if($title != "" && $description != '')
                       {
                            $translation = $data->getTranslation($locale);
                            if($translation)
                            {
                                $translation->title       = $title;
                                $translation->description = $description;
                                $update                   = $translation->save();
                            }
                            else
                            {
                                $translation              = $data->getNewTranslation($locale);
                                $translation->question_id  = $data->id;
                                $translation->title       = $title;
                                $translation->description = $description;
                                $update                   = $translation->save();
                            }    
                       }
                        
                    }
                }
                
                if($update)
                {    
                    Session::flash('success',str_singular($this->module_title).' details updated successfully.');
                }
                else
                {
                    Session::flash('error','Problem occured, while upadating '.$this->module_title);    
                }
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error','Problem occured, while upadating '.$this->module_title);
            }
        }
        else
        {
            Session::flash('error','Problem occured while updating '.str_singular($this->module_title));
        }
    } 

    public function view($enc_id=null)
    {
       if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_question = [];
            $obj_question = $this->BaseModel->where('id',$id)->with('question_translation')->first();
            if($obj_question)
            {
                $arr_question                        = $obj_question->toArray();
                $arr_question['question_translation'] = $this->LanguageService->arrange_locale_wise($arr_question['question_translation']);
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']            = $arr_lang;
            $this->arr_view_data['id']                  = base64_encode($id);
            $this->arr_view_data['arr_question']         = $arr_question;
            $this->arr_view_data['creator_panel_slug']  = $this->creator_panel_slug;
            $this->arr_view_data['page_title']          = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']  = "icon-home2";
            $this->arr_view_data['parent_module_title'] = "Dashboard";
            $this->arr_view_data['parent_module_url']   = url('/').'/program-creator/dashboard';
            $this->arr_view_data['module_icon']         = $this->module_icon;
            $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']          = $this->module_url_path;
            $this->arr_view_data['sub_module_title']    = 'View '.$this->module_title;
            $this->arr_view_data['sub_module_icon']     = 'fa fa-eye';
            $this->arr_view_data['module_url_path']     = $this->module_url_path;

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
    | Date      : 18 June, 2018
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
    | Date      : 18 June, 2018
    */
    
    public function perform_delete($id)
    {
        $is_translation_available = '';

        $delete = $this->BaseModel->where('id',$id)->delete();
        
        if($delete)
        {
            $is_translation_available = $this->QuestionTranslationModel->where('question_id',$id);

            if($is_translation_available)
            {
                $is_translation_available->delete();
            }

            return TRUE;
        }

        return FALSE;
    }
}
