<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplacePortfolio extends Model
{
    use HasFactory;
    protected $table = 'marketplace_portfolios';
    protected $fillable = [
        'user_id', 'category', 'title', 'description', 'project_date', 'port_img', 'project_link'
    ];
}
