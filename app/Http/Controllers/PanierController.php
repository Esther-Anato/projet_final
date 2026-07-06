<?php

namespace App\Http\Controllers;

use App\Models\LignePanier;
use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PanierController extends Controller
{
    /**
     * Récupère ou crée le panier courant (connecté ou invité via session).
     */
    private function obtenirOuCreerPanier(Request $request): Panier
    {
        if ($request->user()) {
            return Panier::firstOrCreate(['utilisateur_id' => $request->user()->id]);
        }

        $sessionId = $request->session()->get('panier_session_id');

        if (! $sessionId) {
            $sessionId = (string) Str::uuid();
            $request->session()->put('panier_session_id', $sessionId);
        }

        return Panier::firstOrCreate(['session_id' => $sessionId, 'utilisateur_id' => null]);
    }

    public function index(Request $request): View
    {
        $panier = $this->obtenirOuCreerPanier($request);
        $panier->load(['lignes.produit.images']);

        return view('panier.index', compact('panier'));
    }

    public function ajouter(Request $request): RedirectResponse
    {
        $valide = $request->validate([
            'produit_id' => ['required', 'exists:produits,id'],
            'quantite' => ['required', 'integer', 'min:1', 'max:10'],
            'couleur_choisie' => ['nullable', 'string'],
        ]);

        $produit = Produit::findOrFail($valide['produit_id']);
        $panier = $this->obtenirOuCreerPanier($request);

        $ligneExistante = $panier->lignes()
            ->where('produit_id', $produit->id)
            ->where('couleur_choisie', $valide['couleur_choisie'] ?? null)
            ->first();

        if ($ligneExistante) {
            $ligneExistante->increment('quantite', $valide['quantite']);
        } else {
            LignePanier::create([
                'panier_id' => $panier->id,
                'produit_id' => $produit->id,
                'quantite' => $valide['quantite'],
                'couleur_choisie' => $valide['couleur_choisie'] ?? null,
                'prix_unitaire' => $produit->prix,
            ]);
        }

        return redirect()->back()->with('succes', 'Produit ajouté au panier.')->with('ouvrir_panier', true);
    }

  public function modifier(Request $request, LignePanier $lignePanier): RedirectResponse
{
    // Vérifier que cette ligne appartient au panier de l'utilisateur courant
    $panier = $this->obtenirOuCreerPanier($request);

    if ($lignePanier->panier_id !== $panier->id) {
        abort(403, 'Action non autorisée.');
    }

    $valide = $request->validate([
        'quantite' => ['required', 'integer', 'min:1', 'max:10'],
    ]);

    $lignePanier->update(['quantite' => $valide['quantite']]);

    return redirect()->back()->with('succes', 'Quantité mise à jour.')->with('ouvrir_panier', true);
}

public function supprimer(Request $request, LignePanier $lignePanier): RedirectResponse
{
    // Vérifier que cette ligne appartient au panier de l'utilisateur courant
    $panier = $this->obtenirOuCreerPanier($request);

    if ($lignePanier->panier_id !== $panier->id) {
        abort(403, 'Action non autorisée.');
    }

    $lignePanier->delete();

return redirect()->back()->with('succes', 'Produit retiré du panier.')->with('ouvrir_panier', true);
}
}
