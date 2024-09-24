<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\NewsLetterModel;
use App\Models\NewsletterSubscriberModel;
use App\Common\Services\EmailService;
class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_newsletter:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send News Letter Subscription';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EmailService $email_service)
    {
        parent::__construct();
        $this->EmailService = $email_service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = [];
        $arr_subscriber = $arr_newsletter = [];
        $obj_newsletter = $obj_subscriber = $email_status = false;
        
        $broadcast_date = date('Y-m-d');
        $obj_newsletter =  NewsLetterModel::where('broadcast_date',$broadcast_date)->where('status','pending')->get();
        if($obj_newsletter!=false)
        {
            $arr_newsletter = $obj_newsletter->toArray();
        }
        
        if(count($arr_newsletter)>0) {
            foreach ($arr_newsletter as $key => $newsletter_data) {
                $obj_subscriber = NewsletterSubscriberModel::where('is_active','=','active')
                                                            ->whereHas('user_details',function($query){
                                                                $query->select('id','first_name','last_name','contact','email')->whereNull('deleted_at');
                                                            })
                                                            ->with(['user_details'=>function($query){
                                                                $query->select('id','first_name','last_name','contact','email')->whereNull('deleted_at');
                                                            }])
                                                            ->where('user_type','=',$newsletter_data['user_type'])
                                                            ->get();
                if($obj_subscriber!=false){
                    
                    $arr_subscriber = $obj_subscriber->toArray();
                    
                    if(count($arr_subscriber)>0){
                        foreach ($arr_subscriber as $key => $subscriber_data) {
                            //Send Email
                            $unsubscribe_url = url('/').'/unsubscribe_newsletter/'.encrypt($subscriber_data['user_details']['id']);

                            $arr_built_content = [
                                'NAME'            => $subscriber_data['user_details']['first_name'].' '.$subscriber_data['user_details']['last_name'],
                                'UNSUBSCRIBE_LINK' => $unsubscribe_url,
                                'MESSAGE'         => $newsletter_data['message'],
                                'PROJECT_NAME'    => config('app.project.name')
                            ];

                            $arr_mail_data                      = [];
                            $arr_mail_data['email_template_id'] = '11';
                            $arr_mail_data['arr_built_content'] = $arr_built_content;
                            $arr_mail_data['user']              = [
                                'email'      => $subscriber_data['user_details']['email'],
                                'first_name' => $subscriber_data['user_details']['first_name'].' '.$subscriber_data['user_details']['last_name']
                            ];
                            $email_status  = $this->EmailService->send_mail($arr_mail_data);
                        }
                    }
                }
                if($email_status!=false)
                {
                    $update_status = NewsLetterModel::where('id',$newsletter_data['id'])->update(['status'=>'sent']);
                }
            }
        }
        if($email_status!=false)
        {
            dd("success");
        }
        else
        {
            dd("fail");
        }
    }
}
