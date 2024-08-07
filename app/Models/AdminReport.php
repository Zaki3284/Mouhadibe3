<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'comments',
        'read_by_admin',
    ];
}
