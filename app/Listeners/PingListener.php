<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PingEvent;
use Illuminate\Support\Facades\Log;

class PingListener implements ShouldQueue{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     * @param PingEvent $event
     * @return void
     */
    public function handle(PingEvent $event) {
        Log::info('listener', ['data' => ['a' => 'b']]);
    }
}
