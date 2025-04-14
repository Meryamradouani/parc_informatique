<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('stock_sortie'); // Remplacez 'table1' par le nom de votre première table
        Schema::dropIfExists('stock_entree'); // Remplacez 'table2' par le nom de votre deuxième table
    }

    public function down()
    {
        // Ajoutez ici le code pour recréer les tables si nécessaire
    }
}
