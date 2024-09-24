<?php

namespace App\Http\Controllers\Front\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentProgramQuestionModel;
use App\Models\UserLoginHistoryModel;
use App\Common\Services\StudentPerformanceService;
use Validator;
use Response;
use Session;
use Config;
use Auth;
use Hash;
use App;
use DB;
class DashboardController extends Controller
{
  	public function __construct(StudentPerformanceService $student_performance_service)
  	{
      $this->module_url_path             = url('/').'/'.config('app.project.student_panel_slug').'/dashboard';
  	  $this->StudentProgramQuestionModel = new StudentProgramQuestionModel();
      $this->UserLoginHistoryModel       = new UserLoginHistoryModel();
      $this->auth                        = auth()->guard('users');
      $this->per_day_point               = 10;
      $this->StudentPerformanceService   = $student_performance_service;
  	}
    public function index($type='weekly',$selected_year=false)
    {
        $arr_programs   = $arr_year_range = $arr_program_count = [];
        $student_id     = Auth::user()->id;
        $arr_year_range = get_academic_year($student_id);
        
        if($selected_year!=false)
        {
          $default_year = $selected_year;
        }
        else
        {
          $default_year = get_current_year();

        }
        $current_year                      =  get_current_year();
        $arr_program_count                 = $this->StudentPerformanceService->get_program_count($student_id);
        $total_time_spent                  = $this->StudentPerformanceService->get_total_time_spent($student_id);
      
        if(isset($type) && $type=='weekly')
        {
           $arr_weekly_data                = $this->StudentPerformanceService->get_weekly_performance($student_id);
           $data['arr_data']               = $arr_weekly_data;
        }
        elseif(isset($type) && $type=='monthly')
        {
           $arr_monthly_data               = $this->StudentPerformanceService->get_monthly_performance($student_id);
           $data['arr_data']               = $arr_monthly_data;
        }
        elseif(isset($type) && $type=='daily')
        {
           $arr_daily_data                 = $this->StudentPerformanceService->get_daily_performance($student_id);
           $data['arr_data']               = $arr_daily_data;
        }
        elseif(isset($type) && $type=='yearly')
        {
           $arr_yearly_data                = $this->StudentPerformanceService->get_yearly_performance($student_id,$default_year);
           $data['arr_data']               = $arr_yearly_data;
        }
        else
        {
          $arr_weekly_data                = $this->StudentPerformanceService->get_weekly_performance($student_id);
          $data['arr_data']               = $arr_weekly_data;
        }
        $data['current_year']            = $current_year;
        $data['selected_type']           = $type;
        $data['default_year']            = $default_year;    
        $data['module_url_path']         = $this->module_url_path;
        $data['arr_year_range']          = $arr_year_range;
        $data['total_time_spent']        = $total_time_spent;
        $data['arr_program_count']       = $arr_program_count;
        $data['pageTitle']               = trans('student.Dashboard');
        $data['middleContent']           = 'student.dashboard';
        $data['user_type']               = 'student';
        $data['parentTitle']             = trans('student.Dashboard');
        $data['pageTitle']               = trans('student.Dashboard');

        return view('front.layout.master')->with($data);
        return redirect(url('/'));
    } 

    
}
