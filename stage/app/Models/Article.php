<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article'; // Si nécessaire
    protected $primaryKey = 'code_article'; // Si nécessaire

    protected $fillable = [
        'numeroserie',
        'marque',
        'model',
        'libelle',
        'description',
        'accessoires',
        // Pas besoin d'ajouter _token ici
    ];

    public function stockEntrer()
    {
        return $this->hasMany(StockEntrer::class, 'code_article');
    }
    public function stockSortie()
{
    return $this->hasMany(StockSortie::class, 'code_article');
}
public function articleStocks()
    {
        return $this->hasMany(ArticleStock::class, 'code_article', 'code_article');
    }
    
}
