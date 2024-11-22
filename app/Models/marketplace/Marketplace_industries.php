<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_industries extends Model
{
    use HasFactory;
    protected $table = 'marketplace_industries';
    protected $fillable = ['name'];
}
