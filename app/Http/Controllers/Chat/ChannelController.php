<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function channels($channel)
    {
        return view('channel', ['channel' => $channel]);
    }
}
