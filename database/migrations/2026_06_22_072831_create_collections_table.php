<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->comment('Ex: Joyau de Bla, Collection DO, Capsule Bureau');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('histoire')->nullable()->comment('Histoire / heritage racontee');
            $table->string('image')->nullable();
            $table->boolean('est_capsule')->default(false)->comment('true si c\'est la collection capsule du projet');
            $table->boolean('est_actif')->default(true);
            $table->unsignedInteger('ordre')->default(0)->comment('Ordre d\'affichage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
