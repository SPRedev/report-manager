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
        Schema::create('predoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('importation_id')->constrained()->onDelete('cascade');
            $table->string('predom_id');
             $table->string('date_predom');
              $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predoms');
    }
};
