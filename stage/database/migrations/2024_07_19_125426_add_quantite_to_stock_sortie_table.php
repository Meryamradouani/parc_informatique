<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantiteToStockSortieTable extends Migration
{
    public function up()
    {
        Schema::table('stock_sortie', function (Blueprint $table) {
            $table->integer('quantite')->after('emetteur')->nullable(); // Ajout de la colonne quantite après emetteur
        });
    }

    public function down()
    {
        Schema::table('stock_sortie', function (Blueprint $table) {
            $table->dropColumn('quantite'); // Suppression de la colonne quantite lors du rollback
        });
    }
}
