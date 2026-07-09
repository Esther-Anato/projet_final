@extends('layouts.public-solid')

@section('title', $produit->meta_titre ?? $produit->nom.' — Blac Joyaux')
@section('meta_description', $produit->meta_description ?? $produit->description_courte)

@section('content')

    <div class="max-w-6xl mx-auto px-6 pt-28 pb-16">

        {{-- fil d'ariane --}}
        <nav class="text-sm text-bj-noir/50 mb-6">
            <a href="{{ route('accueil') }}" class="hover:text-bj-violet">Accueil</a> /
            <a href="{{ route('produits.index') }}" class="hover:text-bj-violet">Collections</a> /
            <span>{{ $produit->nom }}</span>
        </nav>

        <div class="grid md:grid-cols-2 gap-10">

            {{-- galerie --}}
            <div>
                <div class="aspect-square rounded-3xl bg-[#ece6dc] overflow-hidden">
                    @if($produit->imagePrincipale())
                        <img src="{{ $produit->imagePrincipale()->url }}" alt="{{ $produit->nom }}"
                             class="w-full h-full object-cover">
                    @endif
                </div>
                {{-- miniatures si plusieurs images --}}
                @if($produit->images->count() > 1)
                    <div class="flex gap-3 mt-3">
                        @foreach($produit->images->take(4) as $img)
                            <div class="w-20 h-20 rounded-xl bg-[#ece6dc] overflow-hidden">
                                <img src="{{ $img->url }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- infos + achat --}}
            <div>
                <p class="text-sm text-bj-or-dk uppercase tracking-wide mb-2">{{ $produit->collection->nom ?? '' }}</p>
                <h1 class="font-display font-bold text-3xl text-bj-noir mb-3">{{ $produit->nom }}</h1>
                <p class="text-2xl font-semibold text-bj-violet-dk mb-6">{{ $produit->prix_formatte }}</p>

              {{-- COULEURS : uniquement les vrais coloris du même modèle --}}
@if($coloris->count())
    <div class="mb-6">
        <p class="text-sm font-medium text-bj-noir mb-2">
            Couleur : <span class="text-bj-noir/60">{{ $produit->couleur }}</span>
        </p>
        <div class="flex flex-wrap gap-2">
            {{-- coloris actuel (entouré) --}}
            <span class="w-11 h-11 rounded-full ring-2 ring-bj-violet ring-offset-2 overflow-hidden bg-[#ece6dc]" title="{{ $produit->couleur }}">
                @if($produit->imagePrincipale())
                    <img src="{{ $produit->imagePrincipale()->url }}" alt="{{ $produit->couleur }}" class="w-full h-full object-cover">
                @endif
            </span>
            {{-- autres coloris --}}
            @foreach($coloris as $c)
                <a href="{{ route('produits.afficher', $c) }}" title="{{ $c->couleur }}"
                   class="w-11 h-11 rounded-full overflow-hidden bg-[#ece6dc] hover:ring-2 hover:ring-bj-or ring-offset-2 transition">
                    @if($c->imagePrincipale())
                        <img src="{{ $c->imagePrincipale()->url }}" alt="{{ $c->couleur }}" class="w-full h-full object-cover">
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endif
                {{-- description courte --}}
                @if($produit->description_courte)
                    <p class="text-bj-noir/70 leading-relaxed mb-6">{{ $produit->description_courte }}</p>
                @endif

                {{-- ajouter au panier --}}
                <form method="POST" action="{{ route('panier.ajouter') }}">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <input type="hidden" name="quantite" value="1">
                    <input type="hidden" name="couleur_choisie" value="{{ $produit->couleur }}">
                    <button type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-bj-violet text-white font-semibold px-10 py-4 rounded-full hover:bg-bj-violet-dk transition">
                        <x-heroicon-o-shopping-bag class="w-5 h-5" />
                        Ajouter au panier
                    </button>
                </form>

                {{-- mini réassurance --}}
                <div class="mt-8 space-y-2 text-sm text-bj-noir/70 border-t border-gray-100 pt-6">
                    <p class="flex items-center gap-2"><x-heroicon-o-truck class="w-5 h-5 text-bj-violet" /> Livraison à Abidjan sous 1 à 3 jours</p>
                    <p class="flex items-center gap-2"><x-heroicon-o-credit-card class="w-5 h-5 text-bj-violet" /> Espèces ou Mobile Money</p>
                    <p class="flex items-center gap-2"><x-heroicon-o-sparkles class="w-5 h-5 text-bj-violet" /> Façonné à Abidjan, Côte d'Ivoire</p>
                </div>
            </div>
        </div>

        {{-- ══════════ DESCRIPTION ENRICHIE ══════════ --}}
    <div class="mt-16 bg-white rounded-3xl p-8 md:p-12">
        <div class="grid md:grid-cols-3 gap-10">

            {{-- texte description --}}
            <div class="md:col-span-2">
                <h2 class="font-display font-semibold text-2xl text-bj-violet-dk mb-4">Description</h2>
                <p class="text-bj-noir/75 leading-relaxed mb-4">
                    {{ $produit->description ?? $produit->description_courte }}
                </p>
                @if($produit->histoire)
                    <p class="text-bj-noir/75 leading-relaxed">{{ $produit->histoire }}</p>
                @endif

                {{-- points forts --}}
                <ul class="mt-6 space-y-2 text-sm text-bj-noir/80">
                    <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-5 h-5 text-bj-violet" /> Façonné à la main à Abidjan</li>
                    <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-5 h-5 text-bj-violet" /> Finitions et matières soignées</li>
                    @if($produit->usage)
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-5 h-5 text-bj-violet" /> Idéal : {{ $produit->usage }}</li>
                    @endif
                </ul>
            </div>

            {{-- caractéristiques --}}
            <div class="bg-bj-creme rounded-2xl p-6">
                <h3 class="font-display font-semibold text-bj-violet-dk mb-4">Caractéristiques</h3>
                <dl class="text-sm divide-y divide-black/5">
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Collection</dt><dd class="font-medium text-right">{{ $produit->collection->nom ?? '—' }}</dd></div>
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Couleur</dt><dd class="font-medium text-right">{{ $produit->couleur ?? '—' }}</dd></div>
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Matière</dt><dd class="font-medium text-right">{{ $produit->matiere ?? '—' }}</dd></div>
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Dimensions</dt><dd class="font-medium text-right">{{ $produit->dimensions ?? '—' }}</dd></div>
                    @if($produit->tenue_associee)
                        <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">À porter avec</dt><dd class="font-medium text-right">{{ $produit->tenue_associee }}</dd></div>
                    @endif
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Entretien</dt><dd class="font-medium text-right">{{ $produit->entretien ?? '—' }}</dd></div>
                    <div class="flex justify-between py-2.5"><dt class="text-bj-noir/55">Fabrication</dt><dd class="font-medium text-right">Abidjan, CI</dd></div>
                </dl>
            </div>
        </div>
    </div>
    {{-- ══════════ RÉASSURANCE (à la place de l'avis) ══════════ --}}
    <section class="mt-16 bg-bj-violet-dk rounded-3xl px-6 py-12 text-center">
        <div class="max-w-2xl mx-auto">
            <p class="font-script text-bj-or text-4xl mb-4">Un Joyaux, un savoir-faire</p>
            <p class="text-white/85 leading-relaxed">
                Chaque sac Blac Joyaux est façonné à Abidjan par nos artisans, avec une attention
                particulière portée aux matières et aux finitions. Un héritage ivoirien, pensé pour
                vous accompagner au quotidien avec élégance.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-10">
                <div class="flex flex-col items-center gap-2">
                    <x-heroicon-o-sparkles class="w-8 h-8 text-bj-or" />
                    <p class="text-white text-sm font-medium">Fait main à Abidjan</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-heroicon-o-truck class="w-8 h-8 text-bj-or" />
                    <p class="text-white text-sm font-medium">Livraison 1 à 3 jours</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-heroicon-o-shield-check class="w-8 h-8 text-bj-or" />
                    <p class="text-white text-sm font-medium">Finitions soignées</p>
                </div>
            </div>
        </div>
    </section>
        {{-- vous aimerez aussi --}}
        @if($produitsLies->count())
            <section class="mt-20">
                <h2 class="font-script text-bj-violet-dk text-4xl text-center mb-10">Vous aimerez aussi</h2>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                    @foreach($produitsLies->take(3) as $lie)
                        <x-carte-produit :produit="$lie" />
                    @endforeach
                </div>
            </section>
        @endif

    </div>

@endsection
