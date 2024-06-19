<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComptableController extends Controller
{
    public function dashboard()
    {
        return view('comptable.dashboard');
    }
}
