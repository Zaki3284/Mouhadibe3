<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Problem;



use App\Models\Product;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use App\Models\AdminReport;
use App\Models\User;
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
                    $adminReports = AdminReport::all();
                    $products = Product::all();
                    $orders = Order::all();
                    $totalReports = AdminReport::count(); // Example: Count of all admin reports
                    $completionRate = 75; // Example: Completion rate in percentage
                    $readReports = AdminReport::where('read_by_admin', true)->count();
                    $totalProblems = Problem::count();

                    return view('admin.dashboard', compact('adminReports', 'products', 'orders', 'totalReports', 'readReports', 'totalProblems'));

                case 'comptable':
                    return redirect()->route('comptable.dashboard');
                case 'superadmin':
                    // Retrieve all users from the database
                    $totalUsers = User::count();
                    $totalProblems = Problem::count();
                    $users = User::all();
                    $contactMessages = ContactMessage::all();
                    $problems = Problem::all();
                    return view('superadmin.dashboard', compact('users', 'contactMessages', 'problems', 'totalUsers', 'totalProblems'));

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
        $users = User::all();
        $contactMessages = ContactMessage::all();
        $problems = Problem::all();
        return view('superadmin.dashboard', compact('users', 'contactMessages', 'problems'));
    }
}
