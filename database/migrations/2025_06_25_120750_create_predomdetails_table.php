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
        Schema::create('predomdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('predom_id')->constrained()->onDelete('cascade');
            $table->string('predomdetail_id');
            $table->string('rc_nif');
            $table->string('rc_nif_statust');
            $table->string('decision');
            $table->string('decision_statust');
            $table->string('tax');
            $table->string('tax_statust');
            $table->string('certificate');
            $table->string('certificate_statust');
            $table->string('facture');
            $table->string('facture_statust');
            $table->string('engagement');
            $table->string('engagement_statust');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predomdetails');
    }
};
