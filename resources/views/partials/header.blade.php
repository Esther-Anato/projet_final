{{-- resources/views/partials/header.blade.php --}}
{{-- Contenu du header, partagé entre le layout "hero" (transparent) et "solid" (fond plein) --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 lg:h-24 flex items-center relative">

    {{-- nav gauche (desktop only) --}}
    <nav class="hidden lg:flex items-center gap-10">
        <a href="{{ route('accueil') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('accueil') ? 'text-bj-or font-medium' : 'text-white' }}">Accueil</a>
        <a href="{{ route('histoire') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('histoire') ? 'text-bj-or font-medium' : 'text-white' }}">Notre Histoire</a>
    </nav>

    {{-- logo : centré en absolute, indépendant du contenu autour --}}
    <a href="{{ route('accueil') }}"
       class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 shrink-0"
       aria-label="Blac Joyaux — accueil">
        <img src="{{ asset('images/logo.png') }}" alt="Blac Joyaux" class="h-11 sm:h-12 lg:h-14 w-auto">
    </a>

    {{-- nav droite (desktop) + actions : toujours collé à droite via ml-auto --}}
    <div class="flex items-center gap-3 sm:gap-5 ml-auto">
        <nav class="hidden lg:flex items-center gap-10 mr-6">
            <a href="{{ route('produits.index') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('produits.*') ? 'text-bj-or font-medium' : 'text-white' }}">Collections</a>
            <a href="{{ route('contact') }}" class="text-white text-lg hover:opacity-70 transition {{ request()->routeIs('contact') ? 'text-bj-or font-medium' : '' }}">Contact</a>
        </nav>

        {{-- recherche --}}
        <div x-data="{ ouvert: false }" class="relative flex items-center">
            <button @click="ouvert = !ouvert" aria-label="Rechercher" class="text-white hover:text-bj-or transition flex items-center">
                <x-heroicon-o-magnifying-glass class="w-5 h-5 sm:w-6 sm:h-6" />
            </button>

            <form x-show="ouvert" x-transition method="GET" action="{{ route('produits.index') }}"
                  class="absolute right-0 top-full mt-3 bg-white rounded-full shadow-lg flex items-center px-4 py-2 w-[85vw] max-w-xs z-50"
                  style="display:none;">
                <input type="text" name="recherche" placeholder="Rechercher un sac..."
                       value="{{ request('recherche') }}"
                       class="flex-1 border-0 focus:ring-0 text-sm text-bj-noir p-0" autofocus>
                <button type="submit" class="text-bj-violet shrink-0">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </button>
            </form>
        </div>

        {{-- panier --}}
        <a href="{{ route('panier.index') }}" aria-label="Panier" class="relative text-white hover:text-bj-or transition flex items-center">
            <x-heroicon-o-shopping-bag class="w-5 h-5 sm:w-6 sm:h-6" />
            @php
                $sessionId = session('panier_session_id');
                $nbArticles = 0;
                if ($sessionId) {
                    $panierCourant = \App\Models\Panier::where('session_id', $sessionId)->first();
                    $nbArticles = $panierCourant ? $panierCourant->lignes()->sum('quantite') : 0;
                }
            @endphp
            @if($nbArticles > 0)
                <span class="absolute -top-2 -right-2 bg-bj-or text-bj-noir text-[10px] font-bold min-w-[18px] h-[18px] px-1 rounded-full grid place-items-center">
                    {{ $nbArticles }}
                </span>
            @endif
        </a>
    </div>

</div>
