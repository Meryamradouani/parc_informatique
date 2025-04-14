<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntrer extends Model
{
    protected $table = 'stock_entrer';
    protected $primaryKey = 'entry_id';

    protected $fillable = [
        'date',
        'recepteur',
        'emetteur',
        'observation',
        'entry_numero',
        'code_article',
        'quantite', // Ajoutez le champ quantite ici
    ];

    public function recepteurRelation()
    {
        return $this->belongsTo(Utilisateur::class, 'recepteur', 'id_utilisateur');
    }

    public function emetteurRelation()
    {
        return $this->belongsTo(Utilisateur::class, 'emetteur', 'id_utilisateur');
    }

    public function articleRelation()
    {
        return $this->belongsTo(Article::class, 'code_article', 'code_article');
    }
    public function articleStock()
    {
        return $this->hasOne(ArticleStock::class, 'stock_entrer_id', 'entry_id');
    }


}
