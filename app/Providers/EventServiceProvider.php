<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LoginListener'
        ],
        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\LegacyPasswordListener',
        ],
        'App\Events\ThreadViewedEvent' => [
            'App\Listeners\ThreadViewedListener'
        ],
        'App\Events\ModerationActionEvent' => [
            'App\Listeners\ModerationActionListener'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
