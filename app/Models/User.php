<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username', 'email', 'password', 'phone_number', 'confirmation_token', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Override the notification method for email verification
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    // Define the relationship with the Company model (assuming this relationship exists)
    public function company()
    {
        return $this->hasOne(Company::class, 'admin_user_id');
    }

    // Define the relationship to show comptable information (assuming this relationship exists)
    public function comptableInformation()
    {
        return $this->hasOne(Company::class, 'comptable_user_id');
    }

    // Define the relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
