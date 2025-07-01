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
        Schema::create('orderimportations', function (Blueprint $table) {
            $table->id();
            $table->string('id_ord');
            $table->foreignId('id_fourniseur')->constrained('fourniseurs')->onDelete('cascade');
            $table->date('date_offre')->nullable();
            $table->string('offre')->nullable();
            $table->date('date_contre_offre')->nullable();
            $table->string('contre_offre')->nullable();
            $table->date('date_confirmation')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('status')->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderimportations');
    }
};
