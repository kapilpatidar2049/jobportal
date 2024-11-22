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
        if (!Schema::hasTable('job_preferences')) {
            Schema::create('job_preferences', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('job_id');
                $table->foreign('job_id')->references('id')->on('jobportaljobs')->onDelete('cascade');
                $table->json('email');
                $table->boolean('sendmail')->default(true);
                $table->boolean('contactmail')->default(true);
                $table->string('requirecv');
                $table->string('deadline')->default(true);
                $table->date('deadlinetime')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_preferences');
    }
};
