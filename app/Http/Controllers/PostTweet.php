<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tweet;
use App\Http\Requests\PostTweetRequest;

class PostTweet extends Controller
{
    // method for get request tweet before user sent tweet in timeline
    public function __invoke(PostTweetRequest $request)
    {
        $tweet = new Tweet(['body' => $request->tweet_body]);
        Auth::user()->tweets()->save($tweet);

        return redirect('home');
    }
}
