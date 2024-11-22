<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasTable('marketplace_skills')) {
            Schema::create('marketplace_skills', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('industry_id');
                $table->string('name');
                $table->timestamps();
                $table->foreign('industry_id')->references('id')->on('marketplace_industries')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplace_skills');
    }
};
