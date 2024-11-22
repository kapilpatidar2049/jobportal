<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_project extends Model
{
    use HasFactory;
    protected $table = 'marketplace_projects';
    protected $fillable = ['name','description','budget','bids','currency','project_rate','project_type','skills','time','bookmark','remote_project','min_rate','max_rate','listing_type','country','industry','city','user_id','assigned_user_id'];

    public function skills()
    {
        return $this->hasMany(Marketplace_project_skills::class, 'project_id', 'id');
    }

    public function bids()
    {
        return $this->hasMany(Marketplace_bids::class, 'project_id', 'id');
    }

}