<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'histoire',
        'image',
        'est_capsule',
        'est_actif',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'est_capsule' => 'boolean',
            'est_actif' => 'boolean',
        ];
    }

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class, 'collection_id');
    }

    public function produitsActifs(): HasMany
    {
        return $this->produits()->where('est_actif', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeCapsule($query)
    {
        return $query->where('est_capsule', true);
    }
}
