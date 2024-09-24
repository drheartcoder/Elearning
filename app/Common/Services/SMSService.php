<?php

namespace App\Common\Services;

use \Session;
use AWS;
class SMSService
{
	public function __construct(){}

	public function send_SMS($msg=FALSE,$mobile_number = FALSE)
	{		
		$status = '';
		$sms    = AWS::createClient('sns');

        $status = $sms->publish([
                'Message' => $msg,
                'PhoneNumber' => $mobile_number,    
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                     ]
                 ],
              ]);

       if($status)
       {
       	 return true;
       }
	   return false;
	}

}



?>
