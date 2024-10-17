<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected string $user_type;
    protected string $content;
    protected string $verification_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$verification_code,$user_type,$content = Null)
    {
        $this->user = $user;
        $this->verification_code = $verification_code;
        $this->user_type = $user_type;
        $this->content = $content ?: "Your Login  Verification Code is";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(get_option('MAIL_FROM_ADDRESS'), get_option('app_name'))
            ->subject('Login Verification '. get_option('app_name'))
            ->markdown('mail.login-verification')
            ->with([
                'user'  => $this->user,
                'verification_code' => $this->verification_code,
                'user_type' => $this->user_type,
                'content' => $this->content,
            ]);
    }
}
