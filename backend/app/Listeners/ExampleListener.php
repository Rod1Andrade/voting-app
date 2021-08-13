<?php

namespace Rodri\VotingApp\App\Listeners;

use Rodri\VotingApp\App\Events\ExampleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExampleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Rodri\VotingApp\App\Events\ExampleEvent $event
     * @return void
     */
    public function handle(ExampleEvent $event)
    {
        //
    }
}
