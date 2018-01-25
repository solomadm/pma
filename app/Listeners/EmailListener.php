<?php

namespace App\Listeners;

use App\Events\DelegateRegistered;

class EmailListener {
    /**
     * Create the event listener.
     *
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DelegateRegistered $event
     * @return void
     */
    public function handle(DelegateRegistered $event) {

    }
}
