<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EmailTemplateModel;
use App\Models\EmailTemplateTranslationModel;
use App\Common\Services\LanguageService;

use Validator;
use Session;
use DB;


class EmailTemplateController extends Controller
{

	public function __construct(EmailTemplateModel $email_template_model,
								LanguageService $language_service,
								EmailTemplateTranslationModel $email_template_translation)
	{
		$this->arr_view_data                 = [];
		
		$this->admin_panel_slug              = config('app.project.admin_panel_slug');
		$this->admin_url_path                = url(config('app.project.admin_panel_slug'));
		$this->module_url_path               = $this->admin_url_path."/email_template";
		$this->module_title                  = "Email Template";
		$this->module_view_folder            = "admin.email_template";
		$this->module_icon                   = "fa fa-envelope";
		$this->BaseModel                     = $email_template_model;
		$this->LanguageService               = $language_service;
		$this->EmailTemplateTranslationModel =$email_template_translation;
	}

	public function index()
	{
		$this->arr_view_data['parent_module_icon']   = "fa fa-home";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function edit($enc_id)
	{
		$arr_lang = array();
		$id = base64_decode($enc_id);
		$arr_email_template = $arr_variables = [];

		$obj_email_template = $this->BaseModel->where('id',$id)->with(['translations'])->select('*')->first();
		
		if($obj_email_template)
		{
			$arr_email_template = $obj_email_template->toArray();	
			$arr_email_template['translations']            = $this->LanguageService->arrange_locale_wise($arr_email_template['translations']);
		}		
		$arr_variables = isset($arr_email_template['template_variables']) && !empty($arr_email_template['template_variables']) ? explode("~",$arr_email_template['template_variables']):array();

        $arr_lang = $this->LanguageService->get_all_language();

        $this->arr_view_data['arr_lang']       		= $arr_lang;
		$this->arr_view_data['arr_variables']       = $arr_variables;
		$this->arr_view_data['arr_email_template']  = $arr_email_template;
		$this->arr_view_data['id']                  = $enc_id;
		$this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']  = "fa fa-home";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']        = str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']          = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules = $arr_template = array();
		$status    = false;
		$form_data = $request->all();
		$update    = FALSE;
		$arr_lang  = $this->LanguageService->get_all_language();
        /*validate fields*/
        if(isset($arr_lang) && sizeof($arr_lang)>0)
        {
            foreach ($arr_lang as $key => $value) 
            {
            	if($value['locale']=='en')
                {
                	$arr_rules['template_from_'.$value['locale']]      = "required";
					$arr_rules['template_from_mail_'.$value['locale']] = "required";
                }	
                
				$arr_rules['template_name_'.$value['locale']]      = "required";                       				
				$arr_rules['template_subject_'.$value['locale']]   = "required";
				$arr_rules['template_html_'.$value['locale']]      = "required";

                $messages = [
                                'required' => 'This field is required.',
                            ];                
            }
        }
		
		$validator = Validator::make($request->all(),$arr_rules,$messages);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

		$template_name = $request->input('template_name', null);
		$id         = base64_decode($enc_id);
			//dump($request->all());
		$email_data = $this->BaseModel->where('id',$id)->first();
		if(isset($arr_lang) && sizeof($arr_lang)>0)
		{
            foreach ($arr_lang as $key => $lang) 
            {
            	if($lang['locale']=='en')
            	{
					$arr_data['template_from']      = isset($form_data['template_from_'.$lang['locale']])?$form_data['template_from_'.$lang['locale']]:'';  	
					$arr_data['template_from_mail'] = isset($form_data['template_from_mail_'.$lang['locale']])?$form_data['template_from_mail_'.$lang['locale']]:''; 
					$update                         = $this->BaseModel->where('id',$id)->update($arr_data);  					
            	}			


				$template_name    = isset($form_data['template_name_'.$lang['locale']])?$form_data['template_name_'.$lang['locale']]:'';              	
				$template_subject = isset($form_data['template_subject_'.$lang['locale']])?$form_data['template_subject_'.$lang['locale']]:''; 
				$template_html    = isset($form_data['template_html_'.$lang['locale']])?$form_data['template_html_'.$lang['locale']]:''; 


				if($template_name!="" && $template_subject!="" && $template_html!="")
				{
					$translation  = $email_data->getTranslation($lang['locale']);
					if($translation)
					{
						$translation->template_name    = ucfirst($template_name);
						$translation->template_subject = ucfirst($template_subject);
						$translation->template_html    = $template_html;						
						$update                        = $translation->save();
					}
					else
					{
						$translation                    = $email_data->getNewTranslation($lang['locale']);
						$translation->email_template_id = $email_data->id;
						$translation->template_name     = ucfirst($template_name);
						$translation->template_subject  = ucfirst($template_subject);
						$translation->template_html     = $template_html;
						$update                         = $translation->save();
					}    
				}
                
            }            
            
            if($update)
            {    
                Session::flash('success',str_singular($this->module_title).' details updated successfully.');
                return redirect($this->module_url_path);
            }
            else
            {
                Session::flash('error','Problem occured, while upadating '.$this->module_title);    
                return redirect()->back();
            }		
		}
		
	}

	public function load_data(Request $request)
	{
        $objectData = $final_array = $arr_data = $arr_search_column = $resp = []; 

        $column  = $order = $template_name = $count = $obj_data = '';

        $template_name   = isset($request->template_name) ? $request->template_name : ''; 
        
        if($request->input('order')[0]['column'] == 0) 
        {
            $column = "template_name";
        }
        elseif($request->input('order')[0]['column'] == 1)
        {
        	 $column = "template_subject";
        }

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column      = $request->input('column_filter');

        $tbl_email_template = $this->BaseModel->getTable();


        $obj_data = DB::table($tbl_email_template)
        			->join('email_template_translation','email_template.id','=','email_template_translation.email_template_id')
                    ->select('email_template.id','template_name','template_subject','template_from','template_from_mail','email_template.created_at')
                    ->where('email_template_translation.locale','en');


        if(isset($template_name) && $template_name != "")
        {
           $obj_data = $obj_data->where('email_template_translation.template_name','like','%'.$template_name.'%');
        }        

        $count        = count($obj_data->get());

        if(($order =='' || $order =='ASC') && $column=='')
        {
            $obj_data   = $obj_data->orderBy('email_template.id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            } 
        }
        if($order !='' && $column!='' )
        {
            $obj_data   = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }


        $objectData     = $obj_data->get();

        $resp['draw']            = isset($_GET['draw']) ? $_GET['draw'] : '';
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ; 

        if(count($objectData)>0)
            {
                $i = 0;

                foreach($objectData as $row)
                {

                    $build_action_btn =''; 
                    $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                    $build_action_btn .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';
    
                    $final_array[$i][0] = isset($row->template_name) && $row->template_name!=''?$row->template_name:"N/A";

                    $final_array[$i][1] = isset($row->template_subject) && $row->template_subject!=''?$row->template_subject:"N/A";
                    $final_array[$i][2] = isset($row->template_from) && $row->template_from!=''?$row->template_from:"N/A";
                    $final_array[$i][3] = isset($row->template_from_mail) && $row->template_from_mail!=''?$row->template_from_mail:"N/A";                    
                    $final_array[$i][4] = isset($build_action_btn) ? $build_action_btn : '';
                  
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp));exit;      
    
    
	}

	 public function preview(Request $request)
    {
        $form_data = [];

        $content ="";
        
        $form_data = $request->all();

        if(isset($form_data['preview_html']) && !empty($form_data['preview_html']))
        {
            if(isset($form_data['preview_html']) && !empty($form_data['preview_html']))
            {
                $content = html_entity_decode($form_data['preview_html']);
                return view('email.general',compact('content'))->render();    
            }
            else
            {
                Session::flash('error','Please enter '.str_singular($this->module_title).' content');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error','Problem occured while showing '.str_singular($this->module_title).' preview');
            return redirect()->back();
        }
    }


}
