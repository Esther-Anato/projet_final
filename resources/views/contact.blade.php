@extends('layouts.public')

@section('title', 'Contact - Blac Joyaux')

@section('content')
<section class="bg-bj-creme min-h-screen">

    {{-- Hero --}}
    <div class="bg-bj-violet text-bj-creme py-16 px-6 text-center">
        <p class="font-script text-3xl md:text-4xl text-bj-or mb-2" style="font-family: 'Great Vibes', cursive;">L'avenir en main</p>
        <h1 class="font-display text-3xl md:text-5xl font-semibold" style="font-family: 'Bricolage Grotesque', sans-serif;">
            Contactez-nous
        </h1>
        <p class="mt-4 font-secondary text-bj-creme/80 max-w-xl mx-auto" style="font-family: 'Questrial', sans-serif;">
            Une question sur un modèle, une commande, une visite au showroom ? Écrivez-nous.
        </p>
    </div>

    <div class="max-w-5xl mx-auto px-6 py-12 grid md:grid-cols-2 gap-10">

        {{-- Formulaire --}}
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5" style="font-family: 'Inter', sans-serif;">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-bj-violet mb-1">Nom complet</label>
                    <input type="text" name="nom" value="{{ old('nom') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet"
                        required>
                    @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-bj-violet mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet"
                        required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-bj-violet mb-1">Téléphone (optionnel)</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                </div>

                <div>
                    <label class="block text-sm font-medium text-bj-violet mb-1">Message</label>
                    <textarea name="message" rows="5"
                        class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet"
                        required>{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-bj-violet text-bj-creme font-medium py-3 rounded-lg hover:bg-bj-violet/90 transition">
                    Envoyer le message
                </button>
            </form>
        </div>

        {{-- Infos + showroom --}}
        <div class="space-y-6" style="font-family: 'Inter', sans-serif;">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="font-display text-xl text-bj-violet mb-3" style="font-family: 'Bricolage Grotesque', sans-serif;">
                    Showroom
                </h2>
                <p class="text-gray-600">Cocody Palmeraie, Abidjan</p>
                <p class="text-gray-600 mt-1">Livraison sous 1 à 3 jours</p>
                <p class="text-gray-600 mt-1">Paiement : Espèces, Orange Money, Wave</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="font-display text-xl text-bj-violet mb-3" style="font-family: 'Bricolage Grotesque', sans-serif;">
                    Réponse rapide
                </h2>
                <p class="text-gray-600 mb-4">Pour une réponse immédiate, écrivez-nous directement sur WhatsApp.</p>
                <a href="https://wa.me/2250000000000" target="_blank"
                    class="inline-flex items-center gap-2 bg-green-500 text-white px-5 py-2.5 rounded-lg hover:bg-green-600 transition">
                    Discuter sur WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
