<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProduitController extends Controller
{
    /**
     * Catalogue complet, avec filtre optionnel par collection.
     */
   public function index(Request $request): View
{
    $requete = Produit::actif()->with(['collection', 'images']);

    if ($request->filled('collection')) {
        $requete->whereHas('collection', function ($q) use ($request) {
            $q->where('slug', $request->string('collection'));
        });
    }

    if ($request->filled('usage')) {
        $requete->where('usage', $request->string('usage'));
    }
    if ($request->filled('recherche')) {
    $terme = $request->string('recherche');
    $requete->where(function ($q) use ($terme) {
        $q->where('nom', 'like', "%{$terme}%")
          ->orWhere('description_courte', 'like', "%{$terme}%");
    });
}

    // tri par prix / nouveauté
    match ($request->query('tri')) {
        'prix_asc'  => $requete->orderBy('prix', 'asc'),
        'prix_desc' => $requete->orderBy('prix', 'desc'),
        default     => $requete->latest(),
    };

    $produits = $requete->paginate(12)->withQueryString();
    $collections = Collection::where('est_actif', true)->orderBy('ordre')->get();

    return view('produits.index', compact('produits', 'collections'));
}
    /**
     * Fiche produit complète.
     */
   public function afficher(Produit $produit): View
{
    $produit->load(['collection', 'images']);
    $produit->increment('nb_vues');

    $coloris = $produit->modele
        ? Produit::actif()
            ->where('modele', $produit->modele)
            ->where('id', '!=', $produit->id)
            ->with('images')
            ->get()
        : collect();

    // suggestions "vous aimerez aussi" = même collection
    $produitsLies = Produit::actif()
        ->where('collection_id', $produit->collection_id)
        ->where('id', '!=', $produit->id)
        ->limit(3)
        ->get();

    return view('produits.fiche', compact('produit', 'produitsLies', 'coloris'));
}
// ProduitController
public function afficherCollection(Collection $collection): View
{
    $produits = $collection->produitsActifs()->with('images')->get();
    return view('collections.afficher', compact('collection', 'produits'));
}
    /**
     * Page dédiée à la capsule.
     */
    public function capsule(): View
    {
        $produits = Produit::actif()->capsule()->with(['collection', 'images'])->get();

        return view('produits.capsule', compact('produits'));
    }
    public function rechercheAjax(Request $request)
{
    $terme = $request->query('q', '');

    if (mb_strlen($terme) < 2) {
        return response()->json([]);
    }

    $produits = Produit::actif()
        ->where(function ($query) use ($terme) {
            $query->where('nom', 'like', "%{$terme}%")
                  ->orWhere('description_courte', 'like', "%{$terme}%");
        })
        ->with('images')
        ->limit(6)
        ->get()
        ->map(fn ($p) => [
            'nom'   => $p->nom,
            'prix'  => $p->prix_formatte,
            'url'   => route('produits.afficher', $p),
            'image' => $p->imagePrincipale()?->url,
        ]);

    return response()->json($produits);
}
}
