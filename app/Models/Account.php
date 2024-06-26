<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comptable_user_id'];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
