<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    // On indique à Laravel le nom de la table (pas la convention auto anglaise)
    protected $table = 'utilisateurs';

    // La colonne mot de passe s'appelle mot_de_passe et non password
    protected $authPasswordName = 'mot_de_passe';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'mot_de_passe',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verifie_le' => 'datetime',
            'mot_de_passe' => 'hashed',
        ];
    }

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'utilisateur_id');
    }

    public function paniers(): HasMany
    {
        return $this->hasMany(Panier::class, 'utilisateur_id');
    }
}
