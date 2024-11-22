<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('marketplace__invoices', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_gst')->nullable();
            $table->integer('balance_due');

            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_gst')->nullable();
            $table->date('invoice_date');
            $table->string('terms');
            $table->date('due_date');
            $table->string('place_supply')->nullable();
            $table->string('subject')->nullable();
            $table->string('link')->nullable();


            $table->string('bank_name');
            $table->string('account_name');
            $table->bigInteger('account_number');
            $table->string('ifsc_code');
            $table->string('branch');
            $table->string('terms_conditions');

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('marketplace__invoices');
    }
};
