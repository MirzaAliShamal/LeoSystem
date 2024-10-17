<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $message;
    protected $user_type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$message,$user_type = "User")
    {
        $this->user = $user;
        $this->message = $message;
        $this->user_type = $user_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(get_option('MAIL_FROM_ADDRESS'), get_option('app_name'))
            ->subject($this->user_type.' Account Rejected'. get_option('app_name'))
            ->markdown('mail.user-rejected')
            ->with([
                'user' => $this->user,
                'message' => $this->message,
                'user_type' => $this->user_type,
            ]);
    }
}
