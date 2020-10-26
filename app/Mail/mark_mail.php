<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\SiteModel;

class mark_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public $textmessage;
    // public $phone;
    // public $email; 
    
    public $data;

    // public function __construct($message, $phone, $email)
    // {
    //     $this->textmessage = $message;
    //     $this->phone = $phone;
    //     $this->email = $email;

    //     // $this->data = $data;
    // }

    public function __construct($data)
    {
        // $this->textmessage = $message;

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email', ['email' => $this->data['email'], 'phone' => $this->data['phone'], 'content' => $this->data['content'],])->to(SiteModel::find('1')->email, "Заказ звонка");
    }
}
