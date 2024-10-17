<?php

namespace App\Providers;

use App\Broadcasting\SnsChannel;
use Aws\Sns\SnsClient;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SnsClient::class, function ($app) {
            return new SnsClient([
                'version' => 'latest',
                'region'  => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);
        });

//        $this->app->singleton(SnsChannel::class, function ($app) {
//            return new SnsChannel($app->make(SnsClient::class));
//        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Notification::extend('sns', function ($app) {
            return new SnsChannel($app->make(SnsClient::class));
        });
    }
}
