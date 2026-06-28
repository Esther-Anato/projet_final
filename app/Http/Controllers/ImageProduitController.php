<?php

namespace App\Http\Controllers;

use App\Models\ImageProduit;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProduitController extends Controller
{
    /**
     * Enregistre une nouvelle image pour un produit.
     */
    public function enregistrer(Request $request, Produit $produit): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
        ]);

        // Stocke le fichier dans storage/app/public/produits/
        $chemin = $request->file('image')->store('produits', 'public');

        ImageProduit::create([
            'produit_id'        => $produit->id,
            'chemin'            => $chemin,
            'texte_alternatif'  => $request->input('texte_alternatif', $produit->nom),
            // Si c'est la première image du produit, elle devient principale
            'est_principale'    => $produit->images()->count() === 0,
            'ordre'             => $produit->images()->count(),
        ]);

        return back()->with('succes', 'Image ajoutée avec succès.');
    }

    /**
     * Supprime une image produit.
     */
    public function supprimer(ImageProduit $imageProduit): RedirectResponse
    {
        // Supprimer le fichier physique du stockage
        Storage::disk('public')->delete($imageProduit->chemin);

        $imageProduit->delete();

        return back()->with('succes', 'Image supprimée.');
    }

    /**
     * Définit une image comme image principale du produit.
     */
    public function definirPrincipale(ImageProduit $imageProduit): RedirectResponse
    {
        // Retirer "principale" de toutes les images du produit
        $imageProduit->produit->images()->update(['est_principale' => false]);

        // Définir celle-ci comme principale
        $imageProduit->update(['est_principale' => true]);

        return back()->with('succes', 'Image principale mise à jour.');
    }
}
