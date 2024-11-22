<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplacePortfolioImages extends Model
{
    use HasFactory;
    protected $table = 'marketplace_portfolio_images';
    protected $fillable = ['image','portfolio_id'];
}
