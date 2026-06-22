<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'numero_commande',
        'utilisateur_id',
        'nom_client',
        'telephone_client',
        'email_client',
        'adresse_livraison',
        'ville_livraison',
        'sous_total',
        'frais_livraison',
        'total',
        'mode_paiement',
        'statut_paiement',
        'reference_paiement',
        'statut',
        'livraison_jours_min',
        'livraison_jours_max',
        'contacte_via_whatsapp',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'contacte_via_whatsapp' => 'boolean',
            'sous_total' => 'integer',
            'frais_livraison' => 'integer',
            'total' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Commande $commande) {
            if (empty($commande->numero_commande)) {
                $commande->numero_commande = static::genererNumero();
            }
        });
    }

    public static function genererNumero(): string
    {
        $annee = now()->format('Y');
        $derniere = static::whereYear('created_at', $annee)->latest('id')->first();
        $prochain = $derniere ? ((int) substr($derniere->numero_commande, -4)) + 1 : 1;

        return sprintf('BJ-%s-%04d', $annee, $prochain);
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function lignes(): HasMany
    {
        return $this->hasMany(LigneCommande::class, 'commande_id');
    }

    public function urlWhatsapp(): string
    {
        $message = "Bonjour Blac Joyaux, je viens de passer la commande {$this->numero_commande}. Pouvez-vous confirmer sa disponibilite ?";

        return 'https://wa.me/'.config('services.whatsapp.numero').'?text='.urlencode($message);
    }
}
