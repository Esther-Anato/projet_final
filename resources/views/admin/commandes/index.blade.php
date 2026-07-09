@extends('layouts.admin')

@section('titre', 'Commandes')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-bj-violet-dk">Commandes</h1>
    </div>

    @if(session('ok'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-2 mb-6 text-sm">{{ session('ok') }}</div>
    @endif

    {{-- filtres par statut --}}
    @php
        $statuts = ['' => 'Toutes', 'en_attente' => 'En attente', 'confirmee' => 'Confirmées', 'expediee' => 'Expédiées', 'livree' => 'Livrées', 'annulee' => 'Annulées'];
    @endphp
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach($statuts as $val => $label)
            <a href="{{ route('admin.commandes.index', $val ? ['statut' => $val] : []) }}"
               class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('statut') === $val || (!request('statut') && $val === '') ? 'bg-bj-violet text-white' : 'bg-white text-bj-noir border border-gray-200 hover:border-bj-violet' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-xl overflow-hidden shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="px-4 py-3">N° commande</th>
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($commandes as $commande)
                    @php
                        $couleurs = [
                            'en_attente' => 'bg-yellow-100 text-yellow-700',
                            'confirmee'  => 'bg-blue-100 text-blue-700',
                            'expediee'   => 'bg-purple-100 text-purple-700',
                            'livree'     => 'bg-green-100 text-green-700',
                            'annulee'    => 'bg-red-100 text-red-700',
                        ];
                    @endphp
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $commande->numero_commande ?? '#'.$commande->id }}</td>
                        <td class="px-4 py-3">{{ $commande->nom_client }}</td>
                        <td class="px-4 py-3">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2.5 py-1 rounded-full {{ $couleurs[$commande->statut] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $commande->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.commandes.afficher', $commande) }}" class="text-bj-violet hover:underline">Détails</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Aucune commande.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $commandes->links() }}</div>
</div>
@endsection
