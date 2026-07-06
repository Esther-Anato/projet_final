@extends('layouts.public')

@section('title', 'Finaliser votre commande — Blac Joyaux')

@section('content')
<div class=" bg-bj-violet min-h-screen pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="font-script text-white text-5xl text-center mb-12">Finaliser votre commande</h1>

        @if($errors->any())
            <div class="max-w-2xl mx-auto mb-8 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php $total = $panier->lignes->sum(fn($l) => $l->prix_unitaire * $l->quantite); @endphp

        <form method="POST" action="{{ route('commandes.enregistrer') }}" class="grid lg:grid-cols-3 gap-8 items-start">
            @csrf

            {{-- ══ COLONNE FORMULAIRE ══ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- coordonnées --}}
                <div>
                    <h2 class="text-white font-display font-semibold text-xl mb-4">Coordonnées</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input name="nom_client" value="{{ old('nom_client') }}" required placeholder="Nom complet *"
                               class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or">
                        <input name="telephone_client" value="{{ old('telephone_client') }}" required placeholder="Téléphone (WhatsApp) *"
                               class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or">
                        <input type="email" name="email_client" value="{{ old('email_client') }}" placeholder="E-mail (facultatif)"
                               class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or sm:col-span-2">
                    </div>
                    <p class="text-white/60 text-sm mt-2">Vous validez votre commande en tant qu'invité.</p>
                </div>

                {{-- adresse de livraison --}}
                <div>
                    <h2 class="text-white font-display font-semibold text-xl mb-4">Adresse de livraison</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input name="adresse_livraison" value="{{ old('adresse_livraison') }}" required placeholder="Adresse / quartier *"
                               class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or sm:col-span-2">
                        <input name="ville_livraison" value="{{ old('ville_livraison', 'Abidjan') }}" required placeholder="Ville *"
                               class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or sm:col-span-2">
                    </div>
                    <p class="text-white/60 text-sm mt-2">Abidjan : livraison sous 3 à 5 jours. Autres villes de Côte d'Ivoire : 1 à 7 jours.</p>
                </div>

                {{-- paiement --}}
                <div>
                    <h2 class="text-white font-display font-semibold text-xl mb-4">Mode de paiement</h2>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 bg-white/10 border border-white/20 rounded-xl px-4 py-4 cursor-pointer hover:bg-white/15 transition">
                            <input type="radio" name="mode_paiement" value="mobile_money_orange" required class="text-bj-or focus:ring-bj-or">
                            <span class="text-white font-medium">Orange Money</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/10 border border-white/20 rounded-xl px-4 py-4 cursor-pointer hover:bg-white/15 transition">
                            <input type="radio" name="mode_paiement" value="mobile_money_wave" class="text-bj-or focus:ring-bj-or">
                            <span class="text-white font-medium">Wave</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/10 border border-white/20 rounded-xl px-4 py-4 cursor-pointer hover:bg-white/15 transition">
                            <input type="radio" name="mode_paiement" value="especes_livraison" class="text-bj-or focus:ring-bj-or">
                            <span class="text-white font-medium">
                                Espèces à la livraison
                                <span class="block text-white/50 text-xs font-normal">Vous payez en espèces à la réception de l'article.</span>
                            </span>
                        </label>
                    </div>
                </div>

                {{-- notes --}}
                <div>
                    <textarea name="notes" rows="2" placeholder="Ajouter une note à votre commande (facultatif)"
                              class="w-full rounded-lg border-0 py-3.5 focus:ring-2 focus:ring-bj-or">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- ══ RÉSUMÉ ══ --}}
            <aside class="bg-white rounded-2xl p-6 lg:sticky lg:top-24">
                <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-5">Résumé de la commande</h2>

                <div class="space-y-4 mb-5 max-h-72 overflow-y-auto">
                    @foreach($panier->lignes as $ligne)
                        <div class="flex gap-3">
                            <div class="w-14 h-14 rounded-lg bg-[#ece6dc] overflow-hidden shrink-0">
                                @if($ligne->produit->imagePrincipale())
                                    <img src="{{ $ligne->produit->imagePrincipale()->url }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-bj-noir leading-snug">{{ $ligne->produit->nom }}</p>
                                @if($ligne->couleur_choisie)<p class="text-xs text-bj-noir/50">{{ $ligne->couleur_choisie }}</p>@endif
                                <p class="text-xs text-bj-noir/50">Qté : {{ $ligne->quantite }}</p>
                            </div>
                            <span class="text-sm font-medium whitespace-nowrap">{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 flex justify-between font-bold text-bj-violet-dk text-lg">
                    <span>Total</span>
                    <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>

                <button type="submit" class="mt-6 w-full bg-bj-violet text-white font-semibold py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                    Confirmer la commande
                </button>

                <p class="text-xs text-bj-noir/50 mt-4 text-center">
                    Une question ? <a href="https://wa.me/2250708771557" target="_blank" class="text-bj-violet underline">Contactez-nous sur WhatsApp</a>
                </p>
            </aside>
        </form>
    </div>
</div>
@endsection
