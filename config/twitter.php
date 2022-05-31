<?php

return [
    'consumer_key' => env('TWITTER_CLIENT_ID', ''),
    'consumer_secret' => env('TWITTER_CLIENT_SECRET', ''),
    'access_token' => env('TWITTER_CLIENT_ID_ACCESS_TOKEN', 'ccc'),
    'access_token_secret' => env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET', 'ddd'),
    'redirect' => env('CALLBACK_URL', 'eee'),
];
