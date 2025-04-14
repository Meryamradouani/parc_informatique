<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StockEntrerController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminarticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminprofileController;
use App\Http\Controllers\StockSortieController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\bonEntrerController;
use App\Http\Controllers\bonsortieController;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('index');
})->name('index');

// Page d'accueil
Route::get('/home', function () {
    return view('user.home');
})->name('home');

// Autres pages
Route::get('/utilisateur', [UtilisateurController::class, 'index'])->name('utilisateur');
Route::get('/home', function () {
    return view('user.home');
})->name('home');


Route::get('/gestionstock', function () {
    return view('user.gestionstock');
})->name('gestionstock');

Route::get('/utilisateur.show', function () {
    return view('user.show');
})->name('show');

Route::get('/bon-entree', function () {
    return view('user.bon-entree');
})->name('bon-entree');

Route::get('/bon-sortie', function () {
    return view('user.bon-sortie');
})->name('bon-sortie');
//login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('/user', function () {
    return view('user.home');
})->name('user');

//registre


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


use App\Http\Controllers\ArticleController;
use App\Models\articleStock;

// Routes pour la gestion des articles
Route::get('/articles', [ArticleController::class, 'index'])->name('article');
Route::post('/articles/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::resource('articles', ArticleController::class);
Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::resource('article', ArticleController::class);
Route::get('/user.article', [ArticleController::class, 'index'])->name('user.article');
// Route pour mettre à jour le profil
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// admin utilisateur
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin.utilisateur', [AdminController::class, 'show'])->name('admin.utilisateur');
Route::delete('/admin/utilisateur/{id}', [AdminController::class, 'destroy'])->name('admin.utilisateur.destroy');
Route::get('/utilisateurs', [AdminController::class, 'show'])->name('utilisateurs.show');
Route::post('/utilisateurs', [AdminController::class, 'store'])->name('utilisateurs.store');
Route::put('/admin/utilisateur/{id}', [AdminController::class, 'update'])->name('admin.utilisateur.update');
Route::get('/admin/utilisateur/{id}/edit', [AdminController::class, 'edit'])->name('admin.utilisateur.edit');
Route::patch('/admin/utilisateur/{id}', [UtilisateurController::class, 'update'])->name('utilisateurs.update');
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index'); // Vue principale pour l'admin
    Route::get('/utilisateur', [AdminController::class, 'show'])->name('admin.utilisateur'); // Liste des utilisateurs
    Route::post('/utilisateur', [AdminController::class, 'store'])->name('admin.utilisateur.store'); // Ajouter un utilisateur
    Route::put('/utilisateur/{id}', [AdminController::class, 'update'])->name('admin.utilisateur.update'); // Mettre à jour un utilisateur
    Route::delete('/utilisateur/{id}', [AdminController::class, 'destroy'])->name('admin.utilisateur.destroy'); // Supprimer un utilisateur
});
// stock admin
Route::resource('stock', StockController::class);
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');
Route::get('stock/{id}/edit', [StockController::class, 'edit'])->name('stock.edit');
Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');
Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
Route::get('/stock/{id}/edit', 'StockController@edit')->name('stock.edit');

//bon admin
Route::resource('stock_entrer', StockEntrerController::class);
Route::put('/stock_entrer/{id}', 'StockEntrerController@update')->name('stock_entrer.update');
Route::resource('stock-sorties', StockSortieController::class);
Route::get('/stock_entrer', [StockEntrerController::class, 'index'])->name('stock_entrer.index');
Route::get('/admin.dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/stock-sorties', [ StockSortieController::class, 'index'])->name('stock-sorties.index');
//bon user
Route::resource('/bon-entree', bonEntrerController::class);
Route::resource('/bon-sortie', bonSortieController::class);
Route::get('/bons-entree', [BonEntrerController::class, 'index'])->name('bon-entree.index');
Route::get('/bons-sortie', [BonSortieController::class, 'index'])->name('bon-sortie.index');
Route::get('/bon-entree/{id}', [bonEntrerController::class, 'show'])->name('bon-entree.show');
Route::put('/bon-entree/{id}', [bonEntrerController::class, 'update'])->name('bon-entree.update');

//******************** */
Route::resource('admin',AdminController::class);
//article d'admin
Route::get('/admin.article', [AdminarticleController::class, 'index'])->name('admin.article');
Route::post('/admin', [AdminarticleController::class, 'update'])->name('admin.update');
Route::delete('/admin', [AdminarticleController::class, 'destroy'])->name('articles.destroy');
Route::put('/admin/{admin}', [AdminarticleController::class, 'update'])->name('admin.update');
Route::resource('/admin', AdminarticleController::class);
Route::post('/admin', [AdminarticleController::class, 'store'])->name('articles.store');
Route::delete('/admin/articles/{id}', [AdminarticleController::class, 'destroy'])->name('admin.articles.destroy');
Route::get('/admin.profile', [AdminprofileController::class, 'show'])->name('profile');
Route::put('/admin/articles/{id}', [AdminarticleController::class, 'update'])->name('admin.articles.update');
//stock user
Route::resource('stocks', StocksController::class);
Route::get('/stocks', [StocksController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [StocksController::class, 'create'])->name('stocks.create');
Route::post('/stocks/store', [StocksController::class, 'store'])->name('stocks.store');
Route::get('stocks/{id}/edit', [StocksController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [StocksController::class, 'update'])->name('stocks.update');
Route::delete('/stocks/{id}', [StocksController::class, 'destroy'])->name('stocks.destroy');
Route::get('/stocks/{id}/edit', 'StocksController@edit')->name('stocks.edit');
