<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\ImageProduit;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $joyauDeBla   = Collection::where('slug', 'joyau-de-bla')->first();
        $collectionDo = Collection::where('slug', 'collection-do')->first();
        $wawaAba      = Collection::where('slug', 'wawa-aba')->first();

        // COLLECTION JOYAU DE BLA (14 coloris)

        // ── Joyau de Bla Violet Croco ─────────────────────────────────────
        $sac1 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Violet Croco',
            'slug'               => 'joyau-de-bla-violet-croco',
            'description_courte' => 'Sac iconique Blac Joyaux en cuir effet croco violet, avec la poupée signature en or.',
            'description'        => 'Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Chaque sac est fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir effet croco',
            'couleur'            => 'Violet',
            'variantes_couleur'  => ['Violet', 'Bleu ciel', 'jaune'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'humidité.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Robe de soirée, tailleur, tenue habillée',
            'prix'               => 70000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Violet Croco - Blac Joyaux',
            'meta_description'   => 'Sac à main Joyau de Bla violet croco, fabriqué en Côte d\'Ivoire. Poupée ashanti signature en finition dorée.',
            'mots_cles_seo'      => ['sac violet croco Abidjan', 'sac made in Côte d\'Ivoire', 'maroquinerie ivoirienne premium'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac1->id,
            'chemin'           => 'images/produits/Sac-a-main-Blac-Joyaux-nouvelle-version-croco-maille-violet-petit-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Violet Croco - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Bleu Ciel Croco ─────────────────────────────────
        $sac2 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Bleu Ciel Croco',
            'slug'               => 'joyau-de-bla-bleu-ciel-croco',
            'description_courte' => 'Sac Joyau de Bla en cuir croco bleu ciel, lumineux et élégant.',
            'description'        => 'Le Joyau de Bla Bleu Ciel apporte une touche de fraîcheur et de légèreté. Sa texture croco et sa poupée dorée en font un accessoire qui se remarque.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir effet croco',
            'couleur'            => 'Bleu ciel',
            'variantes_couleur'  => ['Violet', 'Bleu ciel', 'jaune'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'humidité.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue blanche, robe légère, tailleur clair',
            'prix'               => 70000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Bleu Ciel - Blac Joyaux',
            'meta_description'   => 'Sac à main bleu ciel croco Joyau de Bla, maroquinerie ivoirienne Blac Joyaux.',
            'mots_cles_seo'      => ['sac bleu ciel Abidjan', 'sac croco femme CI', 'cadeau femme élégante'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac2->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-croco-bleu-ciel-2-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Bleu Ciel Croco - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Doré ─────────────────────────────────────────────
        $sac3 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Doré',
            'slug'               => 'joyau-de-bla-dore',
            'description_courte' => 'Le Joyau de Bla dans un coloris doré précieux, pour les grandes occasions.',
            'description'        => 'Incarnation ultime du luxe accessible ivoirien, le Joyau de Bla Doré brille de mille feux. Parfait pour les cérémonies, mariages et soirées de prestige.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse finition dorée',
            'couleur'            => 'Doré',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'humidité et les rayures.',
            'usage'              => 'cadeau',
            'tenue_associee'     => 'Tenue de cérémonie, robe de soirée, mariage',
            'prix'               => 50000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Doré - Blac Joyaux',
            'meta_description'   => 'Sac à main doré Joyau de Bla, idéal en cadeau pour une cérémonie ou un mariage.',
            'mots_cles_seo'      => ['sac doré cérémonie Abidjan', 'cadeau mariage femme CI', 'sac luxe ivoirien'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac3->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-Dore-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Doré - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Noir ─────────────────────────────────────────────
        $sac4 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Noir',
            'slug'               => 'joyau-de-bla-noir',
            'description_courte' => 'Le best-seller intemporel de Blac Joyaux, en noir élégant.',
            'description'        => 'Le Joyau de Bla Noir est le modèle le plus apprécié de la maison. Polyvalent et élégant, il s\'accorde à toutes les tenues du bureau à la soirée.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Noir',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tailleur, jean chic, robe chemise',
            'prix'               => 50000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Noir - Blac Joyaux',
            'meta_description'   => 'Sac à main noir Joyau de Bla, best-seller Blac Joyaux, maroquinerie ivoirienne.',
            'mots_cles_seo'      => ['sac noir made in CI', 'maroquinerie ivoirienne', 'sac à main premium Abidjan'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac4->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-noir-bijoux-dore-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Noir - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Orange ───────────────────────────────────────────
        $sac5 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Orange',
            'slug'               => 'joyau-de-bla-orange',
            'description_courte' => 'Le Joyau de Bla dans un orange vibrant et ensoleillé.',
            'description'        => 'Audacieux et chaleureux, le Joyau de Bla Orange apporte une touche de couleur et de joie à n\'importe quelle tenue. Un choix idéal pour se démarquer.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Orange',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue neutre, blanc, beige, jean',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Orange - Blac Joyaux',
            'meta_description'   => 'Sac à main orange Joyau de Bla, pièce audacieuse de la maison Blac Joyaux.',
            'mots_cles_seo'      => ['sac orange femme Abidjan', 'sac coloré made in CI', 'accessoire mode ivoirien'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac5->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-Orange-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Orange - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Rouge ────────────────────────────────────────────
        $sac6 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Rouge',
            'slug'               => 'joyau-de-bla-rouge',
            'description_courte' => 'Le Joyau de Bla en rouge passion, pour une allure affirmée.',
            'description'        => 'Le rouge est la couleur de la confiance et du pouvoir. Le Joyau de Bla Rouge est fait pour les femmes qui savent ce qu\'elles veulent et qui n\'hésitent pas à le montrer.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Rouge',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'cadeau',
            'tenue_associee'     => 'Tenue noire, blanche ou neutre',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Rouge - Blac Joyaux',
            'meta_description'   => 'Sac à main rouge Joyau de Bla, idéal à offrir ou pour une occasion spéciale.',
            'mots_cles_seo'      => ['sac rouge femme CI', 'cadeau femme cadre Abidjan', 'sac africain premium'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac6->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-Rouge-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Rouge - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

                // ── Joyau de Bla Jaune Croco ──────────────────────────────────────
        $sac7 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Jaune Croco',
            'slug'               => 'joyau-de-bla-jaune-croco',
            'description_courte' => 'Sac Joyau de Bla en cuir croco jaune soleil, audacieux et lumineux.',
            'description'        => 'Le Joyau de Bla Jaune Croco est la pièce la plus audacieuse de la collection. Sa couleur jaune soleil et sa texture croco en font un accessoire qui attire tous les regards.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir effet croco',
            'couleur'            => 'Jaune',
            'variantes_couleur'  => ['Violet', 'Bleu ciel', 'Jaune'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'humidité.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue blanche, noire ou neutre',
            'prix'               => 70000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Jaune Croco - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla jaune croco, maroquinerie ivoirienne Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac jaune croco femme CI', 'sac audacieux Abidjan', 'maroquinerie ivoirienne colorée'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac7->id,
            'chemin'           => 'images/produits/Sac_à_main___Nouvelle_version___Croco_Jaune.png',
            'texte_alternatif' => 'Sac Joyau de Bla Jaune Croco - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Peau de Serpent ──────────────────────────────────
        $sac8 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Peau de Serpent',
            'slug'               => 'joyau-de-bla-peau-serpent',
            'description_courte' => 'Sac Joyau de Bla en cuir effet peau de serpent, sauvage et élégant.',
            'description'        => 'Le Joyau de Bla Peau de Serpent est une pièce unique qui mêle héritage africain et audace créative. Sa texture distinctive et ses teintes naturelles camel et brun en font un accessoire statement.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir effet peau de serpent',
            'couleur'            => 'Peau de serpent',
            'variantes_couleur'  => ['Peau de serpent'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'humidité.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue unie pour laisser le sac parler',
            'prix'               => 70000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Peau de Serpent - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla effet peau de serpent, pièce unique Blac Joyaux maroquinerie ivoirienne.',
            'mots_cles_seo'      => ['sac peau serpent femme CI', 'sac exotique Abidjan', 'accessoire luxe ivoirien'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac8->id,
            'chemin'           => 'images/produits/Sac-a-main-Blac-Joyaux-nouvelle-version-peau-serpent-petit-4-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Peau de Serpent - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Rose Saumon ──────────────────────────────────────
        $sac9 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Rose Saumon',
            'slug'               => 'joyau-de-bla-rose-saumon',
            'description_courte' => 'Sac Joyau de Bla rose saumon, doux et féminin.',
            'description'        => 'Le Joyau de Bla Rose Saumon est la version la plus douce et la plus féminine de la collection. Sa teinte rose poudré et sa poupée dorée en font un cadeau idéal.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Rose saumon',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'cadeau',
            'tenue_associee'     => 'Robe légère, tenue estivale, ensemble blanc',
            'prix'               => 40000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Rose Saumon - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla rose saumon, cadeau idéal pour une femme élégante, Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac rose femme CI', 'cadeau femme élégante Abidjan', 'sac féminin made in CI'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac9->id,
            'chemin'           => 'images/produits/Sac-a-main-Blac-Joyaux-nouvelle-version-rose-saumon-petit-3-300x300.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Rose Saumon - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Rouge Vif (J'adore) ─────────────────────────────
        $sac10 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Rouge Vif',
            'slug'               => 'joyau-de-bla-rouge-vif',
            'description_courte' => 'Sac Joyau de Bla rouge vif, pour une femme qui ose.',
            'description'        => 'Le Joyau de Bla Rouge Vif est une déclaration de style. Son rouge intense et sa poupée dorée en font une pièce signature pour les femmes qui veulent affirmer leur personnalité.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Rouge vif',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue noire ou blanche pour un contraste parfait',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Rouge Vif - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla rouge vif, maroquinerie ivoirienne Blac Joyaux.',
            'mots_cles_seo'      => ['sac rouge vif femme CI', 'sac statement Abidjan', 'maroquinerie ivoirienne bold'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac10->id,
            'chemin'           => 'images/produits/Sac-a-main-Blac-Joyaux-nouvelle-version-rouge-jadore-4.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Rouge Vif - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Rose Gold ────────────────────────────────────────
        $sac11 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Rose Gold',
            'slug'               => 'joyau-de-bla-rose-gold',
            'description_courte' => 'Sac Joyau de Bla rose gold nacrée, glamour et raffiné.',
            'description'        => 'Le Joyau de Bla Rose Gold est la pièce la plus glamour de la collection. Sa finition nacrée rose gold et sa poupée dorée en font un accessoire parfait pour les grandes occasions et les cadeaux de prestige.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir nacré',
            'couleur'            => 'Rose gold',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter les rayures sur la finition nacrée.',
            'usage'              => 'cadeau',
            'tenue_associee'     => 'Tenue de soirée, robe de cérémonie, mariage',
            'prix'               => 50000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Rose Gold - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla rose gold nacré, cadeau luxe maroquinerie ivoirienne Blac Joyaux.',
            'mots_cles_seo'      => ['sac rose gold femme CI', 'cadeau luxe femme Abidjan', 'sac cérémonie maroquinerie ivoirienne'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac11->id,
            'chemin'           => 'images/produits/sac-a-main-classique-rose-gold-petit.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Rose Gold - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Rouge Bordeaux ───────────────────────────────────
        $sac12 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Rouge Bordeaux',
            'slug'               => 'joyau-de-bla-rouge-bordeaux',
            'description_courte' => 'Sac Joyau de Bla rouge bordeaux, profond et élégant.',
            'description'        => 'Le Joyau de Bla Rouge Bordeaux allie profondeur et élégance. Sa couleur bordeaux riche et sa poupée dorée en font une pièce sophistiquée parfaite pour toutes les occasions.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Rouge bordeaux',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue noire, beige ou crème',
            'prix'               => 75000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Rouge Bordeaux - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla rouge bordeaux, maroquinerie ivoirienne Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac bordeaux femme CI', 'sac élégant Abidjan', 'maroquinerie ivoirienne premium'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac12->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-Rouge-Bordeaux-4.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Rouge Bordeaux - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Vert ─────────────────────────────────────────────
        $sac13 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Vert',
            'slug'               => 'joyau-de-bla-vert',
            'description_courte' => 'Sac Joyau de Bla vert émeraude, vibrant et naturel.',
            'description'        => 'Le Joyau de Bla Vert apporte la fraîcheur et l\'énergie de la nature. Sa couleur vert émeraude vif et son inscription "Blac Joyaux" en dorée en font une pièce originale et reconnaissable.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Vert',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue blanche, beige ou neutre',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Vert - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla vert émeraude, maroquinerie ivoirienne Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac vert femme CI', 'sac coloré made in CI', 'accessoire mode ivoirien'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac13->id,
            'chemin'           => 'images/produits/Sac-Blac-Joyaux-Vert-4.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Vert - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── Joyau de Bla Jaune Moutarde ───────────────────────────────────
        $sac14 = Produit::create([
            'collection_id'      => $joyauDeBla->id,
            'nom'                => 'Joyau de Bla - Jaune Moutarde',
            'slug'               => 'joyau-de-bla-jaune-moutarde',
            'description_courte' => 'Sac Joyau de Bla jaune moutarde, chaleureux et tendance.',
            'description'        => 'Le Joyau de Bla Jaune Moutarde est une couleur douce et tendance qui s\'accorde à de nombreuses tenues. Sa poupée dorée et son rabat arrondi restent la signature incontournable de la maison.',
            'histoire'           => 'Inspiré de la poupée de fécondité ashanti, le Joyau de Bla est le modèle fondateur de Blac Joyaux. Fabriqué par des artisans ivoiriens à Abidjan.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Jaune moutarde',
            'variantes_couleur'  => ['Doré', 'Noir', 'Orange', 'Rouge', 'Jaune moutarde', 'Rose saumon', 'Rose gold', 'Rouge bordeaux', 'Rouge vif', 'Vert'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Tenue beige, blanche, jean ou kaki',
            'prix'               => 40000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Joyau de Bla Jaune Moutarde - Blac Joyaux',
            'meta_description'   => 'Sac Joyau de Bla jaune moutarde, maroquinerie ivoirienne Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac jaune moutarde femme CI', 'sac tendance Abidjan', 'maroquinerie ivoirienne colorée'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac14->id,
            'chemin'           => 'images/produits/Sac-a-main-Blac-Joyaux-nouvelle-version-jaune-moutarde-petit-1.jpg',
            'texte_alternatif' => 'Sac Joyau de Bla Jaune Moutarde - Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // COLLECTION DO

        // ── DO marron (boucle) ──────────────────────────────────────────────
        $sac15 = Produit::create([
            'collection_id'      => $collectionDo->id,
            'nom'                => 'Sac DO - marron boucle',
            'slug'               => 'sac-do-marron-boucle',
            'description_courte' => 'Sac DO marron vieilli, chic et intemporel.',
            'description'        => 'Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.',
            'histoire'           => 'La Collection DO est la ligne complémentaire de Blac Joyaux, pensée pour accompagner le quotidien premium de la femme ivoirienne moderne.',
            'matiere'            => 'Cuir vieilli',
            'couleur'            => 'Marron',
            'variantes_couleur'  => ['Marron'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon légèrement humide. Laisser sécher à l\'air libre.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Jean, robe décontractée, tenue de ville',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Sac DO marron boucle - Collection DO Blac Joyaux',
            'meta_description'   => 'Sac DO marron boucle, collection DO Blac Joyaux, maroquinerie ivoirienne accessible.',
            'mots_cles_seo'      => ['sac marron boucle femme Abidjan', 'petit sac à main CI', 'sac compact élégant'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac15->id,
            'chemin'           => 'images/produits/sac-do-mixte.jpg',
            'texte_alternatif' => 'Sac DO Camel - Collection DO Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── DO Noir ───────────────────────────────────────────────────────
        $sac16 = Produit::create([
            'collection_id'      => $collectionDo->id,
            'nom'                => 'Sac DO - croco lézard',
            'slug'               => 'sac-do-croco-lezard',
            'description_courte' => 'Sac DO noir , chic et intemporel.',
            'description'        => 'Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.',
            'histoire'           => 'La Collection DO est la ligne complémentaire de Blac Joyaux, pensée pour accompagner le quotidien premium de la femme ivoirienne moderne.',
            'matiere'            => 'Cuir ',
            'couleur'            => 'Noir',
            'variantes_couleur'  => ['Noir','Marron'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Toutes tenues, du casual au chic',
            'prix'               => 70000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Sac DO croco lézard - Collection DO Blac Joyaux',
            'meta_description'   => 'Sac DO croco lézard, collection DO Blac Joyaux, maroquinerie ivoirienne.',
            'mots_cles_seo'      => ['sac noir femme Abidjan', 'sac compact noir CI', 'maroquinerie ivoirienne'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac16->id,
            'chemin'           => 'images/produits/sac-do-noir.jpg',
            'texte_alternatif' => 'Sac DO Noir effet python - Collection DO Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── DO Marron ─────────────────────────────────────────────────────
        $sac17 = Produit::create([
            'collection_id'      => $collectionDo->id,
            'nom'                => 'Sac DO - Marron',
            'slug'               => 'sac-do-marron',
            'description_courte' => 'Sac DO marron vieilli, chaleureux et décontracté.',
            'description'        => 'Parfaits pour toutes les occasions de la vie quotidienne, ces sacs allient style et fonctionnalité. Conçus pour les femmes modernes en quête d’accessoires pratiques, ils conjuguent luxe, éthique et durabilité tout en célébrant notre riche culture africaine.',
            'histoire'           => 'La Collection DO est la ligne complémentaire de Blac Joyaux, pensée pour accompagner le quotidien premium de la femme ivoirienne moderne.',
            'matiere'            => 'Cuir vieilli',
            'couleur'            => 'Marron',
            'variantes_couleur'  => ['Noir', 'Marron'],
            'dimensions'         => '27 cm x 16 cm x 11 cm',
            'entretien'          => 'Nettoyer avec un chiffon légèrement humide. Laisser sécher à l\'air libre.',
            'usage'              => 'quotidien premium',
            'tenue_associee'     => 'Jean, tenue casual, robe décontractée',
            'prix'               => 50000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'Sac DO Marron - Collection DO Blac Joyaux',
            'meta_description'   => 'Sac DO marron vieilli, collection DO Blac Joyaux, maroquinerie ivoirienne accessible.',
            'mots_cles_seo'      => ['sac marron femme Abidjan', 'sac casual made in CI', 'maroquinerie ivoirienne quotidien'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac17->id,
            'chemin'           => 'images/produits/sac-do-marron.jpg',
            'texte_alternatif' => 'Sac DO Marron - Collection DO Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);


        // COLLECTION WAWA ABA

        // ── ALPHA Noir ─────────────────────────────────────────────────────
        $sac18 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'ALPHA - Noir',
            'slug'               => 'alpha-noir',
            'description_courte' => 'Cartable ALPHA noir, sac de bureau moderne.',
            'description'        => 'Porte-documents premium au design contemporain, conçu pour transporter l’essentiel avec élégance. Sa silhouette fine et structurée s’adapte parfaitement au quotidien des professionnels modernes.',
            'histoire'           => 'Pensé pour les hommes qui évoluent entre bureau, entrepreneuriat, rendez-vous et voyages d’affaires, Alpha accompagne chaque journée avec discrétion et assurance.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Noir',
            'variantes_couleur'  => ['Noir', 'Rouge bordeaux', 'Vert '],
            'dimensions'         => '40 cm x 30 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Ranger dans la pochette de protection fournie.',
            'usage'              => 'bureau, réunions professionnelles, Conférences, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur, ensemble professionnel, robe bureau',
            'prix'               => 80000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'ALPHA Noir - Sac de bureau Blac Joyaux',
            'meta_description'   => 'Cartable ALPHA noir, sac de bureau premium Blac Joyaux, made in Côte d\'Ivoire.',
            'mots_cles_seo'      => ['sac de bureau homme Abidjan', 'cartable homme cadre CI', 'sac bureau made in Côte d\'Ivoire', 'cadeau homme cadre'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac18->id,
            'chemin'           => 'images/produits/sac-ALPHA-noir.jpg',
            'texte_alternatif' => 'Cartable ALPHA Noir - Sac de bureau Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── ALPHA Rouge Bordeaux ───────────────────────────────────────────
        $sac19 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'ALPHA - Rouge Bordeaux',
            'slug'               => 'alpha-rouge-bordeaux',
            'description_courte' => 'Cartable ALPHA en rouge bordeaux, sac de bureau moderne.',
            'description'        => 'Porte-documents premium au design contemporain, conçu pour transporter l’essentiel avec élégance. Sa silhouette fine et structurée s’adapte parfaitement au quotidien des professionnels modernes.',
            'histoire'           => 'Pensé pour les hommes qui évoluent entre bureau, entrepreneuriat, rendez-vous et voyages d’affaires, Alpha accompagne chaque journée avec discrétion et assurance.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Rouge bordeaux',
            'variantes_couleur'  => ['Noir', 'Rouge bordeaux', 'Vert'],
            'dimensions'         => '40 cm x 30 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Ranger dans la pochette de protection fournie.',
            'usage'              => 'bureau, réunions professionnelles, Conférences, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur sombre, ensemble professionnel',
            'prix'               => 80000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'ALPHA Rouge Bordeaux - Sac de bureau Blac Joyaux',
            'meta_description'   => 'Cartable ALPHA rouge bordeaux, sac de bureau premium Blac Joyaux Abidjan.',
            'mots_cles_seo'      => ['sac de bureau homme Abidjan', 'cartable homme cadre CI', 'sac bureau made in Côte d\'Ivoire', 'cadeau homme cadre'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac19->id,
            'chemin'           => 'images/produits/sac-ALPHA-rouge.jpg',
            'texte_alternatif' => 'Cartable ALPHA Rouge Bordeaux - Sac de bureau Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── ALPHA Vert ─────────────────────────────────────────────────────
        $sac20 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'ALPHA - Vert',
            'slug'               => 'alpha-vert',
            'description_courte' => 'Cartable ALPHA vert forêt, sac de bureau moderne.',
            'description'        => 'Porte-documents premium au design contemporain, conçu pour transporter l’essentiel avec élégance. Sa silhouette fine et structurée s’adapte parfaitement au quotidien des professionnels modernes.',
            'histoire'           => 'Pensé pour les hommes qui évoluent entre bureau, entrepreneuriat, rendez-vous et voyages d’affaires, Alpha accompagne chaque journée avec discrétion et assurance.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Vert',
            'variantes_couleur'  => ['Noir', 'Rouge bordeaux', 'Vert'],
            'dimensions'         => '40 cm x 30 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Ranger dans la pochette de protection fournie.',
            'usage'              => 'bureau, réunions professionnelles, Conférences, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur beige ou crème, ensemble neutre',
            'prix'               => 80000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'ALPHA Vert - Sac de bureau Blac Joyaux',
            'meta_description'   => 'Cartable ALPHA vert, sac de bureau original Blac Joyaux, made in Côte d\'Ivoire.',
            'mots_cles_seo'      => ['sac de bureau homme Abidjan', 'cartable homme cadre CI', 'sac bureau made in Côte d\'Ivoire', 'cadeau homme cadre'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac20->id,
            'chemin'           => 'images/produits/sac-ALPHA-vert.jpg',
            'texte_alternatif' => 'Cartable ALPHA Vert - Sac de bureau Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── TERRA Beige ───────────────────────────────────────────────────
        $sac21 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'TERRA - Beige',
            'slug'               => 'terra-beige',
            'description_courte' => 'Sac de bureau TERRA beige, intemporel et polyvalent.',
            'description'        => 'Sac de bureau féminin au design structuré, moderne et intemporel, conçu pour allier élégance, praticité et légèreté au quotidien.',
            'histoire'           => 'Pensé pour les femmes actives d’aujourd’hui, Terra accompagne chaque étape de la journée : bureau, rendez-vous, université, entrepreneuriat ou déplacements professionnels.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Beige',
            'variantes_couleur'  => ['Beige', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '38 cm x 28 cm x 13 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec. Éviter l\'exposition prolongée au soleil pour préserver la couleur beige.',
            'usage'              => 'cadeau, bureau,Réunions professionnelles, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur, ensemble professionnel, robe midi',
            'prix'               => 70000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'TERRA Beige - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac tote TERRA beige, collection capsule WAWA ABA Blac Joyaux, made in Côte d\'Ivoire.',
            'mots_cles_seo'      => ['sac tote femme Abidjan', 'grand sac bureau CI', 'sac cadeau femme cadre', 'maroquinerie ivoirienne premium'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac21->id,
            'chemin'           => 'images/produits/sac-TERRA-beige.jpg',
            'texte_alternatif' => 'Sac TERRA Beige - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── TERRA Noir ────────────────────────────────────────────────────
        $sac22 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'TERRA - Noir',
            'slug'               => 'terra-noir',
            'description_courte' => 'Sac de bureau TERRA noir, intemporel et polyvalent.',
            'description'        => 'Sac de bureau féminin au design structuré, moderne et intemporel, conçu pour allier élégance, praticité et légèreté au quotidien.',
            'histoire'           => 'Pensé pour les femmes actives d’aujourd’hui, Terra accompagne chaque étape de la journée : bureau, rendez-vous, université, entrepreneuriat ou déplacements professionnels.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Noir',
            'variantes_couleur'  => ['Beige', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '38 cm x 28 cm x 13 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'cadeau, bureau,Réunions professionnelles, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur, tenue professionnelle, jean chic',
            'prix'               => 70000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'TERRA Noir - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac tote TERRA noir, collection capsule WAWA ABA Blac Joyaux, made in Côte d\'Ivoire.',
            'mots_cles_seo'      => ['grand sac noir bureau Abidjan', 'tote bag femme CI', 'cadeau femme professionnelle'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac22->id,
            'chemin'           => 'images/produits/sac-TERRA-noir.jpg',
            'texte_alternatif' => 'Sac TERRA Noir - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── TERRA Rouge Bordeaux ──────────────────────────────────────────
        $sac23 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'TERRA - Rouge Bordeaux',
            'slug'               => 'terra-rouge-bordeaux',
            'description_courte' => 'Sac de bureau TERRA rouge bordeaux, intemporel et polyvalent.',
            'description'        => 'Sac de bureau féminin au design structuré, moderne et intemporel, conçu pour allier élégance, praticité et légèreté au quotidien.',
            'histoire'           => 'Pensé pour les femmes actives d’aujourd’hui, Terra accompagne chaque étape de la journée : bureau, rendez-vous, université, entrepreneuriat ou déplacements professionnels.',
            'matiere'            => 'Cuir grainé',
            'couleur'            => 'Rouge bordeaux',
            'variantes_couleur'  => ['Beige', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '38 cm x 28 cm x 13 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'cadeau, bureau,Réunions professionnelles, voyages d’affaires, utilisation quotidienne',
            'tenue_associee'     => 'Tailleur beige ou crème, ensemble neutre',
            'prix'               => 70000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'TERRA Rouge Bordeaux - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac tote TERRA rouge bordeaux, cadeau idéal pour une femme cadre ivoirienne.',
            'mots_cles_seo'      => ['sac rouge bureau femme CI', 'cadeau femme cadre Abidjan', 'tote bag rouge bordeaux'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac23->id,
            'chemin'           => 'images/produits/sac-TERRA-rouge.jpg',
            'texte_alternatif' => 'Sac TERRA Rouge Bordeaux - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── AYA Blanc ─────────────────────────────────────────────────────
        $sac24 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'AYA - Blanc',
            'slug'               => 'aya-blanc',
            'description_courte' => 'Sac AYA blanc avec anse bambou, chic et moderne.',
            'description'        => 'Sac à main premium au design minimaliste et structuré, pensé pour offrir une allure raffinée tout en restant léger, confortable et pratique au quotidien.',
            'histoire'           => 'Conçu pour accompagner les femmes dans leurs moments les plus précieux, Aya allie sophistication et praticité. Son design structuré, ses lignes épurées et sa silhouette intemporelle en font un compagnon idéal pour les sorties, les rendez-vous, les cérémonies et les occasions spéciales.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Blanc',
            'variantes_couleur'  => ['Blanc', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '30 cm x 18 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon légèrement humide. Attention aux taches sur le blanc.',
            'usage'              => 'Sorties, restaurants, rendez-vous, cérémonies, occasions spéciales, Utilisation quotidienne, Cadeau',
            'tenue_associee'     => 'Robe légère, tenue estivale, ensemble coloré',
            'prix'               => 60000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'AYA Blanc - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac AYA blanc anse bambou, collection capsule WAWA ABA Blac Joyaux, made in Côte d\'Ivoire.',
            'mots_cles_seo'      => ['sac blanc femme Abidjan', 'sac tendance CI', 'cadeau élégant femme ivoirienne', 'sac anse bambou'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac24->id,
            'chemin'           => 'images/produits/sac-AYA-blanc.jpg',
            'texte_alternatif' => 'Sac AYA Blanc anse bambou - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── AYA Noir ──────────────────────────────────────────────────────
        $sac25 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'AYA - Noir',
            'slug'               => 'aya-noir',
            'description_courte' => 'Sac AYA noir avec anse bambou, chic et moderne.',
            'description'        => 'Sac à main premium au design minimaliste et structuré, pensé pour offrir une allure raffinée tout en restant léger, confortable et pratique au quotidien.',
            'histoire'           => 'Conçu pour accompagner les femmes dans leurs moments les plus précieux, Aya allie sophistication et praticité. Son design structuré, ses lignes épurées et sa silhouette intemporelle en font un compagnon idéal pour les sorties, les rendez-vous, les cérémonies et les occasions spéciales.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Noir',
            'variantes_couleur'  => ['Blanc', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '30 cm x 18 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'Sorties, restaurants, rendez-vous, cérémonies, occasions spéciales, Utilisation quotidienne, Cadeau',
            'tenue_associee'     => 'Toutes tenues, du casual au chic',
            'prix'               => 60000,
            'est_vedette'        => true,
            'est_actif'          => true,
            'meta_titre'         => 'AYA Noir - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac AYA noir anse bambou, collection WAWA ABA Blac Joyaux, maroquinerie ivoirienne.',
            'mots_cles_seo'      => ['sac noir tendance Abidjan', 'sac anse bambou femme CI', 'maroquinerie ivoirienne moderne'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac25->id,
            'chemin'           => 'images/produits/sac-AYA-noir.jpg',
            'texte_alternatif' => 'Sac AYA Noir anse bambou - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

        // ── AYA Rouge Bordeaux ────────────────────────────────────────────
        $sac26 = Produit::create([
            'collection_id'      => $wawaAba->id,
            'nom'                => 'AYA - Rouge Bordeaux',
            'slug'               => 'aya-rouge-bordeaux',
            'description_courte' => 'Sac AYA rouge bordeaux, une pièce à offrir ou à s\'offrir.',
            'description'        => 'Sac à main premium au design minimaliste et structuré, pensé pour offrir une allure raffinée tout en restant léger, confortable et pratique au quotidien.',
            'histoire'           => 'Conçu pour accompagner les femmes dans leurs moments les plus précieux, Aya allie sophistication et praticité. Son design structuré, ses lignes épurées et sa silhouette intemporelle en font un compagnon idéal pour les sorties, les rendez-vous, les cérémonies et les occasions spéciales.',
            'matiere'            => 'Cuir lisse',
            'couleur'            => 'Rouge bordeaux',
            'variantes_couleur'  => ['Blanc', 'Noir', 'Rouge bordeaux'],
            'dimensions'         => '30 cm x 18 cm x 8 cm',
            'entretien'          => 'Nettoyer avec un chiffon doux et sec.',
            'usage'              => 'Sorties, restaurants, rendez-vous, cérémonies, occasions spéciales, Utilisation quotidienne, Cadeau',
            'tenue_associee'     => 'Tenue noire, beige ou crème',
            'prix'               => 60000,
            'est_vedette'        => false,
            'est_actif'          => true,
            'meta_titre'         => 'AYA Rouge Bordeaux - Collection WAWA ABA Blac Joyaux',
            'meta_description'   => 'Sac AYA rouge bordeaux anse bambou, cadeau idéal collection WAWA ABA Blac Joyaux.',
            'mots_cles_seo'      => ['cadeau femme ivoirienne', 'sac rouge bordeaux Abidjan', 'sac tendance made in CI'],
        ]);

        ImageProduit::create([
            'produit_id'       => $sac26->id,
            'chemin'           => 'images/produits/sac-AYA-rouge.jpg',
            'texte_alternatif' => 'Sac AYA Rouge Bordeaux anse bambou - Collection WAWA ABA Blac Joyaux',
            'est_principale'   => true,
            'ordre'            => 0,
        ]);

    }
}
