<?php

namespace App\Events;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public User $user,
        public Tenant|null $tenant = null
    ) {
    }

    /**
    * Get the channel the event should broadcast on.
    */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('users.' . $this->user->id);
    }
}
