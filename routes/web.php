<?php

use App\Http\Controllers\Fortify\ProfileInformationController;
use App\Http\Controllers\UserProfileController;
use App\Notifications\News;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function (){
$user = auth()->user();
    //$user->notify(new News('Mesajınız var','Kullanıcı mesajınız geldi gelen kutunuzda.'));

    flash('Bilgileriniz Güncellendi')->warning()->important();
    flash('Bilgileriniz Güncellendi')->success()->important();
    flash('Bilgileriniz Güncellendi')->info()->important();
    flash('Bilgileriniz Güncellendi')->error()->important();

    return redirect()->route('dashboard');
})->middleware('auth')->name('index');
Route::middleware(['auth', 'verified'])->get('/dashboard', function ( ) {
    //flash('Bilgileriniz Güncellendi')->success();

    return inertia('Dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth','verified']], function () {
    // User & Profile...
    Route::get('/user/profile', [UserProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::delete('/user/profile/delete-profile-photo', [UserProfileController::class, 'deleteProfilePhoto'])
        ->name('profile.delete-profile-photo');

    Route::delete('/user/profile/delete-user', [UserProfileController::class, 'deleteUser'])
        ->name('profile.delete-user');

    Route::delete('/user/profile/logout-other-browser-sessions', [UserProfileController::class, 'logoutOtherBrowserSessions'])
        ->name('profile.logout-other-browser-sessions');

    Route::get('notifications/{notif}/markRead', function (\Illuminate\Notifications\DatabaseNotification $notif) {
        if($notif->notifiable_type === \App\Models\User::class && $notif->notifiable->id === auth()->user()->id){
            $notif->markAsRead();
            return redirect()->route('dashboard');
        }
    })->name('notifications.markread');

    Route::put('/user/settings', [UserProfileController::class, 'settingsupdate'])
        ->name('user-settings.update');
    Route::put('/user/settings', [UserProfileController::class, 'settingsupdate'])
        ->name('user-settings.update');
});

// Override Fortify route
Route::group(['middleware' => config('fortify.middleware')], function () {
    // Profile Information...
//    Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
//        ->middleware(['auth'])
//        ->name('user-profile-information.update');

    Route::put('/user/profile-photo', [ProfileInformationController::class, 'updateProfilePhoto'])
        ->middleware(['auth'])
        ->name('user-profile-photo.update');
});

Route::get('/test',function () {
    return redirect()->route('dashboard');
});
