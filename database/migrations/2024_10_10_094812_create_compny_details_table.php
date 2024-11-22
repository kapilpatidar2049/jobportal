<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('compny_details')) {
            Schema::create('compny_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('job_portal_users')->onDelete('cascade');
                $table->string('name')->nullable();
                $table->string('company_name');
                $table->string('website')->nullable();
                $table->string('employees')->nullable();
                $table->string('heared_about_us')->nullable();
                $table->string('phone')->nullable();
                $table->string('country')->nullable();
                $table->string('language')->nullable();
                $table->string('industry')->nullable();
                $table->string('sub_industry')->nullable();
                $table->text('description')->nullable();
                $table->string('gst_number')->nullable();
                $table->year('foundedin')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compny_details');
    }
};
