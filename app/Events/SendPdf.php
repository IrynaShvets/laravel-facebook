<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPdf implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $pdf;
    /**
     * Create a new event instance.
     */
    public function __construct($pdf, $user_id)
    {
        \Log::info('user ID '.$user_id);
        $this->user_id = $user_id;
        $this->pdf = $pdf;
        \Log::info('helo pdf'. $pdf);
        \Log::info($user_id);
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
       
        return [
            new Channel('pdf.' .$this->user_id),

        ];
    }

    public function broadcastAs()
    {
        return 'send-pdf';
    }
}
