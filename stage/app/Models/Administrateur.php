<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    protected $table = 'administrateur'; // Nom de la table

    protected $fillable = [
        'utilisateur',
        'email',
        'password',
        'nom',
        'prenom',
    ];
}
