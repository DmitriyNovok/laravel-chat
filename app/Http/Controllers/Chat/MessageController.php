<?php

namespace App\Http\Controllers\Chat;

use App\Events\Message;
use App\Events\PrivateMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        PrivateMessage::dispatch($request->all());
    }
}
