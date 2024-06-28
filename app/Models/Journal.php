<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'Date', 'Numero_de_Compte', 'Libelle', 'Montant_Debit', 'Montant_Credit', 'Code_Journal'
    ];
}
