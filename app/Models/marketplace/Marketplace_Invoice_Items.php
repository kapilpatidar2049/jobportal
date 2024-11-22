<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_Invoice_Items extends Model
{
    use HasFactory;
    protected $table = 'marketplace_invoice_items';
    protected $fillable = ['item_description','amount','qty','rate','igst','invoice_id'];
}
