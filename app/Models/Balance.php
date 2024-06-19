<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $primaryKey = 'balance_id';

    protected $fillable = [
        'comptable_user_id',
        'account_name',
        'balance_amount',
    ];

    public function comptable()
    {
        return $this->belongsTo(User::class, 'comptable_user_id');
    }

    // Define other relationships and methods as needed
}
