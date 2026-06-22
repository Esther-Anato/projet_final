<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verifie_le')->nullable();
            $table->string('mot_de_passe');
            $table->string('telephone')->nullable()->comment('Numero Mobile Money / WhatsApp du client');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('reinitialisation_mdp', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
        Schema::dropIfExists('reinitialisation_mdp');
    }
};
