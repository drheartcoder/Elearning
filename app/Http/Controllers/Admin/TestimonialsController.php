<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TestimonialsModel;
use App\Models\TestimonialsTranslationModel;

use App\Common\Traits\MultiActionTrait;
use App\Common\Services\LanguageService;

use Validator;
use Session;

use DB;

use DataTables;

class TestimonialsController extends Controller
{
   
	use MultiActionTrait;
	
	public function __construct(TestimonialsModel $testimonials_model,TestimonialsTranslationModel $testimonials_translationmodel,LanguageService $language_service)
	{
		$this->arr_view_data      		   = [];
		$this->admin_panel_slug   		   = config('app.project.admin_panel_slug');
		$this->admin_url_path     		   = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    		   = $this->admin_url_path."/testimonials";
		$this->module_title       		   = "Testimonial";
		$this->module_view_folder 		   = "admin.testimonials";
		$this->module_icon        		   = "fa fa-comments";
		$this->BaseModel          		   = $testimonials_model;
		$this->LanguageService    		   = $language_service;

		$this->TestimonialsTranslationModel  = $testimonials_translationmodel;

		$this->testimonials_image_base_path   = base_path().config('app.project.img_path.testimonials_image');
        $this->testimonials_image_public_path = url('/').config('app.project.img_path.testimonials_image');

	}
	
	/*
    | Function  : Display listing.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

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

    /*
    | Function  : Get data to show listing.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	 public function load_data(Request $request)
    {
        $objectData = $final_array = $arr_data = $arr_search_column = $resp = []; 

        $column  = $order = $title = $count = $obj_data = '';

        $title   = isset($request->title) ? $request->title : ''; 
        
        if ($request->input('order')[0]['column'] == 1) 
        {
            $column = "title";
        }    

        if ($request->input('order')[0]['column'] == 3) 
        {
            $column = "created_at";
        }     

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column      = $request->input('column_filter');

        $tbl_testimonials = $this->BaseModel->getTable();

        $tbl_testimonials_translation = $this->TestimonialsTranslationModel->getTable();

        $obj_data = DB::table($tbl_testimonials)
                    ->select($tbl_testimonials.'.id',$tbl_testimonials.'.status',$tbl_testimonials.'.created_at',$tbl_testimonials_translation.'.title',$tbl_testimonials_translation.'.message')
                    ->join($tbl_testimonials_translation, $tbl_testimonials_translation.'.testimonials_id','=',$tbl_testimonials.'.id','left')
                    ->where($tbl_testimonials_translation.'.locale','=','en');


        if(isset($title) && $title != "")
        {
           $obj_data = $obj_data->where($tbl_testimonials_translation.'.title','like','%'.$title.'%');
        }

        $count        = count($obj_data->get());

        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

        
        if(($order =='ASC' || $order =='') && $column=='')
        {
          $obj_data   = $obj_data->orderBy($tbl_testimonials.'.id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if($order !='' && $column!='' )
        {
            if($column == 'title')
            {
                $obj_data   = $obj_data->orderBy($tbl_testimonials_translation.'.'.$column,$order)->limit($data_length)->offset($_GET['start']);
            }
            else
            {
                $obj_data   = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
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
                if(isset($row->status) && $row->status != null && $row->status == "0")
                {   
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif(isset($row->status) && $row->status != null && $row->status == "1")
                {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action =''; 

                $view_href           = $this->module_url_path.'/view/'.base64_encode($row->id);
                $build_view_action  .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View"><i class="material-icons">visibility</i></a>';

                $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                $build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';

                $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon like" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this record ?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>'; 

                if(isset($row->message))
                {
                    $short_message = str_limit(strip_tags($row->message),  100, '...'); 
                }


                $final_array[$i][0] = '<div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>';

                $final_array[$i][1] = isset($row->title) && $row->title!=''?$row->title:"N/A";
                $final_array[$i][2] = isset($short_message) && $short_message!=''?$short_message:"N/A";
                $final_array[$i][3] = isset($row->created_at) && $row->created_at!=''? get_formated_created_date($row->created_at) :"N/A";
                $final_array[$i][4] = isset($build_active_btn) ? $build_active_btn : '';
                $final_array[$i][5] = isset($build_view_action) ? $build_view_action : '';
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;      
    
    }

	/*
    | Function  : Create new front page.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function create()
	{
		$arr_lang                               	 = array();
        $arr_lang                               	 = $this->LanguageService->get_all_language();
	    $this->arr_view_data['arr_lang']     		= $arr_lang;
		
		$this->arr_view_data['title']           = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     =  'Add '.$this->module_title;
        $this->arr_view_data['sub_module_icon']      =  'fa fa-plus';

        $this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;		
		
		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	/*
    | Function  : Store data
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

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
            	 if($value['locale']=='en')
                {
                    $arr_rules['testimonial_image_'.$value['locale']]             = "required";
                        
                }

                $arr_rules['testimonial_name_'.$value['locale']]    = "required";
                $arr_rules['message_'.$value['locale']]             = "required";

                /*check duplication of page title*/
                
                $locale                         = isset($value['locale'])?$value['locale']:'';
                $lang_title                     = isset($value['title'])?$value['title']:'';


            }
        }
        $validator                              = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        if($request->hasFile('testimonial_image_en'))
        {
            $file_name = $request->input('testimonial_image_en');
            $file_extension = strtolower($request->file('testimonial_image_en')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('testimonial_image_en')->move($this->testimonials_image_base_path , $file_name);
                
            }
            else
            {
                Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }

        $arr_data['image']                  	= isset($file_name) ? $file_name : '' ;  
        $arr_data['status']                  	= '1' ;  
        
        $status                                 = $this->BaseModel->create($arr_data);  
        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale                     = isset($lang['locale'])?$lang['locale']:'';
                    $title                 		= isset($form_data['testimonial_name_'.$locale])?$form_data['testimonial_name_'.$locale]:'';  
                    $message                    = isset($form_data['message_'.$locale])?$form_data['message_'.$locale]:'';  
                   if($title!="" && $message!="")
                   {
                        $translation   = $status->translateOrNew($lang['locale']);
                        $translation->testimonials_id  = $status->id;
                        $translation->title     = ucfirst($title);
                        $translation->message     = ucfirst($message);
                        $translation->save();
                   }
                    
                }
            }
            Session::flash('success',$this->module_title.' created successfully');
        }
        else
        {
            Session::flash('error','Problem occured, while creating '.strtolower($this->module_title));
        }
        return redirect($this->module_url_path);
    
	}

	/*
    | Function  : Edit details
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function edit($id=null)
	{
        $arr_testimonials = $arr_lang = [];

		($id)? $id                              = base64_decode($id):NULL;

        $arr_lang                               = $this->LanguageService->get_all_language();      
        
        $obj_testimonials                       = $this->BaseModel->where('id',$id)->with(['translations'])->first();

        if($obj_testimonials)
        {
            $arr_testimonials                           = $obj_testimonials->toArray();

           $arr_testimonials['translations']            = $this->LanguageService->arrange_locale_wise($arr_testimonials['translations']);
        }

        $this->arr_view_data['testimonials_image_base_path']   = $this->testimonials_image_base_path;
        $this->arr_view_data['testimonials_image_public_path'] = $this->testimonials_image_public_path;

		$this->arr_view_data['id']           	    = base64_encode($id);
		
		$this->arr_view_data['arr_testimonials']    = $arr_testimonials;
        $this->arr_view_data['arr_lang']            = $arr_lang;

		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

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

	/*
    | Function  : Update specific record.
    | Author    : Deepak Bari
    | Date      : 15 June, 2018
    */

	public function update(Request $request, $id=null)
	{
		//dd($request->all());

		$testimonials_id = '';

        $form_data                              = $arr_data = array();
        $form_data                              = $request->all();
        $testimonials_id                                = isset($id)?base64_decode($id):'0';
        $data                              = $this->BaseModel->where('id',$testimonials_id)->first();
        $update                                 = FALSE;
        $arr_lang                               = $this->LanguageService->get_all_language();

        /*validate fields*/

        if(isset($arr_lang) && sizeof($arr_lang)>0)
        {
            foreach ($arr_lang as $key => $value) 
            {

                $arr_rules['testimonial_name_'.$value['locale']]    = "required";
                $arr_rules['message_'.$value['locale']]             = "required";

                /*check duplication of title*/
                
                $locale                         = isset($value['locale'])?$value['locale']:'';
                $lang_title                     = isset($value['title'])?$value['title']:'';
            }
        }

        $validator                              = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $old_image = $request->input('oldimage');        
        if($request->hasFile('testimonial_image_en'))
        {
            $file_name = $request->input('testimonial_image_en');
            $file_extension = strtolower($request->file('testimonial_image_en')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('testimonial_image_en')->move($this->testimonials_image_base_path , $file_name);
                if($isUpload)
                {
                    if ($old_image!="" && $old_image!=null) 
                    {
                        if (file_exists($this->testimonials_image_base_path.$old_image))
                        {
                            @unlink($this->testimonials_image_base_path.$old_image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }
        else
        {
        	$file_name=$old_image;
        }
        
        $arr_data['image']                  	= isset($file_name) ? $file_name : '' ;  

        $status                                 = $this->BaseModel->where('id',$testimonials_id)->update($arr_data);  

        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale                     = isset($lang['locale'])?$lang['locale']:'';
                    $title                 		= isset($form_data['testimonial_name_'.$locale])?$form_data['testimonial_name_'.$locale]:'';  
                    $message                    = isset($form_data['message_'.$locale])?$form_data['message_'.$locale]:''; 
                   if($title!="" && $message!="")
                   {
                        $translation            = $data->getTranslation($lang['locale']);
                        if($translation)
                        {
                            $translation->title              = isset($title) ? ucfirst($title) : '';
                            $translation->message            = isset($message) ? $message : '';
                            $update                          = $translation->save();
                        }
                        else
                        {
                            $translation                     = $data->getNewTranslation($lang['locale']);
                            $translation->testimonials_id    = $data->id;
                            $translation->title              = isset($title) ? ucfirst($title) : '';
                            $translation->message               = isset($message) ? $message : '';
                            $update = $translation->save();
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

        return redirect($this->module_url_path1);
    
	}

    /*
    | Function  : View details.
    | Author    : Deepak Bari
    | Date      : 16 June, 2018
    */

    public function view($enc_id=null)
    {

       if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_subscription_plan = [];
            $obj_subscription_plan = $this->BaseModel->where('id',$id)->with('testimonial_translation')->first();
            if($obj_subscription_plan)
            {
                $arr_subscription_plan                                  = $obj_subscription_plan->toArray();
                $arr_subscription_plan['testimonial_translation'] = $this->LanguageService->arrange_locale_wise($arr_subscription_plan['testimonial_translation']);
            }


            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['testimonials_image_base_path']   = $this->testimonials_image_base_path;
            $this->arr_view_data['testimonials_image_public_path'] = $this->testimonials_image_public_path;
            $this->arr_view_data['arr_lang']              = $arr_lang;
            $this->arr_view_data['id']                    = base64_encode($id);
            $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
            $this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
            $this->arr_view_data['page_title']            = "View ".$this->module_title;
            $this->arr_view_data['parent_module_icon']    = "fa fa-home";
            $this->arr_view_data['parent_module_title']   = "Dashboard";
            $this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']           = "fa fa-file-text";
            $this->arr_view_data['module_title']          = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']            = $this->module_url_path;
            $this->arr_view_data['sub_module_title']      = 'View '.$this->module_title;
            $this->arr_view_data['sub_module_icon']       = 'fa fa-eye';
            $this->arr_view_data['module_url_path']       = $this->module_url_path;

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
    | Author    : Deepak Bari
    | Date      : 16 June, 2018
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
    | Author    : Deepak Bari
    | Date      : 16 June, 2018
    */
    
    public function perform_delete($id)
    {
        $is_translation_available = '';

        $obj_img = $this->BaseModel->where('id',$id)->select('image')->first();

        if($obj_img)
        {
            if(isset($obj_img->image) && !empty($obj_img->image) && file_exists($this->testimonials_image_base_path.$obj_img->image))
            {
                 @unlink($this->testimonials_image_base_path.$obj_img->image);
            }
        }

        $delete= $this->BaseModel->where('id',$id)->delete();
        
        if($delete)
        {
            $is_translation_available = $this->TestimonialsTranslationModel->where('testimonials_id',$id);

            if($is_translation_available)
            {
                $is_translation_available->delete();
            }

            return TRUE;
        }

        return FALSE;
    }


}
