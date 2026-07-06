@extends('layouts.public')

@section('title', 'Finaliser votre commande — Blac Joyaux')

@section('content')

    <div class="max-w-6xl mx-auto px-6 pt-28 pb-20">
        <h1 class="font-script text-bj-violet-dk text-5xl text-center mb-12">Finaliser votre commande</h1>

        @if($errors->any())
            <div class="max-w-2xl mx-auto mb-8 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $erreur)<li>{{ $erreur }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php $total = $panier->lignes->sum(fn($l) => $l->prix_unitaire * $l->quantite); @endphp

        <form method="POST" action="{{ route('commandes.enregistrer') }}" class="grid lg:grid-cols-3 gap-8 items-start">
            @csrf

            {{-- ══ FORMULAIRE ══ --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- coordonnées --}}
                <div class="bg-white rounded-2xl p-6">
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Vos coordonnées</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nom complet *</label>
                            <input name="nom_client" value="{{ old('nom_client') }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Téléphone (WhatsApp) *</label>
                            <input name="telephone_client" value="{{ old('telephone_client') }}" required placeholder="+225 ..."
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1">Email (facultatif)</label>
                            <input type="email" name="email_client" value="{{ old('email_client') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                        </div>
                    </div>
                </div>

                {{-- livraison --}}
                <div class="bg-white rounded-2xl p-6">
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Livraison</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1">Adresse / quartier *</label>
                            <input name="adresse_livraison" value="{{ old('adresse_livraison') }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1">Ville *</label>
                            <input name="ville_livraison" value="{{ old('ville_livraison', 'Abidjan') }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">
                            <p class="text-xs text-bj-noir/50 mt-1">Livraison à Abidjan sous 3 à 5 jours. Autres villes de Côte d'Ivoire : 1 à 7 jours.</p>
                        </div>
                    </div>
                </div>

                {{-- paiement --}}
                <div class="bg-white rounded-2xl p-6">
                    <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Mode de paiement</h2>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 border rounded-xl px-4 py-3 cursor-pointer hover:border-bj-violet">
                            <input type="radio" name="mode_paiement" value="mobile_money_orange" class="text-bj-violet focus:ring-bj-violet" @checked(old('mode_paiement')==='mobile_money_orange') required>
                            <span class="font-medium">Orange Money</span>
                        </label>
                        <label class="flex items-center gap-3 border rounded-xl px-4 py-3 cursor-pointer hover:border-bj-violet">
                            <input type="radio" name="mode_paiement" value="mobile_money_wave" class="text-bj-violet focus:ring-bj-violet" @checked(old('mode_paiement')==='mobile_money_wave')>
                            <span class="font-medium">Wave</span>
                        </label>
                        <label class="flex items-center gap-3 border rounded-xl px-4 py-3 cursor-pointer hover:border-bj-violet">
                            <input type="radio" name="mode_paiement" value="especes_livraison" class="text-bj-violet focus:ring-bj-violet" @checked(old('mode_paiement')==='especes_livraison')>
                            <span class="font-medium">Espèces à la livraison</span>
                        </label>
                    </div>
                </div>

                {{-- notes --}}
                <div class="bg-white rounded-2xl p-6">
                    <label class="block font-display font-semibold text-lg text-bj-violet-dk mb-3">Notes (facultatif)</label>
                    <textarea name="notes" rows="2" placeholder="Une précision pour la livraison ?"
                              class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- ══ RÉCAP ══ --}}
            <aside class="bg-white rounded-2xl p-6 lg:sticky lg:top-24">
                <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Votre commande</h2>

                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    @foreach($panier->lignes as $ligne)
                        <div class="flex justify-between gap-2 text-sm">
                            <span class="text-bj-noir/70">{{ $ligne->produit->nom }}
                                @if($ligne->couleur_choisie)<span class="text-bj-noir/40">· {{ $ligne->couleur_choisie }}</span>@endif
                                × {{ $ligne->quantite }}</span>
                            <span class="whitespace-nowrap">{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 flex justify-between font-bold text-bj-violet-dk text-lg">
                    <span>Total</span>
                    <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>

                <button type="submit"
                        class="mt-6 w-full bg-bj-violet text-white font-semibold py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                    Confirmer la commande
                </button>

                <p class="text-xs text-bj-noir/50 mt-4 text-center">
                    Une question ? <a href="https://wa.me/2250708771557" target="_blank" class="text-bj-violet underline">Contactez-nous sur WhatsApp</a>
                </p>
            </aside>
        </form>
    </div>

@endsection
