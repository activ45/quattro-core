<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\TicketMessage;

class TicketMessageObserver
{
    /**
     * Handle to the post "creating" event.
     *
     * @param  \App\Models\TicketMessage  $message
     * @return void
     */
    public function creating(TicketMessage $message)
    {
        $message->user_id = auth()->id();
    }
}
