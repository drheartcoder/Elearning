<?php 

namespace App\Common\Services;
use Validator;
use Response;
use Session;
use Config;
use Auth;
use Hash;
use App;
use DB;
use DateTime;
class StudentPerformanceService
{
	public function __construct()
	{
		$this->per_day_point = 10;
	}
	/*get total program count of that student has assigned*/
	public function get_program_count($student_id)
  {
        $arr_programs               = $arr_data = [];
        $total_answered_count       = $total_pending_count = 0;
        $obj_program    =  DB::table('student_program_questions')
                              ->select('program_id','student_id','created_at',DB::raw('COUNT(program_id) as program_count'))
                              ->where('student_id','=',$student_id)
                              ->groupBy('program_id')
                              ->orderBy('id','desc')
                              ->get();
                             
        if($obj_program)
        {
            $arr_programs = json_decode(json_encode($obj_program));
            if(isset($arr_programs) && sizeof($arr_programs)>0)
            {
                foreach($arr_programs as $key => $value) 
                {
                      $total_program_count  =  DB::table('student_program_questions')
                                              ->select('program_id','student_id','is_answer')
                                              ->where('is_answer','=','yes')
                                              ->where('student_id','=',$student_id)
                                              ->where('program_id','=',$value->program_id)
                                              ->count();

                      if(isset($value->program_count) && $value->program_count==$total_program_count)
                      {
                          $total_answered_count++;
                      }
                      else
                      {
                          $total_pending_count++;
                      }
                }
            }
        }
        $arr_data['total_answered_count'] = $total_answered_count;
        $arr_data['total_pending_count']  = $total_pending_count;
        return $arr_data;
    }
    /*get total time that student has spent on a system*/
    public function get_total_time_spent($student_id)
    {
      $no_of_hours = DB::Table('user_login_history')
                      ->where('user_id','=',$student_id)
                      ->selectRaw('SEC_TO_TIME(SUM(time_in_seconds)) as time')
                      ->first();
      return $no_of_hours;
    }
    /*check that student is login to that given date or not*/
    public function check_user_is_login($user_id,$week_date=false,$month=false,$date=false)
    { 
   
        $date_count = 0;
        if(isset($week_date) && $week_date!="")
        {
           $date_count   = DB::Table('user_login_history')
                                  ->where('user_id','=',$user_id)
                                  ->whereDate('created_at',$week_date)
                                  ->count();
        }
        elseif (isset($month) && $month!=false) 
        {
          $year = date('Y');
          $date_count    = DB::Table('user_login_history')
                                  ->where('user_id','=',$user_id)
                                  ->whereYear('created_at','=',$year)
                                  ->whereMonth('created_at','=',$month)
                                  ->count();
        }
        elseif (isset($date) && $date!=false) 
        {
          $year = date('Y',strtotime($date));
          $month = date('m',strtotime($date));
          $date_count    = DB::Table('user_login_history')
                                  ->where('user_id','=',$user_id)
                                  ->whereYear('created_at','=',$year)
                                  ->whereMonth('created_at','=',$month)
                                  ->count();
          
        }
        else
        {
          $today_date    = date('Y-m-d');
          $date_count    = DB::Table('user_login_history')
                                  ->where('user_id','=',$user_id)
                                  ->whereDate('created_at','=',$today_date)
                                  ->count();
          
        }
        return $date_count;
    }
    
    /*get weekly performance in terms of points & chart*/
    public function get_weekly_performance($user_id,$chart_name=false)
    {
    	  $total_present_days = $total_points = $total_student_points = $total_all_student_points = $global_student_points = 0;
        $total_classwise_points = 0;
        $arr_dates    = $arr_student_data   =  $arr_data  = $arr_weekly_data = [];
        $arr_student  = $arr_student_points =  $arr_all_student = $arr_classwise_points = $arr_global_points = [];
    	  $arr_dates    = get_last_week_dates();
        $arr_student  = get_student_list($user_id);
         /*for login user*/
       if(isset($arr_dates) && sizeof($arr_dates)>0)
       {
          foreach ($arr_dates as $key => $value) 
          {
              $week_date       = date('Y-m-d',strtotime($value));
              $arr_weekly_chart['student_grade'][$key]['date'] = $value;
              $date_count      = $this->check_user_is_login($user_id,$week_date);  
              if($date_count>0)
              {
                  $arr_weekly_chart['student_grade'][$key]['per_day_points']   = $this->per_day_point;
                  $total_points                              = $total_points + $this->per_day_point;
              }
              else
              {
                   $arr_weekly_chart['student_grade'][$key]['per_day_points']   = 0;
              }
              
          }
        }
        $arr_student_data['student_total_points'] = $total_points;
        $arr_student_data['student_grade']        = get_grade($total_points);

       
        /*for classwise users*/
        if(isset($arr_student) && sizeof($arr_student)>0)
        {
            foreach ($arr_student as $i => $student) 
            {
               $total_class_student_points = 0;
               $student_id     = isset($student['student_id'])?$student['student_id']:'';
               if(isset($arr_dates) && sizeof($arr_dates)>0)
               {
                  foreach ($arr_dates as $key => $value) 
                  {
                     $week_date      = date('Y-m-d',strtotime($value));
                     $is_user_login  = $this->check_user_is_login($student_id,$week_date);  
                     if($is_user_login>0)
                     {
                       $total_student_points = $total_student_points + $this->per_day_point;
                       $total_class_student_points = $total_class_student_points+$this->per_day_point;
                     
                     }
                  }
               }
               $arr_classwise_points[$student_id] = $total_class_student_points;
       
            }
        }
        $total_student            = sizeof($arr_student);
        $arr_avg_class_points     = $this->get_avg_range_student($arr_classwise_points,$total_student);
        $arr_student_data['arr_avg_class_points']     = $arr_avg_class_points;
        /*for all student*/
        $arr_all_student   = get_student_grade_list($user_id);
        if(isset($arr_all_student) && sizeof($arr_all_student)>0)
        {
            foreach ($arr_all_student as $i => $student) 
            {
              $total_global_student_points = 0;
               if(isset($arr_dates) && sizeof($arr_dates)>0)
               {
                  foreach ($arr_dates as $key => $value) 
                  {
                     $week_date      = date('Y-m-d',strtotime($value));
                     $student_id     = isset($student['student_id'])?$student['student_id']:'';
                     $is_user_login  = $this->check_user_is_login($student_id,$week_date);  
                     if($is_user_login>0)
                     {
                        $total_all_student_points    = $total_all_student_points + $this->per_day_point;
                        $total_global_student_points = $total_global_student_points + $this->per_day_point;
                     }
                  }
               }
               $arr_global_points[$student_id] = $total_global_student_points;
            }
        }
        $total_student              = sizeof($arr_all_student);
        if($total_student!=0)
        {
          $global_student_points    = round($total_all_student_points/$total_student);  
        }
        
        $arr_avg_global_points      = $this->get_avg_range_student($arr_global_points,$total_student);

        $arr_student_data['global_student_points'] = $global_student_points;
        $arr_student_data['arr_avg_global_points'] = $arr_avg_global_points;
        //get chart data
    	  if(isset($arr_dates) && sizeof($arr_dates)>0)
        {
           foreach($arr_dates as $key => $value) 
           {
              $total_classwise_points = 0;
              $week_date   = date('Y-m-d',strtotime($value));
              if(isset($arr_student) && sizeof($arr_student)>0)
              {
                foreach ($arr_student as $i => $student) 
                {
                    $student_id     = isset($student['student_id'])?$student['student_id']:'';
                    $is_user_login  = $this->check_user_is_login($student_id,$week_date);
                    if($is_user_login>0)
                    {
                        $total_classwise_points = $total_classwise_points + $this->per_day_point;
                    }
                }
                $arr_weekly_chart['class_wise_points'][$key]['date']             = $value;
                $arr_weekly_chart['class_wise_points'][$key]['per_day_points']   = $total_classwise_points;
              }  
           }
        }

        if(isset($arr_dates) && sizeof($arr_dates)>0)
        {
           foreach($arr_dates as $key => $value) 
           {
              $total_global_points = 0;
              $week_date   = date('Y-m-d',strtotime($value));
              if(isset($arr_all_student) && sizeof($arr_all_student)>0)
              {
                foreach ($arr_all_student as $i => $student) 
                {
                    $student_id     = isset($student['student_id'])?$student['student_id']:'';
                    $is_user_login  = $this->check_user_is_login($student_id,$week_date);
                    if($is_user_login>0)
                    {
                        $total_global_points = $total_global_points + $this->per_day_point;
                    }
                }
                $arr_weekly_chart['global_points'][$key]['date']             = $value;
                $arr_weekly_chart['global_points'][$key]['per_day_points']   = $total_global_points;
              }  
           }
        }
   		  $str_student_performance              = $this->build_chart('weekly',$arr_weekly_chart,false,$chart_name);
        $arr_data['arr_student_data']         = $arr_student_data;
        $arr_data['str_student_performance']  = $str_student_performance;

        return $arr_data;

    }
    /*get monthly performance in terms of points & chart*/
    public function get_monthly_performance($user_id)
    {
        $arr_monthly_performance = $arr_student_data =$arr_classwise_points = [];
        $total_student_points    = $total_all_student_points = $total_points = $total_present_days= 0;
        $arr_months              = get_month_list();
        $arr_student             = get_student_list($user_id);
        /*for student wise grade*/
        if(isset($arr_months) && sizeof($arr_months)>0)
	      {
	        foreach ($arr_months as $key => $value) 
	        {
	            $date_count   = $this->check_user_is_login($user_id,false,$value);  
	            $arr_student_data['student_points'][$key]['month'] = $value;
	            if($date_count>0)
	            {
	                $total_login_in_month                      = $date_count*$this->per_day_point;
	                $arr_student_data['student_points'][$key]['per_day_points']   = $this->per_day_point;
	                $total_present_days                        = $total_present_days + 1;
	                $total_points                              = $total_points + $total_login_in_month;
	            }
	            else
	            {
	              $arr_student_data['student_points'][$key]['per_day_points']   = 0;
	            }

	            
	        }
	       }
          $arr_student_data['student_total_points'] = $total_points;
          $arr_student_data['student_grade'] = get_grade($total_points);

          /*for classwise users*/
          if(isset($arr_student) && sizeof($arr_student)>0)
          {
              foreach ($arr_student as $i => $student) 
              {
                 $total_class_student_points = 0;
                 $student_id                 = isset($student['student_id'])?$student['student_id']:'';
                 if(isset($arr_months) && sizeof($arr_months)>0)
                 {
                    foreach ($arr_months as $key => $value) 
                    {
                       $is_user_login  = $this->check_user_is_login($student_id,false,$value);  
                       if($is_user_login>0)
                       {
                         $total_class_student_points = $total_class_student_points+$this->per_day_point;
                       
                       }
                    }
                 }
                 $arr_classwise_points[$student_id] = $total_class_student_points;
              }
          }
        $total_student            = sizeof($arr_student);
        $arr_avg_class_points     = $this->get_avg_range_student($arr_classwise_points,$total_student);
        $arr_student_data['arr_avg_class_points']     = $arr_avg_class_points;


        /*for all student*/
        $arr_all_student   = get_student_grade_list($user_id);
        if(isset($arr_all_student) && sizeof($arr_all_student)>0)
        {
            foreach ($arr_all_student as $i => $student) 
            {
              $total_global_student_points = 0;
               if(isset($arr_months) && sizeof($arr_months)>0)
               {
                  foreach ($arr_months as $key => $value) 
                  {
                     $student_id     = isset($student['student_id'])?$student['student_id']:'';
                     $is_user_login  = $this->check_user_is_login($student_id,false,$value);  
                     if($is_user_login>0)
                     {
                        $total_global_student_points = $total_global_student_points + $this->per_day_point;
                     }
                  }
               }
               $arr_global_points[$student_id] = $total_global_student_points;
            }
        }
        $total_student            = sizeof($arr_all_student);
        $arr_avg_global_points    = $this->get_avg_range_student($arr_global_points,$total_student);
        $arr_student_data['arr_avg_global_points'] = $arr_avg_global_points;

           //get student performance by monthly
        	 if(isset($arr_months) && sizeof($arr_months)>0)
           {
               foreach($arr_months as $key => $value) 
               {
                  $total_classwise_points = 0;
                  if(isset($arr_student) && sizeof($arr_student)>0)
                  {
                    foreach ($arr_student as $i => $student) 
                    {
                        $student_id     = isset($student['student_id'])?$student['student_id']:'';
                        $is_user_login  = $this->check_user_is_login($student_id,false,$value);
                        if($is_user_login>0)
                        {
                            $total_login_in_month   = $is_user_login*$this->per_day_point;
                            $total_classwise_points = $total_classwise_points + $total_login_in_month;
                        }

                    }
                   
                    $arr_student_data['class_wise_points'][$key]['date']             = date('M',strtotime($value));
                    $arr_student_data['class_wise_points'][$key]['per_day_points']   = $total_classwise_points;
                  }  
               }
            }
            $arr_all_student  = get_student_grade_list($user_id);
            if(isset($arr_months) && sizeof($arr_months)>0)
            {
               foreach($arr_months as $key => $value) 
               {
                  $total_global_points = 0;
                  if(isset($arr_all_student) && sizeof($arr_all_student)>0)
                  {
                    foreach ($arr_all_student as $i => $student) 
                    {
                        $student_id     = isset($student['student_id'])?$student['student_id']:'';
                        $is_user_login  = $this->check_user_is_login($student_id,false,$value);
                        if($is_user_login>0)
                        {
                            $total_login_in_month   = $is_user_login*$this->per_day_point;
                            $total_global_points = $total_global_points + $total_login_in_month;
                        }
                    }
                    $arr_student_data['global_points'][$key]['date']             = date('M',strtotime($value));
                    $arr_student_data['global_points'][$key]['per_day_points']   = $total_global_points;
                  }  
               }
            }
          $str_student_performance                  = $this->build_chart('monthly',$arr_student_data);
          $arr_data['arr_student_data']             = $arr_student_data;
          $arr_data['str_student_performance']      = $str_student_performance;
          return $arr_data;
    }
    /*get yearly performance in terms of points & chart*/
    public function get_yearly_performance($user_id,$year)
    {
       $arr_months              = $arr_yearly_data = $arr_student = $arr_classwise_points = [];
       $total_student_points    = $total_all_student_points = $total_points = $total_present_days= 0;
       $arr_months              = get_months_between_range($year);
       $arr_student             = get_student_list($user_id);
	   
  	    if(isset($arr_months) && sizeof($arr_months)>0)
  	    {
  	        foreach ($arr_months as $key => $value) 
  	        {
  	            $date_count   = $this->check_user_is_login($user_id,false,false,$value);  
  	            $arr_yearly_data['student_grade'][$key]['month'] = $value;
  	            if($date_count>0)
  	            {
  	                $total_login_in_month   = $date_count*$this->per_day_point;
  	                $arr_yearly_data['student_points'][$key]['per_day_points']   = $this->per_day_point;
  	                $total_present_days                        = $total_present_days + 1;
  	                $total_points                              = $total_points + $total_login_in_month;
  	            }
  	            else
  	            {
  	              $arr_yearly_data['student_points'][$key]['per_day_points']   = 0;
  	            }
  	            
  	        }
  	    }
        $arr_yearly_data['student_total_points'] = $total_points;
        $arr_yearly_data['student_grade'] = get_grade($total_points);

        /*for classwise users*/
  	    if(isset($arr_student) && sizeof($arr_student)>0)
  	    {
  	          foreach ($arr_student as $i => $student) 
  	          {
                 $total_class_student_points = 0;
  	             if(isset($arr_months) && sizeof($arr_months)>0)
  	             {
  	                foreach ($arr_months as $key => $value) 
  	                {
  	                   $student_id     = isset($student['student_id'])?$student['student_id']:'';
  	                   $is_user_login  = $this->check_user_is_login($student_id,false,false,$value);  
  	                   if($is_user_login>0)
  	                   {
  	                     $total_login_in_month         = $is_user_login*$this->per_day_point;
  	                     $total_class_student_points   = $total_class_student_points + $total_login_in_month;
  	                   
  	                   }
  	                }
                    $arr_classwise_points[$student_id] = $total_class_student_points;
  	             }
  	          }
  	    }
        $total_student            = sizeof($arr_student);
        $arr_avg_class_points     = $this->get_avg_range_student($arr_classwise_points,$total_student);
        $arr_yearly_data['arr_avg_class_points']   = $arr_avg_class_points;
  
  	    /*for all student*/
  	    $arr_all_student  = get_student_grade_list($user_id);
  	    if(isset($arr_all_student) && sizeof($arr_all_student)>0)
  	    {
  	         foreach ($arr_all_student as $i => $student) 
  	          {
                $total_global_student_points = 0;
                 $student_id     = isset($student['student_id'])?$student['student_id']:'';
  	             if(isset($arr_months) && sizeof($arr_months)>0)
  	             {
  	                foreach ($arr_months as $key => $value) 
  	                {
  	                   
  	                   $is_user_login  = $this->check_user_is_login($student_id,false,false,$value);  
  	                   if($is_user_login>0)
  	                   {
  	                      $total_login_in_month   = $is_user_login*$this->per_day_point;
  	                      $total_global_student_points = $total_global_student_points + $total_login_in_month;
  	                   }
  	                }
  	             }
                 $arr_global_points[$student_id] = $total_global_student_points;
  	          }
  	    }
  	    $total_student            = sizeof($arr_all_student);
  	    $arr_avg_global_points    = $this->get_avg_range_student($arr_global_points,$total_student);
        $arr_yearly_data['arr_avg_global_points'] = $arr_avg_global_points;
         
        //student performance graph
          if(isset($arr_months) && sizeof($arr_months)>0)
          {
               foreach($arr_months as $key => $value) 
               {
                  $total_classwise_points = 0;
                  if(isset($arr_student) && sizeof($arr_student)>0)
                  {
                    foreach ($arr_student as $i => $student) 
                    {
                        $student_id     = isset($student['student_id'])?$student['student_id']:'';
                        $is_user_login  = $this->check_user_is_login($student_id,false,false,$value);
                        if($is_user_login>0)
                        {
                            $total_login_in_month   = $is_user_login*$this->per_day_point;
                            $total_classwise_points = $total_classwise_points + $total_login_in_month;
                        }

                    }
                   
                    $arr_yearly_data['class_wise_points'][$key]['date']             = date('M',strtotime($value));
                    $arr_yearly_data['class_wise_points'][$key]['per_day_points']   = $total_classwise_points;
                  }  
               }
            }
            if(isset($arr_months) && sizeof($arr_months)>0)
            {
               foreach($arr_months as $key => $value) 
               {
                  $total_global_points = 0;
                  if(isset($arr_all_student) && sizeof($arr_all_student)>0)
                  {
                    foreach ($arr_all_student as $i => $student) 
                    {
                        $student_id     = isset($student['student_id'])?$student['student_id']:'';
                        $is_user_login  = $this->check_user_is_login($student_id,false,false,$value);
                        if($is_user_login>0)
                        {
                            $total_login_in_month   = $is_user_login*$this->per_day_point;
                            $total_global_points = $total_global_points + $total_login_in_month;
                        }
                    }
                    $arr_yearly_data['global_points'][$key]['date']             = date('M',strtotime($value));
                    $arr_yearly_data['global_points'][$key]['per_day_points']   = $total_global_points;
                  }  
               }
            }
            $str_student_performance = $this->build_chart('yearly',$arr_yearly_data,$year);
            $arr_data['arr_student_data']         = $arr_yearly_data;
            $arr_data['str_student_performance']  = $str_student_performance;
            return $arr_data;

      
    }
    /*get daily performance in terms of points & chart*/
    public function get_daily_performance($user_id)
    {
       $arr_daily_performance   = $arr_student_data         = $arr_classwise_points = $arr_global_points = [];
       $total_student_points    = $total_all_student_points = $total_daily_points = $classwise_student_points = 0;
       $current_date            = date('Y-m-d');
       $user_id                 = Auth::user()->id;

        /*for student wise grade*/
        $is_user_login   = $this->check_user_is_login($user_id);
        if($is_user_login>0)
        {
          $total_daily_points = $this->per_day_point;
        }

        $arr_student_data['student_total_points'] = $total_daily_points;
        $arr_student_data['student_grade']        = 'A';  

        /*for classwise users*/
        $arr_student = get_student_list($user_id);
        if(isset($arr_student) && sizeof($arr_student)>0)
        {
            foreach($arr_student as $i => $student) 
            {
               $student_id                 = isset($student['student_id'])?$student['student_id']:'';
               $is_user_login              = $this->check_user_is_login($student_id);  
               if($is_user_login>0)
               {
                 $total_student_points     = $total_student_points + $this->per_day_point;
                 $classwise_student_points = $classwise_student_points + $this->per_day_point;
               }
               $arr_classwise_points[$student_id] = $total_student_points;
            }
        }

        $total_student             = sizeof($arr_student);
        $arr_avg_class_points      = $this->get_avg_range_student($arr_classwise_points,$total_student);
        $arr_student_data['arr_avg_class_points'] = $arr_avg_class_points;

        /*for all student*/
        $arr_all_student = get_student_grade_list($user_id);
        if(isset($arr_all_student) && sizeof($arr_all_student)>0)
        {
            foreach ($arr_all_student as $i => $student) 
            {
               $global_student_points  = 0;
               $student_id     = isset($student['student_id'])?$student['student_id']:'';
               $is_user_login  = $this->check_user_is_login($student_id);  
               if($is_user_login>0)
               {
                  $total_all_student_points       = $total_all_student_points + $this->per_day_point;
                  $global_student_points          = $global_student_points + $this->per_day_point;
               }
               $arr_global_points[$student_id]    = $global_student_points;
            }
        }
        $total_student                             = sizeof($arr_all_student);
        $arr_avg_global_points                     = $this->get_avg_range_student($arr_global_points,$total_student);
        $arr_student_data['arr_avg_global_points'] = $arr_avg_global_points;
       
        //get student performance by monthly
        $arr_weekly_chart                         = $this->get_weekly_performance($user_id,'daily');
        $arr_data['arr_student_data']             = $arr_student_data;

        if(isset($arr_weekly_chart['str_student_performance']) && $arr_weekly_chart['str_student_performance']!="")
        {
        	 $arr_data['str_student_performance'] = $arr_weekly_chart['str_student_performance'];
        }
        return $arr_data;
    }
    /*generate chart by daily,weekly,monthly & yearly*/
    public function build_chart($type,$arr_data,$year=false,$chart_name=false)
    {
       $xaxisname = $caption = '';
       $arr_student_performance = [];
       $arr_chart = $arr_label  = $arr_data_set1 = $arr_data_set2 = $arr_data_set3 = [];
       $arr_dates = [];

       if(isset($type) && $type=='weekly')
       {
       	 if($chart_name!=false)
         {
         	 $caption   = $chart_name;
         }
         else
         {
         	 $caption   = trans('parent.Weekly');
         	 $xaxisname = trans('parent.Days');
         }
         
       }
       elseif(isset($type) && $type=='daily')
       {
          $caption   = trans('parent.Daily');
          $xaxisname = trans('parent.Days');
       }
       elseif(isset($type) && $type=='monthly')
       {
          $caption   = trans('parent.Monthly');
          $xaxisname = trans('parent.Current_Month');
       }
       if($year==false)
       {
        $year = get_current_year();
       }
       $arr_student_performance['chart'] = ["caption"=>$caption." ".trans('parent.Performance'),"subcaption"=> $year, "xaxisname"=> $xaxisname,"yaxisname"=> trans('parent.Points'),"formatnumberscale"=> "1","theme"=> "fusion", "drawcrossline"=> "1"];

       if(isset($type) && $type=='weekly')
       {
              $arr_dates    = get_last_week_dates();
              if(isset($arr_dates) && sizeof($arr_dates)>0)
              {
                foreach ($arr_dates as $key => $value)
                {
                     $arr_label['category'][]["label"] =  $value;   
                }
              }

            if(isset($arr_data) && sizeof($arr_data)>0)
            {
                if(isset($arr_data['student_grade']) && sizeof($arr_data['student_grade'])>0)
                {
                  $arr_data_set1['seriesname'] = trans('parent.Performance_Assessment');
                  foreach ($arr_data['student_grade'] as $key => $value) 
                  {
                    $arr_data_set1['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['class_wise_points']) && sizeof($arr_data['class_wise_points'])>0)
                {
                  $arr_data_set2['seriesname'] = trans('parent.Class_Comparative_Analysis');
                  foreach ($arr_data['class_wise_points'] as $key => $value) 
                  {
                    $arr_data_set2['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['global_points']) && sizeof($arr_data['global_points'])>0)
                {
                  $arr_data_set3['seriesname'] = trans('parent.Global_Comparative_Analysis');
                  foreach ($arr_data['global_points'] as $key => $value) 
                  {
                      $arr_data_set3['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }
            }

             $arr_student_performance['categories'][] = $arr_label;
             $arr_student_performance['dataset'][] = $arr_data_set1;
             $arr_student_performance['dataset'][] = $arr_data_set2;
             $arr_student_performance['dataset'][] = $arr_data_set3;

       }
       elseif(isset($type) && $type=='monthly')
       {  
            $arr_months  = [];
            if($year!=false)
            {
               $arr_months    = get_month_list();
            }
            if(isset($arr_months) && sizeof($arr_months)>0)
            {
              foreach ($arr_months as $key => $value)
              {
              	    $dateObj   = DateTime::createFromFormat('!m', $value);
					$monthName = $dateObj->format('F');
                    $arr_label['category'][]["label"] = $monthName;   
              }
            }
          
            if(isset($arr_data) && sizeof($arr_data)>0)
            {
                if(isset($arr_data['student_points']) && sizeof($arr_data['student_points'])>0)
                {
                  $arr_data_set1['seriesname'] = trans('parent.Performance_Assessment');
                  foreach ($arr_data['student_points'] as $key => $value) 
                  {
                    $arr_data_set1['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['class_wise_points']) && sizeof($arr_data['class_wise_points'])>0)
                {
                  $arr_data_set2['seriesname'] = trans('parent.Class_Comparative_Analysis');
                  foreach ($arr_data['class_wise_points'] as $key => $value) 
                  {
                    $arr_data_set2['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['global_points']) && sizeof($arr_data['global_points'])>0)
                {
                  $arr_data_set3['seriesname'] = trans('parent.Global_Comparative_Analysis');
                  foreach ($arr_data['global_points'] as $key => $value) 
                  {
                      $arr_data_set3['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }
            }
            $arr_student_performance['categories'][] = $arr_label;
            $arr_student_performance['dataset'][]    = $arr_data_set1;
            $arr_student_performance['dataset'][]    = $arr_data_set2;
            $arr_student_performance['dataset'][]    = $arr_data_set3;
       }
       elseif(isset($type) && $type=='yearly')
       {
            $arr_months  = [];
            if($year!=false)
            {
               $arr_months    = get_months_between_range($year);
            }
            if(isset($arr_months) && sizeof($arr_months)>0)
            {
              foreach ($arr_months as $key => $value)
              {
                   $arr_label['category'][]["label"] =  date('M-Y',strtotime($value));   
              }
            }
          
            if(isset($arr_data) && sizeof($arr_data)>0)
            {
                if(isset($arr_data['student_points']) && sizeof($arr_data['student_points'])>0)
                {
                  $arr_data_set1['seriesname'] = trans('parent.Performance_Assessment');
                  foreach ($arr_data['student_points'] as $key => $value) 
                  {
                    $arr_data_set1['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['class_wise_points']) && sizeof($arr_data['class_wise_points'])>0)
                {
                  $arr_data_set2['seriesname'] = trans('parent.Class_Comparative_Analysis');
                  foreach ($arr_data['class_wise_points'] as $key => $value) 
                  {
                    $arr_data_set2['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }

                if(isset($arr_data['global_points']) && sizeof($arr_data['global_points'])>0)
                {
                  $arr_data_set3['seriesname'] = trans('parent.Global_Comparative_Analysis');
                  foreach ($arr_data['global_points'] as $key => $value) 
                  {
                      $arr_data_set3['data'][]["value"] = isset($value['per_day_points'])?$value['per_day_points']:'';
                  }
                }
            }
            $arr_student_performance['categories'][] = $arr_label;
            $arr_student_performance['dataset'][]    = $arr_data_set1;
            $arr_student_performance['dataset'][]    = $arr_data_set2;
            $arr_student_performance['dataset'][]    = $arr_data_set3;

       }
       elseif (isset($type) && $type=='daily') 
       {
         
            $arr_data_set1['data'][]["value"] = isset($arr_data['student_total_points'])?$arr_data['student_total_points']:'';
            $arr_data_set2['data'][]["value"] = isset($arr_data['classwise_student_points'])?$arr_data['classwise_student_points']:'';
            $arr_data_set3['data'][]["value"] = isset($arr_data['global_student_points'])?$arr_data['global_student_points']:'';

            $arr_label['category'][]["label"]        = date('M');
            $arr_student_performance['categories'][] = $arr_label;
            $arr_student_performance['dataset'][]    = $arr_data_set1;
            $arr_student_performance['dataset'][]    = $arr_data_set2;
            $arr_student_performance['dataset'][]    = $arr_data_set3;
       }
       return json_encode($arr_student_performance);
 
    }
    public function get_avg_range_student($arr_data,$total_student)
    {
        $arr_avg = [];
        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            $high    = max($arr_data);
            $low     = min($arr_data);

            $arr_avg['high'] = $high;
            $arr_avg['low']  = $low;
            if($high>0)
            {
              $arr_avg['avg']  = round(($high + $low)/2);
            }
            else
            {
              $arr_avg['avg']  = 0;
            }
        }
        return $arr_avg;

    }
}
?>