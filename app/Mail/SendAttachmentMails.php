<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAttachmentMails extends Mailable
{
    use Queueable, SerializesModels;
    public $arr_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($arr_data)
    {
        $this->arr_data   = $arr_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.common')
                    ->from($this->arr_data['from_mail'],$this->arr_data['from_name'])
                    ->subject($this->arr_data['subject'])
                    ->attach($this->arr_data['attachment'])
                    ->with('content', $this->arr_data['content']);
    }
}