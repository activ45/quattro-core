<?php

namespace App\Observers;

use App\Models\Ticket;

class TicketObserver
{
    /**
     * Handle to the post "creating" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function creating(Ticket $ticket)
    {
        $ticket->user_id = auth()->id();
    }
    /**
     * Handle the ticket "created" event.
     *
     * @param Ticket $ticket
     */
    public function created(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "updated" event.
     *
     * @param Ticket $ticket
     */
    public function updated(Ticket $ticket)
    {

    }

    /**
     * Handle the ticket "deleted" event.
     *
     * @param Ticket $ticket
     */
    public function deleted(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "restored" event.
     *
     * @param Ticket $ticket
     */
    public function restored(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "force deleted" event.
     *
     * @param Ticket $ticket
     */
    public function forceDeleted(Ticket $ticket)
    {
        //
    }
}
