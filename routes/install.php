<?php
use Illuminate\Support\Facades\Route;

//region Install Routes
Route::get('/install', function () {
    Artisan::call('storage:link');
    Artisan::call('migrate:refresh', [
        '--seed'=>true,
        '--force' => true
    ]);
    return redirect()->route('index');
});
Route::get('/install/storage', function () {
    $setup = Artisan::call('storage:link');
    return redirect()->route('index');
});
//endregion
