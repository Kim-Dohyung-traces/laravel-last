<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        # 이건 .. 지워두 되는가
        # Registered::class => [
        #     SendEmailVerificationNotification::class,
        # ],

        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UsersEventListener::class
        ],
    ];

    # 메일 발송에 관련
    protected $subscribe = [
        \App\Listeners\UsersEventListener::class,
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
