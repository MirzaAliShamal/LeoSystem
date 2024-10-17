<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Integer;

class UserApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected string $user_id;
    protected string $user_type;
    public $subject;
    protected string $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$user_id,$user_type,$content = Null,$subject=null)
    {
        $this->user = $user;
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->content = $content ?: "Congratulations! Your Application to Become a $user_type Has Been Successfully Approved!";
        $this->subject = $subject ?: $user_type.' Request Approved';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(get_option('MAIL_FROM_ADDRESS'), get_option('app_name'))
            ->subject($this->subject.' '. get_option('app_name'))
            ->markdown('mail.user-approved')
            ->with([
                'user'  => $this->user,
                'user_id' => $this->user_id,
                'user_type' => $this->user_type,
                'content' => $this->content,
            ]);
    }
}
