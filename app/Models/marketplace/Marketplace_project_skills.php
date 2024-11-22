<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_project_skills extends Model
{
    use HasFactory;
    protected $table = 'marketplace_project_skills';
    protected $fillable = ['name','project_id'];

    public function project()
    {
        return $this->belongsTo(Marketplace_project::class, 'project_id', 'id')->withDefault();
    }
}
