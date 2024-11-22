<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_account extends Model
{
    use HasFactory;
    protected $table = 'bank_accounts';
    protected $fillable = ['account_holder_name','currency','account_number','bank_name','ifsc_code','routing_number','swift_code','status','user_id'];
}
