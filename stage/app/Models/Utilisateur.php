<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utilisateur extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        
        'email',
        'password',
        'fonctionalite',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stockEntreesRecepteur()
    {
        return $this->hasMany(StockEntrer::class, 'recepteur', 'id_utilisateur');
    }

    public function stockEntreesEmetteur()
    {
        return $this->hasMany(StockEntrer::class, 'emetteur', 'id_utilisateur');
    }
}
