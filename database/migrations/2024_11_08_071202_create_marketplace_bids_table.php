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
        Schema::create('marketplace_bids', function (Blueprint $table) {
            $table->id();
            $table->decimal('bid_amount', 10, 2);
            $table->string('currency'); 
            $table->integer('delivery_days');
            $table->text('proposal');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('project_id')->references('id')->on('marketplace_projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplace_bids');
    }
};
