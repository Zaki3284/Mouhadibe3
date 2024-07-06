<?php

namespace App\Http\Controllers;

use App\Models\AdminReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminReports = AdminReport::all(); // Fetch all admin reports
        return view('admin.dashboard', ['adminReports' => $adminReports]);
    }
}
