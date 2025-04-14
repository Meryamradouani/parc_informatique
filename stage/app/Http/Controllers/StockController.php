<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleStock;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    /**
     * Affiche la liste des articles avec leur stock actuel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articleStocks = ArticleStock::with('article')->get();
        return view('stock.index', compact('articleStocks'));
    }

    /**
     * Affiche le formulaire de création d'un article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $articles = Article::all();
        return view('stock.create', compact('articles'));
    }
    /**
     * Enregistre un nouvel article avec son stock initial.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_article' => 'required|exists:article,code_article',
            'quantite' => 'required|integer|min:0',
        ]);

        try {
            // Création du stock d'article
            ArticleStock::create([
                'code_article' => $request->code_article,
                'quantite' => $request->quantite,
            ]);

            return redirect()->route('stock.index')->with('success', 'Stock d\'article ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in store method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du stock d\'article.');
        }
    }
    /**
     * Affiche le formulaire d'édition d'un article.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
{
    $articleStock = ArticleStock::findOrFail($id);
    $articles = Article::all();
    return view('stock.edit', compact('articleStock', 'articles'));
}

    /**
     * Met à jour un article existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code_article' => 'required|exists:article,code_article',
            'quantite' => 'required|integer|min:0',
        ]);

        try {
            $articleStock = ArticleStock::findOrFail($id);
            $articleStock->code_article = $request->code_article;
            $articleStock->quantite = $request->quantite;
            $articleStock->save();

            return redirect()->route('stock.index')->with('success', 'Stock d\'article mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in update method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du stock d\'article.');
        }
    }
    /**
     * Supprime un article existant et son stock associé.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Suppression de l'article et de son stock associé dans article_stock
            $articleStock = ArticleStock::where('code_article', $article->code_article)->first();
            if ($articleStock) {
                $articleStock->delete();
            }

            $article->delete();

            return redirect()->route('stock.index')->with('success', 'Article supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in destroy method:', ['exception' => $e]);
            return redirect()->route('stock.index')->with('error', 'Erreur lors de la suppression de l\'article.');
        }
    }
}
