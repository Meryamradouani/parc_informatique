<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articleStock extends Model
{
    use HasFactory;
    protected $table = 'article_stock'; // Nom de la table dans la base de données

    protected $primaryKey = 'id'; // Clé primaire de la table

    protected $fillable = [
        'quantite',
        'code_article',
        'stock_entrer_id',
        'stock_sortie_id',
        // Ajoutez d'autres champs selon vos besoins
    ];
    public function article()
    {
        return $this->belongsTo(Article::class, 'code_article', 'code_article');
    }
    public function stockEntrer()
    {
        return $this->belongsTo(StockEntrer::class, 'stock_entrer_id', 'entry_id');
    }
    public function stockSortie()
    {
        return $this->belongsTo(stockSortie::class, 'stock_sortie_id', 'sortie_id');
    }
    public function scopeCheckQuantity($query, $code_article, $quantite)
    {
        return $query->where('code_article', $code_article)
                    ->where('quantite', '>=', $quantite);
    }

    // Relation avec les sorties de stock

}
