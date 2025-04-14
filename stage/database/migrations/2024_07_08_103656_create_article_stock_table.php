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
        Schema::create('article_stock', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->unsignedBigInteger('code_article');
            $table->timestamps();
            $table->foreign('code_article')->references('code_article')->on('article')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_stock');
    }
};
