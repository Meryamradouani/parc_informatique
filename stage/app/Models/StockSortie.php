<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockSortie extends Model
{
    protected $table = 'stock_sortie';

    protected $primaryKey = 'sortie_id';

    protected $fillable = [
        'numero_serie',
        'date',
        'observation',
        'code_article',
        'recepteur',
        'emetteur',
        'quantite', // Ajoutez le champ quantite ici
    ];

    // Relation avec l'article
    public function recepteurRelation()
    {
        return $this->belongsTo(Utilisateur::class, 'recepteur', 'id_utilisateur');
    }

    public function emetteurRelation()
    {
        return $this->belongsTo(Utilisateur::class, 'emetteur', 'id_utilisateur');
    }

    // Relation avec l'émetteur (Utilisateur)
    public function articleRelation()
    {
        return $this->belongsTo(Article::class, 'code_article', 'code_article');
    }
    public function articleStock()
    {
        return $this->hasOne(ArticleStock::class, 'stock_entrer_id', 'entry_id');
    }

}
