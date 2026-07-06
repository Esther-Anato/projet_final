@extends('layouts.public')

@section('title', 'Boutique — Blac Joyaux')

@section('content')

    {{-- ══════════ HERO BOUTIQUE ══════════ --}}
    <section class="relative h-[60vh] min-h-[420px] flex items-center">
        <img src="{{ asset('images/boutique-hero.jpg') }}" alt="Collections Blac Joyaux"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full mt-16">
            <h1 class="font-script text-white text-5xl md:text-7xl mb-4 drop-shadow-lg">Nos Collections</h1>
            <p class="text-white/90 italic max-w-md leading-relaxed text-lg">
                « Porter un Joyaux, c'est avancer dans le monde avec élégance, fierté et confiance en soi. »
            </p>
        </div>
    </section>

    {{-- ══════════ CARTES-COLLECTIONS (déco + filtres) ══════════ --}}
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="font-script text-bj-violet-dk text-4xl md:text-5xl text-center mb-10">Explorez nos collections</h2>

      {{-- ══════════ CARTES-COLLECTIONS ══════════ --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($collections as $collection)
        <a href="{{ route('collections.afficher', $collection) }}"
           class="group relative block h-64 rounded-3xl overflow-hidden bg-bj-violet-dk shadow-lg">
            @if($collection->image)
                <img src="{{ asset('storage/'.$collection->image) }}" alt="{{ $collection->nom }}"
                     class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            @endif
            <div class="absolute inset-x-0 bottom-0 p-6">
                <span class="text-white font-display font-bold text-2xl">{{ $collection->nom }}</span>
            </div>
        </a>
    @endforeach
</div>
    </section>
@if(request('recherche'))
    · Résultats pour « {{ request('recherche') }} »
@endif
  {{-- ══════════ CATALOGUE ══════════ --}}
    <section class="bg-bj-creme py-16">
        <div class="max-w-7xl mx-auto px-6">

            {{-- barre filtre + tri --}}
            <div class="flex items-center justify-between flex-wrap gap-4 mb-10">
                <p class="text-bj-noir/70 text-sm">
                    {{ $produits->total() }} sac{{ $produits->total() > 1 ? 's' : '' }}
                    @if(request('recherche'))
                        · Résultats pour « {{ request('recherche') }} »
                    @endif
                    @if(request('collection'))
                        · <a href="{{ route('produits.index') }}" class="text-bj-violet underline">Voir tout</a>
                    @endif
                </p>

                <div class="flex flex-wrap items-center gap-3">
                    {{-- chips collection --}}
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('produits.index', ['tri' => request('tri')]) }}"
                           class="px-5 py-2 rounded-full text-sm font-medium border transition
                                  {{ !request('collection') ? 'bg-bj-violet text-white border-bj-violet' : 'bg-white text-bj-noir border-gray-300 hover:border-bj-violet' }}">
                            Tout
                        </a>
                        @foreach($collections as $collection)
                            <a href="{{ route('produits.index', ['collection' => $collection->slug, 'tri' => request('tri')]) }}"
                               class="px-5 py-2 rounded-full text-sm font-medium border transition
                                      {{ request('collection') === $collection->slug ? 'bg-bj-violet text-white border-bj-violet' : 'bg-white text-bj-noir border-gray-300 hover:border-bj-violet' }}">
                                {{ $collection->nom }}
                            </a>
                        @endforeach
                    </div>

                    {{-- tri --}}
                    <select onchange="window.location.href=this.value"
                            class="rounded-full border-gray-300 text-sm text-bj-noir focus:border-bj-violet focus:ring-bj-violet">
                        <option value="{{ route('produits.index', ['collection' => request('collection'), 'tri' => 'recent']) }}"
                                @selected(!request('tri') || request('tri') === 'recent')>Trier : Nouveautés</option>
                        <option value="{{ route('produits.index', ['collection' => request('collection'), 'tri' => 'prix_asc']) }}"
                                @selected(request('tri') === 'prix_asc')>Prix croissant</option>
                        <option value="{{ route('produits.index', ['collection' => request('collection'), 'tri' => 'prix_desc']) }}"
                                @selected(request('tri') === 'prix_desc')>Prix décroissant</option>
                    </select>
                </div>
            </div>

            {{-- grille produits --}}
            @if($produits->count())
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                    @foreach($produits as $produit)
                        <x-carte-produit :produit="$produit" />
                    @endforeach
                </div>

                <div class="mt-14">
                    {{ $produits->links() }}
                </div>
            @else
                <p class="text-center text-bj-noir/60 py-16">Aucun sac trouvé.</p>
            @endif

        </div>
    </section>

@endsection
