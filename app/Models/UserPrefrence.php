<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrefrence extends Model
{
    use HasFactory;
    protected $table = 'jobpreferences';
    protected $fillable = [
        'user_id',
        'title',
        'job_type',
        'days',
        'shifts',
        'minimum_pay',
        'pay_periods',
        'willing_to_relocate',
        'relocate',
        'locations',
        'remote',
    ];
}
