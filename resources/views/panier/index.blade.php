@extends('layouts.public-solid')

@section('title', 'Mon panier — Blac Joyaux')

@section('content')

    <div class="max-w-5xl mx-auto px-6 pt-28 pb-20">
        <h1 class="font-script text-bj-violet-dk text-5xl mb-2">Votre panier</h1>

        @if(session('succes'))
            <p class="text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-2 mb-6 text-sm">
                {{ session('succes') }}
            </p>
        @endif

        @php
            $lignes = $panier->lignes;
            $total = $lignes->sum(fn($l) => $l->prix_unitaire * $l->quantite);
        @endphp

        @if($lignes->count())
            <div class="grid lg:grid-cols-3 gap-8 items-start">

                {{-- liste des articles --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($lignes as $ligne)
                        <div class="bg-white rounded-2xl p-4 flex gap-4 items-center">
                            {{-- image --}}
                            <div class="w-24 h-28 rounded-xl bg-[#ece6dc] overflow-hidden shrink-0">
                                @if($ligne->produit->imagePrincipale())
                                    <img src="{{ $ligne->produit->imagePrincipale()->url }}"
                                         alt="{{ $ligne->produit->nom }}" class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- infos --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-display font-semibold text-bj-noir">{{ $ligne->produit->nom }}</p>
                                @if($ligne->couleur_choisie)
                                    <p class="text-sm text-bj-noir/60">{{ $ligne->couleur_choisie }}</p>
                                @endif
                                <p class="text-sm text-bj-noir/60 mt-1">{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA / pièce</p>

                                {{-- modifier quantité --}}
                                <form method="POST" action="{{ route('panier.modifier', $ligne) }}" class="mt-2 flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantite" value="{{ $ligne->quantite }}" min="1" max="10"
                                           class="w-16 rounded-lg border-gray-300 text-sm py-1"
                                           onchange="this.form.submit()">
                                    <span class="text-xs text-bj-noir/50">Modifier</span>
                                </form>
                            </div>

                            {{-- prix ligne + supprimer --}}
                            <div class="text-right shrink-0">
                                <p class="font-semibold text-bj-violet-dk">{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</p>
                                <form method="POST" action="{{ route('panier.supprimer', $ligne) }}" class="mt-2">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-bj-noir/50 underline hover:text-bj-violet">Retirer</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- récap --}}
                <aside class="bg-white rounded-2xl p-6 lg:sticky lg:top-24">
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Récapitulatif</h2>
                    <div class="flex justify-between text-sm py-2">
                        <span class="text-bj-noir/60">Sous-total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="flex justify-between text-sm py-2 border-b border-gray-100">
                        <span class="text-bj-noir/60">Livraison (Abidjan)</span>
                        <span>Confirmée au contact</span>
                    </div>
                    <div class="flex justify-between font-bold text-bj-violet-dk text-lg pt-4">
                        <span>Total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>

                    <a href="{{ route('commandes.creer') }}"
                       class="mt-6 block text-center bg-bj-violet text-white font-semibold py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                        Commander
                    </a>

                    <div class="mt-4 space-y-2 text-xs text-bj-noir/60">
                        <p>· Espèces ou Mobile Money</p>
                        <p>· Livraison à Abidjan sous 1 à 3 jours</p>
                    </div>
                </aside>
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-bj-noir/60 mb-6">Votre panier est vide.</p>
                <a href="{{ route('produits.index') }}"
                   class="inline-flex items-center gap-2 bg-bj-violet text-white font-semibold px-8 py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                    Découvrir la boutique
                </a>
            </div>
        @endif
    </div>

@endsection
