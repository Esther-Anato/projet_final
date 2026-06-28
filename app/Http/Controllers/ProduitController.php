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

        $produits = $requete->latest()->paginate(12)->withQueryString();
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

        $produitsLies = Produit::actif()
            ->where('collection_id', $produit->collection_id)
            ->where('id', '!=', $produit->id)
            ->limit(3)
            ->get();

        return view('produits.fiche', compact('produit', 'produitsLies'));
    }

    /**
     * Page dédiée à la capsule.
     */
    public function capsule(): View
    {
        $produits = Produit::actif()->capsule()->with(['collection', 'images'])->get();

        return view('produits.capsule', compact('produits'));
    }
}
