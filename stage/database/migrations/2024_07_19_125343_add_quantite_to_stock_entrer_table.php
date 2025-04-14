<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantiteToStockEntrerTable extends Migration
{
    public function up()
    {
        Schema::table('stock_entrer', function (Blueprint $table) {
            $table->integer('quantite')->after('recepteur')->nullable(); // Ajout de la colonne quantite après recepteur
        });
    }

    public function down()
    {
        Schema::table('stock_entrer', function (Blueprint $table) {
            $table->dropColumn('quantite'); // Suppression de la colonne quantite lors du rollback
        });
    }
}
