<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            return \redirect()->route('admin')->with('success', 'Welcome to Dashboard');
        } else {
            return \redirect()->route('showroom')->with('success', 'Welcome to Dashboard');
        }

        // return Auth::user();
    }
}
