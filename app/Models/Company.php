<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mouhasibe_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id',
        'comptable_user_id',
        'company_name',
        'company_address',
    ];

    /**
     * Define the relationship with the admin user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    /**
     * Define the relationship with the comptable user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comptable()
    {
        return $this->belongsTo(User::class, 'comptable_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }
}
