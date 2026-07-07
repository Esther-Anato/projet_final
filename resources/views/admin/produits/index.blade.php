@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-bj-violet-dk">Gestion des produits</h1>
        <a href="{{ route('admin.produits.creer') }}"
           class="bg-bj-violet text-white font-semibold px-5 py-2.5 rounded-full hover:bg-bj-violet-dk transition">
            + Ajouter un produit
        </a>
    </div>

    @if(session('ok'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-2 mb-6 text-sm">{{ session('ok') }}</div>
    @endif

    <div class="bg-white rounded-xl overflow-hidden shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-500">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Collection</th>
                    <th class="px-4 py-3">Prix</th>
                    <th class="px-4 py-3">Actif</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($produits as $produit)
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $produit->nom }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $produit->collection->nom ?? '—' }}</td>
                        <td class="px-4 py-3">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $produit->est_actif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $produit->est_actif ? 'Oui' : 'Non' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.produits.editer', $produit) }}" class="text-bj-violet hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.produits.supprimer', $produit) }}" class="inline ml-3"
                                  onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Aucun produit pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $produits->links() }}</div>
</div>
@endsection
