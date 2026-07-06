@extends('layouts.public')

@section('title', 'Commande confirmée — Blac Joyaux')

@section('content')
<div class="max-w-3xl mx-auto px-6 pt-28 pb-20">

    {{-- en-tête succès --}}
    <div class="text-center mb-10">
        <div class="w-20 h-20 rounded-full bg-bj-violet/10 grid place-items-center mx-auto mb-5">
            <x-heroicon-s-check-circle class="w-12 h-12 text-bj-violet" />
        </div>
        <h1 class="font-script text-bj-violet-dk text-5xl mb-3">Merci !</h1>
        <p class="text-bj-noir/70">
            Votre commande <span class="font-semibold text-bj-violet-dk"></span> a bien été enregistrée.
            Nous vous contactons rapidement pour la confirmer.
        </p>
    </div>

    {{-- récap articles --}}
    <div class="bg-white rounded-2xl p-6 mb-6">
        <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Votre commande</h2>
        <div class="space-y-3">
            @foreach($commande->lignes as $ligne)
                <div class="flex justify-between gap-3 text-sm border-b border-gray-50 pb-3">
                    <span class="text-bj-noir/70">
                        {{ $ligne->nom_produit }}
                        @if($ligne->couleur_choisie)<span class="text-bj-noir/40">· {{ $ligne->couleur_choisie }}</span>@endif
                        × {{ $ligne->quantite }}
                    </span>
                    <span class="whitespace-nowrap font-medium">{{ number_format($ligne->total_ligne, 0, ',', ' ') }} FCFA</span>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between font-bold text-bj-violet-dk text-lg pt-4">
            <span>Total</span>
            <span>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
        </div>
    </div>

    {{-- infos livraison + paiement --}}
    <div class="grid sm:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6">
            <h3 class="font-display font-semibold text-bj-violet-dk mb-3">Livraison</h3>
            <p class="text-sm text-bj-noir/70 leading-relaxed">
                {{ $commande->nom_client }}<br>
                {{ $commande->adresse_livraison }}<br>
                {{ $commande->ville_livraison }}<br>
                {{ $commande->telephone_client }}
            </p>
            <p class="text-xs text-bj-noir/50 mt-3">Livraison estimée sous 3 à 5 jours à Abidjan.</p>
        </div>
        <div class="bg-white rounded-2xl p-6">
            <h3 class="font-display font-semibold text-bj-violet-dk mb-3">Paiement</h3>
            <p class="text-sm text-bj-noir/70">
                @php
                    $modes = [
                        'mobile_money_orange' => 'Orange Money',
                        'mobile_money_wave'   => 'Wave',
                        'especes_livraison'   => 'Espèces à la livraison',
                    ];
                @endphp
                {{ $modes[$commande->mode_paiement] ?? $commande->mode_paiement }}
            </p>
            <p class="text-xs text-bj-noir/50 mt-3">Statut : commande en attente de confirmation.</p>
        </div>
    </div>

    {{-- suite --}}
    <div class="bg-bj-violet-dk rounded-2xl p-6 text-center">
        <p class="text-white/90 mb-4">
            Une question sur votre commande ? Écrivez-nous directement sur WhatsApp.
        </p>
        <a href="https://wa.me/2250708771557?text={{ urlencode('Bonjour, je souhaite un suivi pour ma commande #'.$commande->id) }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 bg-bj-wa text-[#0a3d1c] font-semibold px-6 py-3 rounded-full hover:brightness-105 transition">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5-4.5-.2-.2-1.2-1.6-1.2-3s.7-2.1 1-2.4c.2-.3.5-.4.7-.4h.5c.2 0 .4 0 .6.5l.8 2c.1.1.1.3 0 .5l-.4.5-.3.3c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.3.1.5.1.6-.1l.7-.9c.2-.3.4-.2.6-.1l2 .9c.2.1.4.2.4.3.1.2.1.9-.1 1.6z"/></svg>
            Suivre sur WhatsApp
        </a>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('produits.index') }}" class="text-bj-violet underline hover:text-bj-violet-dk">Continuer mes achats</a>
    </div>

</div>
@endsection
