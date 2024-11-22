<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_bids extends Model
{
    use HasFactory;
    protected $table = 'marketplace_bids';
    protected $fillable = ['bid_amount','currency','delivery_days','proposal','project_id','user_id'];

    public function project()
    {
        return $this->belongsTo(Marketplace_project::class, 'project_id', 'id')->withDefault();
    }
}