<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class AdminCommandeController extends Controller
{
    public function index(Request $request)
    {
        $requete = Commande::latest();

        // filtre par statut
        if ($request->filled('statut')) {
            $requete->where('statut', $request->statut);
        }

        $commandes = $requete->paginate(20)->withQueryString();

        return view('admin.commandes.index', compact('commandes'));
    }

    public function afficher(Commande $commande)
    {
        $commande->load('lignes');
        return view('admin.commandes.afficher', compact('commande'));
    }

    public function changerStatut(Request $request, Commande $commande)
    {
        $valide = $request->validate([
            'statut' => ['required', 'in:en_attente,confirmee,expediee,livree,annulee'],
        ]);

        $commande->update(['statut' => $valide['statut']]);

        return back()->with('ok', 'Statut mis à jour.');
    }
}
