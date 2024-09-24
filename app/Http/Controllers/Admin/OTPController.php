<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;

use App\Common\Traits\MultiActionTrait;

use DB;
use Validator;
use Session;
use flash;
//use DataTables;

class OTPController extends Controller
{
    use MultiActionTrait;
	public function __construct(UsersModel $user_model)
	{
        $this->arr_view_data      = [];
        $this->BaseModel          = $user_model;
        $this->UsersModel         = $user_model;

        $this->module_title       = "OTP";
        $this->module_icon        = "fa fa-commenting";
        $this->module_view_folder = "admin.otp";
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/account_setting/otp");
	}

	public function index()
	{
		$this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;

        $this->arr_view_data['module_url_path']      = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

    public function load_data(Request $request)
    {
        $UsersData = $final_array = [];
        $column    = '';

        $order     = strtoupper($request->input('order')[0]['dir']);
        //dump($order);
        /*$obj_data  = DB::table('users')->RAW('SELECT first_name, last_name, email, contact, password_reset_code, LENGTH(password_reset_code) as length_code')->where('length_code', '<', 7)->where('password_reset_code', '!=', null)->where('password_reset_code', '!=', '');*/

        $obj_data = DB::Table('users')->select('users.id','users.first_name','users.last_name','users.email','users.password_reset_code','users.contact')->where('password_reset_code','<>',"");
              
        $count    = count($obj_data);

        if(($order == 'ASC' || $order=='') && $column == '')
        {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($_GET['length'])->offset($_GET['start']);
        }
        if($order != '' && $column != '' )
        {
            $obj_data = $obj_data->orderBy($column,$order)->limit($_GET['length'])->offset($_GET['start']);
        }
        if($obj_data)
        {
            $UsersData               = $obj_data->get();
        }
        
        $resp['draw']            = $_GET['draw'];
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        if(count($UsersData) > 0)
        {
            $i = 0;
            foreach($UsersData as $row)
            {
                $otp = isset($row->password_reset_code) && $row->password_reset_code != '' ? $row->password_reset_code : "NA";
                if(strlen($otp) < 7)
                {
                    $final_array[$i][0] = '<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>';
                    $final_array[$i][1] = isset($row->first_name) && $row->first_name != '' ? $row->first_name : "NA";
                    $final_array[$i][2] = isset($row->last_name) && $row->last_name != '' ? $row->last_name : "NA";
                    $final_array[$i][3] = isset($row->email) && $row->email != '' ? $row->email : "NA";
                    $final_array[$i][4] = isset($row->contact) && $row->contact != '' ? $row->contact : "NA";
                    $final_array[$i][5] = $otp;
                    $i++;
                }
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp)); exit;      
    }
    public function multi_action(Request $request)
    {
       $status    = '';
       $form_data = $request->all();
       if(isset($form_data['checked_record']) && sizeof($form_data['checked_record'])>0)
       {
            foreach ($form_data['checked_record'] as $key => $value) 
            {
                $user_id = isset($value)?base64_decode($value):'';
                $status  = $this->UsersModel->where('id','=',$user_id)->update(['password_reset_code'=>'']);
            }
       }
       if($status)
       {
             Session::flash('success',$this->module_title.'(s) deleted successfully');
       }
       else
       {
            Session::flash('error','Problem occured, while creating '.$this->module_title);
       }
       return redirect()->back();
    }
}
