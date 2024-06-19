<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = ['account_id', 'date', 'description', 'debit', 'credit'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
