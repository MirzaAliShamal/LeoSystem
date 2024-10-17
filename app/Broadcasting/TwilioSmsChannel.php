<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
class TwilioSmsChannel
{

    protected $twilio;

    /**
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    /**
     * @throws TwilioException
     */
    public function send($notifiable, Notification $notification): void
    {
        if (! $to = $notifiable->routeNotificationFor('twilio', $notification)) {
            return;
        }

        $message = $notification->toTwilio($notifiable);

        $this->twilio->messages->create($to, [
            'from' => config('services.twilio.from'),
//            'messagingServiceSid' => config('services.twilio.messaging_service_sid'),
            'body' => $message
        ]);
    }
}
