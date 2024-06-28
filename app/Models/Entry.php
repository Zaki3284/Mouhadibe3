<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'date', 'libelle', 'montant_debit', 'montant_credit', 'compte_id'
    ];


    public function entries()
    {
        return $this->hasMany(Entry::class)->where('date', '>=', now()->subDays(7));
    }



    public function compte()
    {
        return $this->belongsTo(Compte::class, 'compte_id');
    }
}
