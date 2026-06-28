<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        Collection::create([
            'nom' => 'Joyau de Bla',
            'slug' => 'joyau-de-bla',
            'description' => 'La collection phare de Blac Joyaux, inspirée de la poupée de fécondité ashanti.',
            'histoire' => 'Joyau de Bla puise son nom et son âme dans la poupée de fécondité ashanti, symbole de beauté, d\'héritage et de transmission. Chaque sac porte ce motif identitaire, devenu la signature visuelle de la marque.',
            'est_capsule' => false,
            'est_actif' => true,
            'ordre' => 1,
        ]);

        Collection::create([
            'nom' => 'Collection DO',
            'slug' => 'collection-do',
            'description' => 'Une collection complémentaire, élégante et polyvalente, pensée pour le quotidien premium.',
            'histoire' => null,
            'est_capsule' => false,
            'est_actif' => true,
            'ordre' => 2,
        ]);

        // Placeholder capsule — à activer (est_actif = true) une fois que
        // la filière Création livre les vrais modèles de sacs de bureau.
        Collection::create([
            'nom' => 'Capsule Bureau',
            'slug' => 'capsule-bureau',
            'description' => 'Nouvelle collection capsule 2026 : 2 à 3 sacs de bureau pour la jeune cadre ivoirienne, à offrir ou à s\'offrir.',
            'histoire' => 'En attente du storytelling de la filière Création digitale.',
            'est_capsule' => true,
            'est_actif' => false,
            'ordre' => 0,
        ]);
    }
}
