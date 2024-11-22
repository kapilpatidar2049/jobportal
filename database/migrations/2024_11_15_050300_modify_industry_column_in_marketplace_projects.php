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
        Schema::table('marketplace_projects', function (Blueprint $table) {
            $table->unsignedBigInteger('industry')->nullable(); // Add new industry_id column
            $table->foreign('industry')->references('id')->on('marketplace_industries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketplace_projects', function (Blueprint $table) {
            $table->dropForeign(['industry']); // Drop the foreign key
            $table->dropColumn('industry'); // Drop the industry_id column
        });
    }
};
