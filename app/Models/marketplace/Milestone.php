<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $table = 'milestones';
    protected $fillable = [
        'user_id', 'project_id', 'title', 'description', 'due_date', 'status',
    ];

    public function project()
    {
        return $this->belongsTo(Marketplace_project::class)->withDefault();  // Assuming you have a Project model
    }
}
