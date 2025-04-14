<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur; // Utilisez le modèle Utilisateur
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        // Utilisez paginate() pour récupérer les utilisateurs avec pagination
        $utilisateurs = Utilisateur::paginate(10); // 10 utilisateurs par page

        // Passez à la vue
        return view('user.utilisateur', compact('utilisateurs'));
    }
    public function show($id)
{
    $utilisateur = Utilisateur::findOrFail($id); // Récupérez l'utilisateur par ID
    return view('user.show', compact('utilisateur')); // Affichez la vue des détails
}


}
