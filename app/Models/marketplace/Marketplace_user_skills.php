<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Marketplace_user_skills extends Model
{
    use HasFactory;
    protected $table = 'marketplace_user_skills';
    protected $fillable = ['user_id','name'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
}
