<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id', 'message','seen','seen_at'];

    public function sender()
    {
        return $this->belongsTo(JobPortalUser::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(JobPortalUser::class, 'receiver_id');
    }

}
