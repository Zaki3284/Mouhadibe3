<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'type', 'classe', 'numero_compte',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class, 'account', 'numero_compte');
    }
}
