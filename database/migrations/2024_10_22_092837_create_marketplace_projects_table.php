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
        Schema::create('marketplace_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->decimal('budget', 10, 2)->nullable(); 
            $table->integer('bids')->default(0);
            $table->string('currency'); 
            $table->string('project_rate'); 
            $table->string('project_type'); 
            $table->timestamp('time')->nullable(); 
            $table->boolean('bookmark')->default(false); 
            $table->boolean('remote_project')->default(false); 
            $table->decimal('min_rate', 10, 2)->nullable(); 
            $table->decimal('max_rate', 10, 2)->nullable();
            $table->string('listing_type')->nullable(); 
            $table->string('country')->nullable(); 
            $table->string('city')->nullable(); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplace_projects');
    }
};
