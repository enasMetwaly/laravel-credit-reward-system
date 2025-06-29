<?php

namespace App\Providers;

use Illuminate\Broadcasting\BroadcastServiceProvider as BaseBroadcastServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends BaseBroadcastServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}