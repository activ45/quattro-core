<?php

use App\Http\Controllers\Fortify\ProfileInformationController;
use App\Http\Controllers\UserProfileController;
use App\Notifications\News;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

//region Main Page Controller
Route::group(['middleware' => ['auth','verified']],function(){
    Route::get('/',[\App\Http\Controllers\MainController::class,'index'])
        ->name('index');
    Route::get('/dashboard', [\App\Http\Controllers\MainController::class,'dashboard'])
        ->name('dashboard');
});
//endregion


//region User Profile Routes
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
});
//endregion Routes

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

Route::get('/test',function (Request $request) {
    return Carbon::now();
});
