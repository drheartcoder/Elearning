<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FrontPagesModel;
use App\Models\FrontPagesTranslationModel;

use App\Common\Traits\MultiActionTrait;
use App\Common\Services\LanguageService;

use Validator;
use Session;
use DB;
use DataTables;

class FrontPagesController extends Controller
{
    use MultiActionTrait;
    
    public function __construct(FrontPagesModel $front_pages_model,FrontPagesTranslationModel $front_page_translation,LanguageService $language_service)
    {
        $this->arr_view_data               = [];
        $this->admin_panel_slug            = config('app.project.admin_panel_slug');
        $this->admin_url_path              = url(config('app.project.admin_panel_slug'));
        $this->module_url_path             = $this->admin_url_path."/front_pages";
        $this->module_title                = "Front Pages";
        $this->module_view_folder          = "admin.front_pages";
        $this->module_icon                 = "fa fa-file-text";
        $this->BaseModel                   = $front_pages_model;
        $this->LanguageService             = $language_service;
        $this->FrontPagesTranslationModel  = $front_page_translation;

        $this->contact_us_banner_image_base_img_path   = base_path().config('app.project.img_path.contact_us_banner_image');
        $this->contact_us_banner_image_public_img_path = url('/').config('app.project.img_path.contact_us_banner_image');
    }
    
    /*
    | Function  : Display listing.
    | Author    : Deepak Bari
    | Date      : 14 June, 2018
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
    | Date      : 14 June, 2018
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

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column      = $request->input('column_filter');

        $tbl_front_pages = $this->BaseModel->getTable();

        $tbl_front_pages_translation = $this->FrontPagesTranslationModel->getTable();

        $obj_data = DB::table($tbl_front_pages)
                    ->select($tbl_front_pages.'.id',$tbl_front_pages_translation.'.meta_keyword',$tbl_front_pages_translation.'.meta_title',$tbl_front_pages.'.status',$tbl_front_pages_translation.'.title',$tbl_front_pages_translation.'.name')
                    ->join($tbl_front_pages_translation, $tbl_front_pages_translation.'.front_page_id','=',$tbl_front_pages.'.id','left')
                    ->where($tbl_front_pages_translation.'.locale','=','en');


        if(isset($title) && $title != "")
        {
           $obj_data = $obj_data->where($tbl_front_pages_translation.'.title','like','%'.$title.'%');
        }

        $count        = count($obj_data->get());        
        
        if(($order =='ASC' || $order =='') && $column=='')
        {
            $obj_data   = $obj_data->orderBy($tbl_front_pages.'.id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }
        if($order !='' && $column!='' )
        {
            if($column == 'title')
            {
                $obj_data   = $obj_data->orderBy($tbl_front_pages_translation.'.'.$column,$order);
                if($_GET['length']!='-1')
                {
                    $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
                }    
            }
            else
            {
                $obj_data   = $obj_data->orderBy($column,$order);
                if($_GET['length']!='-1')
                {
                    $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
                }    
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
                    $edit_href     =  $this->module_url_path.'/edit/'.base64_encode($row->id);
                    $build_view_action .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';

    
                    $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';;

                    $final_array[$i][1] = isset($row->title) && $row->title!=''?$row->title:"N/A";
                    $final_array[$i][2] = isset($row->name) && $row->name!=''?$row->name:"N/A";
                    $final_array[$i][3] = isset($row->meta_keyword) && $row->meta_keyword!=''?$row->meta_keyword:"N/A";
                    $final_array[$i][4] = isset($row->meta_title) && $row->meta_title!=''?$row->meta_title:"N/A";
                    $final_array[$i][5] = isset($build_active_btn) ? $build_active_btn : '';
                    $final_array[$i][6] = isset($build_view_action) ? $build_view_action : '';
                  
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp));exit;      
    
    }

    /*
    | Function  : Create new front page.
    | Author    : Deepak Bari
    | Date      : 14 June, 2018
    */

    public function create()
    {
        $arr_lang                                    = array();
        $arr_lang                                    = $this->LanguageService->get_all_language();

        $this->arr_view_data['arr_lang']             = $arr_lang;
        
        $this->arr_view_data['page_title']           = "Add ".str_singular($this->module_title);
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     =  'Add '.str_singular($this->module_title);
        $this->arr_view_data['sub_module_icon']      =  'fa fa-plus';

        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;     
        
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    /*
    | Function  : Store data
    | Author    : Deepak Bari
    | Date      : 14 June, 2018
    */

    public function store(Request $request)
    {
        $form_data                              = $arr_data = $arr_lang = $arr_rules = array();
        $form_data                              = $request->all();
        $arr_lang                               = $this->LanguageService->get_all_language();

        /*validate fields*/

        if (isset($arr_lang) && sizeof($arr_lang) > 0) {
            foreach ($arr_lang as $key => $value) {
                // if($value['locale']=='en') {
                    $arr_rules['meta_keyword_'.$value['locale']]     = "required";
                    $arr_rules['meta_title_'.$value['locale']]       = "required";
                    $arr_rules['meta_description_'.$value['locale']] = "required";       
                // }
                    $arr_rules['title_'.$value['locale']]            = "required";
                    $arr_rules['page_name_'.$value['locale']]        = "required";
                    $arr_rules['page_description_'.$value['locale']] = "required";

                $locale     = isset($value['locale'])?$value['locale']:'';
                $lang_title = isset($value['title'])?$value['title']:'';

                $is_page_exists = $this->FrontPagesTranslationModel->where('title',$form_data['title_'.$locale])->count();
                
                if ($is_page_exists > 0) {
                    Session::flash('error','This page title is already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }

        $validator = Validator::make($request->all(),$arr_rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['page_slug'] = str_slug(isset($form_data['title_'.$locale])?$form_data['title_'.$locale]:'');
        $status                = $this->BaseModel->create($arr_data);  
        if ($status) {
            if (isset($arr_lang) && sizeof($arr_lang) > 0) {
                foreach ($arr_lang as $key => $lang) {
                    $locale           = isset($lang['locale'])?$lang['locale']:'';
                    $title            = isset($form_data['title_'.$locale])?$form_data['title_'.$locale]:'';  
                    $meta_title       = isset($form_data['meta_title_'.$locale])?$form_data['meta_title_'.$locale]:'';
                    $meta_keyword     = isset($form_data['meta_keyword_'.$locale])?$form_data['meta_keyword_'.$locale]:'';
                    $meta_description = isset($form_data['meta_description_'.$locale])?$form_data['meta_description_'.$locale]:'';
                    
                    $page_name        = isset($form_data['page_name_'.$locale])?$form_data['page_name_'.$locale]:'';  
                    $page_description = isset($form_data['page_description_'.$locale])?$form_data['page_description_'.$locale]:''; 

                   if ($title!="" && $page_description!="") {
                        $translation                   = $status->translateOrNew($lang['locale']);
                        $translation->front_page_id    = $status->id;
                        $translation->title            = ucfirst($title);
                        $translation->meta_title       = ucfirst($meta_title);
                        $translation->meta_keyword     = ucfirst($meta_keyword);
                        $translation->meta_description = ucfirst($meta_description);
                        $translation->name             = ucfirst($page_name);
                        $translation->description      = ucfirst($page_description);

                        $translation->save();
                   }
                    
                }
            }
            Session::flash('success','Page created successfully');
        } else {
            Session::flash('error','Problem occured, while creating '.$this->module_title);
        }
        return redirect($this->module_url_path);
    }

    /*
    | Function  : Edit details
    | Author    : Deepak Bari
    | Date      : 14 June, 2018
    */

    public function edit($id=null)
    {
        $arr_page = $arr_lang = [];
        ($id) ? $id = base64_decode($id) : NULL;
        $arr_lang                               = $this->LanguageService->get_all_language();
        $obj_page                               = $this->BaseModel->where('id',$id)->with(['translations'])->first();
        if ($obj_page) {
            $arr_page                           = $obj_page->toArray();
           $arr_page['translations']            = $this->LanguageService->arrange_locale_wise($arr_page['translations']);
        }
        $this->arr_view_data['id']                                       = base64_encode($id);
        $this->arr_view_data['page_details']                             = $arr_page;
        $this->arr_view_data['arr_lang']                                 = $arr_lang;
        $this->arr_view_data['admin_panel_slug']                         = $this->admin_panel_slug;
        $this->arr_view_data['page_title']                               = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['parent_module_icon']                       = "icon-home2";
        $this->arr_view_data['parent_module_title']                      = "Dashboard";
        $this->arr_view_data['parent_module_url']                        = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']                              = $this->module_icon;
        $this->arr_view_data['module_title']                             = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']                               = $this->module_url_path;
        $this->arr_view_data['contact_us_banner_image_public_img_path']  = $this->contact_us_banner_image_public_img_path;
        $this->arr_view_data['sub_module_title']                         = 'Edit '.str_singular($this->module_title);
        $this->arr_view_data['sub_module_icon']                          = 'fa fa-pencil-square-o';
        $this->arr_view_data['module_url_path']                          = $this->module_url_path;
        
        if(isset($arr_page) && count($arr_page)>0)
        {
            if($arr_page['page_slug']=='contact-us-page'){
                return view($this->module_view_folder.'.edit_contact_us',$this->arr_view_data);
            }
        }
        return view($this->module_view_folder.'.edit',$this->arr_view_data);
    }

    /*
    | Function  : Update specific record.
    | Author    : Deepak Bari
    | Date      : 14 June, 2018
    */

    public function update(Request $request, $id=null)
    {
        $page_id = '';

        $form_data = $arr_data = array();
        $form_data = $request->all();
        $page_id   = isset($id)?base64_decode($id):'0';
        $page_data = $this->BaseModel->where('id',$page_id)->first();
        $update    = FALSE;
        $arr_lang  = $this->LanguageService->get_all_language();
        
        if(isset($arr_lang) && sizeof($arr_lang)>0) {
            foreach ($arr_lang as $key => $value) {
                // if ($value['locale']=='en') {
                    $arr_rules['meta_keyword_'.$value['locale']]     = "required";
                    $arr_rules['meta_title_'.$value['locale']]       = "required";
                    $arr_rules['meta_description_'.$value['locale']] = "required";       
                // }
                    $arr_rules['page_name_'.$value['locale']]        = "required";
                    $arr_rules['title_'.$value['locale']]            = "required";
                    $arr_rules['page_description_'.$value['locale']] = "required";

                $messages = [ 'required' => 'This field is required.',];

                /*check duplication of page title*/
                $locale     = isset($value['locale']) ? $value['locale']:'';
                $lang_title = isset($value['title']) ? $value['title']:'';

                $is_page_exists = $this->FrontPagesTranslationModel->where('title','=',$form_data['title_'.$locale])
                                                                    ->where('front_page_id','<>',$page_id)
                                                                    ->count();

                if ($is_page_exists > 0) {
                    Session::flash('error','This page title is already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }
        
        $validator = Validator::make($request->all(),$arr_rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        
        $status = $this->BaseModel->where('id',$page_id)->update($arr_data);

        if ($status) {
            if (isset($arr_lang) && sizeof($arr_lang) > 0) {
                foreach ($arr_lang as $key => $lang) {
                    $page_name        = isset($form_data['page_name_'.$lang['locale']])?$form_data['page_name_'.$lang['locale']]:'';  
                    
                    $title            = isset($form_data['title_'.$lang['locale']]) ? $form_data['title_'.$lang['locale']] : '';  
                    $meta_keyword     = isset($form_data['meta_keyword_'.$lang['locale']]) ? $form_data['meta_keyword_'.$lang['locale']] : '';
                    $meta_title       = isset($form_data['meta_title_'.$lang['locale']]) ? $form_data['meta_title_'.$lang['locale']] : '';
                    $meta_description = isset($form_data['meta_description_'.$lang['locale']]) ? $form_data['meta_description_'.$lang['locale']] : '';
                    
                    $page_description = isset($form_data['page_description_'.$lang['locale']]) ? $form_data['page_description_'.$lang['locale']] : '';

                    if ($title != "" && $page_description != "") {
                        $translation = $page_data->getTranslation($lang['locale']);
                        
                        if ($translation) {
                            $translation->title            = ucfirst($title);
                            $translation->name             = ucfirst($page_name);
                            $translation->meta_keyword     = ucfirst($meta_keyword);
                            $translation->meta_title       = ucfirst($meta_title);
                            $translation->meta_description = ucfirst($meta_description);
                            $translation->description      = $page_description;

                            $update = $translation->save();
                        } else {
                            $translation                   = $page_data->getNewTranslation($lang['locale']);
                            $translation->front_page_id    = $page_data->id;
                            $translation->title            = ucfirst($title);
                            $translation->name             = ucfirst($page_name);
                            $translation->meta_keyword     = ucfirst($meta_keyword);
                            $translation->meta_title       = ucfirst($meta_title);
                            $translation->meta_description = ucfirst($meta_description);
                            $translation->description      = $page_description;

                            $update = $translation->save();
                        }    
                   }
                }
            }
            
            if ($update) {
                Session::flash('success',str_singular($this->module_title).' details updated successfully.');
            } else {
                Session::flash('error','Problem occured, while upadating '.$this->module_title);    
            }
            return redirect($this->module_url_path);
        } else {
            Session::flash('error','Problem occured, while upadating '.$this->module_title);
        }

        return redirect($this->module_url_path1);
    
    }

    public function update_contact_us(Request $request)
    {
        $arr_data = array();
        $update    = FALSE;
        $arr_rules['banner_image'] = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if($request->hasFile('banner_image'))
        {
            $file_name  = $request->input('banner_image');
            $old_image = $request->input('old_banner_image');
            $file_extension = strtolower($request->file('banner_image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('banner_image')->move($this->contact_us_banner_image_base_img_path , $file_name);
                if($isUpload)
                {
                    if ($old_image!="" && $old_image!=null) 
                    {
                        if (file_exists($this->contact_us_banner_image_base_img_path.$old_image))
                        {
                            @unlink($this->contact_us_banner_image_base_img_path.$old_image);
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
            $file_name = $old_image;
        }
        $arr_data['banner_image'] = $file_name;
        $status = $this->BaseModel->where('page_slug','contact-us-page')->update($arr_data);

        if ($status) {
            Session::flash('success',str_singular($this->module_title).' details updated successfully.');
        } else {
            Session::flash('error','Problem occured, while upadating '.$this->module_title);
        }

        return redirect()->back();
    
    }    

}
