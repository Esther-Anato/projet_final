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


        Collection::create([
            'nom' => 'Wawa Aba',
            'slug' => 'wawa-aba',
            'description' => 'Le symbole Wawa Aba provient des Adinkra d’Afrique de l’Ouest. Il représente la graine du Wawa, reconnue pour être robuste malgré sa petite taille.',
            'histoire' => 'Pour Blac Joyaux, la collection Wawa Aba symbolise les femmes et les hommes modernes qui avancent avec assurance, sans avoir besoin d’en faire trop pour être remarqués.',
            'est_capsule' => true,
            'est_actif' => true,
            'ordre' => 0,
        ]);
    }
}
