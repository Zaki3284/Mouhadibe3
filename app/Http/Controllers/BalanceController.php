<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;
use Carbon\Carbon;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        try {
            $date = Carbon::createFromFormat('Y-m', $month);
        } catch (\Exception $e) {
            return redirect()->route('balances.index')->withErrors('Invalid month format. Please use YYYY-MM.');
        }

        $balances = Balance::whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->get()
            ->groupBy('code_journal');

        return view('comptable.balance.index', compact('balances', 'month'));
    }
}
