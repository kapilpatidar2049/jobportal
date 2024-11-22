<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_bookmarks extends Model
{
    use HasFactory;
    protected $table = 'marketplace_bookmarks';
    protected $fillable = ['project_id','user_id'];

}
