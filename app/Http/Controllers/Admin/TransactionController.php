<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;

use App\Models\UsersModel;
use App\Models\TransactionsModel;

use Validator;
use Session;
use flash;
use Excel;
use DB;

class TransactionController extends Controller
{
   use MultiActionTrait;
	public function __construct()
	{
        $this->arr_view_data      = [];
        $this->UsersModel         = new UsersModel();
        $this->TransactionsModel  = new TransactionsModel();

        $this->module_title       = "Transaction";
        $this->module_icon        = "fa fa-money";
        $this->module_view_folder = "admin.transaction";
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/transaction");
        $this->admin_url_path     = url(config('app.project.admin_panel_slug'));
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
	}

    public function Index()
    {
        $this->arr_view_data['page_title']          = "Manage Transaction";
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage Transaction";
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;

        return view($this->module_view_folder.'.index',$this->arr_view_data);

    }

    public function LoadData(Request $request)
    {
        $transactionData = $final_array = [];
        $column          = '';
        $keyword         = $request->input('keyword');
        $search_date     = $request->input('search_date');
        
        if($request->input('order')[0]['column'] == 1) {
            $column = "name";
        }
        if($request->input('order')[0]['column'] == 2) {
            $column = "subject";
        }
        if($request->input('order')[0]['column'] == 3) {
            $column = "grade";
        }
        if($request->input('order')[0]['column'] == 5) {
            $column = "created_at";
        }

        $order             = strtoupper($request->input('order')[0]['dir']);
        $arr_search_column = $request->input('column_filter');

        $obj_data = $this->TransactionsModel->orderBy('id', 'DESC')
                                            ->with(['plan_data' => function($query){
                                            }])
                                            ->with(['user_data' => function($query){
                                                $query->select('id','first_name','last_name','email','pin');
                                            }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) {
                $q->whereRaw("(transaction_id LIKE '%".$keyword."%' OR payment_via LIKE '%".$keyword."%' OR amount LIKE '%".$keyword."%' OR payment_status LIKE '%".$keyword."%' OR status LIKE '%".$keyword."%' )")
                    ->orWhereHas("plan_data", function($query) use ($keyword){
                        $query->whereHas("subscription_plan_translation", function($query1) use ($keyword){
                            $query1->where('name', 'like','%'.$keyword.'%');
                        });
                    })
                    ->orWhereHas("user_data", function($query) use ($keyword){
                        $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                    });
            });
        }

        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('c', strtotime($search_date)) );
        }

        $count = count($obj_data->get());

        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;

        if(($order == 'ASC' || $order =='') && $column == '') {
            $obj_data = $obj_data->orderBy('id','DESC')->limit($data_length)->offset($_GET['start']);
        }
        if($order != '' && $column != '' ) {
           $obj_data = $obj_data->orderBy($column,$order)->limit($data_length)->offset($_GET['start']);
        }

        
        $transactionData         = $obj_data->get();        
        $resp['draw']            = isset($_GET['draw']) ? $_GET['draw'] : '';
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '';

        if(count($transactionData) > 0) {
            $i = 0;
            foreach($transactionData as $row) {

                if($row['status'] != null && $row['status'] == "0") {
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Activate this record ?\')" ><i class="material-icons">lock</i></a>';
                }
                elseif($row['status'] != null && $row['status'] == "1") {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to Deactivate this record ?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                $build_view_action = '';
                $view_href         = $this->module_url_path.'/view/'.base64_encode($row['id']);
                
                $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$view_href.'" title="View"><i class="material-icons">remove_red_eye</i></a>';

                if(isset($row['invoice']) && $row['invoice']!="")
                {
                      $download_href         = url('/').'/uploads/invoice/'.$row['invoice'];

                     $build_view_action .= '<a class="btn btn-link btn-info btn-just-icon like" href="'.$download_href.'" title="Download" download><i class="material-icons">cloud_download</i></a>';
                }
              

                $final_array[$i][0] = '<div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row['id']).'">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>';

                $first_name = isset($row['user_data']['first_name']) && $row['user_data']['first_name'] != '' ? $row['user_data']['first_name'] : "" ;
                $last_name  = isset($row['user_data']['last_name'])  && $row['user_data']['last_name']  != '' ? $row['user_data']['last_name']  : "" ;

                $final_array[$i][1] = isset($row['transaction_id']) && $row['transaction_id'] != '' ? $row['transaction_id'] : "NA";
                $final_array[$i][2] = $first_name.' '.$last_name;
                $final_array[$i][3] = isset($row['plan_data']['name']) && $row['plan_data']['name'] != '' ? $row['plan_data']['name'] : "NA";
                $final_array[$i][4] = isset($row['payment_via']) && $row['payment_via'] != '' ? ucwords($row['payment_via']) : "NA";
                $final_array[$i][5] = isset($row['amount']) && $row['amount'] != '' ? $row['amount'] : "NA";
                $final_array[$i][6] = isset($row['payment_status']) && $row['payment_status'] != '' ? ucwords($row['payment_status']) : "NA";
                $final_array[$i][7] = isset($row['status']) && $row['status'] != '' ? ucwords($row['status']) : "NA";
                $final_array[$i][8] = isset($row['created_at']) && $row['created_at'] != '' ? get_added_on_date_time($row['created_at']) : "N/A";
                $final_array[$i][9] = $build_view_action;

                $i++;
            }
        }
        
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));
        exit;
    }

    public function View($enc_id)
    {
        if($enc_id) {
            $transaction_id = base64_decode($enc_id);
            $obj_data = $this->TransactionsModel->where('id', $transaction_id)->with('plan_data', 'user_data', 'coupon_data')->first();
            if($obj_data) {
                $arr_data = $obj_data->toArray();
            }
            //dd($arr_data);

            $this->arr_view_data['arr_data']             = $arr_data;
            $this->arr_view_data['page_title']           = $this->module_title;
            $this->arr_view_data['parent_module_icon']   = "fa fa-home";
            $this->arr_view_data['parent_module_title']  = "Dashboard";
            $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
            $this->arr_view_data['module_url_path']      = $this->module_url_path;
            $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
            $this->arr_view_data['module_icon']          = $this->module_icon;
            $this->arr_view_data['module_url']           = $this->module_url_path;
            $this->arr_view_data['module_title']         = "Manage ".$this->module_title;
            $this->arr_view_data['sub_module_title']     = 'Show '.$this->module_title;
            $this->arr_view_data['sub_module_icon']      = 'fa fa-eye';
            
            return view($this->module_view_folder.'.view',$this->arr_view_data);

        } else {
            Session::flash('error','Problem occured, while Showing '.str_singular($this->module_title).' details');
            return redirect()->back();
        }
    }


    public function ExportCSV(Request $request)
    {
        $export_array = $data = $arr_transactions = [];

        $form_data    = $request->all();
        $keyword      = isset($form_data['export_keyword']) && !empty($form_data['export_keyword']) ? $form_data['export_keyword'] : '';
        $search_date  = isset($form_data['export_date'])    && !empty($form_data['export_date'])    ? $form_data['export_date']    : '';

        $obj_data     = $this->TransactionsModel->orderBy('id', 'DESC')
                                                ->with(['plan_data' => function($query){
                                                }])
                                                ->with(['user_data' => function($query){
                                                    $query->select('id','first_name','last_name','email','pin');
                                                }]);

        if(isset($keyword) && $keyword != "")
        {
            $obj_data = $obj_data->where(function($q) use($keyword) 
            {
                $q->whereRaw("(transaction_id LIKE '%".$keyword."%' OR payment_via LIKE '%".$keyword."%' OR amount LIKE '%".$keyword."%' )")
                    ->orWhereHas("plan_data", function($query) use ($keyword){
                        $query->whereHas("subscription_plan_translation", function($query1) use ($keyword){
                            $query1->where('name', 'like','%'.$keyword.'%');
                        });
                    })
                    ->orWhereHas("user_data", function($query) use ($keyword){
                        $query->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR CONCAT(first_name,' ',last_name) LIKE '%".$keyword."%' )");
                    });
            });
        }

        if(isset($search_date) && $search_date != "")
        {
            $obj_data = $obj_data->whereDate('created_at', '=', date('c', strtotime($search_date)) );
        }

        $obj_data = $obj_data->get();

        if($obj_data)
        {
            $arr_transactions = $obj_data->toArray();
            /*dd($arr_transactions);*/

            // build data array to export
            foreach ($arr_transactions as $key => $transactions) 
            {
                $first_name = isset($transactions['user_data']['first_name']) ? ucfirst($transactions['user_data']['first_name']) : '';
                $last_name  = isset($transactions['user_data']['last_name']) ? ucfirst($transactions['user_data']['last_name']) : '';
                $email      = isset($transactions['user_data']['email']) ? $transactions['user_data']['email'] : '';
                $pin        = isset($transactions['user_data']['pin']) ? $transactions['user_data']['pin'] : '';

                $data['Sr. No.']          = ( $key + 1 );
                $data['Transaction Id']   = isset($transactions['transaction_id']) ? $transactions['transaction_id'] : '';
                $data['User Name']        = $first_name.' '.$last_name;
                $data['Email']            = $email;
                $data['Pin']              = $pin;

                $data['Plan Name']        = isset($transactions['plan_data']['name']) ? ucwords($transactions['plan_data']['name']) : 'NA';
                $data['Plan details']     = isset($transactions['plan_data']['details']) ? $transactions['plan_data']['details'] : 'NA';
                $data['Plan Validity']    = isset($transactions['plan_data']['validity']) ? ucwords($transactions['plan_data']['validity']) : 'NA';

                $data['Payment via']      = isset($transactions['payment_via']) ? ucwords($transactions['payment_via']) : 'NA';
                $data['Amount']           = isset($transactions['amount']) ? $transactions['amount'] : 'NA';
                $data['Transaction Date'] = isset($transactions['created_at']) ? get_added_on_date_time($transactions['created_at']) : 'NA';
                
                array_push($export_array, $data);
            }
        }
        $data = $export_array;
        $type = 'CSV';
        //$type = 'CSV';

        return Excel::create('Transactions Report', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Transactions Report');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
                  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Transactions Report');

            $excel->sheet('Transactions Report', function($sheet) use ($data)
            {

                /*$sheet->setstring();*/
                $sheet->setColumnFormat(array('B' => '@'));
                $sheet->fromArray($data);
            });

        })->download($type);

    }

}
