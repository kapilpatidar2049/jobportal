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
        Schema::create('job_sponsers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->unique();
            $table->foreign('job_id')->references('id')->on('jobportaljobs')->onDelete('cascade');
            $table->string('duration');
            $table->date('customdate')->nullable();
            $table->string('currency');
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('budget_type')->default('daily');
            $table->boolean('addlabel')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_sponsers');
    }
};
