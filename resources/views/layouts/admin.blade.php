<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Blac Joyaux</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bj-creme min-h-screen font-sans">

    <div class="flex min-h-screen">
        {{-- sidebar --}}
        <aside class="w-64 bg-bj-violet-dk text-white flex flex-col shrink-0">
            <div class="px-6 py-6 border-b border-white/10">
                <img src="{{ asset('images/logo-blanc.png') }}" alt="Blac Joyaux" class="h-12 w-auto mx-auto">
                <p class="text-center text-xs text-bj-or tracking-widest mt-2 uppercase">Espace Admin</p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('admin.produits.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.produits.*') ? 'bg-white/10 text-bj-or' : 'text-white/80 hover:bg-white/5' }}">
                    <x-heroicon-o-shopping-bag class="w-5 h-5" /> Produits
                </a>
                <a href="{{ route('admin.commandes.index') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.commandes.*') ? 'bg-white/10 text-bj-or' : 'text-white/80 hover:bg-white/5' }}">
    <x-heroicon-o-clipboard-document-list class="w-5 h-5" /> Commandes
</a>
                <a href="{{ route('accueil') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/5 transition">
                    <x-heroicon-o-globe-alt class="w-5 h-5" /> Voir le site
                </a>
            </nav>
            <div class="px-4 py-6 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/5 transition w-full">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" /> Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- contenu --}}
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-gray-200 px-8 h-16 flex items-center justify-between">
                <h1 class="font-display font-semibold text-bj-violet-dk">@yield('titre', 'Administration')</h1>
                <span class="text-sm text-bj-noir/60">Bonjour, {{ auth()->user()->name ?? 'Admin' }}</span>
            </header>
            <main class="flex-1 p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
