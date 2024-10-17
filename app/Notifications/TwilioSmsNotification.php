<?php

namespace App\Notifications;

use App\Broadcasting\TwilioSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioSmsNotification extends Notification
{
    use Queueable;


    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }


    public function via($notifiable): array
    {
        return [TwilioSmsChannel::class];
    }

    public function toTwilio($notifiable)
    {
        return $this->message;
    }
}
