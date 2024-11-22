<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_skills extends Model
{
    use HasFactory;
    protected $table = 'marketplace_skills';
    protected $fillable = ['name', 'industry_id'];
}
