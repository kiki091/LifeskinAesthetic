<?php

namespace App\Listeners;

use App\Events\Status;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThingTo
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
     * @param  Status  $event
     * @return void
     */
    public function handle(Status $event)
    {
        //
    }
}
