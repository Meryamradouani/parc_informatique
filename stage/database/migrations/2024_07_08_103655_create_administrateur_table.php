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
        Schema::create('administrateur', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('utilisateur', 50);
            $table->text('email');
            $table->text('password');
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrateur');
    }
};
