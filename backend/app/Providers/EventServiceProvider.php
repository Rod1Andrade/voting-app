<?php

namespace Rodri\VotingApp\App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Rodri\VotingApp\App\Events\ExampleEvent::class => [
            \Rodri\VotingApp\App\Listeners\ExampleListener::class,
        ],
    ];
}
