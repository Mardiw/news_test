<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewsEvent;
use App\Models\NewsLog;

class NewsEventListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewsEvent $event)
    {
        NewsLog::create([
            'news_id' => $event->newsId,
            'action' => $event->action,
            'created_at' => now()
        ]);
    }
}
