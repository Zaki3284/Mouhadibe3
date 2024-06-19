<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteDeResultat extends Model
{
    protected $fillable = [
        'charge',
        'montant_charge',
        'produit',
        'montant_produit',
    ];

    // Add any additional methods or relationships here
}
