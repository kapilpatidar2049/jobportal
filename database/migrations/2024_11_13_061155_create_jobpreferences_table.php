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
        Schema::create('jobpreferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('job_portal_users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('job_type')->nullable();
            $table->string('days')->nullable();
            $table->string('shifts')->nullable();
            $table->string('minimum_pay')->nullable();
            $table->string('pay_periods')->nullable();
            $table->boolean('willing_to_relocate')->default(1);
            $table->string('relocate')->nullable();
            $table->string('locations')->nullable();
            $table->string('remote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobpreferences');
    }
};
