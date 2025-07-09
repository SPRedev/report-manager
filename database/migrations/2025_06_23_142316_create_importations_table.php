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
        Schema::create('importations', function (Blueprint $table) {
            $table->id();
                $table->string('importation_id')->nullable();
                $table->string('fourniseur_name');
                $table->foreignId('id_ord');
                $table->string('importation_date')->nullable();
                $table->string('montant_algex')->nullable();
                $table->string('montant_definitive')->nullable();
                $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importations');
    }
};
