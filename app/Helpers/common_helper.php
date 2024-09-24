<?php

use App\Models\UsersModel;
use App\Models\CurrencyRateModel;
use App\Models\TransactionsModel;
use App\Models\CountryPhoneCodeModel;
use App\Models\ProgramModel;
use App\Models\SiteStatusModel;
function get_current_day()
{
	return strtoupper(date('D'));
}

function get_formated_created_date($date=null)
{
	if ($date!='0000-00-00 00:00:00') 
	{
		return date('d-m-Y',strtotime($date));
	}
	return '-';
}

function get_added_on_date_time($created_date)
{
	$date = '';
	if($created_date!="" || $created_date!="0000-00-00 00:00:00")
	{
		$date = date('d-M-Y h:i A',strtotime($created_date));	
	}
	return $date;
}

function get_added_on_date($created_date)
{
	$date ='';
	if($created_date!="" || $created_date!="0000-00-00 00:00:00")
	{
		$date = date('d-M-Y',strtotime($created_date));	
	}
	return $date;
}
function get_months()
{
	$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
	return $months;
}	
function generate_public_random_id()
{
    $secure = TRUE;    
    $bytes = openssl_random_pseudo_bytes(8, $secure);
    $order_token = "EL-".date('Y').'-'.bin2hex($bytes);
    return $order_token;
} 
function get_last_week_dates()
{
	$arr_dates = [];

	$start_week = date('Y-m-d', strtotime('-6 days'));
	$end_week   = date("Y-m-d");
	$date_from = strtotime($start_week);
	$date_to   = strtotime($end_week);
	
	for ($i=$date_from; $i<=$date_to; $i+=86400) 
	{  
		$arr_dates[] =date("Y-m-d", $i);
	}
	return $arr_dates;
}
function get_current_year()
{
	$current_month = date('m');
    $current_year = date('Y');
    if($current_month>6)
    {
      $next_year= date('Y', strtotime('+1 year'));
      $arr_year[0]  = $current_year;
      $arr_year[1]  = $next_year;
    }
    else
    {
      $previous_year= date('Y', strtotime('-1 year'));
      $arr_year[0]  = $previous_year;
      $arr_year[1]  = $current_year;
    }
    $default_year = $arr_year[0].'-'.$arr_year[1];
    return $default_year;

}
function get_month_list()
{
	$arr_month = [];
	for ($i = -2; $i <= 0; $i++){
  		$arr_month[] = date('m', strtotime("$i month"));
	}
	return $arr_month;
}
function convert_price($from_currency_code,$to_currency_code,$price)
{
	$arr_data = [];
	$currency_conversion_arr = CurrencyRateModel::where('from_currency_code',$from_currency_code)
	         							->where('to_currency_code',$to_currency_code)->first();          
          
    $from_currency_arr    = getCurrency($currency_conversion_arr['from_currency_id']);
    $to_currency_arr      = getCurrency($currency_conversion_arr['to_currency_id']);          
    $from_currency_symbol = html_entity_decode($from_currency_arr['html_code']);
    $to_currency_symbol   = html_entity_decode($to_currency_arr['html_code']);  

    $per_currency_rate    = $to_currency_symbol.' '.$currency_conversion_arr['rate'];
    $arr_data['per_currency_rate']       = $per_currency_rate;
    $arr_data['converted_amount']        = number_format(($currency_conversion_arr['rate']*$price),'3');
    $arr_data['to_currency_symbol'] 	 = $to_currency_symbol;
    $arr_data['from_currency_symbol'] 	 = $from_currency_symbol;
    $arr_data['from_currency'] 	         = isset($currency_conversion_arr['from_currency_id'])?$currency_conversion_arr['from_currency_id']:'';
    $arr_data['to_currency'] 	         = isset($currency_conversion_arr['to_currency_id'])?$currency_conversion_arr['to_currency_id']:'';
    return $arr_data;
}
function get_time_difference($start_date)
{
	$days = 0;
	$start   = date_create($start_date);
	$end 	 = date_create(date("Y-m-d H:i:s")); // Current time and date
	$diff  	 = date_diff( $start, $end );
	$days    = isset($diff->days) && $diff->days!=0 ?$diff->days:'';
	
	if(isset($diff->days) && $diff->days!=0)
	{
		$days = $diff->days;
	}
	return $days;
}
function get_incentive_amount($user_id)
{
	$incentive_amount = 0;
	$obj_user = UsersModel::where('id','=',$user_id)->first();
	if(isset($obj_user->insentive_amount) && $obj_user->insentive_amount!="")
	{
		$incentive_amount = $obj_user->insentive_amount;
	}	
	return $incentive_amount;

}

function get_membership_status($user_id)
{
	$status = "-";
	$obj_user = TransactionsModel::where('user_id','=',$user_id)->orderBy('id','DESC')->first();
	if(isset($obj_user) && count($obj_user)!="")
	{
		$status = ucwords($obj_user->status);
	}
	return $status;
}
function get_country_phone_code()
{
	$arr_phone_code   = [];
	$obj_country_code = CountryPhoneCodeModel::orderBy('nicename','ASC')->get();
	if($obj_country_code)
	{
		$arr_phone_code = $obj_country_code->toArray();
	}
	return $arr_phone_code;
}
function get_country_code_details($id=false)
{
	$arr_phone_code   = [];
	$obj_country_code = CountryPhoneCodeModel::where('id','=',$id)->first();
	if($obj_country_code)
	{
		$arr_phone_code = $obj_country_code->toArray();
	}
	return $arr_phone_code;
}
function get_program_details($program_id)
{
	$arr_program = [];
	$obj_program = ProgramModel::where('id',$program_id)->select('id','name','slug')->first();
	if($obj_program)
	{
		$arr_program = $obj_program->toArray();
	}
	return $arr_program;
}
function get_site_data()
{
	$arr_site_settings = [];
    $site_setting  = SiteStatusModel::first();
    if($site_setting)
    {
        $arr_site_settings = $site_setting->toArray();
        
    }
    return $arr_site_settings ;
}
?>