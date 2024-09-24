<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CertificateModel;
use App\Models\LanguageModel;

use Validator;
use Session;
use DB;


class CertificateController extends Controller
{

	public function __construct(CertificateModel $certificate_model)
	{
		$this->arr_view_data           = [];
		
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/certificate";
		$this->module_title       = "Certificate";
		$this->module_view_folder = "admin.certificate";
		$this->module_icon        = "fa fa-file-text";
		$this->BaseModel          = $certificate_model;
		$this->LanguageModel      = new LanguageModel();
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
		$id = base64_decode($enc_id);
		$arr_flyer = $arr_variables = [];  $lang_arr = [];

		$obj_flyer = $this->BaseModel->where('id',$id)->select('*')->first();
		
		if($obj_flyer)
		{
			$arr_flyer = $obj_flyer->toArray();	
		}


		$lang_arr = $this->LanguageModel->where('status','1')->get();



		$arr_variables = isset($arr_flyer['template_variables']) && !empty($arr_flyer['template_variables']) ? explode("~",$arr_flyer['template_variables']):array();

		$this->arr_view_data['arr_variables']       = $arr_variables;
		$this->arr_view_data['arr_flyer']           = $arr_flyer;
		$this->arr_view_data['id']                  = $enc_id;
		$this->arr_view_data['lang_arr']            = $lang_arr;		 
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
		$arr_rules      = $arr_template = array();
		$status         = false;

		$arr_rules['template_name']      = "required";
		$arr_rules['template_from']      = "required";
		$arr_rules['template_from_mail'] = "required";
		$arr_rules['template_subject']   = "required";
		$arr_rules['template_html']      = "required";
		$arr_rules['lang']             	 = "required";


		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$template_name = $request->input('template_name', null);
		$id         = base64_decode($enc_id);


		$arr_template['template_name']      = $template_name;
		$arr_template['template_from']      = $request->input('template_from', null);
		$arr_template['template_from_mail'] = $request->input('template_from_mail', null);
		$arr_template['template_subject']   = $request->input('template_subject', null);
		$arr_template['template_html']      = $request->input('template_html', null);
		$arr_template['locale']             = $request->input('lang', null);


		/*$dose_exist = $this->BaseModel->where('template_name', '=', $template_name)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', $this->module_title.' with this name already exist.');
			return redirect()->back();
		}*/
		$status = $this->BaseModel->where('id', $id)->update($arr_template);		

		if($status)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect()->back();
		}

		Session::flash('error', 'Error while updating '.$this->module_title.'.');
		return redirect()->back();
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

        elseif($request->input('order')[0]['column'] == 4)
        {
        	 $column = "created_at";
        }    

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column      = $request->input('column_filter');

        $tbl_flyer = $this->BaseModel->getTable();


        $obj_data = DB::table($tbl_flyer)
                    ->select('id','template_name','template_subject','template_from','template_from_mail','created_at');
                   
                   


        if(isset($template_name) && $template_name != "")
        {
           $obj_data = $obj_data->where('.template_name','like','%'.$template_name.'%');
        }
      

       
        $count        = count($obj_data->get());

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
                    $final_array[$i][4] = isset($row->created_at) && $row->created_at!=''? get_formated_created_date($row->created_at) :"N/A";
                    $final_array[$i][5] = isset($build_action_btn) ? $build_action_btn : '';
                  
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
