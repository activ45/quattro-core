<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        return \Redirect::route('dashboard');
    }

    public function dashboard()
    {
        $user = User::all();
        return inertia('Dashboard',[
            'page_users' => $user
        ]);
    }
}
