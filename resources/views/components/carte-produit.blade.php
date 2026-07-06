{{-- resources/views/components/carte-produit.blade.php --}}
@props(['produit', 'badge' => null, 'badgeOr' => false])

@php $image = $produit->imagePrincipale(); @endphp

<div class="group relative">

    {{-- clic sur la carte → fiche produit --}}
    <a href="{{ route('produits.afficher', $produit) }}" class="block">

        {{-- image --}}
        <div class="relative aspect-square rounded-2xl bg-[#ece6dc] overflow-hidden">
            @if($badge)
                <span class="absolute top-3 left-3 z-10 text-[11px] font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full
                             {{ $badgeOr ? 'bg-bj-or text-bj-noir' : 'bg-bj-violet text-white' }}">
                    {{ $badge }}
                </span>
            @endif

            @if($image)
                <img src="{{ $image->url }}" alt="{{ $image->texte_alternatif ?? $produit->nom }}"
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
            @else
                <div class="w-full h-full grid place-items-center text-bj-violet/30">
                    <x-heroicon-o-photo class="w-12 h-12" />
                </div>
            @endif
        </div>

        {{-- nom + couleur + prix --}}
        <div class="mt-3 text-center px-2">
            <p class="text-sm text-bj-noir leading-snug">{{ $produit->nom }}</p>
            @if($produit->couleur)
                <p class="text-xs text-bj-noir/60 mt-0.5">{{ $produit->couleur }}</p>
            @endif
            <p class="mt-1 font-semibold text-bj-violet-dk">{{ $produit->prix_formatte }}</p>
        </div>
    </a>

    {{-- icône ajout au panier, POSÉE SUR l'image (bas droite) --}}
    <form method="POST" action="{{ route('panier.ajouter') }}" class="absolute top-3 right-3 z-20">
        @csrf
        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
        <input type="hidden" name="quantite" value="1">
        <button type="submit" aria-label="Ajouter au panier"
                class="w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-md grid place-items-center text-bj-violet
                       hover:bg-bj-violet hover:text-white transition">
            <x-heroicon-o-shopping-bag class="w-5 h-5" />
        </button>
    </form>
</div>
