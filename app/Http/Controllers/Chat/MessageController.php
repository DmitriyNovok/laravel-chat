<?php

namespace App\Http\Controllers\Chat;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        Message::dispatch($request->input('message'));
    }
}
