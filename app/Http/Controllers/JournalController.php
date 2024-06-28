<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\Entry;
use App\Models\Compte;

class JournalController extends Controller
{
    /**
     * Display a listing of the journals.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journals = Journal::all();
        return view('comptable.journals.index', compact('journals'));
    }

    /**
     * Store a newly created journal entry in both journals and entries tables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Date' => 'required|date',
            'Numero_de_Compte' => 'required|string',
            'Libelle' => 'required|string',
            'Montant_Debit' => 'nullable|numeric',
            'Montant_Credit' => 'nullable|numeric',
            'Code_Journal' => 'required|string',
        ]);

        // Check if the account exists in 'comptes' table
        $compte = Compte::where('numero_compte', $validatedData['Numero_de_Compte'])->first();

        if (!$compte) {
            return response()->json(['error' => 'Account not found in comptes list.'], 404);
        }

        // Create a new journal entry
        $journal = Journal::create($validatedData);

        // Create an entry in 'entries' table
        $entryData = [
            'date' => $validatedData['Date'],
            'account' => $validatedData['Numero_de_Compte'],
            'description' => $validatedData['Libelle'],
            'debit' => $validatedData['Montant_Debit'],
            'credit' => $validatedData['Montant_Credit'],
        ];

        Entry::create($entryData);

        return response()->json($journal, 201);
    }
    /**
     * Display the specified journal.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        return response()->json($journal, 200);
    }

    /**
     * Update the specified journal entry in both journals and entries tables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        $validatedData = $request->validate([
            'Date' => 'required|date',
            'Numero_de_Compte' => 'required|string',
            'Libelle' => 'required|string',
            'Montant_Debit' => 'nullable|numeric',
            'Montant_Credit' => 'nullable|numeric',
            'Code_Journal' => 'required|string',
        ]);

        // Check if the new account number exists in 'comptes' table
        $compte = Compte::where('numero_compte', $validatedData['Numero_de_Compte'])->first();

        if (!$compte) {
            return response()->json(['error' => 'New account not found in comptes list.'], 404);
        }

        // Update the journal entry
        $journal->update($validatedData);

        // Update the associated entry in 'entries' table (assuming you have a method for this)

        return response()->json($journal, 200);
    }

    /**
     * Remove the specified journal entry from both journals and entries tables.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        // Check if the account associated with the journal exists in 'comptes' table
        $compte = Compte::where('numero_compte', $journal->Numero_de_Compte)->first();

        if (!$compte) {
            return response()->json(['error' => 'Account associated with the journal not found in comptes list.'], 404);
        }

        // Delete the entry from 'entries' table associated with the journal
        $entry = Entry::where('account', $journal->Numero_de_Compte)
            ->where('description', $journal->Libelle)
            ->where('debit', $journal->Montant_Debit)
            ->where('credit', $journal->Montant_Credit)
            ->where('date', $journal->Date)
            ->first();

        if ($entry) {
            $entry->delete();
        }

        // Delete the journal entry
        $journal->delete();

        return response()->json(null, 204);
    }
}
