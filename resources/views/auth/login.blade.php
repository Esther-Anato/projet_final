<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — Blac Joyaux</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen grid place-items-center p-6"
      style="background: radial-gradient(circle at center, #4A2461 0%, #3D1F4F 100%);">

    <div class="w-full max-w-md">
        {{-- logo --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-blanc.png') }}" alt="Blac Joyaux" class="h-16 w-auto mx-auto mb-3">
            <p class="text-bj-or text-sm tracking-widest uppercase">Espace administration</p>
        </div>

        {{-- carte --}}
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h1 class="font-script text-3xl text-bj-violet-dk text-center mb-6">Connexion</h1>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-2 mb-5 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-bj-noir mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                </div>
                <div>
                    <label class="block text-sm font-medium text-bj-noir mb-1">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                </div>
                <label class="flex items-center gap-2 text-sm text-bj-noir/70">
                    <input type="checkbox" name="remember" class="rounded text-bj-violet focus:ring-bj-violet">
                    Se souvenir de moi
                </label>
                <button type="submit"
                        class="w-full bg-bj-violet text-white font-semibold py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="text-center text-white/50 text-xs mt-6">© {{ date('Y') }} Blac Joyaux</p>
    </div>

</body>
</html>
