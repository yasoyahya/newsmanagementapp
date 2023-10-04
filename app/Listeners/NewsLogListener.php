<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewsEvent;
use App\Models\NewsLog;

class NewsLogListener
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
    // public function handle(object $event): void
    // {
    //     //
    // }

    public function handle(NewsEvent $event)
    {
        // Create a log entry in the separate table
        NewsLog::create([
            'news_id' => $event->news->id,
            'action' => $event->action,
        ]);
    }
    
}
