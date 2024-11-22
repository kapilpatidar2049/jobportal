<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('bank_name');
            $table->string('ifsc_code')->nullable(); 
            $table->string('routing_number')->nullable(); 
            $table->string('swift_code')->nullable(); 
            $table->string('currency')->default('USD'); 
            $table->string('status')->default('pending'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
   
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
