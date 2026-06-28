<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $joyauDeBla = Collection::where('slug', 'joyau-de-bla')->first();
        $collectionDo = Collection::where('slug', 'collection-do')->first();

        Produit::create([
            'collection_id' => $joyauDeBla->id,
            'nom' => 'Sac Joyau de Bla - Noir',
            'slug' => 'sac-joyau-de-bla-noir',
            'description_courte' => 'Le best-seller Blac Joyaux, orné de la poupée emblématique.',
            'description' => 'Sac à main structuré en cuir, signé de la poupée Joyaux de Bla en finition dorée. Un modèle polyvalent qui s\'accorde à de nombreux styles, du bureau aux sorties habillées.',
            'histoire' => 'Premier modèle de la maison, le Joyau de Bla incarne l\'héritage ashanti revisité avec une élégance contemporaine.',
            'matiere' => 'Cuir pleine fleur',
            'couleur' => 'Noir',
            'variantes_couleur' => ['Noir', 'Camel', 'Léopard'],
            'dimensions' => '30 cm x 22 cm x 12 cm',
            'entretien' => 'Nettoyer avec un chiffon doux et sec. Éviter l\'exposition prolongée au soleil.',
            'usage' => 'quotidien premium',
            'tenue_associee' => 'Tailleur, robe chemise, jean chic',
            'prix' => 85000,
            'est_vedette' => true,
            'est_actif' => true,
            'meta_titre' => 'Sac Joyau de Bla Noir - Maroquinerie ivoirienne premium',
            'meta_description' => 'Sac à main en cuir Joyau de Bla, fabriqué en Côte d\'Ivoire. Pièce signature Blac Joyaux, finitions dorées, héritage ashanti.',
            'mots_cles_seo' => ['sac made in Côte d\'Ivoire', 'maroquinerie ivoirienne', 'sac à main premium Abidjan'],
        ]);

        Produit::create([
            'collection_id' => $joyauDeBla->id,
            'nom' => 'Sac Joyau de Bla - Camel',
            'slug' => 'sac-joyau-de-bla-camel',
            'description_courte' => 'La même icône Blac Joyaux, en camel chaleureux.',
            'description' => 'Sac à main structuré en cuir camel, orné de la poupée Joyaux de Bla. Une teinte chaleureuse qui rehausse les tenues neutres comme colorées.',
            'histoire' => 'Variante camel du modèle signature, pour celles qui veulent un sac passe-partout et lumineux.',
            'matiere' => 'Cuir pleine fleur',
            'couleur' => 'Camel',
            'variantes_couleur' => ['Noir', 'Camel', 'Léopard'],
            'dimensions' => '30 cm x 22 cm x 12 cm',
            'entretien' => 'Nettoyer avec un chiffon doux et sec. Éviter l\'exposition prolongée au soleil.',
            'usage' => 'cadeau',
            'tenue_associee' => 'Tenue casual chic, denim',
            'prix' => 85000,
            'est_vedette' => true,
            'est_actif' => true,
            'meta_titre' => 'Sac Joyau de Bla Camel - Blac Joyaux',
            'meta_description' => 'Sac à main camel en cuir, collection Joyau de Bla. Idéal à offrir à une jeune cadre ivoirienne.',
            'mots_cles_seo' => ['cadeau femme cadre', 'sac chic à offrir', 'sac africain premium'],
        ]);

        Produit::create([
            'collection_id' => $collectionDo->id,
            'nom' => 'Sac DO Compact',
            'slug' => 'sac-do-compact',
            'description_courte' => 'Format compact, idéal pour les essentiels du quotidien.',
            'description' => 'Sac compact de la Collection DO, pensé pour celles qui veulent l\'élégance Blac Joyaux dans un format plus léger.',
            'histoire' => null,
            'matiere' => 'Cuir synthétique haut de gamme',
            'couleur' => 'Brun',
            'variantes_couleur' => ['Brun', 'Noir'],
            'dimensions' => '24 cm x 18 cm x 10 cm',
            'entretien' => 'Nettoyer avec un chiffon humide, laisser sécher à l\'air libre.',
            'usage' => 'quotidien premium',
            'tenue_associee' => 'Tenue de ville décontractée',
            'prix' => 45000,
            'est_vedette' => false,
            'est_actif' => true,
            'meta_titre' => 'Sac DO Compact - Blac Joyaux',
            'meta_description' => 'Sac compact accessible, collection DO Blac Joyaux, maroquinerie ivoirienne.',
            'mots_cles_seo' => ['petit sac à main Abidjan', 'sac compact femme'],
        ]);

        // À ajouter dans ProduitSeeder.php dès réception des infos Création
        $capsule = Collection::where('slug', 'capsule-bureau')->first();

        Produit::create([
            'collection_id'     => $capsule->id,
            'nom'               => '[Nom du sac donné par la Création]',
            'slug'              => '[nom-du-sac-en-minuscules-avec-tirets]',
            'description_courte' => '[Accroche courte]',
            'description'       => '[Description complète]',
            'histoire'          => '[Histoire du modèle]',
            'matiere'           => '[Matière]',
            'couleur'           => '[Couleur principale]',
            'variantes_couleur' => ['[Couleur 1]', '[Couleur 2]'],
            'dimensions'        => '[ex: 35 cm x 25 cm x 10 cm]',
            'entretien'         => '[Conseils entretien]',
            'usage'             => 'bureau',
            'tenue_associee'    => '[Tenue suggérée]',
            'prix'              => 75000, // à adapter
            'est_vedette'       => true,
            'est_actif'         => true,
            'meta_titre'        => '[Titre SEO]',
            'meta_description'  => '[Description SEO]',
            'mots_cles_seo'     => ['sac de bureau femme Abidjan', 'sac bureau made in CI'],
        ]);

        Collection::where('slug', 'capsule-bureau')->update(['est_actif' => true]);
    }
}
