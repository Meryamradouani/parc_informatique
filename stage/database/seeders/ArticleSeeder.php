<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemple de données à insérer
        $data = [
            [
                'numeroserie' => '123456789',
                'marque' => 'Marque A',
                'model' => 'Modèle 1',
                'libelle' => 'Article 1',
                'description' => 'Description de l\'article 1',
                'accessoires' => 'Accessoire 1, Accessoire 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numeroserie' => '987654321',
                'marque' => 'Marque B',
                'model' => 'Modèle 2',
                'libelle' => 'Article 2',
                'description' => 'Description de l\'article 2',
                'accessoires' => 'Accessoire 3, Accessoire 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres données selon vos besoins
        ];

        // Insérer les données dans la table 'article'
        DB::table('article')->insert($data);
    }
}
