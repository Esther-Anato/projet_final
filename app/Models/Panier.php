<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';

    protected $fillable = [
        'utilisateur_id',
        'session_id',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function lignes(): HasMany
    {
        return $this->hasMany(LignePanier::class, 'panier_id');
    }

    public function getTotalAttribute(): int
    {
        return $this->lignes->sum(fn (LignePanier $ligne) => $ligne->prix_unitaire * $ligne->quantite);
    }

    public function getNbArticlesAttribute(): int
    {
        return $this->lignes->sum('quantite');
    }
}
