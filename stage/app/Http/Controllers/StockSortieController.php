<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockSortie;
use App\Models\Utilisateur;
use App\Models\Article;
use App\Models\ArticleStock;
use Illuminate\Support\Facades\Log;

class StockSortieController extends Controller
{
    /**
     * Affiche la liste des bons de sortie avec leurs détails.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stockSorties = StockSortie::all();

        // Charger explicitement les relations
        foreach ($stockSorties as $sortie) {
            $sortie->recepteur = Utilisateur::find($sortie->recepteur);
            $sortie->emetteur = Utilisateur::find($sortie->emetteur);
            $sortie->article = Article::find($sortie->code_article);
        }

        return view('stock-sorties.index', compact('stockSorties'));
    }

    /**
     * Affiche le formulaire de création d'un bon de sortie.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $utilisateurs = Utilisateur::all();
        $articles = Article::all();
        return view('stock-sorties.create', compact('utilisateurs', 'articles'));
    }

    /**
     * Enregistre un nouveau bon de sortie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|string|max:11',
            'date' => 'required|date',
            'observation' => 'nullable|string',
            'code_article' => 'required|integer',
            'recepteur' => 'required|integer',
            'emetteur' => 'required|integer',
            'quantite' => 'required|integer',
        ]);

        // Vérifier la disponibilité de la quantité en stock
        if (!$this->isQuantityAvailable($request->code_article, $request->quantite)) {
            return redirect()->back()->withInput()->with('error', 'Quantité demandée non disponible en stock.');
        }

        try {
            // Création du bon de sortie
            $stockSortie = StockSortie::create($request->all());

            // Mettre à jour le stock d'article
            $this->updateArticleStock($request->code_article, $request->quantite);

            return redirect()->route('stock-sorties.index')->with('success', 'Bon de sortie ajouté avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in store method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du bon de sortie.');
        }
    }

    /**
     * Affiche le formulaire d'édition d'un bon de sortie.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $stockSortie = StockSortie::findOrFail($id);
        $articles = Article::all();
        $utilisateurs = Utilisateur::all();
        return view('stock-sorties.edit', compact('stockSortie', 'articles', 'utilisateurs'));
    }

    /**
     * Met à jour un bon de sortie existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'numero_serie' => 'required|string|max:11',
            'date' => 'required|date',
            'observation' => 'nullable|string',
            'code_article' => 'required|integer',
            'recepteur' => 'required|integer',
            'emetteur' => 'required|integer',
            'quantite' => 'required|integer',
        ]);

        try {
            $stockSortie = StockSortie::findOrFail($id);

            // Récupérer l'ancienne quantité pour annuler son effet
            $ancienneQuantite = $stockSortie->quantite;

            // Annuler l'effet de l'ancienne quantité
            $this->updateArticleStock($stockSortie->code_article, $ancienneQuantite, true);

            // Vérifier la disponibilité de la nouvelle quantité
            if (!$this->isQuantityAvailable($validated['code_article'], $validated['quantite'])) {
                // Réappliquer l'ancienne quantité si la nouvelle quantité n'est pas disponible
                $this->updateArticleStock($stockSortie->code_article, $ancienneQuantite);
                return redirect()->back()->withInput()->with('error', 'Quantité demandée non disponible en stock.');
            }

            // Mettre à jour le bon de sortie
            $stockSortie->update($validated);

            // Mettre à jour le stock avec la nouvelle quantité
            $this->updateArticleStock($validated['code_article'], $validated['quantite']);

            return redirect()->route('stock-sorties.index')->with('success', 'Bon de sortie mis à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in update method:', ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du bon de sortie.');
        }
    }

    /**
     * Supprime un bon de sortie existant et restaure la quantité d'article correspondante.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $stockSortie = StockSortie::findOrFail($id);

            // Restaurer la quantité du bon de sortie dans l'article stock correspondant
            if ($stockSortie) {
                $this->updateArticleStock($stockSortie->code_article, $stockSortie->quantite, true);
            }

            $stockSortie->delete();

            return redirect()->route('stock-sorties.index')->with('success', 'Bon de sortie supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in destroy method:', ['exception' => $e]);
            return redirect()->route('stock-sorties.index')->with('error', 'Erreur lors de la suppression du bon de sortie.');
        }
    }

    /**
     * Vérifie si la quantité demandée est disponible en stock.
     *
     * @param int $code_article
     * @param int $quantite
     * @return bool
     */
    private function isQuantityAvailable($code_article, $quantite)
    {
        $articleStock = ArticleStock::where('code_article', $code_article)->first();

        return $articleStock && $articleStock->quantite >= $quantite;
    }

    /**
     * Met à jour le stock d'article.
     *
     * @param int $code_article
     * @param int $quantite
     * @param bool $isRestoration
     * @return bool
     */
    private function updateArticleStock($code_article, $quantite, $isRestoration = false)
    {
        $articleStock = ArticleStock::where('code_article', $code_article)->first();

        if (!$articleStock) {
            if ($isRestoration) {
                $articleStock = new ArticleStock();
                $articleStock->code_article = $code_article;
                $articleStock->quantite = $quantite;
                $articleStock->save();
                return true;
            }
            return false;
        }

        try {
            // Ajuster la quantité en fonction de l'opération
            $articleStock->quantite += $isRestoration ? $quantite : -$quantite;
            $articleStock->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error updating article stock:', ['exception' => $e]);
            return false;
        }
    }

    /**
     * Affiche les détails d'un bon de sortie.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $stockSortie = StockSortie::findOrFail($id);

            $stockSortie->recepteur = Utilisateur::find($stockSortie->recepteur);
            $stockSortie->emetteur = Utilisateur::find($stockSortie->emetteur);
            $stockSortie->article = Article::find($stockSortie->code_article);

            return view('stock-sorties.show', compact('stockSortie'));
        } catch (\Exception $e) {
            Log::error('Error in show method:', ['exception' => $e]);
            return redirect()->route('stock-sorties.index')->with('error', 'Bon de sortie non trouvé.');
        }
    }
}
