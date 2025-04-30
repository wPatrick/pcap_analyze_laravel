<?php

namespace App\Events;

use App\Models\Pcap;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PcapAnalyzed implements ShouldBroadcastNow
{
    use InteractsWithBroadcasting;
    use Dispatchable, SerializesModels;
    public Pcap $pcap;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pcap $pcap)
    {
        $this->pcap = $pcap;
        $this->broadcastVia('pusher');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PresenceChannel|array
     */
    public function broadcastOn(): Channel|PresenceChannel|array
    {
        return new Channel('pcap');
    }

    public function broadcastAs(): string
    {
        return 'PcapAnalyzed';
    }


}
