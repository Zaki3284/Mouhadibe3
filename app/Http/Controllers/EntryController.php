<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        try {
            $date = Carbon::createFromFormat('Y-m', $month);
        } catch (\Exception $e) {
            return redirect()->route('entry.index')->withErrors('Invalid month format. Please use YYYY-MM.');
        }

        $entries = Entry::with('compte')
            ->whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->get()
            ->groupBy('account');

        return view('comptable.grand-livre.index', compact('entries', 'month'));
    }
}
