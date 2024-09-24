<?php 

namespace App\Common\Services;
use App\Models\NewsletterSubscriberModel;

class NewsletterService
{
	public function __construct(NewsletterSubscriberModel $newsletter_subscriber_model)
	{
		$this->NewsletterSubscriberModel = $newsletter_subscriber_model;
	}

	public function subscribe($user_id=null, $user_type=null)
	{
		if($user_id != null && $user_type != null) {
		    $arr_ins = [
							'user_id'           => $user_id,
							'user_type'         => $user_type,
							'subscription_date' => date('Y-m-d H:i:s')
		    			];
		    $subscribe_status = $this->NewsletterSubscriberModel->create($arr_ins);
		    return 'SUBSCRIBED';
		} else {
			return 'ERROR';
		}
	}


	public function get_users_list()
	{
		$arr_responce = $arr_members  = array();

		$obj_subscriber = $this->NewsletterSubscriberModel
								->with(['user_details' => function($q_u) {
																			$q_u->select('id', 'user_type', 'first_name', 'last_name', 'email', 'contact');
																		}])->get();

		if (isset($obj_subscriber) && count($obj_subscriber)>0) {
			$arr_subscriber = $obj_subscriber->toArray();
			if (isset($arr_subscriber) && count($arr_subscriber) > 0) {
				$arr_responce['status'] 		= 'SUCCESS';
		    	$arr_responce['message'] 		= 'Member list get successfully.';
		    	$arr_responce['arr_members'] 	= $arr_subscriber;
		    } else {
		    	$arr_responce['status'] 		= 'ERROR';
		    	$arr_responce['message'] 		= 'Error while getting member list.';
		    }
		} else {
	    	$arr_responce['status'] 		= 'ERROR';
	    	$arr_responce['message'] 		= 'Error while getting member list.';
	    }
		/*if ($this->apiKey != null && $this->listId != null && $this->dataCenter != null && $this->url != null) 
		{
			$data = array(
				'fields'     => 'total_items,members.id,members.email_address,members.timestamp_opt,members.unique_email_id,members.status',
				'count'      => 1000, // the number of lists to return, default - 10
				'sort_field' => 'timestamp_signup',
				'sort_dir'   => 'DESC'
			);

		    $url = $this->url.'/members?'. http_build_query($data);

		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->apiKey);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    $curl_responce = curl_exec($ch);
		    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		    curl_close($ch);

		    $arr_members = json_decode($curl_responce,true);
		   
		    if($httpCode==200 && isset($arr_members) && is_array($arr_members)>0 && sizeof($arr_members)>0)
		    {
		    	$arr_responce['status'] 		= 'SUCCESS';
		    	$arr_responce['message'] 		= 'Member list get successfully.';
		    	$arr_responce['arr_members'] 	= $arr_members;
		    }
		    else
		    {
		    	$arr_responce['status'] 		= 'ERROR';
		    	$arr_responce['message'] 		= 'Error while getting member list.';
		    }
		}
		else
		{
			$arr_responce['status'] 		= 'ERROR';
		    $arr_responce['message'] 		= 'You haave invalid api credentials settings.';
		}*/


		return $arr_responce;

	}

	function unsubscribe($subscriber_hash=null)
	{
		if($subscriber_hash!=null && $this->apiKey!=null && $this->listId!=null && $this->dataCenter!=null && $this->url!=null) 
		{
		    $url = $this->url.'/members/'.$subscriber_hash;
		    $ch  = curl_init($url);
		    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->apiKey);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    $curl_responce = curl_exec($ch);
		    $httpCode      = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		    curl_close($ch);
		    json_decode($curl_responce,true);

		    if (isset($httpCode) && $httpCode==204)
		    {
		    	return 'SUCCESS';	
		    }
		}
		
		return 'ERROR';
		
	}
}