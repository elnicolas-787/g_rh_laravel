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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id');
            $table->foreign('employees_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            $table->string('num_contrat');
            $table->string('type_contrat');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->double('salaire');
            $table->integer('jour_sem');
            $table->integer('heure_sem');
            $table->string('horaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
