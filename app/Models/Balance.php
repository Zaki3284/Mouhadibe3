<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'account',
        'description',
        'movement_debit',
        'movement_credit',
        'balance_debit',
        'balance_credit',
        'code_journal',
        'date'
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'account', 'numero_compte');
    }
}
