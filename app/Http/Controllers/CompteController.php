<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompteController extends Controller
{
    /**
     * Display a listing of the comptes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comptes = Compte::all();
        return view('admin.comptes.index', compact('comptes'));
    }

    /**
     * Store a newly created compte in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => [
                'required',
                'string',
                'max:255',
                Rule::in(['Actif', 'Passif', 'Capitaux propres', 'Revenu', 'Dépense']), // Validate only specific values
            ],
            'classe' => [
                'required',
                'string',
                'max:255',
                Rule::in([
                    'Classe 1 : Comptes de Capitaux',
                    'Classe 2 : Comptes d\'Immobilisations',
                    'Classe 3 : Comptes de Stocks et en-cours',
                    'Classe 4 : Comptes de Tiers',
                    'Classe 5 : Comptes financiers',
                    'Classe 6 : Comptes de charges',
                    'Classe 7 : Comptes de produits',
                ]), // Validate only specific values
            ],
            'numero_compte' => 'required|string|max:255|unique:comptes',
        ]);

        $compte = Compte::create($request->all());

        return response()->json(['compte' => $compte, 'message' => 'Compte created successfully']);
    }

    /**
     * Show the form for editing the specified compte.
     *
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Compte $compte)
    {
        return response()->json(['compte' => $compte]);
    }

    /**
     * Update the specified compte in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $compte = Compte::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => [
                'required',
                'string',
                'max:255',
                Rule::in(['Actif', 'Passif', 'Capitaux propres', 'Revenu', 'Dépense']), // Validate only specific values
            ],
            'classe' => [
                'required',
                'string',
                'max:255',
                Rule::in([
                    'Classe 1 : Comptes de Capitaux',
                    'Classe 2 : Comptes d\'Immobilisations',
                    'Classe 3 : Comptes de Stocks et en-cours',
                    'Classe 4 : Comptes de Tiers',
                    'Classe 5 : Comptes financiers',
                    'Classe 6 : Comptes de charges',
                    'Classe 7 : Comptes de produits',
                ]), // Validate only specific values
            ],
            'numero_compte' => [
                'required',
                'string',
                'max:255',
                Rule::unique('comptes')->ignore($compte->id),
            ],
        ]);

        $compte->update($request->all());

        return response()->json(['compte' => $compte, 'message' => 'Compte updated successfully']);
    }


    /**
     * Remove the specified compte from storage.
     *
     * @param  \App\Models\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compte = Compte::findOrFail($id);
        $compte->delete();

        return response()->json(['message' => 'Compte deleted successfully']);
    }
}
