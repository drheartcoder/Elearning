<?php

namespace App\Common\Services;

use App\Models\EmailTemplateModel;
use App\Models\SiteStatusModel;
use App\Models\UsersModel;
use App\Models\ReferenceCodeModel;
use \Session;
use \Mail;
use App;

use App\Mail\SendMailable;
use App\Mail\SendAttachmentMails;

class EmailService
{
	public function __construct(UsersModel $user,
								EmailTemplateModel $email,
								ReferenceCodeModel $refernce_code)
	{
		$this->EmailTemplateModel = $email;
		$this->UsersModel 		  = $user;
		$this->BaseModel          = $this->EmailTemplateModel;
		$this->ReferenceCodeModel = $refernce_code;
	}

	public function send_mail($arr_mail_data = FALSE)
	{
		if(isset($arr_mail_data) && sizeof($arr_mail_data)>0)
		{
			$arr_email_template = $arr_data = [];

		    $locale = App::getLocale();
			$obj_email_template = $this->EmailTemplateModel->where('id',$arr_mail_data['email_template_id'])
														   ->with(['template_details'=>function($q1) use($locale){
														   		$q1->where('locale','=',$locale);
														   }])
															->first();


			if($obj_email_template)
			{
				$attachment = '';
				$arr_email_template = $obj_email_template->toArray();
				$user               = $arr_mail_data['user'];

				if(isset($arr_email_template['template_details'][0]['template_html']) && $arr_email_template['template_details'][0]['template_html']!="")
				{
					$content = $arr_email_template['template_details'][0]['template_html'];
					if(isset($arr_mail_data['arr_built_content']) && sizeof($arr_mail_data['arr_built_content']) > 0)
					{
						foreach($arr_mail_data['arr_built_content'] as $key => $data)
						{
							$content = str_replace("##".$key."##",$data,$content);
						}
					}
					//Build Email
					$content   = view('email.general',compact('content'))->render();
					$content   = html_entity_decode($content);
					$from_mail = isset($arr_email_template['template_from_mail'])?$arr_email_template['template_from_mail']:'';
					$from_name = isset($arr_email_template['template_from'])?$arr_email_template['template_from']:'';
					$subject   = isset($arr_email_template['template_details'][0]['template_subject'])?$arr_email_template['template_details'][0]['template_subject']:'';
					$to_mail   = isset($user['email'])?$user['email']:'';
					$to_name   = isset($user['first_name']) ? $user['first_name']:"";

					$arr_data['content']   = $content; 
					$arr_data['from_mail'] = $from_mail; 
					$arr_data['from_name'] = $from_name; 
					$arr_data['subject']   = $subject; 
					$arr_data['to_mail']   = $to_mail; 
					$arr_data['to_name']   = $to_name; 

					try {
						$attachment = isset($user['attachment_path']) && $user['attachment_path']!="" ? $user['attachment_path'] : '';
						if($attachment!=""){
							$arr_data['attachment'] = $attachment;
							Mail::to($to_mail)->queue(new SendAttachmentMails($arr_data)); 
						}
						else{
							Mail::to($to_mail)->queue(new SendMailable($arr_data));
						}
					}catch (Exception $e) {
							return $e;
					}
				}
			}
		}
		return false;    
	}
/*
	public function send_flyer($arr_mail_data = FALSE)
	{
		if(isset($arr_mail_data) && sizeof($arr_mail_data)>0)
		{		
			$user               = $arr_mail_data['user'];
			if(isset($arr_mail_data['flyer_content']))
			{
				$content = $arr_mail_data['flyer_content'];
				if(isset($arr_mail_data['arr_built_content']) && sizeof($arr_mail_data['arr_built_content']) > 0)
				{
					foreach($arr_mail_data['arr_built_content'] as $key => $data)
					{
						$content = str_replace("##".$key."##",$data,$content);
					}
				}

				
				$content   = view('email.flyer',compact('content'))->render();
				$content   = html_entity_decode($content);
				
				$send_mail = Mail::send(array(),array(), function($message) use($user,$arr_mail_data,$content)
				{
					$name = isset($user['first_name']) ? $user['first_name']:"";
					$message->from($arr_mail_data['flyer_email'], $arr_mail_data['flyer_from']);
					$message->to($user['email'], $name )
							->subject($arr_mail_data['flyer_subject'])
							->setBody($content, 'text/html');
				});							
				return true;
			}
			
		}
		return false;    
	}*/

	public function send_flyer($arr_mail_data = FALSE)
	{
		if(isset($arr_mail_data) && sizeof($arr_mail_data)>0)
		{					
			$arr_email_template = []; 

			$obj_email_template = $this->EmailTemplateModel->where('id',$arr_mail_data['email_template_id'])->first();
			
			if($obj_email_template)
			{
				$attachment         = '';
				$arr_email_template = $obj_email_template->toArray();

				$user               = $arr_mail_data['user'];
				$attachment         = $arr_mail_data['attachment'];
				//dd($attachment);
				
				if(isset($arr_email_template['template_html']))
				{
					$content = $arr_email_template['template_html'];
						
					if(isset($arr_mail_data['arr_built_content']) && sizeof($arr_mail_data['arr_built_content'])>0)
					{
						foreach($arr_mail_data['arr_built_content'] as $key => $data)
						{
							$content = str_replace("##".$key."##",$data,$content);
						}
					}

					//Build Email
					$content   = view('email.general',compact('content'))->render();
					$content   = html_entity_decode($content);
					$from_mail = isset($arr_email_template['template_from_mail'])?$arr_email_template['template_from_mail']:'';
					$from_name = isset($arr_email_template['template_from'])?$arr_email_template['template_from']:'';
					$subject   = isset($arr_email_template['template_details'][0]['template_subject'])?$arr_email_template['template_details'][0]['template_subject']:'';
					$to_mail   = isset($user['email'])?$user['email']:'';
					$to_name   = isset($user['first_name']) ? $user['first_name']:"";

					$arr_data['content']    = $content; 
					$arr_data['from_mail']  = $from_mail; 
					$arr_data['from_name']  = $from_name; 
					$arr_data['subject']    = $subject; 
					$arr_data['to_mail']    = $to_mail; 
					$arr_data['to_name']    = $to_name; 
					$arr_data['attachment'] = $attachment; 
					try {
						Mail::to($to_mail)->queue(new SendAttachmentMails($arr_data));
					}catch (Exception $e) {
							return $e;
					}
					/*$content   = view('email.general',compact('content'))->render();
					$content   = html_entity_decode($content);		        	

					$send_mail = Mail::send(array(),array(), function($message) use($user,$arr_email_template,$content,$attachment)
					{
						$name = isset($user['first_name']) ? $user['first_name']:"";
						$message->from($arr_email_template['template_from_mail'], $arr_email_template['template_from']);
						$message->to($user['email'], $name );
						if(isset($attachment) && $attachment!=''){
							$message->attach($attachment);
						}
						$message->subject($arr_email_template['template_subject'])->setBody($content, 'text/html');
					});	*/
				}
			}
		}
		return false;    
	}
	

	public function send_notification_mail($arr_mail_data = FALSE)
	{
		if(isset($arr_mail_data) && sizeof($arr_mail_data)>0)
		{					
			$arr_email_template = [];
			$subject            = '';

			$obj_email_template = $this->EmailTemplateModel->with(['translations'])
														   ->where('id',$arr_mail_data['email_template_id'])
														   ->first();

			if($obj_email_template)
			{
				$arr_email_template = $obj_email_template->toArray();
				$user               = $arr_mail_data['user'];
				$preference         = $this->check_language_preference($user['id']);

				$arr_email_template['translations'] = $this->arrange_locale_wise($arr_email_template['translations']);

				if(isset($arr_email_template['translations']) && sizeof($arr_email_template['translations']) > 0
						&& isset($preference))
				{
					foreach($arr_email_template['translations'] as $key => $template)
					{
						if($template['locale'] == $preference)
						{
							$subject = $template['template_subject'];
							$content = $template['template_html'];
						}
					}
				}

				if(isset($arr_mail_data['arr_built_content']) && sizeof($arr_mail_data['arr_built_content'])>0)
				{
					foreach($arr_mail_data['arr_built_content'] as $key => $data)
					{
						$content = str_replace("##".$key."##",$data,$content);
					}
				}

				//Build Email
				$content   = view('email.general',compact('content'))->render();
				$content   = html_entity_decode($content);
				$from_mail = isset($arr_email_template['template_from_mail'])?$arr_email_template['template_from_mail']:'';
				$from_name = isset($arr_email_template['template_from'])?$arr_email_template['template_from']:'';
				$subject   = isset($arr_email_template['template_details'][0]['template_subject'])?$arr_email_template['template_details'][0]['template_subject']:'';
				$to_mail   = isset($user['email'])?$user['email']:'';
				$to_name   = isset($user['first_name']) ? $user['first_name']:"";

				$arr_data['content']   = $content; 
				$arr_data['from_mail'] = $from_mail; 
				$arr_data['from_name'] = $from_name; 
				$arr_data['subject']   = $subject; 
				$arr_data['to_mail']   = $to_mail; 
				$arr_data['to_name']   = $to_name; 
				try {
					Mail::to($to_mail)->queue(new SendMailable($arr_data));
				}catch (Exception $e) {
						return $e;
				}
				/*$content = view('email.general',compact('content'))->render();
				$content = html_entity_decode($content);

				$send_mail = Mail::send(array(),array(), function($message) use($user,$arr_email_template,$content,$subject)
				{
					$name = isset($user['name']) ? $user['name']:"";
					$message->from($arr_email_template['template_from_mail'], $arr_email_template['template_from']);
					$message->to($user['email'], $name );
					$message->subject($subject);
					$message->setBody($content, 'text/html');
				});
				return $send_mail;*/
			}
		}
		return false;
	}

	public function check_language_preference($user_id = false)
	{
		$preference = 'en';
		if($user_id != false)
		{
			$obj_user = $this->UsersModel->where('id',$user_id)->first();
			if($obj_user)
			{
				$preference = isset($obj_user->preferred_language) && $obj_user->preferred_language != "" ? $obj_user->preferred_language : 'en';
			}
		}
		return $preference;
	}

	public function arrange_locale_wise(array $arr_data)
	{
		if(sizeof($arr_data)>0)
		{
			foreach ($arr_data as $key => $data) 
			{
				$arr_tmp = $data;
				unset($arr_data[$key]);
				$arr_data[$data['locale']] = $data;                    
			}
			return $arr_data;
		}
		else
		{
			return [];
		}
	}
	public function send_refer_email($arr_user,$pin,$arr_coupon=false)
    {   
        $extension      = $email_status = '';
        $arr_refernce   = [];
        $obj_refernce   = $this->ReferenceCodeModel->first();

        if($obj_refernce)
        {
            $arr_refernce = $obj_refernce->toArray();
        }
        if(isset($arr_refernce) && sizeof($arr_refernce)>0)
        {
        	if($arr_refernce['reference_reward_type']=='both')
	        {
	            $extension = 'Extension of '.$arr_refernce['validity_extension'].' months and Incentive of '.$arr_refernce['reward_amount'];
	        }
	        elseif($arr_refernce['reference_reward_type']=='validity_extension')
	        {
	            $extension = 'Extension of '.$arr_refernce['validity_extension'].' months'; 
	        }
	        else
	        {
	            $extension = 'Incentive of '.$arr_refernce['reward_amount'].'%';
	        }
	        $first_name = isset($arr_user['first_name'])?$arr_user['first_name']:'';
	        $last_name  = isset($arr_user['last_name'])?$arr_user['last_name']:'';
	        $start_date = isset($arr_coupon['start_date'])?$arr_coupon['start_date']:'';
	        $end_date   = isset($arr_coupon['end_date'])?$arr_coupon['end_date']:'';
	        $discount_amount = isset($arr_refernce['discount_amount'])?$arr_refernce['discount_amount']:'';
	        $arr_built_content = [
	                      
	                'NAME'            => $first_name.' '.$last_name,
	                'SUBJECT'         => 'Coupen Mail',
	                'PROJECT_NAME'    => config('app.project.name'),
	                'EXTENSION'       => $extension ,
	                'DISCOUNT_AMOUNT' => $discount_amount.' CNY',
	                'DISCOUNT_COUPEN' => $pin,
	                'START_DATE'      => $start_date,
	                'END_DATE'        => $end_date,
	            ];

	        $arr_mail_data                      = [];
	        $arr_mail_data['email_template_id'] = '10';
	        $arr_mail_data['arr_built_content'] = $arr_built_content;
	        $arr_mail_data['user']              = [
	                                                'email'      => isset($arr_user['email'])?$arr_user['email']:'',
	                                                'first_name' => isset($arr_user['first_name'])?$arr_user['first_name']:'',
	                                              ];

	        if(isset($arr_user['email']) && $arr_user['email']!="")
	        {
	        	 $email_status  = $this->send_mail($arr_mail_data);
	        }
        }
        return $email_status;
              
    }
}

?>