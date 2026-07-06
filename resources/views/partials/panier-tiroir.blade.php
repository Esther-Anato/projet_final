{{-- resources/views/partials/panier-tiroir.blade.php --}}
@php
    $sessionId = session('panier_session_id');
    $panierT = $sessionId ? \App\Models\Panier::where('session_id', $sessionId)->with('lignes.produit.images')->first() : null;
    $lignesT = $panierT ? $panierT->lignes : collect();
    $totalT  = $lignesT->sum(fn($l) => $l->prix_unitaire * $l->quantite);
@endphp

{{-- overlay sombre --}}
<div id="cart-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 invisible transition-opacity duration-300"></div>

{{-- tiroir --}}
<aside id="cart-drawer"
       class="fixed top-0 right-0 bottom-0 w-full max-w-md bg-white z-50 flex flex-col
              translate-x-full transition-transform duration-300 shadow-2xl">

    {{-- en-tête --}}
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <x-heroicon-o-shopping-bag class="w-7 h-7 text-bj-violet" />
            <h2 class="font-script text-3xl text-bj-violet-dk">Mon Panier</h2>
            @if($lignesT->sum('quantite') > 0)
                <span class="bg-bj-violet text-white text-xs font-bold w-6 h-6 rounded-full grid place-items-center">
                    {{ $lignesT->sum('quantite') }}
                </span>
            @endif
        </div>
        <button id="cart-close" aria-label="Fermer" class="text-bj-noir/60 hover:text-bj-noir">
            <x-heroicon-o-x-mark class="w-7 h-7" />
        </button>
    </div>

    {{-- articles --}}
    <div class="flex-1 overflow-y-auto px-6 py-4">
        @forelse($lignesT as $ligne)
            <div class="flex gap-4 py-4 border-b border-gray-100">
                <div class="w-24 h-28 rounded-xl bg-[#ece6dc] overflow-hidden shrink-0">
                    @if($ligne->produit->imagePrincipale())
                        <img src="{{ $ligne->produit->imagePrincipale()->url }}" alt="{{ $ligne->produit->nom }}"
                             class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex justify-between gap-2">
                        <p class="font-display text-bj-noir text-sm leading-snug">{{ $ligne->produit->nom }}</p>
                        <p class="font-bold text-bj-violet-dk text-sm whitespace-nowrap">
                            {{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA
                        </p>
                    </div>
                    @if($ligne->couleur_choisie)
                        <p class="text-sm text-bj-noir/60">{{ $ligne->couleur_choisie }}</p>
                    @endif

                    <div class="mt-3 flex items-center gap-3">
                        {{-- quantité --}}
                        <form method="POST" action="{{ route('panier.modifier', $ligne) }}" class="flex items-center border border-gray-300 rounded-full">
                            @csrf @method('PATCH')
                            <button type="submit" name="quantite" value="{{ max(1, $ligne->quantite - 1) }}"
                                    class="w-8 h-8 text-bj-violet grid place-items-center">−</button>
                            <span class="w-6 text-center text-sm font-semibold">{{ $ligne->quantite }}</span>
                            <button type="submit" name="quantite" value="{{ min(10, $ligne->quantite + 1) }}"
                                    class="w-8 h-8 text-bj-violet grid place-items-center">+</button>
                        </form>

                        {{-- supprimer --}}
                        <form method="POST" action="{{ route('panier.supprimer', $ligne) }}">
                            @csrf @method('DELETE')
                            <button type="submit" aria-label="Retirer" class="text-bj-violet hover:text-red-600 transition">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-bj-noir/50 py-16">Votre panier est vide.</p>
        @endforelse
    </div>

    {{-- pied --}}
    @if($lignesT->count())
        <div class="border-t border-gray-100 px-6 py-5">
            <div class="flex justify-between font-semibold text-bj-violet-dk mb-1">
                <span>Sous-total</span>
                <span>{{ number_format($totalT, 0, ',', ' ') }} FCFA</span>
            </div>
            <p class="text-xs text-bj-noir/50 mb-4">Livraison et mode de paiement à l'étape suivante.</p>

            <a href="{{ route('commandes.creer') }}"
               class="block text-center border border-bj-violet text-bj-violet font-semibold py-3 rounded-full mb-3 hover:bg-bj-violet hover:text-white transition">
                Valider le panier
            </a>
            <button id="cart-continue"
                    class="w-full text-center bg-bj-violet text-white font-semibold py-3 rounded-full hover:bg-bj-violet-dk transition">
                Continuer mes achats
            </button>
        </div>
    @endif
</aside>
