<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Produit;
use Illuminate\View\View;

class PageController extends Controller
{
    public function accueil(): View
    {
        $produitsVedette = Produit::actif()->vedette()->with(['collection', 'images'])->limit(4)->get();
        $produitsCapsule = Produit::actif()->capsule()->with(['collection', 'images'])->limit(3)->get();

        return view('pages.accueil', compact('produitsVedette', 'produitsCapsule'));
    }

    public function faq(): View
    {
        $faqs = Faq::actif()->get()->groupBy('categorie');

        return view('pages.faq', compact('faqs'));
    }
    public function histoire(): View
{
    return view('pages.histoire');
}
}
