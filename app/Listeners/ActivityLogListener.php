<?php

namespace App\Listeners;

use App\Events\ActivityLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class ActivityLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  ActivityLogEvent  $event
     * @return void
     */


    public function handle(ActivityLogEvent $event)
    {
        $events->listen('mailer.sending', function ($message) {
            $email = Mail::send($receiversDetail['viewName'], $data, function ($message)use($sendersDetail,$receiversDetail)
            {
                $message->to(trim($receiversDetail['toEmail']))->subject($sendersDetail['subject']);
                if(isset($receiversDetail['attachmentFile']) && !empty($receiversDetail['attachmentFile']))
                {
                    $message->attach($receiversDetail['attachmentFile']);
                }
                
                $message->from(trim($sendersDetail['fromEmail']), $sendersDetail['fromName']);
            });
        });
        
    }
}
