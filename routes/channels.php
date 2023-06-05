<?php

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

Broadcast::channel('Phza24-chat{id}', function ($user, $id) {
    return true;
    // return $user->id === Order::findOrNew($orderId)->user_id;

    return (int) $user->id === (int) $id;
});
