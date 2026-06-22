<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produits';

    protected $fillable = [
        'collection_id',
        'nom',
        'slug',
        'description_courte',
        'description',
        'histoire',
        'matiere',
        'couleur',
        'variantes_couleur',
        'dimensions',
        'entretien',
        'usage',
        'tenue_associee',
        'prix',
        'prix_barre',
        'est_vedette',
        'est_actif',
        'meta_titre',
        'meta_description',
        'mots_cles_seo',
        'nb_vues',
    ];

    protected function casts(): array
    {
        return [
            'variantes_couleur' => 'array',
            'mots_cles_seo' => 'array',
            'prix' => 'integer',
            'prix_barre' => 'integer',
            'est_vedette' => 'boolean',
            'est_actif' => 'boolean',
        ];
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageProduit::class, 'produit_id')->orderBy('ordre');
    }

    public function imagePrincipale()
    {
        return $this->images()->where('est_principale', true)->first()
            ?? $this->images()->first();
    }

    public function lignesPanier(): HasMany
    {
        return $this->hasMany(LignePanier::class, 'produit_id');
    }

    public function lignesCommande(): HasMany
    {
        return $this->hasMany(LigneCommande::class, 'produit_id');
    }

    /**
     * Un produit est dans la capsule si SA COLLECTION est marquee est_capsule = true.
     * On ne duplique pas cette info sur Produit : on la lit toujours via la relation.
     */
    public function getEstCapsuleAttribute(): bool
    {
        return (bool) ($this->collection?->est_capsule ?? false);
    }

    public function getPrixFormatteAttribute(): string
    {
        return number_format($this->prix, 0, ',', ' ').' FCFA';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActif($query)
    {
        return $query->where('est_actif', true);
    }

    public function scopeVedette($query)
    {
        return $query->where('est_vedette', true);
    }

    public function scopeCapsule($query)
    {
        return $query->whereHas('collection', fn ($q) => $q->where('est_capsule', true));
    }
}
