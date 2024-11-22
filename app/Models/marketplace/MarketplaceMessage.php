<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MarketplaceMessage extends Model
{
    use HasFactory;
    
    // Correct the table name typo
    protected $table = 'marketplace_messages';
    
    // Fillable attributes
    protected $fillable = ['chat_id', 'sender_id','receiver_id','attachment','message', 'is_read'];
    
    // Relationship with the chat
    public function chat() {
        return $this->belongsTo(MarketplaceChat::class, 'chat_id')->withDefault();
    }

    // Relationship with the sender (User)
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id')->withDefault(); // Corrected
    }
}
