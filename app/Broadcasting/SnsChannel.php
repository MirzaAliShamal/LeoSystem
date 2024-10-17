<?php

namespace App\Broadcasting;

use App\Models\User;
use Aws\Sns\SnsClient;
use Illuminate\Notifications\Notification;

class SnsChannel
{


    protected $snsClient;
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct(SnsClient $snsClient)
    {
        $this->snsClient = $snsClient;
    }


    public function send($notifiable, Notification $notification)
    {
        if (!$phoneNumber = $notifiable->routeNotificationFor('sns', $notification)) {
            return;
        }

        $message = $notification->toSns($notifiable);

        $this->snsClient->publish([
            'Message' => $message,
            'PhoneNumber' => $phoneNumber,
        ]);
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
//    public function join(User $user)
//    {
//        //
//    }
}
