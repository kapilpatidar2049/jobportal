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
        Schema::create('jobportal_prescreen_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobportaljobs')->onDelete('cascade');
            $table->string('type');
            $table->string('education')->nullable();
            $table->string('year')->nullable();
            $table->string('field')->nullable();
            $table->string('language')->nullable();
            $table->string('certificate')->nullable();
            $table->string('location')->nullable();
            $table->string('shift')->nullable();
            $table->string('travel')->nullable();
            $table->string('custom_question')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobportal_prescreen_questions');
    }
};
