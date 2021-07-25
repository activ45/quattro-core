<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\TicketStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\MessageCreateRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(MessageCreateRequest $request,$ticket)
    {
        /**
         * @var Ticket
         */

        if(!auth()->user()->hasRole('user')){
            $ticket = Ticket::findOrFail($ticket);
            $ticket->update([
                'status' => TicketStatus::REPLIED
            ]);
        }else{
            $ticket = Ticket::forUser()->findOrFail($ticket);
            $ticket->update([
                'status' => TicketStatus::OPEN
            ]);
        }

        $message = $ticket->messages()->create([
            'body' => $request->input('body')
        ]);

        if ($message && $request->hasFile('attachment') ) {
            $ticket->addMediaFromRequest('attachment')
                ->withCustomProperties(['message_id' => $message->id])
                ->toMediaCollection('ticket.attachments');
        }

        flash('Yeni mesaj gönderildi.')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
