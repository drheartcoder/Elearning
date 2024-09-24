<?php
use App\Models\TransactionsModel;
function check_user_payment($user_id)
{
	$obj_transaction   = '';
        $is_plan_purchased = 'paid';
        $check_is_exist    = TransactionsModel::where('user_id','=',$user_id)
                                        ->where('status','=','active')
                                        ->orderBy('id','desc')
                                        ->count();

        if($check_is_exist==0)
        {
	         $is_plan_purchased = 'pending'; 
        }
        return $is_plan_purchased;
                                    
}
function check_request_for_wire_transfer($user_id)
{
        $wire_transfer_status = true;
        $count  = TransactionsModel::where('user_id','=',$user_id)
                                        ->where('status','=','active')
                                        ->orderBy('id','desc')
                                        ->count();

        if($count==1)
        {
               $obj_transaction = TransactionsModel::where('user_id','=',$user_id)
                                        ->where('status','=','active')
                                        ->where('payment_status','=','unpaid')
                                        ->where('payment_via','=','offline')
                                        ->first(); 
                if($obj_transaction)
                {
                      $wire_transfer_status = false;  
                }
        }
        else
        {
              $count_offline_payment = TransactionsModel::where('user_id','=',$user_id)
                                        ->where('status','=','active')
                                        ->where('payment_status','=','unpaid')
                                        ->where('payment_via','=','offline')
                                        ->count();     
                if($count_offline_payment==$count)
                {
                   $wire_transfer_status = false;     
                }
        }
        return $wire_transfer_status;

}
?>