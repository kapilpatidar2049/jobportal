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
        Schema::create('build_resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('job_portal_users')->onDelete('cascade');
            $table->string('image');
            $table->string('name');
            $table->string('contry_code');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->text('achievements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('build_resumes');
    }
};
