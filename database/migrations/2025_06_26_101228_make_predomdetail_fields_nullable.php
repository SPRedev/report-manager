<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('predomdetails', function (Blueprint $table) {
            $table->string('rc_nif')->nullable()->change();
            $table->string('rc_nif_statust')->nullable()->change();
            $table->string('decision')->nullable()->change();
            $table->string('decision_statust')->nullable()->change();
            $table->string('tax')->nullable()->change();
            $table->string('tax_statust')->nullable()->change();
            $table->string('certificate')->nullable()->change();
            $table->string('certificate_statust')->nullable()->change();
            $table->string('facture')->nullable()->change();
            $table->string('facture_statust')->nullable()->change();
            $table->string('engagement')->nullable()->change();
            $table->string('engagement_statust')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('predomdetails', function (Blueprint $table) {
            $table->string('rc_nif')->nullable(false)->change();
            $table->string('rc_nif_statust')->nullable(false)->change();
            $table->string('decision')->nullable(false)->change();
            $table->string('decision_statust')->nullable(false)->change();
            $table->string('tax')->nullable(false)->change();
            $table->string('tax_statust')->nullable(false)->change();
            $table->string('certificate')->nullable(false)->change();
            $table->string('certificate_statust')->nullable(false)->change();
            $table->string('facture')->nullable(false)->change();
            $table->string('facture_statust')->nullable(false)->change();
            $table->string('engagement')->nullable(false)->change();
            $table->string('engagement_statust')->nullable(false)->change();
        });
    }
};
