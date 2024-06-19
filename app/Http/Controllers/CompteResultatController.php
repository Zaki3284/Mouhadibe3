<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompteDeResultat;

class CompteResultatController extends Controller
{
    public function index()
    {
        $compteDeResultats = CompteDeResultat::all();
        return view('comptable.compte-resultat.index', compact('compteDeResultats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'charge' => 'required|string|max:255',
            'montant_charge' => 'nullable|numeric',
            'produit' => 'required|string|max:255',
            'montant_produit' => 'nullable|numeric',
        ]);

        CompteDeResultat::create($request->all());

        return redirect()->route('compte-resultat.index')->with('success', 'Compte de résultat added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'charge' => 'required|string|max:255',
            'montant_charge' => 'nullable|numeric',
            'produit' => 'required|string|max:255',
            'montant_produit' => 'nullable|numeric',
        ]);

        $resultat = CompteDeResultat::findOrFail($id);
        $resultat->update($request->all());

        return redirect()->route('compte-resultat.index')->with('success', 'Compte de résultat updated successfully.');
    }

    public function destroy($id)
    {
        $resultat = CompteDeResultat::findOrFail($id);
        $resultat->delete();

        return redirect()->route('compte-resultat.index')->with('success', 'Compte de résultat deleted successfully.');
    }
}
