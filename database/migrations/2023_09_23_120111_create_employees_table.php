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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('immatriculation');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('email');
            $table->date('date_naiss');
            $table->string('lieu_naiss');
            $table->string('cin');
            $table->string('sexe');
            $table->string('situation_f');
            $table->string('telephone');
            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
            $table->unsignedBigInteger('professions_id');
            $table->foreign('professions_id')
                ->references('id')
                ->on('professions')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
