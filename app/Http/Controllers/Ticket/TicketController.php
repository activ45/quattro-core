<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\TicketStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ticket.edit')->only('edit','update');
        $this->middleware('role:user')->only('create','store');
    }

    public function index()
    {

        $tickets = Ticket::with('user','messages.user','department');

        if(!auth()->user()->can('ticket.show')){
            $tickets->where('user_id',auth()->id());
        }

        return inertia('Ticket/Index',[
            'page_tickets' => $tickets->paginate()
        ]);
    }

    public function create()
    {
        return inertia('Ticket/Create',[
            'page_departments' => Department::all()
        ]);
    }

    public function store(TicketCreateRequest $request)
    {
        $ticket = Ticket::create([
            'subject' => $request->input('subject'),
            'department_slug' => $request->input('department')
        ]);
        $message = $ticket->messages()->create([
            'user_id' => auth()->id(),
            'body' => $request->input('body')
            ]);

        if ( $request->hasFile('attachment') ) {
            $ticket->addMediaFromRequest('attachment')
                ->withCustomProperties(['message_id' => $message->id])
                ->toMediaCollection('ticket.attachments');
        }

        flash('Yeni bildirim oluşturuldu.')->success();
        return redirect()->route('ticket.show', $ticket);
    }

    public function show($id)
    {
        $ticket = Ticket::with('user','messages.user','department');

        if(!auth()->user()->can('ticket.show')){
            $ticket->where('user_id',auth()->id());
        }

        $ticket = $ticket->findOrFail($id);
        /**
         * @var $attachments MediaCollection
         */
        $attachments = $ticket->getMedia('ticket.attachments');

        $messages = $ticket->messages->map(function(TicketMessage $msg) use($attachments){
            $msg->attachments = array_values($attachments->filter(function ($value, $key) use($msg) {
                if(is_array($value->custom_properties)){
                    $colle = collect($value->custom_properties);
                    return $colle->has('message_id') && $msg->id === $colle->get('message_id');
                }else
                    return false;

            })->toArray());
            return $msg;
        });
//        dd($messages);
        $activity = Activity::with('causer')->forSubject($ticket)->get();
        return inertia('Ticket/Show',[
            'page_ticket' => $ticket,
            'page_messages' => $messages,
            'page_activity' => $activity,
            'page_attachments' => $attachments
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(TicketUpdateRequest $request, $id)
    {
        $ticket = Ticket::with('user','messages.user','department');
        if(auth()->user()->can('ticket.update')){
            $ticket = $ticket->findOrFail($id);

            Ticket::$logMessage = "Bildirim durumu güncellendi.";

            $ticket->update($request->validated());
            flash('Bildirim durumu güncellendi.')->success();
        }else if($request->input('status') == 'closed'){
            $ticket = $ticket->where('user_id',auth()->id())
                ->findOrFail($id);

            Ticket::$logMessage = "Kullanıcı bildirimi kapattı.";

            $ticket->update(['status' => TicketStatus::CLOSED]);
            flash('Bildirim kapatıldı.')->success();
        }

        return back();
    }

    public function destroy($id)
    {
        //
    }
}
