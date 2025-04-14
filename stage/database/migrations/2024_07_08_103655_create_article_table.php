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
        Schema::create('article', function (Blueprint $table) {
            $table->id('code_article')->primary();
            $table->string('numeroserie', 50);
            $table->string('marque', 50);
            $table->string('model', 50);
            $table->string('libelle', 50);
            $table->string('description', 100)->nullable();
            $table->string('accessoires', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
