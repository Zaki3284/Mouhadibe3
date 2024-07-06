<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\Entry;
use App\Models\Balance;
use App\Models\Compte;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
     * Store a newly created journal entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Date' => 'required|date',
            'Numero_de_Compte' => 'required|string|exists:comptes,numero_compte',
            'Libelle' => 'required|string',
            'Montant_Debit' => 'nullable|numeric',
            'Montant_Credit' => 'nullable|numeric',
            'Code_Journal' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
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

            // Update or create balance entry
            $balance = Balance::firstOrNew([
                'account' => $validatedData['Numero_de_Compte'],
                'code_journal' => $validatedData['Code_Journal'],
                'date' => $validatedData['Date'],
            ]);

            $balance->movement_debit += $validatedData['Montant_Debit'] ?? 0;
            $balance->movement_credit += $validatedData['Montant_Credit'] ?? 0;
            $balance->balance_debit += $validatedData['Montant_Debit'] ?? 0;
            $balance->balance_credit += $validatedData['Montant_Credit'] ?? 0;
            $balance->save();

            DB::commit();

            return response()->json($journal, 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error storing journal entry: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store journal entry.'], 500);
        }
    }

    /**
     * Display the specified journal entry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $journal = Journal::findOrFail($id); // Assuming Journal is your model name
        return response()->json($journal);
    }
    /**
     * Update the specified journal entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Date' => 'required|date',
            'Numero_de_Compte' => 'required|string|exists:comptes,numero_compte',
            'Libelle' => 'required|string',
            'Montant_Debit' => 'nullable|numeric',
            'Montant_Credit' => 'nullable|numeric',
            'Code_Journal' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $journal = Journal::findOrFail($id);

            // Get the original values
            $oldDebit = $journal->Montant_Debit ?? 0;
            $oldCredit = $journal->Montant_Credit ?? 0;

            // Update the journal entry
            $journal->update($validatedData);

            // Find and update the associated entry in 'entries' table
            $entry = Entry::where('account', $journal->Numero_de_Compte)
                ->where('description', $journal->Libelle)
                ->where('date', $journal->Date)
                ->first();

            if ($entry) {
                $entry->update([
                    'date' => $validatedData['Date'],
                    'account' => $validatedData['Numero_de_Compte'],
                    'description' => $validatedData['Libelle'],
                    'debit' => $validatedData['Montant_Debit'],
                    'credit' => $validatedData['Montant_Credit'],
                ]);
            }

            // Update balance entry
            $balance = Balance::where('account', $journal->Numero_de_Compte)
                ->where('code_journal', $journal->Code_Journal)
                ->where('date', $journal->Date)
                ->first();

            if ($balance) {
                $balance->movement_debit += ($validatedData['Montant_Debit'] ?? 0) - $oldDebit;
                $balance->movement_credit += ($validatedData['Montant_Credit'] ?? 0) - $oldCredit;
                $balance->balance_debit += ($validatedData['Montant_Debit'] ?? 0) - $oldDebit;
                $balance->balance_credit += ($validatedData['Montant_Credit'] ?? 0) - $oldCredit;
                $balance->save();
            }

            DB::commit();

            return response()->json($journal, 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating journal entry: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update journal entry.'], 500);
        }
    }

    /**
     * Remove the specified journal entry.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        // Begin transaction
        DB::beginTransaction();

        try {
            // Find the associated entry in 'entries' table
            $entry = Entry::where('account', $journal->Numero_de_Compte)
                ->where('description', $journal->Libelle)
                ->where('date', $journal->Date)
                ->first();

            if ($entry) {
                $entry->delete();
            }

            // Update or delete the associated balance entry
            $balance = Balance::where('account', $journal->Numero_de_Compte)
                ->where('code_journal', $journal->Code_Journal)
                ->where('date', $journal->Date)
                ->first();

            if ($balance) {
                $balance->movement_debit -= $journal->Montant_Debit ?? 0;
                $balance->movement_credit -= $journal->Montant_Credit ?? 0;
                $balance->balance_debit -= $journal->Montant_Debit ?? 0;
                $balance->balance_credit -= $journal->Montant_Credit ?? 0;

                // If the balance becomes zero, delete the balance entry
                if ($balance->movement_debit == 0 && $balance->movement_credit == 0) {
                    $balance->delete();
                } else {
                    $balance->save();
                }
            }

            // Delete the journal entry
            $journal->delete();

            // Commit transaction
            DB::commit();

            return response()->json(['message' => 'Journal entry deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();
            Log::error('Error deleting journal entry: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete journal entry.'], 500);
        }
    }
}
