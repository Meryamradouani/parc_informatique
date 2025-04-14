<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleStock;
use Illuminate\Support\Facades\Log;

class StocksController extends Controller
{
    /**
     * Affiche la liste des stocks d'articles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articleStocks = ArticleStock::with('article')->get();
        return view('stocks.index', compact('articleStocks'));
    }

    /**
     * Affiche le formulaire de création d'un stock d'article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $articles = Article::all();
        return view('stocks.create', compact('articles'));
    }

    /**
     * Enregistre un nouveau stock d'article.
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

            return redirect()->route('stocks.index')->with('success', 'Stock d\'article ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in store method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du stock d\'article.');
        }
    }

    /**
     * Affiche le formulaire d'édition d'un stock d'article.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $articleStock = ArticleStock::findOrFail($id);
        $articles = Article::all();
        return view('stocks.edit', compact('articleStock', 'articles'));
    }

    /**
     * Met à jour un stock d'article existant.
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

            return redirect()->route('stocks.index')->with('success', 'Stock d\'article mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in update method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du stock d\'article.');
        }
    }

    /**
     * Supprime un stock d'article existant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $articleStock = ArticleStock::findOrFail($id);
            $articleStock->delete();

            return redirect()->route('stocks.index')->with('success', 'Stock d\'article supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in destroy method:', ['exception' => $e]);
            return redirect()->route('stocks.index')->with('error', 'Erreur lors de la suppression du stock d\'article.');
        }
    }
}
