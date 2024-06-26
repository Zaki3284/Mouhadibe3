<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::all();
        return view('comptable.journals.index', compact('journals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'debit_account' => 'required',
            'credit_account' => 'required',
            'emplois' => 'required',
            'montant_debit' => 'required|numeric',
            'montant_credit' => 'required|numeric',
            'journal_code' => 'required',
        ]);

        $journal = Journal::create($validated);

        return response()->json(['message' => 'Journal entry created successfully', 'journal' => $journal]);
    }

    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'date' => 'required',
            'debit_account' => 'required',
            'credit_account' => 'required',
            'emplois' => 'required',
            'montant_debit' => 'required|numeric',
            'montant_credit' => 'required|numeric',
            'journal_code' => 'required',
        ]);

        $journal->update($validated);

        return response()->json(['message' => 'Journal entry updated successfully', 'journal' => $journal]);
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();

        return response()->json(['message' => 'Journal entry deleted successfully']);
    }
}
