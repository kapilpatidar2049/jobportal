<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MarketplaceChat extends Model
{
    use HasFactory;
    
    // Correct the table name typo
    protected $table = 'marketplace_chats';
    
    // Fillable attributes
    protected $fillable = ['user_id', 'client_id'];

    // Relationship with messages
    public function messages() {
        return $this->hasMany(MarketplaceMessage::class, 'chat_id');
    }
    
    // Relationship with client (User)
    public function client() {
        return $this->belongsTo(User::class, 'client_id')->withDefault(); // Corrected
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withDefault(); // Corrected
    }
}
