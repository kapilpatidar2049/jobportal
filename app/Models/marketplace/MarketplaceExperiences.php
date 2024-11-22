<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceExperiences extends Model
{
    use HasFactory;
    protected $table = 'marketplace_experiences';
    protected $fillable = [
        'title',
        'company',
        'country',
        'city',
        'start_month',
        'start_year',
        'workingStatus',
        'end_month',
        'end_year',
        'description',
        'user_id'
    ];
}
