<?php

use App\Models\Channel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('channel.{channel}', function ($user, $channel) {
    $channelId = Channel::where('slug', $channel)->first()->id;
    if ($user->channels->contains($channelId)) {
        return $user->name;
    }
});
