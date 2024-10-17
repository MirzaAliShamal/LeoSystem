<?php

namespace App\Notifications;

use App\Broadcasting\SnsChannel;
use Aws\Sns\SnsClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SnsNotification extends Notification
{
    use Queueable;


    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['sns'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSns($notifiable)
    {
       return $this->message;
//        $snsClient = app(SnsClient::class);
//        $snsClient->publish([
//            'Message' => $this->message,
//            'PhoneNumber' => $notifiable->phone_number, // Ensure the notifiable has a phone_number attribute
//        ]);
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
