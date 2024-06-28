<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = Compte::all();
        return view('admin.comptes.index', compact('comptes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'type' => 'required|string',
            'classe' => 'required|string',
            'numero_compte' => 'required|string|unique:comptes,numero_compte',
        ]);

        $compte = Compte::create([
            'nom' => $request->nom,
            'type' => $request->type,
            'classe' => $request->classe,
            'numero_compte' => $request->numero_compte,
        ]);

        return response()->json($compte);
    }

    public function show(Compte $compte)
    {
        return response()->json($compte);
    }

    public function update(Request $request, Compte $compte)
    {
        $request->validate([
            'nom' => 'required|string',
            'type' => 'required|string',
            'classe' => 'required|string',
            'numero_compte' => 'required|string|unique:comptes,numero_compte,' . $compte->id,
        ]);

        $compte->update([
            'nom' => $request->nom,
            'type' => $request->type,
            'classe' => $request->classe,
            'numero_compte' => $request->numero_compte,
        ]);

        return response()->json($compte);
    }


    public function destroy(Compte $compte)
    {
        $compte->delete();

        return response()->json(['message' => 'Compte supprimé avec succès.']);
    }
}
