<?php

namespace App\Providers;

use App\Events\AddViewerEvent;
use App\Events\ApproveCommentEvent;
use App\Listeners\AddViewerListener;
use App\Listeners\ApproveCommentListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ApproveCommentEvent::class => [
            ApproveCommentListener::class,
        ],
        AddViewerEvent::class => [
            AddViewerListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
