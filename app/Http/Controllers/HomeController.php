<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check the user's role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'comptable':
                    return redirect()->route('comptable.dashboard');
                case 'superadmin':
                    return redirect()->route('superadmin.dashboard');
                default:
                    // For users with other roles, show the home view
                    return view('home');
            }
        } else {
            // If the user is not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function ComptableDashboard()
    {
        return view('comptable.dashboard');
    }

    public function superAdminDashboard()
    {
        return view('superadmin.dashboard');
    }
}
