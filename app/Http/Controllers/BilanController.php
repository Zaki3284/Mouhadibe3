<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilan;
use Illuminate\Support\Facades\DB;

class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch necessary data with account name (nom) instead of account number (numero_compte)
        $bilans = DB::table('bilans')
            ->select('comptes.nom as nom', 'bilans.amount', 'bilans.type')
            ->join('comptes', 'bilans.account', '=', 'comptes.numero_compte')
            ->get();

        // Calculate total_actif and total_passif
        $total_actif = Bilan::where('type', 'Actif')->sum('amount');
        $total_passif = Bilan::where('type', 'Passif')->sum('amount');

        return view('comptable.bilan.index', [
            'bilans' => $bilans,
            'total_actif' => $total_actif,
            'total_passif' => $total_passif,
        ]);
    }
}
