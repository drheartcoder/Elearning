<?php 

namespace App\Common\Services;
use Illuminate\Http\Request;

use App\Models\NotificationsModel;
use App\Models\UsersModel;

use Session;
use Mail;
use Auth;
use URL;

class NotificationService
{
	public function __construct(NotificationsModel $notifications_model, UsersModel $users_model)
	{
		$this->NotificationsModel        = $notifications_model;
		$this->UsersModel                = $users_model;
		$this->site_name                 = config('app.project.name');
	}

	public function send_notification($arr_notification_data = FALSE)
	{
		if(isset($arr_notification_data) && sizeof($arr_notification_data)>0)
		{		
			$user_notification_data['message']      = $arr_notification_data['message'];
			$user_notification_data['from_user_id'] = $arr_notification_data['from_user_id'];
			$user_notification_data['to_user_id']   = $arr_notification_data['to_user_id'];
			$user_notification_data['is_read']      = '0';
			$user_notification_data['url']          = isset($arr_notification_data['url']) ? $arr_notification_data['url'] : '';
			
			$notification_status                    = $this->NotificationsModel->create($user_notification_data);

			if($notification_status)
			{
				return true;
			}
			return false;			

		}	
		return false; 
	}

}