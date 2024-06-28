<?php

namespace App\Http\Controllers;



use App\Models\Entry;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Entry;


class EntryController extends Controller
{
    public function index()
    {
        $entries = Entry::with('compte')->get()->groupBy('compte_id');
        return view('comptable.grand-livre.index', compact('entries'));
    }
}
