<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use http\QueryString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($ticket_id,$mediaItem,Request $request)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        /**
         * @var  $ticket Ticket|Media
         */
        if(!auth()->user()->can('ticket.show') && !$ticket->messages()->where('user_id',auth()->id())->exists()){
            abort(404);
        }

        /**
         * @var  $media Media
         */
        $media = $ticket->getMedia('ticket.attachments')->find($mediaItem);

        if(!$media){
            return abort(404,'Dosya bulunamadı!');
        }
        if( $request->has('preview') ){
            return response(file_get_contents($media->getPath()))->header('Content-Type',$media->getTypeFromMime());
            return $media;
        }

        return response()->download($media->getPath(), $media->file_name);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
