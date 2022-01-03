<?php

use App\Http\Controllers\Fortify\ProfileInformationController;
use App\Http\Controllers\UserProfileController;
use App\Notifications\News;
use App\Repositories\Ticket\TicketRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

//region Main Page Controller
Route::group(['middleware' => ['auth','verified']],function(){
    Route::get('/',[\App\Http\Controllers\MainController::class,'dashboard'])
        ->name('index');
    Route::get('/dashboard', [\App\Http\Controllers\MainController::class,'dashboard'])
        ->name('dashboard');
});
//endregion

//region User Profile Routes
Route::group(['middleware' => ['auth']], function () {
    // User & Profile...
    Route::get('/user/profile', [UserProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::delete('/user/profile/delete-profile-photo', [UserProfileController::class, 'deleteProfilePhoto'])
        ->middleware('verified')
        ->name('profile.delete-profile-photo');

//    Route::delete('/user/profile/delete-user', [UserProfileController::class, 'deleteUser'])
//        ->middleware('verified')
//        ->name('profile.delete-user');

    Route::delete('/user/profile/logout-other-browser-sessions', [UserProfileController::class, 'logoutOtherBrowserSessions'])
        ->middleware('verified')
        ->name('profile.logout-other-browser-sessions');

    Route::get('notifications/{notif}/markRead',[\App\Http\Controllers\MainController::class,'markAsRead'])
        ->middleware('verified')
        ->name('notifications.markread');

    Route::put('/user/settings', [UserProfileController::class, 'settingsupdate'])
        ->middleware('verified')
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

Route::get('mail',function (){
    $mail = Mail::raw('Hello World!', function($msg) {
        $msg->to('activ45@hotmail.com')->subject('Test Email');
    });
    return dd('Test Mail Send',$mail);
});
