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
        if (!Schema::hasTable('jobportaljobs')) {
            Schema::create('jobportaljobs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('job_portal_users')->onDelete('cascade');
                $table->string('language')->nullable();
                $table->string('country')->nullable();
                $table->string('title')->nullable();
                $table->string('type')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('area')->nullable();
                $table->string('address')->nullable();
                $table->string('pincode')->nullable();
                $table->string('adscity')->nullable();
                $table->json('job_type')->nullable();
                $table->integer('timelength')->nullable();
                $table->string('timeperiod')->nullable();
                $table->string('showby')->nullable();
                $table->json('schedule')->nullable();
                $table->string('startdate')->default('no')->nullable();
                $table->date('startdatefield')->nullable();
                $table->string('numberofpeople')->nullable();
                $table->string('recruitment_timeline')->nullable();
                $table->string('pay')->nullable();
                $table->decimal('exactamount', 10, 2)->nullable();
                $table->decimal('minimumamount', 10, 2)->nullable();
                $table->decimal('maximumamount', 10, 2)->nullable();
                $table->string('rate')->nullable();
                $table->json('supplement')->nullable();
                $table->json('benefit')->nullable();
                $table->text('job_description')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
