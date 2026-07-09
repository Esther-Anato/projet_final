<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Panier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Page de checkout : récapitulatif panier + formulaire livraison + choix paiement.
     */
    public function creer(Request $request): View|RedirectResponse
    {
        $panier = $request->user()
            ? Panier::with('lignes.produit')->where('utilisateur_id', $request->user()->id)->first()
            : Panier::with('lignes.produit')->where('session_id', $request->session()->get('panier_session_id'))->first();

        if (! $panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('erreur', 'Votre panier est vide.');
        }

        return view('commandes.creer', compact('panier'));
    }

    /**
     * Enregistre la commande avec paiement simulé.
     */

    public function enregistrer(Request $request): RedirectResponse
    {
       $valide = $request->validate([
    'nom_client' => ['required', 'string', 'max:255'],
    'telephone_client' => ['required', 'string', 'max:30'],
    'email_client' => ['required', 'email'],
    'mode_livraison' => ['required', 'in:expedition,retrait'],
    'adresse_livraison' => ['required_if:mode_livraison,expedition', 'nullable', 'string', 'max:255'],
    'ville_livraison' => ['required_if:mode_livraison,expedition', 'nullable', 'string', 'max:100'],
    'mode_paiement' => ['required', 'in:mobile_money_wave,mobile_money_orange,especes_livraison'],
    'notes' => ['nullable', 'string', 'max:500'],
]);
        $panier = $request->user()
            ? Panier::with('lignes.produit')->where('utilisateur_id', $request->user()->id)->first()
            : Panier::with('lignes.produit')->where('session_id', $request->session()->get('panier_session_id'))->first();

        if (! $panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('erreur', 'Votre panier est vide.');
        }

        $commande = DB::transaction(function () use ($valide, $panier, $request) {
            $sousTotalCalcule = $panier->lignes->sum(fn($ligne) => $ligne->prix_unitaire * $ligne->quantite);

           $sousTotal = $panier->lignes->sum(fn($l) => $l->prix_unitaire * $l->quantite);
$fraisLivraison = $valide['mode_livraison'] === 'retrait' ? 0 : 2000;

$commande = Commande::create([
    ...$valide,
    'utilisateur_id' => $request->user()?->id,
    'sous_total' => $sousTotal,
    'frais_livraison' => $fraisLivraison,
    'total' => $sousTotal + $fraisLivraison,
    'statut_paiement' => 'en_attente',
    'statut' => 'en_attente',
    // garde les autres champs que ton controller mettait déjà
]);

            foreach ($panier->lignes as $ligne) {
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $ligne->produit_id,
                    'nom_produit' => $ligne->produit->nom,
                    'couleur_choisie' => $ligne->couleur_choisie,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire' => $ligne->prix_unitaire,
                    'total_ligne' => $ligne->prix_unitaire * $ligne->quantite,
                ]);
            }

            // Simulation paiement : si PAYMENT_MODE=simulated, on marque "paye"
            // automatiquement pour la demo. Especes = toujours "en_attente".
            if (config('services.paiement.mode') === 'simulated' && $valide['mode_paiement'] !== 'especes_livraison') {
                $commande->update([
                    'statut_paiement' => 'paye',
                    'reference_paiement' => 'SIMU-' . strtoupper(uniqid()),
                ]);
            }

            $panier->lignes()->delete();

            return $commande;
        });

        return redirect()->route('commandes.confirmation', $commande)->with('succes', 'Commande enregistrée !');
    }

    public function confirmation(Commande $commande): View
    {
        // Si l'utilisateur est connecté, vérifier que la commande lui appartient
         if (Auth::check() && $commande->utilisateur_id !== Auth::id()) {
        abort(403, 'Accès non autorisé à cette commande.');
    }
        $commande->load('lignes');

        return view('commandes.confirmation', compact('commande'));
    }
}
