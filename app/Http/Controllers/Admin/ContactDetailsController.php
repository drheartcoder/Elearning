<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactDetailsModel;
use App\Models\ContactAddressTranslationModel;
use App\Common\Traits\MultiActionTrait;
use App\Common\Services\LanguageService;

use Validator;
use Session;

class ContactDetailsController extends Controller
{
    use MultiActionTrait;
    public function __construct(ContactDetailsModel $contact_details,
                                ContactAddressTranslationModel $contact_address_translation
                               )
    {
        $this->arr_view_data                 = [];
        $this->admin_url_path                = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->module_url_path               = $this->admin_url_path."/account_setting/contact_address_manage";
        $this->module_view_folder            = "admin.site_status";          
        $this->module_title                  = "Contact Address Manage";
        $this->module_icon                   = 'fa fa-map-marker';          
        $this->BaseModel                     = $contact_details;
        $this->ContactAddressTranslationModel= $contact_address_translation;
        $this->LanguageService               = new LanguageService();
    }

    public function index(Request $request)
    {
        $arr_site_settings = [];
        $obj_site_settings = $this->BaseModel->with(['address_translation'=>function($q1){
                                                $q1->where('locale','=','en');
                                            }])->orderBy('id','desc')->get();     
        if($obj_site_settings) 
        {
            $arr_settings = $obj_site_settings->toArray();
        }

        $this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['arr_settings']        = $arr_settings;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
        return view($this->module_view_folder.'.contact-details',$this->arr_view_data);
    }

    public function create(Request $request)
    {
        $arr_lang                                   = array();
        $arr_lang                                   = $this->LanguageService->get_all_language();

        $this->arr_view_data['arr_lang']             = $arr_lang;       
        $this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;
        $this->arr_view_data['module_url_path']      = $this->module_url_path;        
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
        $this->arr_view_data['module_url']           = $this->module_url_path;
        $this->arr_view_data['sub_module_title']     = 'Add Contact Address';
        $this->arr_view_data['sub_module_icon']      = 'fa fa-plus';
        return view($this->module_view_folder.'.contact-details-create',$this->arr_view_data);
    }
    public function store(Request $request)
    {
        $arr_rules = $arr_data = $arr_lang = [];
        $arr_rules['site_address_en'] = 'required';
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();     
        }

        $arr_lang      = $this->LanguageService->get_all_language();
        $status_create = $this->BaseModel->create(['status'=>'1']);
        if($status_create)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale               = isset($lang['locale'])?$lang['locale']:'';
                    $arr_data['address']  = $request->input('site_address_'.$locale,'');
                    $arr_data['locale']   = $locale;
                    $arr_data['contact_address_id'] = isset($status_create->id)?$status_create->id:'';

                    $this->ContactAddressTranslationModel->create($arr_data);
                }
            }
            Session::flash('success','Contact address details added successfully.');
        }
        else
        {
            Session::flash('error','Problem Occurred, While Adding Contact Address');
        }
        return redirect()->back();
    }

    public function edit($enc_id=null)
    {
        $arr_lang = [];
        $arr_address = [];
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $obj_address_arr = $this->BaseModel->where('id',$id)
                                    ->with(['address_translation'])
                                    ->first();

            if($obj_address_arr)
            {
                $arr_address = $obj_address_arr->toArray();
                $this->arr_view_data['arr_contact_address'] = $this->LanguageService->arrange_locale_wise($arr_address['address_translation']);
            }            
            $arr_lang                                    = $this->LanguageService->get_all_language();
            $this->arr_view_data['arr_lang']             = $arr_lang;
            $this->arr_view_data['id']                   = base64_encode($id);
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['page_title']           = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']           =  $this->module_url_path;
            $this->arr_view_data['sub_module_title']     =  'Edit Contact Address';
            $this->arr_view_data['sub_module_icon']      =  'fa fa-pencil-square-o';
            
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            return view($this->module_view_folder.'.contact-details-edit',$this->arr_view_data);
        }
        else
        {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect($this->module_url_path.'/manage');
        }
    }

    public function update(Request $request)
    {
        $arr_rules = $arr_lang = $arr_data = [];
        $arr_rules['site_address_en'] = 'required';
        $status_update = '';
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();     
        }
        $id                  = base64_decode($request->input('id'),true);
        if($id!=false)
        {
           
            $arr_lang      = $this->LanguageService->get_all_language();
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale               = isset($lang['locale'])?$lang['locale']:'';
                    $arr_data['address']  = $request->input('site_address_'.$locale,'');
                    $status_update = $this->ContactAddressTranslationModel->where('contact_address_id',$id)
                                                                          ->where('locale',$locale)
                                                                          ->update($arr_data);
                }
            }
           
            if($status_update)
            {
                Session::flash('success','Contact address details updated successfully.');
            }
            else
            {
                Session::flash('error','Problem Occurred, While Updating Contact Address');
            }    
        }
        else
        {
            Session::flash('error','Problem Occurred, While Updating Contact Address');
        }
        
        return redirect()->back();
    }
}
