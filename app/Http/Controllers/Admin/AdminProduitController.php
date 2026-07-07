<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('collection')->latest()->paginate(15);
        return view('admin.produits.index', compact('produits'));
    }

    public function creer()
    {
        return view('admin.produits.formulaire', [
            'produit' => new Produit(),
            'collections' => Collection::where('est_actif', true)->get(),
        ]);
    }

    public function editer(Produit $produit)
    {
        return view('admin.produits.formulaire', [
            'produit' => $produit,
            'collections' => Collection::where('est_actif', true)->get(),
        ]);
    }

public function enregistrer(Request $request)
{
    $data = $this->valider($request);
    $data['slug'] = Str::slug($data['nom']).'-'.Str::lower(Str::random(4));
    $produit = Produit::create($data);

    $this->gererImage($request, $produit);

    return redirect()->route('admin.produits.index')->with('ok', 'Produit ajouté.');
}

public function modifier(Request $request, Produit $produit)
{
    $produit->update($this->valider($request));
    $this->gererImage($request, $produit);

    return redirect()->route('admin.produits.index')->with('ok', 'Produit modifié.');
}

private function gererImage(Request $request, Produit $produit): void
{
    if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        // stocke dans storage/app/public/produits
        $chemin = $request->file('image')->store('produits', 'public');

        // si le produit a déjà une image principale, on la remplace
        \App\Models\ImageProduit::updateOrCreate(
            ['produit_id' => $produit->id, 'est_principale' => true],
            [
                'chemin'           => $chemin,
                'texte_alternatif' => $produit->nom,
                'ordre'            => 0,
            ]
        );
    }
}
    public function supprimer(Produit $produit)
    {
        $produit->delete();
        return back()->with('ok', 'Produit supprimé.');
    }

    private function valider(Request $request): array
    {
        $data = $request->validate([
            'nom'                => 'required|string|max:255',
            'collection_id'      => 'required|exists:collections,id',
            'prix'               => 'required|integer|min:0',
            'prix_barre'         => 'nullable|integer|min:0',
            'description_courte' => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'histoire'           => 'nullable|string',
            'matiere'            => 'nullable|string|max:255',
            'couleur'            => 'nullable|string|max:255',
            'dimensions'         => 'nullable|string|max:255',
            'entretien'          => 'nullable|string|max:255',
            'usage'              => 'nullable|string|max:255',
            'tenue_associee'     => 'nullable|string|max:255',
            'meta_titre'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:255',
            'mots_cles_seo'      => 'nullable|string',
        ]);

        // cases à cocher
        $data['est_vedette'] = $request->boolean('est_vedette');
        $data['est_actif']   = $request->boolean('est_actif');

        // mots-clés SEO : "mot1, mot2" → ['mot1','mot2'] (le modèle caste en array)
        $data['mots_cles_seo'] = $request->filled('mots_cles_seo')
            ? array_map('trim', explode(',', $request->mots_cles_seo))
            : [];

        return $data;
    }
}
