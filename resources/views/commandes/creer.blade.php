@extends('layouts.public')

@section('title', 'Finaliser votre commande — Blac Joyaux')

@section('content')
<div class="bg-bj-creme min-h-screen pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="font-script text-bj-violet-dk text-5xl text-center mb-2">Finaliser votre commande</h1>
        <p class="text-center text-bj-noir/50 mb-12">Plus qu'une étape avant de recevoir votre Joyaux.</p>

        @if($errors->any())
            <div class="max-w-2xl mx-auto mb-8 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php $total = $panier->lignes->sum(fn($l) => $l->prix_unitaire * $l->quantite); @endphp

        <form method="POST" action="{{ route('commandes.enregistrer') }}"
              x-data="{ mode: 'expedition', paiement: '' }"
              class="grid lg:grid-cols-3 gap-8 items-start">
            @csrf
            <input type="hidden" name="mode_livraison" :value="mode">

            {{-- ══ COLONNE GAUCHE ══ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- COORDONNÉES --}}
                <section class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-9 h-9 rounded-full bg-bj-violet/10 grid place-items-center text-bj-violet">
                            <x-heroicon-o-user class="w-5 h-5" />
                        </span>
                        <h2 class="font-display font-semibold text-lg text-bj-violet-dk">Vos coordonnées</h2>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-bj-noir/70 mb-1">Nom complet *</label>
                            <input name="nom_client" value="{{ old('nom_client') }}" required
                                   class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bj-noir/70 mb-1">Téléphone (WhatsApp) *</label>
                            <input name="telephone_client" value="{{ old('telephone_client') }}" required placeholder="+225 ..."
                                   class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-bj-noir/70 mb-1">E-mail *</label>
                            <input type="email" name="email_client" value="{{ old('email_client') }}" required
                                   class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">
                        </div>
                    </div>
                </section>

                {{-- LIVRAISON --}}
                <section class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-9 h-9 rounded-full bg-bj-violet/10 grid place-items-center text-bj-violet">
                            <x-heroicon-o-truck class="w-5 h-5" />
                        </span>
                        <h2 class="font-display font-semibold text-lg text-bj-violet-dk">Mode de livraison</h2>
                    </div>

                    {{-- choix expédition / retrait --}}
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button type="button" @click="mode='expedition'"
                                :class="mode==='expedition' ? 'border-bj-violet bg-bj-violet/5 ring-1 ring-bj-violet' : 'border-gray-200'"
                                class="flex flex-col items-center gap-2 border-2 rounded-xl py-4 transition">
                            <x-heroicon-o-truck class="w-6 h-6 text-bj-violet" />
                            <span class="font-medium text-sm">Expédition</span>
                            <span class="text-xs text-bj-noir/50">2 000 FCFA</span>
                        </button>
                        <button type="button" @click="mode='retrait'"
                                :class="mode==='retrait' ? 'border-bj-violet bg-bj-violet/5 ring-1 ring-bj-violet' : 'border-gray-200'"
                                class="flex flex-col items-center gap-2 border-2 rounded-xl py-4 transition">
                            <x-heroicon-o-building-storefront class="w-6 h-6 text-bj-violet" />
                            <span class="font-medium text-sm">Retrait en boutique</span>
                            <span class="text-xs text-green-600 font-medium">Gratuit</span>
                        </button>
                    </div>

                    {{-- champs adresse : UNIQUEMENT expédition --}}
                    <div x-show="mode==='expedition'" x-transition class="grid gap-4">
                        <div>
                            <label class="block text-sm font-medium text-bj-noir/70 mb-1">Adresse / quartier *</label>
                            <input name="adresse_livraison" value="{{ old('adresse_livraison') }}"
                                   class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bj-noir/70 mb-1">Ville *</label>
                            <input name="ville_livraison" value="{{ old('ville_livraison', 'Abidjan') }}"
                                   class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">
                        </div>
                        <p class="text-xs text-bj-noir/50 flex items-center gap-1.5">
                            <x-heroicon-o-clock class="w-4 h-4" />
                            Abidjan : 3 à 5 jours · Autres villes de Côte d'Ivoire : 1 à 7 jours.
                        </p>
                    </div>

                    {{-- bloc retrait : UNIQUEMENT retrait --}}
                    <div x-show="mode==='retrait'" x-transition class="bg-bj-creme rounded-xl p-5 flex gap-4" style="display:none;">
                        <x-heroicon-o-map-pin class="w-6 h-6 text-bj-violet shrink-0" />
                        <div>
                            <p class="font-semibold text-bj-violet-dk">Boutique Blac Joyaux · Cocody Palmeraie</p>
                            <p class="text-sm text-bj-noir/60 mt-0.5">Rond-point de la Palmeraie, Abidjan</p>
                            <p class="text-xs text-bj-noir/50 mt-2">Nous vous contactons dès que votre commande est prête à retirer.</p>
                        </div>
                    </div>
                </section>

                {{-- PAIEMENT --}}
                <section class="bg-white rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-9 h-9 rounded-full bg-bj-violet/10 grid place-items-center text-bj-violet">
                            <x-heroicon-o-credit-card class="w-5 h-5" />
                        </span>
                        <h2 class="font-display font-semibold text-lg text-bj-violet-dk">Mode de paiement</h2>
                    </div>

                    <div class="space-y-3">
                        @foreach([
                            ['val' => 'mobile_money_orange', 'nom' => 'Orange Money', 'desc' => 'Paiement mobile Orange'],
                            ['val' => 'mobile_money_wave', 'nom' => 'Wave', 'desc' => 'Paiement mobile Wave'],
                            ['val' => 'especes_livraison', 'nom' => 'Espèces à la livraison', 'desc' => 'Vous payez à la réception'],
                        ] as $mp)
                            <label @click="paiement='{{ $mp['val'] }}'"
                                   :class="paiement==='{{ $mp['val'] }}' ? 'border-bj-violet bg-bj-violet/5 ring-1 ring-bj-violet' : 'border-gray-200'"
                                   class="flex items-center gap-4 border-2 rounded-xl px-4 py-3.5 cursor-pointer transition">
                                <input type="radio" name="mode_paiement" value="{{ $mp['val'] }}" required class="text-bj-violet focus:ring-bj-violet">
                                <div class="flex-1">
                                    <p class="font-medium text-bj-noir">{{ $mp['nom'] }}</p>
                                    <p class="text-xs text-bj-noir/50">{{ $mp['desc'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </section>

                {{-- NOTE --}}
                <section class="bg-white rounded-2xl p-6 shadow-sm">
                    <label class="flex items-center gap-2 font-display font-semibold text-bj-violet-dk mb-3">
                        <x-heroicon-o-pencil-square class="w-5 h-5" /> Note (facultatif)
                    </label>
                    <textarea name="notes" rows="2" placeholder="Une précision pour votre commande ?"
                              class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-bj-violet focus:ring-bj-violet focus:bg-white transition">{{ old('notes') }}</textarea>
                </section>
            </div>

            {{-- ══ RÉSUMÉ (droite) ══ --}}
            <aside class="bg-white rounded-2xl p-6 shadow-sm lg:sticky lg:top-24">
                <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-5">Votre commande</h2>

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

                <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-bj-noir/60">Sous-total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-bj-noir/60">Livraison</span>
                        <span x-text="mode==='retrait' ? 'Gratuit' : '2 000 FCFA'"></span>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-3 mt-3 flex justify-between font-bold text-bj-violet-dk text-lg">
                    <span>Total</span>
                    <span x-text="mode==='retrait' ? '{{ number_format($total, 0, ',', ' ') }} FCFA' : '{{ number_format($total + 2000, 0, ',', ' ') }} FCFA'"></span>
                </div>

                <button type="submit" class="mt-6 w-full bg-bj-violet text-white font-semibold py-4 rounded-full hover:bg-bj-violet-dk transition">
                    Confirmer la commande
                </button>

                <p class="text-xs text-bj-noir/50 mt-4 text-center flex items-center justify-center gap-1.5">
                    <x-heroicon-o-lock-closed class="w-4 h-4" />
                    Vos informations sont sécurisées.
                </p>
            </aside>
        </form>
    </div>
</div>
@endsection
