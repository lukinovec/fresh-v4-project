<?php

namespace App\Listeners;

use App\Events\TestingEvent;

class TestingListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TestingEvent $event): void
    {
        if ($event->tenant) {
            $event->tenant->count ??= 0;

            $count = $event->tenant->count + 1;

            $event->tenant->update(['name' => 'Testing-' . (string) $count, 'count' => $count]);
        }
    }
}
