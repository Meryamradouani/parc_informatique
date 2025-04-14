<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
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
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'tel' => '0123456789',
                'email' => 'jean.dupont@example.com',
                'password' => Hash::make('motdepasse123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'tel' => '0987654321',
                'email' => 'marie.martin@example.com',
                'password' => Hash::make('motdepasse456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres utilisateurs selon vos besoins
        ];

        // Insérer les données dans la table 'utilisateurs'
        DB::table('utilisateur')->insert($data);
    }
}
