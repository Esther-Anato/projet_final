<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('collections')->cascadeOnDelete();

            //  Identite produit
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('description_courte')->nullable()->comment('Resume pour les cartes produit');
            $table->text('description')->nullable()->comment('Description complete, fiche produit');
            $table->text('histoire')->nullable()->comment('Histoire courte du modele');

            //  Caracteristiques
            $table->string('matiere')->nullable();
            $table->string('couleur')->nullable()->comment('Couleur principale');
            $table->json('variantes_couleur')->nullable()->comment('Liste des variantes disponibles');
            $table->string('dimensions')->nullable()->comment('Ex: 30cm x 22cm x 12cm');
            $table->string('entretien')->nullable()->comment('Conseils d\'entretien');

            //  Usage / occasion
            $table->string('usage')->nullable()->comment('Ex: cadeau, bureau, quotidien premium');
            $table->string('tenue_associee')->nullable()->comment('Tenue suggeree avec ce sac');

            //  Prix
            $table->unsignedInteger('prix')->comment('Prix en FCFA');
            $table->unsignedInteger('prix_barre')->nullable()->comment('Prix barre si promotion');

            //  Statut catalogue
            // Pas de stock : on ne fait pas de decompte de quantite pour ce prototype.
            // L'appartenance a la capsule se lit via collection.est_capsule, pas de
            // colonne dupliquee ici.
            $table->boolean('est_vedette')->default(false)->comment('Best-seller / mis en avant');
            $table->boolean('est_actif')->default(true);

            //  SEO / AI-First
            $table->string('meta_titre')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('mots_cles_seo')->nullable()->comment('Ex: ["sac de bureau femme Abidjan"]');

            $table->unsignedInteger('nb_vues')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
