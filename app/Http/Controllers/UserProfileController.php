<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use App\Http\Resources\UserResource;

class UserProfileController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit()
    {

        return inertia('User/Profile', [
            'page_sessions' => $this->getSessionsProperty(),
            'page_user' => auth()->user()->load('departments')
        ]);
    }

    /**
     * Delete user's profile photo.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
        flash('Profil fotoğrafı silindi.')->success();
        return back();
    }

    /**
     * Delete the current user.
     */
    public function deleteUser(Request $request, StatefulGuard $auth)
    {
        if (! Hash::check($request->password, Auth::user()->password)) {
            return back()->with('status-fail', 'This password does not match our records.');
        }

        $request->user()->deleteProfilePhoto();
        $request->user()->delete();
        $auth->logout();

        return redirect()->route('welcome');
    }

    /**
     * Logout from other browser sessions.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutOtherBrowserSessions(Request $request, StatefulGuard $guard)
    {
        if (! Hash::check($request->password, Auth::user()->password)) {
            flash('Bu şifre kayıtlarımızla eşleşmiyor. ')->error();
            return back();
        }

        if (config('session.driver') !== 'database') {
            flash('Bu özellik desteklenmiyor.')->error();
            return back();
        }

        DB::table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();

        flash('Diğer tarayıcı oturumlarından çıkış yapıldı.')->success();
        return back();
    }

    /**
     * Get the current sessions.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getSessionsProperty()
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()

        )->map(function ($session) {
            return (object) [
                'agent' => $this->createAgent($session),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return string[]
     */
    protected function createAgent($session)
    {
       $agent = tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });

       return [
           'is_desktop' => $agent->isDesktop(),
           'platform' => $agent->platform(),
           'browser' => $agent->browser(),
       ];
    }

    public function settingsupdate(Request $request)
    {
        \Setting::set('notyf_yposition',$request->input('notyf_yposition'));
        \Setting::set('notyf_xposition',$request->input('notyf_xposition'));
        \Setting::save();

        flash('Hesap ayarları güncellendi.')->success();
        return back();
    }
}
