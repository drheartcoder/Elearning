<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\EmailTemplateModel;

use Config;

class ForgotPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url            = url(Config("auth.user_mode").'/reset_password').'/'.$this->token;
        $arr_email_data = [];
        $obj_email_data = EmailTemplateModel::where('id',2)->first();
        if($obj_email_data)
        {
            $arr_email_data = $obj_email_data->toArray();
        }

        $content  = '';
        $content .= $arr_email_data['template_html'];

        $content  = str_replace('##PROJECT_NAME##', config('app.project.name'), $content);
        $content  = str_replace('##NAME##', $notifiable->first_name, $content);
        $content  = str_replace('##RESET_LINK##', $url, $content);

        return (new MailMessage)->view('email.general', array('content'=>$content))->subject(config('app.project.name').' :Forgot Password');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */



public function toArray($notifiable)
{
    return [
            //
    ];
}
}
