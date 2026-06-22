<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageProduit extends Model
{
    use HasFactory;

    protected $table = 'images_produit';

    protected $fillable = [
        'produit_id',
        'chemin',
        'texte_alternatif',
        'est_principale',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'est_principale' => 'boolean',
        ];
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/'.$this->chemin);
    }
}
