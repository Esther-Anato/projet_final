<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LignePanier extends Model
{
    use HasFactory;

    protected $table = 'lignes_panier';

    protected $fillable = [
        'panier_id',
        'produit_id',
        'quantite',
        'couleur_choisie',
        'prix_unitaire',
    ];

    protected function casts(): array
    {
        return [
            'quantite' => 'integer',
            'prix_unitaire' => 'integer',
        ];
    }

    public function panier(): BelongsTo
    {
        return $this->belongsTo(Panier::class, 'panier_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function getTotalLigneAttribute(): int
    {
        return $this->prix_unitaire * $this->quantite;
    }
}
