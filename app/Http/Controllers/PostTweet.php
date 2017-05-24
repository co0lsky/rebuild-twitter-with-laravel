<?php

namespace App\Http\Controllers;

use Auth;
use App\Tweet;
use App\Http\Requests\PostTweetRequest;
use App\Link;

class PostTweet extends Controller
{
    public function __invoke(PostTweetRequest $request)
    {
        $tweet = new Tweet(['body' => $request->tweet_body]);
        Auth::user()->tweets()->save($tweet);

        $this->detectLink($tweet->fresh());

        return redirect('home');
    }

    private function detectLink(Tweet $tweet)
    {
        $reg_exLink = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        // Check if there is a url in the text
        if(preg_match($reg_exLink, $tweet->body, $url)) {
            $link = Link::firstOrCreate(['url' => $url[0]]);

            $tweet->link_id = $link->id;
            $tweet->save();
        }
    }
}
