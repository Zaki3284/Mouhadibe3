<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('operations')->get();
        return view('Comptable.grand-livre.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Account::create($request->all());
        return redirect()->route('accounts.index');
    }

    public function update(Request $request, Account $account)
    {
        $request->validate(['name' => 'required']);
        $account->update($request->all());
        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index');
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }
}
