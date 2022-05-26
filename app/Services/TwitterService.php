<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TwitterService
{
    public function handle()
    {
        $connection = new TwitterOAuth(
            Config::get('twitter.api_key'),
            Config::get('twitter.api_key_secret'),
            Config::get('twitter.access_token'),
            Config::get('twitter.access_token_secret'),
        );
        $params = ['screen_name' => '@koeitecmogames', 'count' => 200];
        $tweets = $connection->get('statuses/user_timeline', $params);
        return $tweets;
    }
}
