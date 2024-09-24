<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Models\SubjectModel;
use App\Models\SubjectTranslationModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class SubjectController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                    LanguageService         $language_service,
                                    SubjectModel            $subject_model,
                                    SubjectTranslationModel $subject_translation
                                )
	{
        $this->arr_view_data           = [];
        $this->LanguageService         = $language_service;
        $this->SubjectModel            = $subject_model;
        $this->BaseModel               = $this->SubjectModel;
        $this->SubjectTranslationModel = $subject_translation;

        $this->module_title            = "Subject";
        $this->module_icon             = "fa fa-book";
        $this->module_view_folder      = "admin.subject";
        $this->admin_url_path          = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/subject");
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
        $SubjectData    =  $final_array=[]; 
        $column      = '';
        $subject_name   = $request->input('subject_name'); 
        
        if ($request->input('order')[0]['column'] == 1) 
        {
            $column = "subject_name";
        }
        if ($request->input('order')[0]['column'] == 2) 
        {
            $column = "subject_name";
        }     
  

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_data               = [];        
        $arr_search_column      = $request->input('column_filter');
        //DB::enableQueryLog();
        $obj_data = DB::table('subject')
                    ->select('subject.id',
                             'subject.status',
                             'subject_translation.name as subject_name',
                             'subject_translation.locale',
                             'subject.created_at')
                    ->join('subject_translation','subject_translation.subject_id','=','subject.id','left')
                    ->where('subject.deleted_at','=',null);
        
        if($subject_name == "")
        {
            $obj_data = $obj_data->where('subject_translation.locale','=','en');                                    
        }

        if(isset($subject_name) && $subject_name != "")
        {
            $obj_data = $obj_data->where('subject_translation.name','=',$subject_name);
        }

        $count        = count($obj_data->get());
        //dd($obj_data->get(),DB::getQueryLog()); 
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        if(($order =='ASC' || $order=='') && $column=='')
        {
          $obj_data   = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if( $order !='' && $column!='' )
        {
          $obj_data   = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        $SubjectData     = $obj_data->get();

        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ; 

        if(count($SubjectData)>0)
        {
            $i = 0;

            foreach($SubjectData as $row)
            {
                if($row->status != null && $row->status == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row->status != null && $row->status == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action =''; 
                $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                $build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';
              
                $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 


                $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                
                if($row->locale=='en')
                {
                    $final_array[$i][1] = isset($row->subject_name) && $row->subject_name!=''?$row->subject_name:"N/A";
                    $final_array[$i][2] = isset($row->id) && get_subject_translation($row->id,'cn')!=false?get_subject_translation($row->id,'cn'):"N/A";
                }
                else
                {
                    $final_array[$i][1] = isset($row->id) && get_subject_translation($row->id,'en')!=false?get_subject_translation($row->id,'en'):"N/A";
                    $final_array[$i][2] = isset($row->subject_name) && $row->subject_name!=''?$row->subject_name:"N/A";
                }
                
                $final_array[$i][3] = isset($row->created_at) && $row->created_at!=''? get_added_on_date_time($row->created_at) :"N/A";
                $final_array[$i][4] = $build_active_btn;
                $final_array[$i][5] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;      
    }

	public function create()
	{
        $arr_lang                                   = array();
        $arr_lang                                   = $this->LanguageService->get_all_language();
 
        $this->arr_view_data['arr_lang']            = $arr_lang;

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

                $arr_rules['subject_name_'.$value['locale']]             = "required";
                   
                /*check duplication of page title*/
                $locale                         = isset($value['locale'])?$value['locale']:'';
                $lang_title                     = isset($value['title'])?$value['title']:'';

                $is_page_exists                 = $this->SubjectTranslationModel->where('name',$form_data['subject_name_'.$locale])->count();
                if($is_page_exists>0)
                {
                    Session::flash('error','This subject name is already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }
        $validator                              = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['status'] = 1;
        $arr_data['subject_slug'] = str_slug($form_data['subject_name_en']);

        $status    = $this->BaseModel->create($arr_data);

        $arr_lang  = $this->LanguageService->get_all_language();
        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale                                  = isset($lang['locale'])?$lang['locale']:'';
                    $name                                    = isset($form_data['subject_name_'.$locale])?$form_data['subject_name_'.$locale]:'';  
                
                    if($name!="")
                    {
                        $translation                         = $status->translateOrNew($lang['locale']);
                        $translation->subject_id             = $status->id;
                        $translation->name                   = $name;
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
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_subject = [];
            $obj_subject = $this->SubjectModel->where('id',$id)
                                              ->with('subject_traslation')
                                              ->first();
            if($obj_subject)
            {
                $arr_subject = $obj_subject->toArray();
                $arr_subject['subject_traslation'] = $this->LanguageService->arrange_locale_wise($arr_subject['subject_traslation']);
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']        = $arr_lang;

            $this->arr_view_data['id']                  = base64_encode($id);
            $this->arr_view_data['arr_subject'] = $arr_subject;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']     =  'Edit '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      =  'fa fa-pencil-square-o';
            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
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
        
        $subject_id = isset($form_data['subject_id'])?base64_decode($form_data['subject_id']):'';

         if(isset($subject_id) && !empty($subject_id))
         {
                $arr_lang             = $this->LanguageService->get_all_language();

                if(isset($arr_lang) && sizeof($arr_lang)>0)
                {
                    foreach ($arr_lang as $key => $value) 
                    {
                        $arr_rules['subject_name_'.$value['locale']] = "required";
                    }
                }

                $validator = Validator::make($request->all(),$arr_rules);
                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $slug = isset($form_data['subject_name_en']) ? str_slug($form_data['subject_name_en']) : '';

                $is_exists = $this->SubjectModel->where('subject_slug','=',$slug)
                                                ->where('id','<>',$subject_id)
                                                ->count();
                if($is_exists > 0)
                {
                    Session::flash('error','Subject Name is Already Exists.'); 
                }
                else
                {

                        $obj_subject = $this->SubjectModel->where('id',$subject_id)->first();
                        if($obj_subject)
                        {
                            $update_status       = $obj_subject->update(['subject_slug'=>$slug]);

                            if($update_status)
                            { 
                                if(isset($arr_lang) && sizeof($arr_lang)>0)
                                {
                                    foreach ($arr_lang as $key => $lang) 
                                    {
                                        $locale                        = isset($lang['locale'])?$lang['locale']:'';
                                        $subject_name                  = isset($form_data['subject_name_'.$locale])?$form_data['subject_name_'.$locale]:'';  
                                      
                                        $translation                   = $obj_subject->getTranslation($lang['locale']);
                                        if($translation)
                                        {
                                            $translation->subject_id   = $subject_id;
                                            $translation->name    = $subject_name;
                                            $status = $translation->save();
                                        }
                                        else
                                        {
                                            $translation = $obj_subject->getNewTranslation($lang['locale']);
                                            $translation->subject_id   = $subject_id;
                                            $translation->name    = $subject_name;
                                            $status = $translation->save();
                                        }
                                    }
                                }
                            }
                            else
                            {
                                Session::flash('error','Problem occured, while creating '.str_singular($this->module_title));
                                return redirect()->back();
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

                        return redirect($this->module_url_path.'/');
                }
                return redirect()->back();

               
         }
         else
         {
              Session::flash('error','Problem occured while updating '.str_singular($this->module_title));
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
            $is_translation_available = $this->SubjectTranslationModel->where('subject_id',$id);

            if($is_translation_available)
            {
                $is_translation_available->delete();
            }

            return TRUE;
        }

        return FALSE;
    }
}
