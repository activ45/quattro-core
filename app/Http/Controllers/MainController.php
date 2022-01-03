<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        return \Redirect::route('dashboard');
    }

    public function dashboard()
    {
        return inertia('Dashboard',[
            'tc_verified_users' => User::withTrashed()->whereNull('tc_verified_at')->count()
        ]);
    }

    public function markAsRead($notif)
    {
        $user = auth()->user();
        if($notif == 0){
            $user->notifications->markAsRead();
            return redirect()->back();
        }elseif( $notif == -1){
            $user->notifications()->delete();
            return redirect()->back();
        }

        $notifData = $user->unreadNotifications->find($notif);
        if($notifData){
            $notifData->markAsRead();
            if($notifData->data['action'] != null){
                return redirect($notifData->data['action']);
            }
        }
        return redirect()->back();
    }
}
