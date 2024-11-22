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
        if (!Schema::hasTable('job_skills')) {
            Schema::create('job_skills', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('job_id');
                $table->foreign('job_id')->references('id')->on('jobportaljobs')->onDelete('cascade');
                $table->string('skill');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};
