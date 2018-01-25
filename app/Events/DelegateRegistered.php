<?php

namespace App\Events;

use App\Delegate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DelegateRegistered {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Delegate delegate */
    public $delegate;

    public function __construct(Delegate $delegate) {
        $this->delegate = $delegate;
    }
}
