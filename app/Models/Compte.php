<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'classe',
        'numero_compte',
    ];

    // Define any relationships if applicable
}
