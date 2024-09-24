<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BankDetailsModel;
use App\Models\BankDetailsTranslationModel;
use App\Common\Services\LanguageService;
use Validator;
use Session;
use Hash;

class BankDetailsController extends Controller
{
    function __construct()
    {
        $this->auth                        = auth()->guard('admin');
        $this->module_title                = "Bank Details";
        $this->module_url_path             = url('/admin/bank_details');
        $this->module_view_folder          = "admin.bank_details";
        $this->module_icon                 = "fa fa-university";
        $this->admin_panel_slug            = config('app.project.admin_panel_slug');
        $this->LanguageService             = new LanguageService();
        $this->BankDetailsModel            = new BankDetailsModel();
        $this->BankDetailsTranslationModel = new BankDetailsTranslationModel();
    }

    /*
    | Name : Deepak Bari
    | Function : Show Account setting form.
    | Date : 14-04-2018
    */

    public function index()
    {
        $arr_bank_details = [];

        $obj_bank_details = $this->BankDetailsModel->with(['bank_translation'])->first();
        if($obj_bank_details)
        {
           $arr_bank_details = $obj_bank_details->toArray();    
           $arr_bank_details['bank_translation'] = $this->LanguageService->arrange_locale_wise($arr_bank_details['bank_translation']);
        }
        $arr_lang                                   = array();
        $arr_lang                                   = $this->LanguageService->get_all_language();

        $this->arr_view_data['arr_lang']            = $arr_lang;       
        $this->arr_view_data['arr_bank_details']    = $arr_bank_details;
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function update(Request $request)
    {
        $arr_rules = $is_setting_avail = $obj_data = $arr_bank_data = array();
        
        $arr_rules['bank_name_en']              = "required";
        //$arr_rules['branch_en']                 = "required";
        $arr_rules['account_holder_name_en']    = "required";
        $arr_rules['account_number']            = "required";
        /*$arr_rules['ifsc_code']            = "required";
         $arr_rules['swift_code']            = "required";*/
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails()) {
            Session::flash('error', 'All fields are required');
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $is_setting_avail                = $this->BankDetailsModel->where('id', '1')->count();

        $arr_data['account_number']      = $request->input('account_number');
        $arr_data['ifsc_code']           = $request->input('ifsc_code');
        $arr_data['swift_code']          = $request->input('swift_code');

        if($is_setting_avail > 0) 
        {
            $obj_data = $this->BankDetailsModel->where('id','1')->update($arr_data);
        } 
        else 
        {
            $obj_data = $this->BankDetailsModel->create($arr_data);
        }
        if($obj_data) 
        {
            $arr_lang                                   = array();
            $arr_lang                                   = $this->LanguageService->get_all_language();
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale               = isset($lang['locale'])?$lang['locale']:'';
                    $account_holder_name  = $request->input('account_holder_name_'.$locale,'');
                    $bank_name            = $request->input('bank_name_'.$locale,'');
                    $branch_name          = $request->input('branch_name_'.$locale,'');
                    $note                 = $request->input('note_'.$locale,'');
                    $bank_detail_id       = 1;
                    $arr_bank_data['bank_details_id']     = $bank_detail_id;
                    $arr_bank_data['locale']              = $locale;
                    $arr_bank_data['account_holder_name'] = $account_holder_name;
                    $arr_bank_data['bank_name']           = $bank_name;
                    $arr_bank_data['branch']              = $branch_name;
                    $arr_bank_data['note']                = $note;

                    if($this->chk_exist_bank_details($bank_detail_id,$locale)==false)
                    {
                        $this->BankDetailsTranslationModel->create($arr_bank_data);
                    }
                    else
                    {
                         $this->BankDetailsTranslationModel->where('bank_details_id','=',$bank_detail_id)
                                                          ->where('locale','=',$locale)
                                                          ->update($arr_bank_data);
                       
                    }
                }
            }
            Session::flash('success','Bank details updated successfully.');
        } 
        else 
        {
            Session::flash('error','Problem occurred, while updating bank details');
        }
      
        return redirect()->back();
    }
    public function chk_exist_bank_details($bank_detail_id,$locale)
    {
         $status = $this->BankDetailsTranslationModel->where('bank_details_id','=',$bank_detail_id)
                                                          ->where('locale','=',$locale)->exists();
                                             
        return $status;

    }

}
