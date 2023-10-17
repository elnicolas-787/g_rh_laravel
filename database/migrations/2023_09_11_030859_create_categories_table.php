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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code_cat');
            $table->string('classe_cat');
            $table->timestamps();
        });

        Schema::table('echelons', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Categorie::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::table('echelons', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Categorie::class);
        });
    }
};
