<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->cascadeOnDelete();
            $table->string('session_id')->nullable()->comment('Pour les visiteurs non connectes');
            $table->timestamps();
        });

        Schema::create('lignes_panier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panier_id')->constrained('paniers')->cascadeOnDelete();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->unsignedInteger('quantite')->default(1);
            $table->string('couleur_choisie')->nullable();
            $table->unsignedInteger('prix_unitaire')->comment('Prix au moment de l\'ajout en FCFA');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lignes_panier');
        Schema::dropIfExists('paniers');
    }
};
