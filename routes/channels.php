<?php

use Illuminate\Support\Facades\Broadcast;

// Define channel authorization rules
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});