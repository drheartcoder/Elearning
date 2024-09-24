<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\MailchimpService;
use App\Common\Services\NewsletterService;
use App\Common\Services\EmailService;
use App\Models\NewsLetterModel;
use App\Models\UsersModel;

use Validator;
use Session;
use Hash;
use DB;

class NewsLetterController extends Controller
{
    function __construct(
                            UsersModel       $users_model,
                            EmailService     $email_service,
                            NewsLetterModel $subscribers,
                            MailchimpService $mailchimp_service,
                            NewsletterService $newsletter_service
                        )
    {
        $this->module_title                  = "Newsletter";
        $this->module_url_path               = url('/admin/newsletter');
        $this->module_view_folder            = "admin.newsletter";
        $this->module_icon                   = "fa fa-newspaper-o";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        
        $this->UsersModel                    = $users_model;
        $this->NewsLetterModel     = $subscribers;
        $this->BaseModel                     = $this->NewsLetterModel;
        $this->EmailService                  = $email_service;
        $this->MailchimpService              = $mailchimp_service;
        $this->NewsletterService             = $newsletter_service;
        
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.admin_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.admin_profile_image');
    }

    public function index()
    {          
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/newsletter';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
        $this->arr_view_data['page_title']          = "Create ".str_singular($this->module_title);
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Create '.str_singular($this->module_title);
        $this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function edit(Request $request, $enc_id)
    {
        if($enc_id!='')
        {
            $obj_data = false;
            $id = base64_decode($enc_id);
            $obj_data = $this->NewsLetterModel->where('id',$id)->first();
            if($obj_data!=false){
                $arr_data = $obj_data->toArray();
                $this->arr_view_data['arr_data']            = $arr_data;
                $this->arr_view_data['enc_id']              = $enc_id;
                $this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
                $this->arr_view_data['parent_module_icon']  = "fa fa-home";
                $this->arr_view_data['parent_module_title'] = "Dashboard";
                $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
                $this->arr_view_data['module_icon']         = $this->module_icon;
                $this->arr_view_data['module_title']        = "Manage ".$this->module_title;
                $this->arr_view_data['module_url_path']     = $this->module_url_path;
                $this->arr_view_data['module_url']          = $this->module_url_path;
                $this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
                $this->arr_view_data['sub_module_icon']     = 'fa fa-pencil';

                return view($this->module_view_folder.'.edit',$this->arr_view_data);
            }
        }
        Session::flash('error','Error while fetching data. Please try again later.');
        return redirect()->back(); 
    }

    public function load_data(Request $request)
    {
        $objectData = $final_array = $arr_search_column = $resp = []; 

        $column  = $order = $title = $count = $obj_data = $search_keyword = '';

        $search_keyword   = isset($request->search_keyword) ? $request->search_keyword : ''; 
        
        if ($request->input('order')[0]['column'] == 1) {
            $column = "title";
        } elseif($request->input('order')[0]['column'] == 2) {
            $column = "user_type";
        } elseif($request->input('order')[0]['column'] == 3) {
            $column = "broadcast_date";
        } elseif($request->input('order')[0]['column'] == 4) {
            $column = "created_at";
        }elseif($request->input('order')[0]['column'] == 5) {
            $column = "status";
        }

        $order = strtoupper($request->input('order')[0]['dir']);  

        $arr_search_column = $request->input('column_filter');

        $tbl_newsletter = $this->NewsLetterModel->getTable();

        $obj_data = DB::table($tbl_newsletter)
                        ->select($tbl_newsletter.'.id',
                                    $tbl_newsletter.'.title',
                                    $tbl_newsletter.'.user_type',
                                    $tbl_newsletter.'.broadcast_date',
                                    $tbl_newsletter.'.created_at',
                                    $tbl_newsletter.'.is_active',
                                    $tbl_newsletter.'.status'
                                );

        if (isset($search_keyword) && $search_keyword != "") {
          $obj_data = $obj_data->whereRaw($tbl_newsletter.".title LIKE '%".$search_keyword."%' OR ".$tbl_newsletter.".user_type LIKE '%".$search_keyword."%' OR ".$tbl_newsletter.".broadcast_date LIKE '%".date('Y-m-d',strtotime($search_keyword))."%' OR ".$tbl_newsletter.".created_at LIKE '%".$search_keyword."%' OR ".$tbl_newsletter.".status LIKE '%".$search_keyword."%'");
        }

        if ($order == '') {
          $obj_data   = $obj_data->orderBy('id','DESC');
        }
        
        if ($order == 'ASC' && $column == '') {
          $obj_data   = $obj_data->orderBy('id','DESC');
        }

        if ($order != '' && $column != '' ) {
            $obj_data   = $obj_data->orderBy($column, $order);
        }

        $count = count($obj_data->get());

        $data_length = ($_GET['length'] != -1) ? $_GET['length'] : $count;
        $obj_data   = $obj_data->limit($data_length)->offset($_GET['start']);
        $objectData = $obj_data->get();
        
        $resp['draw']            = isset($_GET['draw']) ? $_GET['draw'] : '';
        $resp['recordsTotal']    = $count;
        $resp['recordsFiltered'] = $count;
        $build_active_btn        = '' ; 

        if (count($objectData)>0) {
            $i = 0;
            foreach ($objectData as $row) {
                $build_view_action = $build_active_btn = $build_status_btn  = '-';
                if ($row->is_active != null && $row->is_active == 'block') {
                    $build_active_btn = '<a class="btn btn-link btn-warning btn-just-icon like" title="Deactive" href="'.$this->module_url_path.'/activate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to activate this newsletter?\')" ><i class="material-icons">lock</i></a>';
                } elseif ($row->is_active != null && $row->is_active == 'active') {
                   $build_active_btn = '<a class="btn btn-link btn-success btn-just-icon like" title="Active" href="'.$this->module_url_path.'/deactivate/'.base64_encode($row->id).'" onclick="return confirm_action(this,event,\'Do you really want to block this newsletter?\')" ><i class="material-icons">lock_open</i></a>';      
                }

                if ($row->status != null && $row->status == "sent") {
                    $build_status_btn = '<a style="color: #fff" class="btn btn-success">Sent<div class="ripple-container"></div><div class="ripple-container"></div></a>';
                } elseif ($row->status != null && $row->status == "pending") {
                   $build_status_btn = '<a style="color: #fff" class="btn btn-primary">Pending<div class="ripple-container"></div><div class="ripple-container"></div></a>';      
                }

                $delete_href = $this->module_url_path.'/delete/'.base64_encode($row->id); 
                $edit_href   = $this->module_url_path.'/edit/'.base64_encode($row->id); 
                if($row->status=='pending'){
                    $build_view_action = '<a class="btn btn-link btn-danger btn-just-icon" href="'.$edit_href.'"  title="Edit"><i class="material-icons">create</i></a>'; 
                    $build_view_action .= '<a class="btn btn-link btn-danger btn-just-icon remove" href="'.$delete_href.'" onclick="return confirm_action(this,event,\'Do you really want to delete this newsletter?\')"  title="Delete"><i class="material-icons">delete_forever</i></a>';
                }

                $final_array[$i][0] = '<div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checked_record" type="checkbox" name="checked_record[]" id="checked_record" value="'.base64_encode($row->id).'">
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>';

                $final_array[$i][1] = (isset($row->title) && $row->title != '') ? $row->title : "N/A";
                $final_array[$i][2] = (isset($row->user_type) && $row->user_type != '') ? $row->user_type : "N/A";
                $final_array[$i][3] = isset($row->broadcast_date) && $row->broadcast_date != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($row->broadcast_date)) : "N/A";
                $final_array[$i][4] = isset($row->created_at) && $row->created_at != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($row->created_at)) : "N/A";
                $final_array[$i][5] = $build_status_btn;
                $final_array[$i][6] = $build_active_btn;
                $final_array[$i][7] = $build_view_action;
                $i++;
            }
        }
        $resp['data'] = $final_array;
        echo str_replace("\/", "/",  json_encode($resp));exit;
    
    }

    public function store(Request $request)
    {
        $arr_rules = array();
        
        $arr_rules['title']          = "required|max:70";
        $arr_rules['user_type']      = "required"; 
        $arr_rules['broadcast_date'] = "required";
        $arr_rules['message']        = "required|max:10000";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }        

        $arr_data['title']         = trim(ucfirst($request->input('title')));
        $arr_data['user_type']     = $request->input('user_type');
        $arr_data['broadcast_date']= date('Y-m-d',strtotime($request->input('broadcast_date')));
        $arr_data['message']       = $request->input('message');
        $arr_data['is_active']     = 'active';

        $obj_data = $this->NewsLetterModel->create($arr_data);       
        if($obj_data)
        {
            Session::flash('success','Newsletter created successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while creating Newsletter.');
        }
        return redirect()->back();
    }

    public function update(Request $request,$enc_id)
    {
        if($enc_id!='')
        {
            $id = base64_decode($enc_id);
            $arr_rules = array();
            
            $arr_rules['title']          = "required|max:70";
            $arr_rules['user_type']      = "required"; 
            $arr_rules['broadcast_date'] = "required";
            $arr_rules['message']       = "required|max:10000";
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {       
                return redirect()->back()->withErrors($validator)->withInput();  
            }        

            $arr_data['title']         = trim(ucfirst($request->input('title')));
            $arr_data['user_type']     = $request->input('user_type');
            $arr_data['broadcast_date']= date('Y-m-d',strtotime($request->input('broadcast_date')));
            $arr_data['message']       = $request->input('message');

            $obj_data = $this->NewsLetterModel->where('id',$id)->update($arr_data);       
            if($obj_data)
            {
                Session::flash('success','Newsletter updated successfully.');
                return redirect()->back();
            }
        }
        Session::flash('error','Problem occurred, while updating Newsletter.');
        return redirect()->back();
    }

    public function delete($enc_id = null)
    {
        $id = base64_decode($enc_id, true);
        if (!$id) {
            return redirect($this->module_url_path)->with('error','Invalid user');
        } else {
            $delete_status = $this->NewsLetterModel->where('id', $id)->delete();
            if (!$delete_status) {
                return redirect($this->module_url_path)->with('error','Error while deleting subscriber');
            } else {
                return redirect($this->module_url_path)->with('success','deleted successfully');
            }
        }
    }

    public function activate($enc_id = FALSE)
    {
        if (!$enc_id) {
            return redirect()->back();
        }

        $id = base64_decode($enc_id, true);
        $responce = $this->NewsLetterModel->where('id',$id)->update(['is_active'=>'active']);
        if ($responce) {
            Session::flash('success', $this->module_title. ' activated successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Problem occured while '.$this->module_title.' activation ');
        }
        return redirect()->back();
    }

    public function deactivate($enc_id = FALSE)
    {
        if(!$enc_id) {
            return redirect()->back();
        }

        $id = base64_decode($enc_id, true);
        
        $responce = $this->NewsLetterModel->where('id',$id)->update(['is_active' => 'block']);          
        if($responce) {
            Session::flash('success', $this->module_title. ' deactivated successfully');
        } else {
            Session::flash('error', 'Problem occured while '.$this->module_title.' deactivation ');
        }
        return redirect()->back();
    }

    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action']   = "required";
        $arr_rules['checked_record'] = "required";
        $validator = Validator::make($request->all(),$arr_rules);

        if ($validator->fails()) {
            Session::flash('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if (is_array($checked_record) && sizeof($checked_record)<=0) {
            Session::flash('error', 'Problem occurred while performing multiaction');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) {
            $id = base64_decode($record_id, true);
            if ($id) {
                if ($multi_action == "delete") {
                    $resDelete = $this->NewsLetterModel->where('id', $id)->delete();
                    Session::flash('success', $this->module_title. ' deleted successfully');
                } elseif($multi_action == "activate") {
                   $this->NewsLetterModel->where('id',$id)->update(['is_active'=>'active']);
                   Session::flash('success', $this->module_title. ' activated successfully');
                } elseif($multi_action == "deactivate") {
                    $this->NewsLetterModel->where('id',$id)->update(['is_active' => 'block']);
                   Session::flash('success', $this->module_title. ' blocked successfully');
                }
            }
        }      
        return redirect()->back();
    }
}