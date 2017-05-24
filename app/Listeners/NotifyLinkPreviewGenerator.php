<?php

namespace App\Listeners;

use App\Events\LinkCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Dusterio\LinkPreview\Client;

class NotifyLinkPreviewGenerator
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
     * @param  LinkCreated  $event
     * @return void
     */
    public function handle(LinkCreated $event)
    {
        $link = $event->link;

        $previewClient = new Client($link->url);

        // Get a preview from specific parser
        $preview = $previewClient->getPreview('general');

        // Convert output to array
        $preview = $preview->toArray();

        // Update Link
        $link->cover = $preview['cover'];
        $link->title = $preview['title'];
        $link->description = $preview['description'];
        $link->save();

    }
}
