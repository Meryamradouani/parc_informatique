<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockEntrer;
use App\Models\Article;
use App\Models\Utilisateur;
use App\Models\ArticleStock;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StockEntrerController extends Controller
{
    /**
     * Affiche la liste des bons d'entrée avec leurs détails.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stockEntrers = StockEntrer::all();
        foreach ($stockEntrers as $stockEntrer) {
            $stockEntrer->recepteur = Utilisateur::find($stockEntrer->recepteur);
            $stockEntrer->emetteur = Utilisateur::find($stockEntrer->emetteur);
            $stockEntrer->article = Article::find($stockEntrer->code_article);
        }
        return view('stock_entrer.index', compact('stockEntrers'));
    }

    /**
     * Affiche le formulaire de création d'un bon d'entrée.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $utilisateurs = Utilisateur::all();
        $articles = Article::all();
        return view('stock_entrer.create', compact('utilisateurs', 'articles'));
    }

    /**
     * Enregistre un nouveau bon d'entrée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'entry_numero' => 'required|string|max:11',
            'date' => 'required|date',
            'code_article' => 'required|integer|exists:article,code_article',
            'recepteur' => 'required|integer|exists:utilisateur,id_utilisateur',
            'emetteur' => 'required|integer|exists:utilisateur,id_utilisateur',
            'quantite' => 'required|integer|min:1',
        ]);

        try {
            // Création du bon d'entrée
            $stockEntrer = StockEntrer::create($request->all());

            // Mettre à jour le stock d'article
            $this->updateArticleStock($request->code_article, $request->quantite);

            return redirect()->route('stock_entrer.index')->with('success', 'Bon d\'entrée ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in store method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du bon d\'entrée.');
        }
    }

    /**
     * Affiche le formulaire d'édition d'un bon d'entrée.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $stockEntrer = StockEntrer::findOrFail($id);
        $articles = Article::all();
        $utilisateurs = Utilisateur::all();
        return view('stock_entrer.edit', compact('stockEntrer', 'articles', 'utilisateurs'));
    }

    /**
     * Met à jour un bon d'entrée existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'entry_numero' => 'required|string|max:11',
            'date' => 'required|date',
            'observation' => 'nullable|string',
            'code_article' => 'required|integer|exists:article,code_article',
            'recepteur' => 'required|integer|exists:utilisateur,id_utilisateur',
            'emetteur' => 'required|integer|exists:utilisateur,id_utilisateur',
            'quantite' => 'required|integer|min:1',
        ]);

        try {
            $stockEntrer = StockEntrer::findOrFail($id);

            // Annuler l'impact de l'ancienne quantité sur le stock
            $this->updateArticleStock($stockEntrer->code_article, -$stockEntrer->quantite);

            // Mettre à jour le bon d'entrée avec les nouvelles valeurs validées
            $stockEntrer->update($validated);

            // Appliquer la nouvelle quantité au stock d'article
            $this->updateArticleStock($validated['code_article'], $validated['quantite']);

            return redirect()->route('stock_entrer.index')->with('success', 'Bon d\'entrée mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in update method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du bon d\'entrée.');
        }
    }

    /**
     * Supprime un bon d'entrée existant et restaure la quantité d'article correspondante.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $stockEntrer = StockEntrer::findOrFail($id);

            // Restaurer la quantité dans le stock d'article
            $this->updateArticleStock($stockEntrer->code_article, -$stockEntrer->quantite);

            $stockEntrer->delete();

            return redirect()->route('stock_entrer.index')->with('success', 'Bon d\'entrée supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in destroy method:', ['exception' => $e]);
            return redirect()->route('stock_entrer.index')->with('error', 'Erreur lors de la suppression du bon d\'entrée.');
        }
    }

    /**
     * Met à jour le stock d'article en ajoutant ou soustrayant la quantité spécifiée.
     *
     * @param int $code_article
     * @param int $quantite
     * @return void
     */
    private function updateArticleStock($code_article, $quantite)
    {
        try {
            $articleStock = ArticleStock::where('code_article', $code_article)->first();
            if (!$articleStock) {
                // Si aucun stock existant, créer un nouveau
                $articleStock = new ArticleStock();
                $articleStock->code_article = $code_article;
                $articleStock->quantite = 0;
            }

            $articleStock->quantite += $quantite;
            $articleStock->save();

        } catch (\Exception $e) {
            Log::error('Error updating article stock:', ['exception' => $e]);
        }
    }
    public function show($id)
    {
        try {
            $stockEntrer = StockEntrer::findOrFail($id);

            // Charger les relations manuellement
            $stockEntrer->recepteur = Utilisateur::find($stockEntrer->recepteur);
            $stockEntrer->emetteur = Utilisateur::find($stockEntrer->emetteur);
            $stockEntrer->article = Article::find($stockEntrer->code_article);

            return view('stock_entrer.show', compact('stockEntrer'));

        } catch (\Exception $e) {
            Log::error('Error in show method:', ['exception' => $e]);
            return redirect()->route('stock_entrer.index')->with('error', 'Bon d\'entrée non trouvé.');
        }
    }
}
