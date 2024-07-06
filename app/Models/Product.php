<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'fournisseur_user_id',
        'product_name',
        'product_type',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(User::class, 'fournisseur_user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
