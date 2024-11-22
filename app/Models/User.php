<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\marketplace\Marketplace_user_skills;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'platform',
        'image',
        'company_name',
        'company_logo',
        'company_description', // Corrected
        'project',
        'remote_project', // Make sure to correct the field name here as well
        'gst_number',
        'city',
        'country',
        'skill',
        'experience',
        'area',
        'pin_code',
        'street_address',
        'user_name',
        'is_online',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userSkills()
    {
        return $this->hasMany(Marketplace_user_skills::class, 'user_id', 'id');
    }
}
