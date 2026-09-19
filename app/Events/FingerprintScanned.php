<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FingerprintScanned implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public int $finger_id;

    public function __construct(int $finger_id)
    {
        $this->finger_id = $finger_id;
    }

    /**
     * Channel publik agar ESP32 dan browser bisa subscribe tanpa auth.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('enrollment-channel');
    }

    public function broadcastAs(): string
    {
        return 'fingerprint.scanned';
    }

    public function broadcastWith(): array
    {
        return [
            'finger_id' => $this->finger_id,
        ];
    }
}
