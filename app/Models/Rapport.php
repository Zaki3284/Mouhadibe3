<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $table = 'rapport';

    protected $fillable = [
        'admin_user_id',
        'comptable_user_id',
        'report_details',
        'timestamp'
    ];

    public function comments()
    {
        return $this->hasMany(RapportComment::class); // Assuming 'RapportComment' is your model name
    }
}
