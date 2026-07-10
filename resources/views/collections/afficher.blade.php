@extends('layouts.public')

@section('title', $collection->nom.' — Blac Joyaux')
@section('meta_description', $collection->description)

@section('content')

    {{-- ══════════ HERO COLLECTION ══════════ --}}
    <section class="relative min-h-[60vh] flex items-center bg-[#d9c5ad]">
        @if($collection->image)
            <img src="{{ asset('storage/'.$collection->image) }}" alt="{{ $collection->nom }}"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent"></div>
        @endif
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full mt-16">
            <h1 class="font-script text-white text-6xl md:text-7xl mb-4 drop-shadow-lg">{{ $collection->nom }}</h1>
            @if($collection->description)
                <p class="text-white/90 max-w-md leading-relaxed text-lg">{{ $collection->description }}</p>
            @endif
        </div>
    </section>

    {{-- ══════════ PRODUITS EN GRAND ══════════ --}}
    <section class="bg-bj-violet py-16">
        <div class="mmx-autax-w-6xl o px-6 space-y-16">
            @foreach($produits as $index => $produit)
                @php
                    $coloris = $produit->collection->produitsActifs()->where('id', '!=', $produit->id)->limit(4)->get();
                @endphp
                <div class="grid md:grid-cols-2 gap-10 items-center {{ $index % 2 ? 'md:[direction:rtl]' : '' }}">
                    {{-- image --}}
                    <a href="{{ route('produits.afficher', $produit) }}" class="block [direction:ltr]">
                        <div class="aspect-square rounded-3xl bg-[#ece6dc] overflow-hidden">
                            @if($produit->imagePrincipale())
                                <img src="{{ $produit->imagePrincipale()->url }}" alt="{{ $produit->nom }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            @endif
                        </div>
                    </a>

                    {{-- infos --}}
                    <div class="text-center [direction:ltr]">
                        <h2 class="font-display font-bold text-3xl text-white mb-2">
                            {{ Str::upper($produit->nom) }} — {{ $produit->prix_formatte }}
                        </h2>
                        @if($produit->description_courte)
                            <p class="text-white/70 mb-6">{{ $produit->description_courte }}</p>
                        @endif

                        <form method="POST" action="{{ route('panier.ajouter') }}" class="mb-5">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <input type="hidden" name="quantite" value="1">
                            <input type="hidden" name="couleur_choisie" value="{{ $produit->couleur }}">
                            <button type="submit"
                                    class="w-full max-w-sm mx-auto block border border-white/60 text-white font-semibold py-4 rounded-full hover:bg-white hover:text-bj-violet transition">
                                Ajouter au panier
                            </button>
                        </form>

                        {{-- pastilles coloris --}}
                        @if($coloris->count())
                            <div class="flex justify-center gap-3">
                                <span class="w-9 h-9 rounded-full ring-2 ring-white ring-offset-2 ring-offset-bj-violet overflow-hidden bg-[#ece6dc]">
                                    @if($produit->imagePrincipale())
                                        <img src="{{ $produit->imagePrincipale()->url }}" alt="{{ $produit->couleur }}" class="w-full h-full object-cover">
                                    @endif
                                </span>
                                @foreach($coloris as $c)
                                    <a href="{{ route('produits.afficher', $c) }}" title="{{ $c->couleur }}"
                                       class="w-9 h-9 rounded-full overflow-hidden bg-[#ece6dc] hover:ring-2 hover:ring-bj-or ring-offset-2 ring-offset-bj-violet transition">
                                        @if($c->imagePrincipale())
                                            <img src="{{ $c->imagePrincipale()->url }}" alt="{{ $c->couleur }}" class="w-full h-full object-cover">
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('produits.afficher', $produit) }}"
                           class="inline-block mt-6 text-white/80 underline hover:text-white">Voir détails</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
