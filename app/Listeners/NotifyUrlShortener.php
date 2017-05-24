<?php

namespace App\Listeners;

use App\Events\LinkCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mremi\UrlShortener\Model\Link;
use Mremi\UrlShortener\Provider\Bitly\BitlyProvider;
use Mremi\UrlShortener\Provider\Bitly\OAuthClient;
use Mremi\UrlShortener\Provider\Bitly\GenericAccessTokenAuthenticator;

class NotifyUrlShortener
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
        $link = new Link;
        $link->setLongUrl($event->link->url);

        $bitlyProvider = new BitlyProvider(
            new GenericAccessTokenAuthenticator(env('BITLY_GENERIC_ACCESS_TOKEN')),
            array('connect_timeout' => 10, 'timeout' => 10)
        );

        $bitlyProvider->shorten($link);

        $event->link->short_url = $link->getShortUrl();
        $event->link->save();
    }
}
