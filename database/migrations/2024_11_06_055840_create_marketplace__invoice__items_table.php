<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marketplace_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_description')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('igst')->nullable();
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('marketplace__invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplace_invoice_items');
    }
};
