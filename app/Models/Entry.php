<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'account', 'description', 'debit', 'credit',
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'account', 'numero_compte');
    }
}
