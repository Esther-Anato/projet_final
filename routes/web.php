<?php

use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ImageProduitController;
use Illuminate\Support\Facades\Route;

// ── Routes publiques ──────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/notre-histoire', [PageController::class, 'histoire'])->name('histoire');
Route::view('/politique-retour', 'pages.retour')->name('retour');
Route::view('/conditions-livraison', 'pages.livraison')->name('livraison');
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Catalogue
Route::get('/boutique', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/boutique/capsule', [ProduitController::class, 'capsule'])->name('produits.capsule');
Route::get('/boutique/{produit}', [ProduitController::class, 'afficher'])->name('produits.afficher');
// routes/web.php
Route::get('/collections/{collection}', [ProduitController::class, 'afficherCollection'])
    ->name('collections.afficher');
// Panier public (visiteur invité via session)
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier', [PanierController::class, 'ajouter'])
    ->middleware('throttle:panier')
    ->name('panier.ajouter');
Route::patch('/panier/{lignePanier}', [PanierController::class, 'modifier'])->name('panier.modifier');
Route::delete('/panier/{lignePanier}', [PanierController::class, 'supprimer'])->name('panier.supprimer');

// ── Routes protégées (connexion obligatoire) ──────────────────────────────


    // Commande
    Route::get('/commande', [CommandeController::class, 'creer'])
        ->name('commandes.creer');
    Route::post('/commande', [CommandeController::class, 'enregistrer'])
        ->middleware('throttle:commandes')
        ->name('commandes.enregistrer');
    Route::get('/commande/{commande}/confirmation', [CommandeController::class, 'confirmation'])
        ->name('commandes.confirmation');

    // Images produit
    Route::post('/produits/{produit}/images', [ImageProduitController::class, 'enregistrer'])
        ->name('images.enregistrer');
    Route::delete('/images/{imageProduit}', [ImageProduitController::class, 'supprimer'])
        ->name('images.supprimer');

use App\Http\Controllers\Admin\AdminProduitController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/produits', [AdminProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/creer', [AdminProduitController::class, 'creer'])->name('produits.creer');
    Route::post('/produits', [AdminProduitController::class, 'enregistrer'])->name('produits.enregistrer');
    Route::get('/produits/{produit}/editer', [AdminProduitController::class, 'editer'])->name('produits.editer');
    Route::put('/produits/{produit}', [AdminProduitController::class, 'modifier'])->name('produits.modifier');
    Route::delete('/produits/{produit}', [AdminProduitController::class, 'supprimer'])->name('produits.supprimer');
});
require __DIR__.'/auth.php';
