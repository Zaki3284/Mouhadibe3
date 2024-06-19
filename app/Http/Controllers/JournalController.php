<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::all();
        return view('Comptable.journals.index', compact('journals'));
    }

    public function store(Request $request)
    {
        $journal = Journal::create($request->all());
        return response()->json(['id' => $journal->id], 201);
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);
        $journal->update($request->all());
        return response()->json(['message' => 'Journal updated successfully'], 200);
    }

    public function destroy($id)
    {
        Journal::destroy($id);
        return response()->json(['message' => 'Journal deleted successfully'], 200);
    }
}
