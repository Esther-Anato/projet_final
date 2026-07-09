@extends('layouts.admin')

@section('titre', 'Détail commande')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.commandes.index') }}" class="text-bj-violet hover:underline text-sm">← Retour aux commandes</a>

    @if(session('ok'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-2 my-4 text-sm">{{ session('ok') }}</div>
    @endif

    <div class="flex items-center justify-between mt-4 mb-6">
        <h1 class="text-2xl font-bold text-bj-violet-dk">{{ $commande->numero_commande ?? '#'.$commande->id }}</h1>
        <span class="text-sm text-gray-500">{{ $commande->created_at->format('d/m/Y à H:i') }}</span>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        {{-- articles --}}
        <div class="md:col-span-2 bg-white rounded-xl p-6 shadow-sm">
            <h2 class="font-semibold text-bj-violet-dk mb-4">Articles</h2>
            <div class="space-y-3">
                @foreach($commande->lignes as $ligne)
                    <div class="flex justify-between text-sm border-b border-gray-50 pb-3">
                        <span>{{ $ligne->nom_produit }} @if($ligne->couleur_choisie)· {{ $ligne->couleur_choisie }}@endif × {{ $ligne->quantite }}</span>
                        <span class="font-medium">{{ number_format($ligne->total_ligne, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t space-y-1 text-sm">
                <div class="flex justify-between text-gray-500"><span>Sous-total</span><span>{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</span></div>
                <div class="flex justify-between text-gray-500"><span>Livraison</span><span>{{ $commande->frais_livraison > 0 ? number_format($commande->frais_livraison, 0, ',', ' ').' FCFA' : 'Gratuit' }}</span></div>
                <div class="flex justify-between font-bold text-bj-violet-dk text-lg pt-2"><span>Total</span><span>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span></div>
            </div>
        </div>

        {{-- infos + statut --}}
        <div class="space-y-6">
            {{-- changer statut --}}
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="font-semibold text-bj-violet-dk mb-3">Statut</h2>
                <form method="POST" action="{{ route('admin.commandes.statut', $commande) }}">
                    @csrf @method('PATCH')
                    <select name="statut" onchange="this.form.submit()" class="w-full rounded-lg border-gray-300 text-sm">
                        @foreach(['en_attente' => 'En attente', 'confirmee' => 'Confirmée', 'expediee' => 'Expédiée', 'livree' => 'Livrée', 'annulee' => 'Annulée'] as $val => $label)
                            <option value="{{ $val }}" @selected($commande->statut === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            {{-- client --}}
            <div class="bg-white rounded-xl p-6 shadow-sm text-sm">
                <h2 class="font-semibold text-bj-violet-dk mb-3">Client</h2>
                <p>{{ $commande->nom_client }}</p>
                <p class="text-gray-500">{{ $commande->telephone_client }}</p>
                <p class="text-gray-500">{{ $commande->email_client }}</p>
                @if($commande->adresse_livraison)
                    <p class="mt-2 text-gray-500">{{ $commande->adresse_livraison }}, {{ $commande->ville_livraison }}</p>
                @else
                    <p class="mt-2 text-gray-500">Retrait en boutique</p>
                @endif
                <p class="mt-2 text-gray-500">Paiement : {{ str_replace('_', ' ', $commande->mode_paiement) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
