<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurTable extends Migration
{
    public function up()
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('id_utilisateur'); // Identifiant unique
            $table->string('nom', 50); // Nom de l'utilisateur
            $table->string('prenom', 50); // Prénom de l'utilisateur
            $table->string('tel')->nullable()->default(null);
            $table->string('email')->unique(); // Email unique
            $table->string('password'); // Mot de passe
            $table->string('fonctionalite')->nullable(); // Champ pour la fonctionnalité
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateur');
    }
}
