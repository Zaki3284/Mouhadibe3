<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Operation;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('operations')->get();
        return view('comptable.grand-livre.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $comptable_user_id = auth()->id(); // Get logged-in user's ID
            $account = Account::create([
                'name' => $request->name,
                'comptable_user_id' => $comptable_user_id,
                'updated_at' => now(),
                'created_at' => now(),
            ]);

            return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create account: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create account. Please try again.']);
        }
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $account->update($request->all());
            return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update account: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to update account. Please try again.']);
        }
    }

    public function destroy(Account $account)
    {
        try {
            $account->delete();
            return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete account: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete account. Please try again.']);
        }
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }
}
