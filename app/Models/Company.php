<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'company_id'; // Assuming 'company_id' is your primary key

    protected $fillable = [
        'admin_user_id',
        'company_name',
        'address',
        'registration_number', // Added for completeness
        'total_immobilisation', // Added based on previous discussions
        'details_immobilisation', // Added based on previous discussions
        'total_actif_a_court_terme', // Added based on previous discussions
        'details_total_actif_a_court_terme', // Added based on previous discussions
        'total_du_capital', // Added based on previous discussions
        'details_du_capital', // Added based on previous discussions
        'total_du_passif_court_terme', // Added based on previous discussions
        'details_du_passif_court_terme', // Added based on previous discussions
    ];

    /**
     * Relationship with the admin user who owns the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    // Additional relationships and methods can be defined here

}
