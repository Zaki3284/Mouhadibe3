<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_address',
        'company_registration',
        'total_immobilisation',
        'details_immobilisation',
        'total_actif_a_court_terme',
        'details_total_actif_a_court_terme',
        'total_du_capital',
        'details_du_capital',
        'total_du_passif_court_terme',
        'details_du_passif_court_terme',
        'admin_user_id',
    ];
    // Define relationships back to users
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function comptable()
    {
        return $this->belongsTo(User::class, 'comptable_user_id');
    }
}
