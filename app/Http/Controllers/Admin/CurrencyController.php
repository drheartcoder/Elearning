<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurrencyModel;
use App\Models\CurrencyRateModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
use Paginate;

class CurrencyController extends Controller
{
    use MultiActionTrait;
	public function __construct(CurrencyModel $currency_model,CurrencyRateModel $currency_rate_model)
	{
        $this->arr_view_data      = [];
        $this->BaseModel          = $currency_model;
        $this->CurrencyModel      = $currency_model;
        $this->CurrencyRateModel  = $currency_rate_model;

        $this->module_title       = "Currency";
        $this->module_icon        = "fa fa-money";
        $this->module_view_folder = "admin.currency";
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/account_setting/currency");
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
        $CurrencyData = $final_array = [];
        $column       = '';
        $name         = $request->input('name');
        $code         = $request->input('code');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "name";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data          = DB::table('currency');

        if(isset($name) && $name != "")
        {
            $obj_data = $obj_data->where('currency.name', 'like','%'.$name.'%');
        }
        if(isset($code) && $code != "")
        {
            $obj_data = $obj_data->where('currency.code', 'like','%'.$code.'%');
        }

        $count = count($obj_data->get());

        if(($order == 'ASC' || $order == '') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC');
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }
        if($order != '' && $column != '' )
        {
            $obj_data = $obj_data->orderBy($column,$order);
            if($_GET['length']!='-1')
            {
                $obj_data   = $obj_data->limit($_GET['length'])->offset($_GET['start']);
            }    
        }

        $CurrencyData            = $obj_data->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($CurrencyData) > 0)
        {
            $i = 0;

            foreach($CurrencyData as $row)
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
                $edit_href           = $this->module_url_path.'/edit/'.base64_encode($row->id);
                $build_view_action  .= '<a class="btn btn-link btn-warning btn-just-icon like" href="'.$edit_href.'" title="Edit"><i class="material-icons" >create</i></a>';

                $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';

                $final_array[$i][1] = isset($row->name) && $row->name != '' ? $row->name : "NA";
                $final_array[$i][2] = isset($row->code) && $row->code != '' ? $row->code : "NA";
                $final_array[$i][3] = $build_active_btn;
                $final_array[$i][4] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }

	public function create()
	{
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
        $arr_data  = $form_data = $arr_lang = $arr_rules = array();
        $form_data = $request->all();

        $arr_rules['name']      = "required";
        $arr_rules['code']      = "required";
        $arr_rules['html_code'] = "required";

        $is_exists = $this->BaseModel->where('name', $form_data['name'])->count();
        if($is_exists > 0)
        {
            Session::flash('error','This currency name already exist');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data['status']    = '1';
        $arr_data['name']      = $form_data['name'];
        $arr_data['slug']      = str_slug($form_data['name']);
        $arr_data['code']      = $form_data['code'];
        $arr_data['html_code'] = $form_data['html_code'];
        $status                = $this->BaseModel->create($arr_data);

        if($status)
        {
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
            $obj_currency = $this->BaseModel->where('id',$id)->first();
            if($obj_currency)
            {
                $arr_currency = $obj_currency->toArray();
            }

            $this->arr_view_data['id']                  = base64_encode($id);
            $this->arr_view_data['arr_currency']        = $arr_currency;
            $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
            $this->arr_view_data['page_title']          = "Edit ".$this->module_title;
            $this->arr_view_data['parent_module_icon']  = "fa fa-home";
            $this->arr_view_data['parent_module_title'] = "Dashboard";
            $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
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
            return redirect($this->module_url_path);
        }
    }

    public function update(Request $request)
    {
        $arr_rules = $arr_lang = [];
        $form_data = $arr_data = array();
        $form_data = $request->all();
        
        $currency_id = isset($form_data['currency_id']) ? base64_decode($form_data['currency_id']) : '';

        if(isset($currency_id) && !empty($currency_id))
        {
            $arr_rules['name']      = "required";
            $arr_rules['code']      = "required";
            $arr_rules['html_code'] = "required";

            $is_exists = $this->BaseModel->where('name', $form_data['name'])->where('id', '<>', $currency_id)->count();
            if($is_exists > 0)
            {
                Session::flash('error','This currency already exist.');      
                return redirect()->back();
            }

            $validator = Validator::make($request->all(),$arr_rules);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $arr_data['name']      = $form_data['name'];
            $arr_data['slug']      = str_slug($form_data['name']);
            $arr_data['code']      = $form_data['code'];
            $arr_data['html_code'] = $form_data['html_code'];
            $status                = $this->BaseModel->where('id',$currency_id)->update($arr_data);

            if($status)
            {
                Session::flash('success',str_singular($this->module_title).' details updated successfully.');
                /*return redirect($this->module_url_path);*/
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
        return redirect()->back();
    }


    public function rate_manage_load_data(Request $request)
    {
        $CurrencyData = $final_array = [];
        $column       = '';
        $keyword = $request->input('keyword');

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "from_currency_code";
        }

        if($request->input('order')[0]['column'] == 1) 
        {
            $column = "to_currency_code";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

       


        $obj_currency_rate = $this->CurrencyRateModel;
        if($keyword!='' && $keyword!=null)
        {
            $obj_currency_rate = $obj_currency_rate->whereRaw("(from_currency_code LIKE '%".$keyword."%' OR to_currency_code LIKE '%".$keyword."%')");
        }        
        
        $count = count($obj_currency_rate->get());

        if($order == 'ASC' && $column == '')
        {
            $obj_currency_rate = $obj_currency_rate->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            $obj_currency_rate = $obj_currency_rate->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
        }

        $CurrencyData            = $obj_currency_rate->get();
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';       

        if(count($CurrencyData) > 0)
        {
            $i = 0;

            foreach($CurrencyData as $row)
            {

                $build_view_action   = '';                
                $build_view_action  .= '<a class="btn btn-link btn-warning btn-just-icon like btnEditCurrencyRate" data-rate-id="'.$row['id'].'" data-from-currency-id="'.$row['from_currency_id'].'" data-to-currency-id="'.$row['to_currency_id'].'" data-currency-rate="'.$row['rate'].'" title="Edit"><i class="material-icons" >create</i></a>';

                $final_array[$i][0] = '<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>';

                $final_array[$i][1] = isset($row['from_currency_code']) && $row['from_currency_code'] != '' ? $row['from_currency_code'] : "NA";
                $final_array[$i][2] = isset($row['to_currency_code']) && $row['to_currency_code'] != '' ? $row['to_currency_code'] : "NA";                
                $final_array[$i][3] = isset($row['rate']) && $row['rate'] != '' ? $row['rate'] : "NA";
                $final_array[$i][4] = $build_view_action;
              
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;
    }

    public function rate_manage(Request $request)
    {
        $arr_currency =[]; $arr_rules = []; $arr_currency_rate = []; $links='';        

        $arr_currency = $this->CurrencyModel->where('status','1')->get();
        if($arr_currency)
        {
            $arr_currency = $arr_currency->toArray();
        }

        if(isset($_POST['btnAddCurrecnyRate']))
        {
            $arr_rules['from_currency'] = 'required';
            $arr_rules['to_currency']   = 'required';
            $arr_rules['rate']          = 'required';

            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withInput($validator)->withErrors();
            }
            else
            {
                $from_currency_arr                = $this->CurrencyModel->where('id',$request->input('from_currency'))->first();
                $to_currency_arr                  = $this->CurrencyModel->where('id',$request->input('to_currency'))->first();

                $insert_arr['rate']               = $request->input('rate');
                $insert_arr['from_currency_id']   = $request->input('from_currency');
                $insert_arr['from_currency_code'] = $from_currency_arr['code'];
                $insert_arr['to_currency_id']     = $request->input('to_currency');
                $insert_arr['to_currency_code']   = $to_currency_arr['code'];
                
                $check_is_exist = $this->CurrencyRateModel->where(['from_currency_id'=>$request->input('from_currency'),'to_currency_id'=>$request->input('to_currency')])->first();
                if(isset($check_is_exist) && count($check_is_exist)>0)    
                {
                    Session::flash('error','Currency rate already exist.');
                    return redirect()->back();
                }
                $status = $this->CurrencyRateModel->create($insert_arr);

                if($status)
                {
                    Session::flash('success','Currency rate added successfully.');                    
                }
                else
                {
                    Session::flash('error','Problem occured, while adding currency rate');
                }
                return redirect()->back();
            }
        }

        if(isset($_POST['btnEditCurrecnyRate']))
        {
            $arr_rules['rate_id']            = 'required';
            $arr_rules['from_currency_edit'] = 'required';
            $arr_rules['to_currency_edit']   = 'required';
            $arr_rules['rate_edit']          = 'required';

            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withInput($validator)->withErrors();
            }
            else
            {
                $from_currency_arr                = $request->input('from_currency_edit','');
                $to_currency_arr                  = $request->input('to_currency_edit','');

                $insert_arr['rate']               = $request->input('rate_edit','');
                $insert_arr['from_currency_id']   = $request->input('from_currency_edit','');
                $insert_arr['from_currency_code'] = isset($from_currency_arr['code'])?$from_currency_arr['code']:'';
                $insert_arr['to_currency_id']     = $request->input('to_currency_edit','');
                $insert_arr['to_currency_code']   = isset($to_currency_arr['code'])?$to_currency_arr['code']:'';
                
                $check_is_exist = $this->CurrencyRateModel->where(['from_currency_id'=>$request->input('from_currency_edit'),'to_currency_id'=>$request->input('to_currency_edit')])->where('id','!=',$request->input('rate_id'))->first();
                if(isset($check_is_exist) && count($check_is_exist)>0)    
                {
                    Session::flash('error','Currency rate already exist.');
                    return redirect()->back();
                }
                $status = $this->CurrencyRateModel->where('id',$request->input('rate_id'))->update($insert_arr);

                if($status)
                {
                    Session::flash('success','Currency rate updated successfully.');                    
                }
                else
                {
                    Session::flash('error','Problem occured, while updating currency rate');
                }
                return redirect()->back();
            }
        }



        $this->arr_view_data['arr_currency']        = $arr_currency;
        $this->arr_view_data['pagination_arr']      = $links;
        $this->arr_view_data['arr_currency_rate']   = $arr_currency_rate;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['page_title']          = "Manage ".$this->module_title." Rate";
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = "Manage ".$this->module_title." Rate";
        $this->arr_view_data['sub_module_icon']     = 'fa fa-money';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.currency-rate-manage',$this->arr_view_data);
    }
}
