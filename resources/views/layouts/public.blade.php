{{-- resources/views/layouts/public.blade.php --}}
{{-- Layout public du site Blac Joyaux (distinct du layout Breeze app.blade.php réservé aux pages compte/auth) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Blac Joyaux — Maroquinerie ivoirienne')</title>
    <meta name="description" content="@yield('meta_description', 'Sacs à main façonnés en Côte d\'Ivoire. Livraison à Abidjan, paiement espèces ou Mobile Money.')">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    {{-- Polices : Bricolage Grotesque (titres), Inter (corps), Fraunces (slogan) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700&family=Fraunces:ital,opsz,wght@0,9..144,400;1,9..144,400&family=Great+Vibes&family=Inter:wght@400;500;600&family=Questrial&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
{{-- ══════════ ÉCRAN DE CHARGEMENT ══════════ --}}
<div id="page-loader"
     class="fixed inset-0 z-[100] flex items-center justify-center transition-opacity duration-700 ease-out"
     style="background: radial-gradient(circle at center, #4A2461 0%, #3D1F4F 100%);">

    <div class="relative flex flex-col items-center">

        {{-- cercle doré qui tourne autour du logo --}}
        <div class="relative w-32 h-32 flex items-center justify-center">
            <svg class="absolute inset-0 w-full h-full animate-spin" style="animation-duration: 2.5s;" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="46" fill="none" stroke="#FAD698" stroke-width="1.5"
                        stroke-dasharray="70 220" stroke-linecap="round" opacity="0.9"/>
            </svg>
            {{-- logo qui pulse doucement --}}
            <img src="{{ asset('images/logo.png') }}" alt="Blac Joyaux"
                 class="w-16 h-16 object-contain" style="animation: bj-pulse 2s ease-in-out infinite;">
        </div>

        {{-- nom de la marque --}}
        <p class="mt-8 font-display tracking-[0.3em] text-white text-sm uppercase"
           style="animation: bj-fade 2s ease-in-out infinite;">Blac Joyaux</p>
    </div>
</div>

<style>
    @keyframes bj-pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50%      { transform: scale(1.08); opacity: 0.85; }
    }
    @keyframes bj-fade {
        0%, 100% { opacity: 0.5; }
        50%      { opacity: 1; }
    }
</style>
<script>
    (function() {
        const drawer  = document.getElementById('cart-drawer');
        const overlay = document.getElementById('cart-overlay');

        function openCart() {
            drawer.classList.remove('translate-x-full');
            overlay.classList.remove('opacity-0', 'invisible');
        }
        function closeCart() {
            drawer.classList.add('translate-x-full');
            overlay.classList.add('opacity-0', 'invisible');
        }

        // ouvrir via l'icône panier du header
        document.querySelectorAll('[data-open-cart]').forEach(b => b.addEventListener('click', e => { e.preventDefault(); openCart(); }));
        document.getElementById('cart-close')?.addEventListener('click', closeCart);
        document.getElementById('cart-continue')?.addEventListener('click', closeCart);
        overlay?.addEventListener('click', closeCart);
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCart(); });
@if(session('ouvrir_panier'))
    openCart();
@endif
    })();
</script>
<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('page-loader');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 700);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('a[href]').forEach(link => {
            link.addEventListener('click', () => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('http') ||
                    href.startsWith('tel:') || href.startsWith('mailto:') ||
                    link.target === '_blank') return;
                const loader = document.getElementById('page-loader');
                if (loader) { loader.style.display = 'flex'; loader.style.opacity = '1'; }
            });
        });
    });
</script>
<body class="font-sans antialiased bg-bj-creme text-bj-noir">

   {{-- ══════════ HEADER (transparent, superposé au hero) ══════════ --}}
<header class="absolute top-0 left-0 right-0 z-30">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-24 gap-4">

            {{-- nav gauche (desktop) --}}
            <nav class="hidden lg:flex items-center gap-10 flex-1">
                <a href="{{ route('accueil') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('accueil') ? 'text-bj-violet font-medium' : 'text-white' }}">Accueil</a>
                <a href="{{ route('histoire') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('histoire') ? 'text-bj-violet font-medium' : 'text-white' }}">Notre Histoire</a>
            </nav>

            {{-- logo au centre --}}
            <a href="{{ route('accueil') }}" class="shrink-0" aria-label="Blac Joyaux — accueil">
                <img src="{{ asset('images/logo.png') }}" alt="Blac Joyaux" class="h-14 w-auto">
            </a>

            {{-- nav droite (desktop) --}}
            <nav class="hidden lg:flex items-center gap-10 flex-1 justify-end">
                <a href="{{ route('produits.index') }}" class="text-lg transition hover:opacity-70 {{ request()->routeIs('produits.*') ? 'text-bj-violet font-medium' : 'text-white' }}">Collections</a>
                <a href="{{ route('contact') }}" class="text-white text-lg hover:opacity-70 transition">Contact</a>
            </nav>

            {{-- actions --}}
            <div class="flex items-center gap-5 shrink-0 ml-6">
               {{-- recherche --}}
<div x-data="{ ouvert: false }" class="relative">
    <button @click="ouvert = !ouvert" aria-label="Rechercher" class="text-white hover:text-bj-or transition">
        <x-heroicon-o-magnifying-glass class="w-6 h-6" />
    </button>

    <form x-show="ouvert" x-transition method="GET" action="{{ route('produits.index') }}"
          class="absolute right-0 top-10 bg-white rounded-full shadow-lg flex items-center px-4 py-2 w-64 z-50"
          style="display:none;">
        <input type="text" name="recherche" placeholder="Rechercher un sac..."
               value="{{ request('recherche') }}"
               class="flex-1 border-0 focus:ring-0 text-sm text-bj-noir p-0" autofocus>
        <button type="submit" class="text-bj-violet">
            <x-heroicon-o-magnifying-glass class="w-5 h-5" />
        </button>
    </form>
</div>
               <a href="{{ route('panier.index') }}" aria-label="Panier" class="relative text-white hover:text-bj-or transition">
    <x-heroicon-o-shopping-bag class="w-6 h-6" />
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
            </div>

        </div>
    </div>
</header>

{{-- ══════════ TAB BAR MOBILE (fixée en bas, HORS du header) ══════════ --}}
<nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200
            flex justify-around items-center h-16 pb-[env(safe-area-inset-bottom)]">

    <a href="{{ route('accueil') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('accueil') ? 'text-bj-violet' : 'text-bj-noir/70' }}">
        <x-heroicon-o-home class="w-6 h-6" />
        <span class="text-[11px]">Accueil</span>
    </a>

    <a href="{{ route('histoire') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('histoire') ? 'text-bj-violet' : 'text-bj-noir/70' }}">
        <x-heroicon-o-book-open class="w-6 h-6" />
        <span class="text-[11px]">Histoire</span>
    </a>

    <a href="{{ route('produits.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('produits.*') ? 'text-bj-violet' : 'text-bj-noir/70' }}">
        <x-heroicon-o-squares-2x2 class="w-6 h-6" />
        <span class="text-[11px]">Collections</span>
    </a>

    <a href="#" class="flex flex-col items-center gap-0.5 text-bj-noir/70">
        <x-heroicon-o-envelope class="w-6 h-6" />
        <span class="text-[11px]">Contact</span>
    </a>
</nav>

    {{-- ══════════ CONTENU ══════════ --}}
    <main>
        @yield('content')
    </main>

   {{-- ══════════ FOOTER ══════════ --}}
<footer class="bg-bj-violet-dk text-white">
    <div class="max-w-7xl mx-auto px-6 py-14 grid grid-cols-2 md:grid-cols-5 gap-8 items-start">

        {{-- Boutique --}}
        <div>
            <p class="font-display text-xs uppercase tracking-widest text-bj-or mb-4">Boutique</p>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="{{ route('produits.index') }}" class="hover:text-white">Joyau de Bla</a></li>
                <li><a href="{{ route('produits.index') }}" class="hover:text-white">Collection DO</a></li>
                <li><a href="{{ route('produits.capsule') }}" class="hover:text-white">La capsule</a></li>
            </ul>
        </div>

        {{-- La maison --}}
        <div>
            <p class="font-display text-xs uppercase tracking-widest text-bj-or mb-4">La maison</p>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="#" class="hover:text-white">Notre histoire</a></li>
                <li><a href="#" class="hover:text-white">Savoir-faire</a></li>
                <li><a href="#" class="hover:text-white">Showroom</a></li>
                <li><a href="#" class="hover:text-white">Contact</a></li>
            </ul>
        </div>

        {{-- logo au centre --}}
        <div class="flex flex-col items-center col-span-2 md:col-span-1 order-first md:order-none">

{{-- après --}}
<img src="{{ asset('images/logo-off-sf.png') }}" alt="Blac Joyaux" class="h-28 md:h-32 w-auto mb-3">

            <p class="font-serif tracking-widest text-sm">OWN THE FUTURE</p>
        </div>

        {{-- Aide --}}
        <div>
            <p class="font-display text-xs uppercase tracking-widest text-bj-or mb-4">Aide</p>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="{{ route('livraison') }}" class="hover:text-white">Livraison</a></li>
                <li><a href="{{ route('retour') }}" class="hover:text-white">Retours et remboursements</a></li>
                <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                <li><a href="https://wa.me/2250708771557" class="hover:text-white underline" target="_blank">WhatsApp</a></li>
            </ul>
        </div>

        {{-- Nous suivre --}}
        <div>
            <p class="font-display text-xs uppercase tracking-widest text-bj-or mb-4">Nous suivre</p>
            <div class="flex gap-3 mb-5">
                <a href="https://www.facebook.com/blacjoyaux" aria-label="Facebook" class="w-9 h-9 rounded-full border border-bj-or grid place-items-center hover:bg-white/10 transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>
                </a>
                <a href="https://www.instagram.com/blacjoyaux/" aria-label="Instagram" class="w-9 h-9 rounded-full border border-bj-or grid place-items-center hover:bg-white/10 transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                <a href="https://api.whatsapp.com/send/?phone=2250545452215&text=Bonjour+Blac+Joyaux%2C+j%27ai+une+question.&type=phone_number&app_absent=0" aria-label="WhatsApp" class="w-9 h-9 rounded-full border border-bj-or grid place-items-center hover:bg-white/10 transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5-4.5-.2-.2-1.2-1.6-1.2-3s.7-2.1 1-2.4c.2-.3.5-.4.7-.4h.5c.2 0 .4 0 .6.5l.8 2c.1.1.1.3 0 .5l-.4.5-.3.3c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.

                <a href="https://www.tiktok.com/@blac.joyaux" aria-label="TikTok" class="w-9 h-9 rounded-full border border-bj-or grid place-items-center hover:bg-white/10 transition">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M16.5 5.4a4.5 4.5 0 0 1-1.2-3H12v12.3a2.6 2.6 0 1 1-2.6-2.6c.2 0 .5 0 .7.1V9.1a5.8 5.8 0 1 0 5 5.7V9.3a7.5 7.5 0 0 0 4.3 1.4V7.4a4.5 4.5 0 0 1-2.9-2z"/></svg>
                </a>
            </div>
            <div class="flex items-center gap-3 text-xs text-white/70">
                <span class="w-12 h-12 rounded-full border border-bj-or grid place-items-center text-center text-[8px] leading-tight text-bj-or shrink-0">MADE IN CÔTE D'IVOIRE</span>
                <span>Façonné à<br>Abidjan</span>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-5 text-center text-xs text-white/55">
            © {{ date('Y') }} Blac Joyaux. Tous droits réservés. Site réalisé par Black Agency
        </div>
    </div>
</footer>
    {{-- ══════════ WIDGET WHATSAPP FLOTTANT ══════════ --}}
    @include('partials.panier-tiroir')
    @include('partials.whatsapp-widget')

    {{-- ══════════ JS burger + menu mobile ══════════ --}}
    <script>
        document.getElementById('burger')?.addEventListener('click', () => {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
