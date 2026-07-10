@extends('layouts.public-solid')

@section('title', 'Commande confirmée — Blac Joyaux')

@section('content')
<div class="bg-bj-creme min-h-screen pt-28 pb-20">
    <div class="max-w-3xl mx-auto px-6">

        {{-- en-tête succès --}}
        <div class="text-center mb-10">
            <div class="w-20 h-20 rounded-full bg-bj-violet/10 grid place-items-center mx-auto mb-5">
                <x-heroicon-s-check-circle class="w-12 h-12 text-bj-violet" />
            </div>
            <h1 class="font-script text-bj-violet-dk text-5xl mb-3">Merci !</h1>
            <p class="text-bj-noir/70">
                Votre commande <span class="font-semibold text-bj-violet-dk">{{ $commande->numero_commande ?? '#'.$commande->id }}</span>
                a bien été enregistrée. Nous vous contactons rapidement pour la confirmer.
            </p>
        </div>

        {{-- ══ BLOC LIVRAISON vs RETRAIT ══ --}}
        @if($commande->mode_livraison === 'retrait')
            {{-- RETRAIT --}}
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-10 h-10 rounded-full bg-bj-violet/10 grid place-items-center text-bj-violet">
                        <x-heroicon-o-building-storefront class="w-6 h-6" />
                    </span>
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk">Retrait en boutique</h2>
                </div>

                {{-- étapes retrait --}}
                <div class="bg-bj-creme rounded-xl p-5 mb-4">
                    <div class="flex gap-3">
                        <x-heroicon-o-map-pin class="w-6 h-6 text-bj-violet shrink-0" />
                        <div>
                            <p class="font-semibold text-bj-violet-dk">Boutique Blac Joyaux · Cocody Palmeraie</p>
                            <p class="text-sm text-bj-noir/60 mt-0.5">Rond-point de la Palmeraie, Abidjan</p>
                            <p class="text-sm text-bj-noir/60">Ouvert du lundi au samedi, 09h – 18h</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-3 text-sm text-bj-noir/70">
                    <x-heroicon-o-bell-alert class="w-5 h-5 text-bj-or-dk shrink-0 mt-0.5" />
                    <p>Nous vous enverrons un message dès que votre commande est <strong>prête à être retirée</strong>. Présentez votre numéro de commande en boutique.</p>
                </div>
            </div>
        @else
            {{-- LIVRAISON --}}
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-10 h-10 rounded-full bg-bj-violet/10 grid place-items-center text-bj-violet">
                        <x-heroicon-o-truck class="w-6 h-6" />
                    </span>
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk">Livraison à domicile</h2>
                </div>

                <div class="bg-bj-creme rounded-xl p-5 mb-4">
                    <p class="text-sm text-bj-noir/70 leading-relaxed">
                        <span class="font-semibold text-bj-noir">{{ $commande->nom_client }}</span><br>
                        {{ $commande->adresse_livraison }}<br>
                        {{ $commande->ville_livraison }}<br>
                        {{ $commande->telephone_client }}
                    </p>
                </div>

                <div class="flex items-start gap-3 text-sm text-bj-noir/70">
                    <x-heroicon-o-clock class="w-5 h-5 text-bj-or-dk shrink-0 mt-0.5" />
                    <p>Livraison estimée sous <strong>3 à 5 jours</strong> à Abidjan. Nous vous contactons pour convenir de la remise.</p>
                </div>
            </div>
        @endif

        {{-- ══ RÉCAP ARTICLES ══ --}}
        <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm">
            <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Récapitulatif</h2>
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
            <div class="pt-4 space-y-1.5 text-sm">
                <div class="flex justify-between text-bj-noir/60">
                    <span>Sous-total</span><span>{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="flex justify-between text-bj-noir/60">
                    <span>Livraison</span>
                    <span>{{ $commande->frais_livraison > 0 ? number_format($commande->frais_livraison, 0, ',', ' ').' FCFA' : 'Gratuit' }}</span>
                </div>
                <div class="flex justify-between font-bold text-bj-violet-dk text-lg pt-2 border-t border-gray-100 mt-2">
                    <span>Total</span><span>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>

        {{-- ══ PAIEMENT ══ --}}
        <div class="bg-white rounded-2xl p-6 mb-8 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <x-heroicon-o-credit-card class="w-5 h-5 text-bj-violet" />
                <h3 class="font-display font-semibold text-bj-violet-dk">Paiement</h3>
            </div>
            @php
                $modes = [
                    'mobile_money_orange' => 'Orange Money',
                    'mobile_money_wave'   => 'Wave',
                    'especes_livraison'   => 'Espèces à la livraison',
                ];
            @endphp
            <p class="text-sm text-bj-noir/70">{{ $modes[$commande->mode_paiement] ?? $commande->mode_paiement }}</p>
            <p class="text-xs text-bj-noir/50 mt-1">Statut : en attente de confirmation.</p>
        </div>

        {{-- ══ SUIVI WHATSAPP ══ --}}
        <div class="bg-bj-violet-dk rounded-2xl p-6 text-center">
            <p class="text-white/90 mb-4">Une question sur votre commande ? Écrivez-nous sur WhatsApp.</p>
            <a href="https://wa.me/2250708771557?text={{ urlencode('Bonjour, un suivi pour ma commande '.($commande->numero_commande ?? '#'.$commande->id)) }}"
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
</div>
{{-- ══ CONTACTER LE SERVICE CLIENT ══ --}}
@if(in_array($commande->statut, ['en_attente', 'confirmee']))
    <div class="mt-6 text-center">
        <p class="text-sm text-bj-noir/60 mb-3">Besoin de modifier ou d'annuler votre commande ?</p>
        <a href="https://wa.me/2250708771557?text={{ urlencode('Bonjour, je vous contacte au sujet de ma commande '.($commande->numero_commande ?? '#'.$commande->id).'.') }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 border border-bj-violet text-bj-violet font-medium px-6 py-3 rounded-full hover:bg-bj-violet hover:text-white transition">
            <x-heroicon-o-chat-bubble-left-right class="w-5 h-5" />
            Contacter le service client
        </a>
        <p class="text-xs text-bj-noir/40 mt-3">
            Notre équipe est disponible pour toute demande concernant votre commande.
        </p>
    </div>
@elseif($commande->statut === 'annulee')
    <div class="mt-6 text-center">
        <span class="inline-flex items-center gap-2 bg-red-50 text-red-600 font-medium px-6 py-3 rounded-full">
            <x-heroicon-o-x-circle class="w-5 h-5" />
            Cette commande a été annulée
        </span>
    </div>
@endif
@endsection
