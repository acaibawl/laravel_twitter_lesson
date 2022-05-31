<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function tweet()
    {
        $user = Auth::user();

        $twitterUser = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            $user->twitter_oauth_token,
            $user->twitter_oauth_token_secret
        );
        // ツイートする
        $res = $twitterUser->post('statuses/update', [
            'status' => 'Hello Twitter ' . PHP_EOL . Carbon::now()
        ]);
        return redirect()->away('https://twitter.com/');
    }
}
