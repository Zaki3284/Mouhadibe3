<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapport;

class RapportController extends Controller
{
    public function index()
    {
        // Fetch all rapports

        return view('comptable.Rapport');
    }
}
