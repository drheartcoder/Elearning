<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\TransactionsModel;
use App\Models\NotificationsModel;
use App\Models\ClassroomsModel;
use App\Models\ClassroomStudentModel;
use App\Models\StudentProgramsModel;
use App\Models\CouponsModel;
use App\Models\CouponUsageModel;
use DB;

class DashboardController extends Controller
{
	public function __construct(UsersModel            $user_model,
								TransactionsModel     $transaction_model,
								NotificationsModel    $notification_model,
								ClassroomsModel   	  $classroom_model,
								ClassroomStudentModel $classroom_student,
								StudentProgramsModel  $student_program,
								CouponsModel          $coupen_model,
								CouponUsageModel      $coupen_usage
							)

	{
		$this->arr_view_data         = [];
		$this->UsersModel            = $user_model;
		$this->TransactionsModel  	 = $transaction_model;
		$this->NotificationsModel 	 = $notification_model;
		$this->ClassroomsModel    	 = $classroom_model;
		$this->ClassroomStudentModel = $classroom_student;
		$this->StudentProgramsModel  = $student_program;
		$this->CouponsModel          = $coupen_model;
		$this->CouponUsageModel      = $coupen_usage;
		$this->module_title          = "Dashboard";
		$this->module_view_folder    = "admin.dashboard";		
		$this->admin_url_path        = url(config('app.project.admin_panel_slug'));
		$this->admin_panel_slug      = config('app.project.admin_panel_slug');
	}

	public function index($year=false)
	{
		$arr_months = $arr_notifications = $arr_class_wise_list = [];

		$arr_year_range          = $this->get_year_range();
		$student_count	 	     = $this->get_users_count('student',$year);
		$parent_count	 		 = $this->get_users_count('parent',$year);
		$teacher_count	 		 = $this->get_users_count('teacher',$year);
		$program_creater_count	 = $this->get_users_count('program-creator',$year);
		$supervisor_count	     = $this->get_users_count('supervisor',$year);
		$subadmin_count	         = $this->get_users_count('subadmin',$year);

		$str_users  			 = $this->get_registers_users($year);
		$str_transaction_cny     = $this->get_transaction_data($year,'CNY');
		$str_transaction_usd     = $this->get_transaction_data($year,'USD');

		$arr_notifications       = $this->get_admin_notifications();
		$arr_coupen_usage        = $this->get_coupen_code_usage();
		//$arr_class_wise_list     = $this->get_class_wise_program_list();

		$this->arr_view_data['arr_coupen_usage']      = $arr_coupen_usage;
		$this->arr_view_data['arr_notifications']     = $arr_notifications;
		$this->arr_view_data['str_transaction_cny']   = $str_transaction_cny;
		$this->arr_view_data['str_transaction_usd']   = $str_transaction_usd;

		$this->arr_view_data['subadmin_count']        = $subadmin_count;
		$this->arr_view_data['supervisor_count']      = $supervisor_count;
		$this->arr_view_data['arr_months']            = $arr_months;
		$this->arr_view_data['str_users']             = $str_users;
		$this->arr_view_data['student_count']         = $student_count;
		$this->arr_view_data['parent_count']          = $parent_count;
		$this->arr_view_data['teacher_count']         = $teacher_count;
		$this->arr_view_data['program_creater_count'] = $program_creater_count;

		if(isset($year) && $year!=false)
		{
			$this->arr_view_data['selected_year']     = $year;
		}
		$this->arr_view_data['arr_year_range']       = $arr_year_range;
		$this->arr_view_data['page_title']           = $this->module_title;
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		$this->arr_view_data['admin_url_path']       = $this->admin_url_path;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}
	public function get_admin_notifications()
	{
		$arr_notifications = [];
		$login_user_id     = login_user_id('admin'); 
		$obj_notification  = $this->NotificationsModel->where('to_user_id','=',$login_user_id)
													->orderBy('id','desc')
													->take(10)
												    ->get();

		if($obj_notification)
		{
			$arr_notifications = $obj_notification->toArray();
		}
		return $arr_notifications;

	}
	public function get_year_range()
	{
		$min_date = $this->UsersModel->where('user_type','<>','admin')->min('created_at');
		$min_year = isset($min_date)?date('Y',strtotime($min_date)):date('Y');
		$current_year   = date('Y');
		$arr_date_range = range($min_year,$current_year);
		return $arr_date_range;
	}
	public function get_users_count($type,$year=false)
	{
		if(isset($year) && $year!=false)
		{
			$count = $this->UsersModel->where('user_type','=',$type)->where('deleted_at','=',null)
																	->whereYear('created_at','=',$year)
																	->count();
		}
		else
		{
			$count = $this->UsersModel->where('user_type','=',$type)->where('deleted_at','=',null)->count();
		}
		return $count;
	}
	public function get_registers_users($year)
	{
		$arr_data = [];
		$arr_data[0]['data']  =  $this->get_users_count('student',$year);
		$arr_data[0]['label'] = 'Student Count';
		$arr_data[1]['data']  =  $this->get_users_count('parent',$year);
		$arr_data[1]['label'] = 'Parent Count';
		$arr_data[2]['data']  =  $this->get_users_count('teacher',$year);
		$arr_data[2]['label'] = 'Teacher Count';
		$arr_data[3]['data']  =  $this->get_users_count('program-creator',$year);
		$arr_data[3]['label'] = 'Program-creator Count';
		
		return json_encode($arr_data);
	}
	public function get_transaction_data($year,$currency)
	{
		$arr_months = $arr_transaction = [];
		$arr_months = get_months();
		if(isset($arr_months) && sizeof($arr_months)>0)
		{	
			$i = 0;
			foreach ($arr_months as $key => $value) 
			{
				if($currency=='CNY')
				{
					if($year!=false)
					{
						$amount_cny = $this->TransactionsModel->whereMonth('transaction_date','=',$key)
										   ->whereYear('transaction_date','=',$year)
										   ->sum('total_price_cny_amount');
					}
					else
					{
						$amount_cny = $this->TransactionsModel->whereMonth('transaction_date','=',$key)
										   ->sum('total_price_cny_amount');
					}
					if($amount_cny!=0)
					{
						$arr_transaction[$i]['amount_cny'] = round($amount_cny);
						$arr_transaction[$i]['month_cny'] = $value;
						$i++;
					}
					
					
				}
				else if($currency=='USD')
				{
					if($year!=false)
					{
						$amount_usd = $this->TransactionsModel->whereMonth('transaction_date','=',$key)
															  ->whereYear('transaction_date','=',$year)
															  ->sum('total_converted_amount');
					}
					else
					{
						$amount_usd = $this->TransactionsModel->whereMonth('transaction_date','=',$key)
															  ->sum('total_converted_amount');
					}
					if($amount_usd!=0)
					{
						$arr_transaction[$i]['amount_usd'] = round($amount_usd);
						$arr_transaction[$i]['month_usd'] = $value;
						$i++;
					}

				}
				
				
				
			}
		}
		return json_encode($arr_transaction);

	}
	function get_class_wise_program_list()
	{
		$arr_classroom = $arr_student_classroom =$arr_program =   [];
		$obj_classroom = $this->ClassroomsModel->select('id','name')->get();
		if($obj_classroom)
		{
			$arr_classroom = $obj_classroom->toArray();
		}
		if(isset($arr_classroom) && sizeof($arr_classroom)>0)
		{
			foreach($arr_classroom as $key => $value) 
			{
				$obj_student_data	= $this->ClassroomStudentModel->where('classroom_id',$value['id'])
																 ->select('id','classroom_id','student_id')
																 ->with(['class_data'=>function($q1){
																 		$q1->select('id','name');
																 }])
																  ->get();	
				if($obj_student_data)
				{
					$arr_student_classroom[$value['id']] = $obj_student_data->toArray();
				}
			}
		}
		//get student wise classroomd
		if(isset($arr_student_classroom) && sizeof($arr_student_classroom)>0)
		{
			foreach ($arr_student_classroom as $key => $value) 
			{
				$arr_program[]['class_id'] = $key;
				if(isset($value) && sizeof($value)>0)
				{
					foreach ($value as $key => $data) 
					{
						$count = $this->StudentProgramsModel->where('student_id',$data['student_id'])->count();
						dd($value,$count);
					}
				}
				
			}
		}
	}
	public function get_coupen_code_usage()
	{
		$arr_coupen = $arr_coupen_usage = $arr_data = [];
		$obj_coupen = $this->CouponsModel->select('id','title','coupon_code')->get();
		if($obj_coupen)
		{
			$arr_coupen = $obj_coupen->toArray();
		}
		if(isset($arr_coupen) && sizeof($arr_coupen)>0)
		{
			foreach ($arr_coupen as $key => $value) 
			{
				$coupen_count = $this->CouponUsageModel->where('coupon_id',$value['id'])->count();
				if($coupen_count!=0)
				{
					$arr_coupen_usage[$key]['coupon_code'] = $value['coupon_code'];
					$arr_coupen_usage[$key]['count']       = $coupen_count;
					$arr_coupen_usage[$key]['code_data']   = $value;
				}
			}
		}
		if(isset($arr_coupen_usage) && sizeof($arr_coupen_usage)>0)
		{
				$arr_data = array_slice($arr_coupen_usage,0,10);
				usort($arr_data, function($a, $b) {
		   			 return $a['count'] - $b['count'];
					});
				$arr_data = array_reverse($arr_data);
		}
		return $arr_data;
	}

}
