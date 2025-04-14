<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\Articlecontroller;
use Illuminate\Http\Utilisateurcontroller;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Vue principale pour l'admin
    }

    public function show()
    {
        $utilisateurs = Utilisateur::all(); // Récupère tous les utilisateurs
        return view('admin.utilisateur', compact('utilisateurs'));
    }

    // AdminController.php

public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'tel' => 'required|string|max:15',
        'email' => 'required|string|email|max:255|unique:utilisateur,email', // Changez ici
        'password' => 'required|string|min:8',
        'fonctionalite' => 'required|string|max:255',
    ]);

    $validatedData['password'] = bcrypt($validatedData['password']); // Hash le mot de passe
    Utilisateur::create($validatedData);

    return redirect()->route('admin.utilisateur')->with('success', 'Utilisateur ajouté avec succès.');
}

public function update(Request $request, $id)
{
    // Utilisez $id pour retrouver l'utilisateur que vous souhaitez mettre à jour
    $utilisateur = Utilisateur::findOrFail($id);

    // Effectuez les opérations de mise à jour avec les données du formulaire
    $utilisateur->nom = $request->input('nom');
    $utilisateur->prenom = $request->input('prenom');
    $utilisateur->tel = $request->input('tel');
    $utilisateur->email = $request->input('email');
    $utilisateur->fonctionalite = $request->input('fonctionalite');

    // Sauvegardez les modifications
    $utilisateur->save();

    // Redirection avec un message de succès
    return redirect()->route('admin.utilisateur')->with('success', 'Utilisateur mis à jour avec succès.');
}

public function edit($id)
{
    $utilisateur = Utilisateur::findOrFail($id);
    return view('admin.edit', compact('utilisateur'));
}
    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('admin.utilisateur')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
