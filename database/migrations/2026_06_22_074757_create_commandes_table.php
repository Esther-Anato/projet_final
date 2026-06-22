<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique()->comment('Ex: BJ-2026-0001');
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->nullOnDelete();

            // --- Coordonnees client ---
            $table->string('nom_client');
            $table->string('telephone_client')->comment('Numero WhatsApp / Mobile Money');
            $table->string('email_client')->nullable();
            $table->string('adresse_livraison');
            $table->string('ville_livraison')->default('Abidjan');

            // --- Montants ---
            $table->unsignedInteger('sous_total');
            $table->unsignedInteger('frais_livraison')->default(0);
            $table->unsignedInteger('total');

            // --- Paiement ---
            $table->enum('mode_paiement', ['mobile_money_wave', 'mobile_money_orange', 'especes_livraison'])
                ->comment('Moyens de paiement acceptes par Blac Joyaux');
            $table->enum('statut_paiement', ['en_attente', 'paye', 'echoue'])->default('en_attente');
            $table->string('reference_paiement')->nullable()->comment('Reference transaction simulee ou CinetPay');

            // --- Statut commande ---
            $table->enum('statut', ['en_attente', 'confirmee', 'en_preparation', 'expediee', 'livree', 'annulee'])
                ->default('en_attente');
            $table->unsignedTinyInteger('livraison_jours_min')->default(1);
            $table->unsignedTinyInteger('livraison_jours_max')->default(3);

            // --- Suivi conversation ---
            $table->boolean('contacte_via_whatsapp')->default(false);
            $table->text('notes')->nullable()->comment('Note client ou message cadeau');

            $table->timestamps();
        });

        Schema::create('lignes_commande', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('produit_id')->nullable()->constrained('produits')->nullOnDelete();
            $table->string('nom_produit')->comment('Copie du nom au moment de la commande');
            $table->string('couleur_choisie')->nullable();
            $table->unsignedInteger('quantite');
            $table->unsignedInteger('prix_unitaire');
            $table->unsignedInteger('total_ligne');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lignes_commande');
        Schema::dropIfExists('commandes');
    }
};
