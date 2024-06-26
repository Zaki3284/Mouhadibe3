<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'debit_account', 'credit_account', 'emplois', 'montant_debit', 'montant_credit', 'journal_code'
    ];
}
