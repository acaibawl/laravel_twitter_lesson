<?php

namespace App\Http\Controllers;

use App\Services\TwitterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwitterController extends Controller
{
    private TwitterService $service;

    public function __construct(TwitterService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->handle();
    }
}
