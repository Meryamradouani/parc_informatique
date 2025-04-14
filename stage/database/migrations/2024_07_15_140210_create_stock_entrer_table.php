<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_entrer', function (Blueprint $table) {
            $table->id('entry_id');
            $table->string('entry_numero', 11);
            $table->date('date');
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('code_article');
            $table->unsignedBigInteger('recepteur');
            $table->unsignedBigInteger('emetteur');
            $table->timestamps();

            $table->foreign('code_article')->references('code_article')->on('article')->onDelete('cascade');
            $table->foreign('recepteur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');
            $table->foreign('emetteur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_entrer');
    }
};
