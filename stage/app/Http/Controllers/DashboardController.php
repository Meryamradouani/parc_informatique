<?php
// Dans app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\articleStock;
use App\Models\User;
use App\Models\Article;
use App\Models\StockEntrer;
use App\Models\StockSortie;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = Utilisateur::count();
        $articleCount = Article::count();
        $stock_entrer= StockEntrer::count();
        $stock_sortie= StockSortie::count();
        $articleStats = articleStock::select('code_article', 'quantite')->get();

        $articleStocks = ArticleStock::all();

        // Préparer les labels (noms des articles) et les données de quantité
        $labels = $articleStocks->pluck('article.libelle'); // Assurez-vous d'adapter le chemin selon la structure de votre modèle
        $quantities = $articleStocks->pluck('quantite');

        return view('admin.dashboard', compact('userCount', 'articleCount', 'articleStats','labels', 'quantities','stock_sortie','stock_entrer'));
    }
}
