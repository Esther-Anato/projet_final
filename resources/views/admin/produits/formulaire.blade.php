@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-bj-violet-dk mb-6">
        {{ $produit->exists ? 'Modifier' : 'Ajouter' }} un produit
    </h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-6 text-sm">
            <ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data"
          action="{{ $produit->exists ? route('admin.produits.modifier', $produit) : route('admin.produits.enregistrer') }}"
          class="space-y-5">
        @csrf
        @if($produit->exists) @method('PUT') @endif

        {{-- image --}}
        <div>
            <label class="block text-sm font-medium mb-1">Image du produit</label>
            @if($produit->exists && $produit->imagePrincipale())
                <img src="{{ $produit->imagePrincipale()->url }}" alt="" class="w-28 h-28 object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full text-sm">
            <p class="text-xs text-gray-400 mt-1">JPG, PNG ou WEBP, max 4 Mo. {{ $produit->exists ? 'Laisser vide pour garder l\'image actuelle.' : '' }}</p>
        </div>

        {{-- nom + collection + prix --}}
        <div>
            <label class="block text-sm font-medium mb-1">Nom du produit *</label>
            <input name="nom" value="{{ old('nom', $produit->nom) }}" required class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Collection *</label>
                <select name="collection_id" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">— Choisir —</option>
                    @foreach($collections as $c)
                        <option value="{{ $c->id }}" @selected(old('collection_id', $produit->collection_id) == $c->id)>{{ $c->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Prix (FCFA) *</label>
                <input type="number" name="prix" value="{{ old('prix', $produit->prix) }}" required class="w-full border rounded-lg px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description courte</label>
            <input name="description_courte" value="{{ old('description_courte', $produit->description_courte) }}" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded-lg px-3 py-2">{{ old('description', $produit->description) }}</textarea>
        </div>

        {{-- caractéristiques --}}
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium mb-1">Couleur</label>
                <input name="couleur" value="{{ old('couleur', $produit->couleur) }}" class="w-full border rounded-lg px-3 py-2"></div>
            <div><label class="block text-sm font-medium mb-1">Matière</label>
                <input name="matiere" value="{{ old('matiere', $produit->matiere) }}" class="w-full border rounded-lg px-3 py-2"></div>
            <div><label class="block text-sm font-medium mb-1">Dimensions</label>
                <input name="dimensions" value="{{ old('dimensions', $produit->dimensions) }}" class="w-full border rounded-lg px-3 py-2"></div>
            <div><label class="block text-sm font-medium mb-1">Entretien</label>
                <input name="entretien" value="{{ old('entretien', $produit->entretien) }}" class="w-full border rounded-lg px-3 py-2"></div>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="est_vedette" value="1" @checked(old('est_vedette', $produit->est_vedette))> Mettre en vedette
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="est_actif" value="1" @checked(old('est_actif', $produit->est_actif ?? true))> Actif (visible sur le site)
            </label>
        </div>

        {{-- ═══ BLOC SEO ═══ --}}
        <fieldset class="border rounded-xl p-5 bg-gray-50">
            <legend class="px-2 font-semibold text-bj-violet-dk">Référencement (SEO)</legend>
            <p class="text-xs text-gray-500 mb-4">Améliore la visibilité du produit sur Google et les moteurs de recherche.</p>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Titre SEO</label>
                <input name="meta_titre" value="{{ old('meta_titre', $produit->meta_titre) }}" maxlength="60"
                       class="w-full border rounded-lg px-3 py-2" placeholder="Ex : Sac Joyau de Bla Croco Violet — Blac Joyaux">
                <span class="text-xs text-gray-400">Idéal : 50 à 60 caractères.</span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Meta description</label>
                <textarea name="meta_description" rows="2" maxlength="160" class="w-full border rounded-lg px-3 py-2"
                          placeholder="Courte description qui apparaît dans les résultats Google.">{{ old('meta_description', $produit->meta_description) }}</textarea>
                <span class="text-xs text-gray-400">Idéal : 150 à 160 caractères.</span>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Mots-clés SEO</label>
                <input name="mots_cles_seo"
                       value="{{ old('mots_cles_seo', is_array($produit->mots_cles_seo) ? implode(', ', $produit->mots_cles_seo) : '') }}"
                       class="w-full border rounded-lg px-3 py-2" placeholder="sac Abidjan, maroquinerie ivoirienne, cadeau femme">
                <span class="text-xs text-gray-400">Séparés par des virgules.</span>
            </div>
        </fieldset>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-bj-violet text-white font-semibold px-6 py-3 rounded-full hover:bg-bj-violet-dk transition">
                {{ $produit->exists ? 'Enregistrer les modifications' : 'Ajouter le produit' }}
            </button>
            <a href="{{ route('admin.produits.index') }}" class="px-6 py-3 text-gray-500 hover:text-gray-700">Annuler</a>
        </div>
    </form>
</div>
@endsection
