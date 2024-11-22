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
        Schema::create('invoicesetting', function (Blueprint $table) {
            $table->id();
            $table->boolean('logo')->default(true);
            $table->boolean('date')->default(true);
            $table->boolean('selleraddress')->default(true);
            $table->boolean('buyeraddress')->default(true);
            $table->boolean('download')->default(true);
            $table->boolean('terms')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicesetting');
    }
};
