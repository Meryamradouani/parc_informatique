<?php

namespace App\Http\Controllers;

use App\Models\Article; // Assurez-vous que le modèle est importé
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Affiche tous les articles
    public function index()
    {
        $articles = Article::paginate(10); // Récupérer les articles
        return view('user.article', compact('articles')); // Passer la variable à la vue
    }


    // Met à jour l'article
    public function update(Request $request, $id)
    {
        $request->validate([
            'numeroserie' => 'required|string|max:50',
            'marque' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'libelle' => 'required|string|max:50',
            'description' => 'nullable|string|max:100',
            'accessoires' => 'required|string|max:50',
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect()->route('user.article')->with('success', 'Article mis à jour avec succès.');
    }

    // Supprime un article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('user.article')->with('success', 'Article supprimé avec succès.');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'numeroserie' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'libelle' => 'required|string|max:255',
        'description' => 'nullable|string',
        'accessoires' => 'required|string|max:255',
    ]);

    Article::create($validatedData);

    return redirect()->route('user.article')->with('success', 'Article ajouté avec succès.');
}
}
