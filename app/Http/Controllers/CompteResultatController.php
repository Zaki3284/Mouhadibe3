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

        try {
            $comptable_user_id = auth()->id();
            $requestData = $request->all();
            $requestData['comptable_user_id'] = $comptable_user_id;

            CompteDeResultat::create($requestData);

            return response()->json(['message' => 'Le compte a été ajouté avec succès!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de l\'ajout du compte. Veuillez réessayer.'], 500);
        }
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

        return response()->json(['message' => 'Le compte a été mis à jour avec succès!']);
    }

    public function destroy($id)
    {
        try {
            $resultat = CompteDeResultat::findOrFail($id);
            $resultat->delete();

            return response()->json(['message' => 'Le compte a été supprimé avec succès!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de la suppression du compte. Veuillez réessayer.'], 500);
        }
    }
}
