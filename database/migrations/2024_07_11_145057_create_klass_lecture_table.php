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
        Schema::create('klass_lecture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klass_id')->index()->constrained('klasses')->onDelete('cascade');
            $table->foreignId('lecture_id')->index()->constrained('lectures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klass_lecture');
    }
};
