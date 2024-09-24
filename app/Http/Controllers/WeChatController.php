<?php

namespace App\Http\Controllers;

use Log;
use EasyWeChat;

class WeChatController extends Controller
{

    /*
    * micro-channel request message processing 
    * 
    * @return String 
	*/  
    public function serve ()
	{
		//Log::info ( ' Request arrived. '); # Note: Log is Laravel assembly, it remember to log log Laravel Look, not the EasyWeChat log

        $app = app('wechat.official_account');
        
        $app->server->push( function($message) {
            return "Welcome attention overtrue！";
        });

        return $app->server->serve();



		/*$officialAccount = EasyWeChat::officialAccount(); // Public number
		$work            = EasyWeChat::work();            // Enterprise WeChat
		$payment         = EasyWeChat::payment();         // WeChat pay
		$openPlatform    = EasyWeChat::openPlatform();    // Open platform
		$miniProgram     = EasyWeChat::miniProgram();     // The small program

		// supports the incoming configuration account name 
		EasyWeChat::officialAccount( ' foo ' ); */
    }
}