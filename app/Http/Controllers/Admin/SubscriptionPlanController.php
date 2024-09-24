<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\LanguageService;
use App\Models\CurrencyModel;
use App\Models\SubscriptionPlanModel;
use App\Models\SubscriptionPlanTranslationModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class SubscriptionPlanController extends Controller
{
    use MultiActionTrait;
	public function __construct(
                                LanguageService                  $language_service,
                                CurrencyModel                    $currency_model,
                                SubscriptionPlanModel            $subscription_plan_model,
                                SubscriptionPlanTranslationModel $subscription_plan_translation_model
                                )
	{
        $this->arr_view_data                    = [];
        $this->BaseModel                        = $subscription_plan_model;
        $this->LanguageService                  = $language_service;
        $this->SubscriptionPlanModel            = $subscription_plan_model;
        $this->SubscriptionPlanTranslationModel = $subscription_plan_translation_model;
        $this->CurrencyModel                    = $currency_model;

        $this->module_title                     = "Subscription Plan";
        $this->module_icon                      = "fa fa-cogs";
        $this->module_view_folder               = "admin.subscription_plan";
        $this->admin_url_path                   = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug                 = config('app.project.admin_panel_slug');
        $this->module_url_path                  = url(config('app.project.admin_panel_slug')."/subscription_plan");
	}

	public function index()
	{
		$arr_currency = [];
        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }

        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = "fa fa-file-text";
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;

        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

    public function load_data(Request $request)
    {
        $SubjectData = $final_array = [];
        $column      = '';
        $name        = $request->input('title');
        
        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 2) 
        {
            $column = "price";
        }
        if($request->input('order')[0]['column'] == 3) 
        {
            $column = "per_day_price";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');
        $obj_data          = DB::table('subscription_plan')
                            ->select('subscription_plan.id',
                                    'subscription_plan.per_day_price',
                                    'subscription_plan.status',
                                    'subscription_plan_translation.name as name',
                                    'subscription_plan.price')
                            ->join('subscription_plan_translation','subscription_plan_translation.subscription_plan_id','=','subscription_plan.id','left')
                            ->where('subscription_plan_translation.locale','=','en');

        if(isset($name) && $name != "")
        {
            $obj_data = $obj_data->where('subscription_plan_translation.name', 'like','%'.$name.'%');
        }

        $count = count($obj_data->get());
        
        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

        if(($order == 'ASC' || $order =='') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        $SubscriptionPlanData    = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ;

        if(count($SubscriptionPlanData) > 0)
            {
                $i = 0;

                foreach($SubscriptionPlanData as $row)
                {
                    if($row->status != null && $row->status == "0")
                    {   
                        $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                    }
                    elseif($row->status != null && $row->status == "1")
                    {
                       $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                    }

                    $build_view_action   = '';
                    $view_href           = $this->module_url_path.'/view/'.base64_encode($row->id);
                    $build_view_action  .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View Details"><i class="material-icons" >visibility </i></a>';
                    
                    $edit_href           = $this->module_url_path.'/edit/'.base64_encode($row->id);
                    $build_view_action  .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit Details"><i class="material-icons" >create</i></a>';
    
                    $final_array[$i][0] =  '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';

                    $final_array[$i][1] = isset($row->name) && $row->name != '' ? $row->name : "NA";
                    $final_array[$i][2] = isset($row->price) && $row->price != '' ? number_format($row->price,2,'.','') : "NA";
                    $final_array[$i][3] = isset($row->per_day_price) && $row->per_day_price != '' ? number_format($row->per_day_price,2,'.','') : "NA";
                    //$final_array[$i][4] = $build_active_btn;
                    $final_array[$i][4] = $build_view_action;
                  
                    $i++;
                }
            }
            $resp['data'] = $final_array;
            echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

	public function create()
	{
        $arr_currency = [];
        $arr_lang     = array();
        $arr_lang     = $this->LanguageService->get_all_language();

        $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
        if($obj_currency)
        {
            $arr_currency = $obj_currency->toArray();
        }
 
        $this->arr_view_data['arr_lang']            = $arr_lang;
        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['page_title']          = "Create ".$this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = "fa fa-file-text";
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
        $arr_data  = $form_data = $arr_lang = $arr_rules = array();
        $form_data = $request->all();

        $arr_lang  = $this->LanguageService->get_all_language();
        if(isset($arr_lang) && sizeof($arr_lang)>0)
        {
            foreach ($arr_lang as $key => $value) 
            {
                if($value['locale'] == 'en')
                {
                    $arr_rules['subscription_plan_price_'.$value['locale']] = "required";
                    //$arr_rules['subscription_plan_no_of_children_'.$value['locale']] = "required";
                }
                $arr_rules['subscription_plan_name_'.$value['locale']]    = "required";
                $arr_rules['subscription_plan_details_'.$value['locale']] = "required";

                $locale         = isset($value['locale']) ? $value['locale'] : '';
                $lang_title     = isset($value['title']) ? $value['title'] : '';

                $is_page_exists = $this->SubscriptionPlanTranslationModel->where('name', $form_data['subscription_plan_name_'.$locale])->count();
                if($is_page_exists > 0)
                {
                    Session::flash('error','This subscription plan name already exist for '.$lang_title.' language.');      
                    return redirect()->back();
                }
            }
        }

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['status']         = '1';
        $arr_data['slug']           = str_slug($form_data['subscription_plan_name_en']);
        $arr_data['price']          = $form_data['subscription_plan_price_en'];
        //$arr_data['no_of_children'] = $form_data['subscription_plan_no_of_children_en'];
        $status                     = $this->BaseModel->create($arr_data);

        $arr_lang                   = $this->LanguageService->get_all_language();
        if($status)
        {
            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $lang) 
                {
                    $locale  = isset($lang['locale']) ? $lang['locale'] : '';
                    $name    = isset($form_data['subscription_plan_name_'.$locale]) ? $form_data['subscription_plan_name_'.$locale] : '';
                    $details = isset($form_data['subscription_plan_details_'.$locale]) ? $form_data['subscription_plan_details_'.$locale] : '';
                
                    if($name != "")
                    {
                        $translation                       = $status->translateOrNew($lang['locale']);
                        $translation->subscription_plan_id = $status->id;
                        $translation->name                 = $name;
                        $translation->details              = $details;
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
            $id           = base64_decode($enc_id);
            $arr_currency = [];

            $arr_subscription_plan = [];
            $obj_subscription_plan = $this->BaseModel->where('id',$id)->with('subscription_plan_translation')->first();
            if($obj_subscription_plan)
            {
                $arr_subscription_plan                                  = $obj_subscription_plan->toArray();
                $arr_subscription_plan['subscription_plan_translation'] = $this->LanguageService->arrange_locale_wise($arr_subscription_plan['subscription_plan_translation']);
            }

            $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
            if($obj_currency)
            {
                $arr_currency = $obj_currency->toArray();
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']              = $arr_lang;
            $this->arr_view_data['arr_currency']          = $arr_currency;
            $this->arr_view_data['id']                    = base64_encode($id);
            $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
            $this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
            $this->arr_view_data['page_title']            = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']    = "fa fa-home";
            $this->arr_view_data['parent_module_title']   = "Dashboard";
            $this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
            $this->arr_view_data['module_icon']           = "fa fa-file-text";
            $this->arr_view_data['module_title']          = "Manage ".$this->module_title;
            $this->arr_view_data['module_url']            = $this->module_url_path;
            $this->arr_view_data['sub_module_title']      = 'Edit '.$this->module_title;
            $this->arr_view_data['sub_module_icon']       = 'fa fa-pencil-square-o';
            $this->arr_view_data['module_url_path']       = $this->module_url_path;

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
        $form_data = $arr_data = array();
        $form_data = $request->all();
        
        $subscription_plan_id = isset($form_data['subscription_plan_id']) ? base64_decode($form_data['subscription_plan_id']) : '';

        if(isset($subscription_plan_id) && !empty($subscription_plan_id))
        {
            $arr_lang = $this->LanguageService->get_all_language();

            if(isset($arr_lang) && sizeof($arr_lang)>0)
            {
                foreach ($arr_lang as $key => $value) 
                {
                    if($value['locale'] == 'en')
                    {
                        $arr_rules['subscription_plan_price_'.$value['locale']]          = "required";
                        $arr_rules['price_per_day_'.$value['locale']]                    = "required";
                        $arr_rules['subscription_plan_cancel_price_'.$value['locale']]   = "required";
                        $arr_rules['cancel_price_per_day_'.$value['locale']]             = "required";
                        //$arr_rules['subscription_plan_no_of_children_'.$value['locale']] = "required";

                    }
                    $arr_rules['subscription_plan_name_'.$value['locale']]    = "required";
                    $arr_rules['subscription_plan_details_'.$value['locale']] = "required";

                    $locale         = isset($value['locale']) ? $value['locale'] : '';
                    $lang_title     = isset($value['title']) ? $value['title'] : '';
                    $is_page_exists = $this->SubscriptionPlanTranslationModel->where('name', $form_data['subscription_plan_name_'.$locale])
                                                                             ->where('subscription_plan_id','<>',$subscription_plan_id)
                                                                             ->count();
                    if($is_page_exists > 0)
                    {
                        Session::flash('error','This subscription plan name already exist for '.$lang_title.' language.');      
                        return redirect()->back();
                    }
                }
            }

            //$arr_data['slug']           = str_slug($form_data['subscription_plan_name_en']);
            $arr_data['price']          = $form_data['subscription_plan_price_en'];
            $arr_data['per_day_price']  = $form_data['price_per_day_en'];
            $arr_data['scrash_price1']  = $form_data['subscription_plan_cancel_price_en'];
            $arr_data['scrash_price2']  = $form_data['cancel_price_per_day_en'];
            //$arr_data['no_of_children'] = $form_data['subscription_plan_no_of_children_en'];
            $status                     = $this->BaseModel->where('id',$subscription_plan_id)->update($arr_data);

            if($status)
            {
                if(isset($arr_lang) && sizeof($arr_lang)>0)
                {
                    $data = $this->BaseModel->where('id',$subscription_plan_id)->first();
                    foreach ($arr_lang as $key => $lang) 
                    {
                        $locale  = isset($lang['locale']) ? $lang['locale'] : '';
                        $name    = isset($form_data['subscription_plan_name_'.$locale]) ? $form_data['subscription_plan_name_'.$locale] : '';
                        $details = isset($form_data['subscription_plan_details_'.$locale]) ? $form_data['subscription_plan_details_'.$locale] : '';

                       if($name != "" && $details != "")
                       {
                            $translation = $data->getTranslation($locale);
                            if($translation)
                            {
                                $translation->name    = $name;
                                $translation->details = $details;
                                $update               = $translation->save();
                            }
                            else
                            {
                                $translation                       = $data->getNewTranslation($locale);
                                $translation->subscription_plan_id = $data->id;
                                $translation->name                 = $name;
                                $translation->details              = $details;
                                $update                            = $translation->save();
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
            $arr_currency = [];
            $id           = base64_decode($enc_id);

            $arr_subscription_plan = [];
            $obj_subscription_plan = $this->BaseModel->where('id',$id)->with('subscription_plan_translation')->first();
            if($obj_subscription_plan)
            {
                $arr_subscription_plan                                  = $obj_subscription_plan->toArray();
                $arr_subscription_plan['subscription_plan_translation'] = $this->LanguageService->arrange_locale_wise($arr_subscription_plan['subscription_plan_translation']);
            }

            $obj_currency = $this->CurrencyModel->where('slug','renminbi')->first();
            if($obj_currency)
            {
                $arr_currency = $obj_currency->toArray();
            }

            $arr_lang = array();
            $arr_lang = $this->LanguageService->get_all_language();

            $this->arr_view_data['arr_lang']              = $arr_lang;
            $this->arr_view_data['arr_currency']          = $arr_currency;
            $this->arr_view_data['id']                    = base64_encode($id);
            $this->arr_view_data['arr_subscription_plan'] = $arr_subscription_plan;
            $this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
            $this->arr_view_data['page_title']            = $this->module_title.' Details';
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
}
