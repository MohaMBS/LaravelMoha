<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{iD}.{id}', function ($user,$iD,$id) {
    return $user->id == $iD || $user->id == $id; 
});

Broadcast::channel('channel.public', function ($user) {
    return Auth::check();
});

Broadcast::channel('channel.commentLike', function ($user) {
    return Auth::check();
});

Broadcast::channel('presence.home', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});