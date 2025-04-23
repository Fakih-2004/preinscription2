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
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id();
            $table->string('type_diplome_bac+2');
            $table->date('anne_bac+2');
            $table->string('filiere_bac+2');
            $table->string('scan_bac+2');
            $table->string('etalissement_bac+2');
            $table->string('type_bac+3');
            $table->date('annee_bac+3');
            $table->string('filiere_bac+3');
            $table->string('etablissement_bac+3');
            $table->string('scan_bac+3');
            $table->unsignedBigInteger('candidat_id');
            $table->foreign('candidat_id')->references('id')->on('candidats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diplomes');
    }
};
