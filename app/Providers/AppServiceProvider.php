<?php

namespace App\Providers;

use App\Enums\TicketStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $ticket_enums = collect(\App\Enums\TicketStatus::choices())->mergeRecursive(TicketStatus::colors())->map(function ($var){
            return [
                'text' => $var[0],
                'color' => $var[1]
            ];
        });
        View::share('ticket_enums', $ticket_enums->toJson());
    }
}
