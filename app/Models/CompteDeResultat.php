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
        'comptable_user_id',
    ];

    // Add any additional methods or relationships here
}
