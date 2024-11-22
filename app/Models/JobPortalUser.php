<?php

namespace App\Models;

use App\Models\Jobportal\Jobs;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extend from Authenticatable
use Illuminate\Notifications\Notifiable;

class JobPortalUser extends Authenticatable // Extend the Authenticatable class
{
    use Notifiable;

    protected $fillable = [
        'name',
        'image',
        'email',
        'country_code',
        'phone',
        'email_verified_at',
        'role',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'otp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id'); // or 'receiver_id', depending on your design
    }
    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
