<?php

use App\Models\ApiCredentialModel;

function get_onesignel_credential()
{
	
	$obj_onesignel = null;
	$arr_onesignel = array();
	$obj_onesignel = ApiCredentialModel::first(['mailchimp_api_key','mailchimp_list_id']);

	if (isset($obj_onesignel) && $obj_onesignel!=null)
	{
		if (isset($obj_onesignel->mailchimp_api_key) && isset($obj_onesignel->mailchimp_list_id)) 
		{
			$arr_onesignel['mailchimp_api_key'] = $obj_onesignel->mailchimp_api_key;
			$arr_onesignel['mailchimp_list_id'] = $obj_onesignel->mailchimp_list_id;
			
			return $arr_onesignel;
		}
	}

	return null;
}



?>