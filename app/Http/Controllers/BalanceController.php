<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = Balance::all();
        return view('comptable.balance.index', compact('balances'));
    }

    public function create()
    {
        return view('comptable.balance.create');
    }

    public function store(Request $request)
    {
        // Validate and store new Balance entry
    }

    public function show($id)
    {
        $balance = Balance::findOrFail($id);
        return view('comptable.balance.show', compact('balance'));
    }

    public function edit($id)
    {
        $balance = Balance::findOrFail($id);
        return view('comptable.balance.edit', compact('balance'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update Balance entry
    }

    public function destroy($id)
    {
        // Delete Balance entry
    }
}
