<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrateur; // Assurez-vous d'importer le bon modèle

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        Administrateur::create([
            'utilisateur' => 'Admin', // Nom d'utilisateur
            'email' => 'admin@gmail.com', // Email
            'password' => bcrypt('admin123'), // Hachage du mot de passe
            'nom' => 'Admin', // Nom
            'prenom' => 'Admin', // Prénom
        ]);
    }
}

