<?php

namespace App\Models\marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace_Invoice extends Model
{
    use HasFactory;
    protected $table = 'marketplace__invoices';
    protected $fillable = ['logo','company_name','company_address','company_gst',
    'balance_due','client_name','client_address','client_gst','invoice_date','terms',
    'due_date','place_supply','subject','link',
    'bank_name','account_name','account_number','ifsc_code','branch','terms_conditions'];
}
