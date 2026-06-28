<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Où acheter Blac Joyaux ?',
                'reponse' => 'Vous pouvez commander directement sur notre site e-commerce, ou visiter notre showroom à Cocody Palmeraie, Abidjan.',
                'categorie' => 'marque',
                'ordre' => 1,
            ],
            [
                'question' => 'Quels sont les délais de livraison ?',
                'reponse' => 'La livraison se fait sous 1 à 3 jours sur Abidjan. Le délai exact est confirmé par WhatsApp après validation de votre commande.',
                'categorie' => 'livraison',
                'ordre' => 2,
            ],
            [
                'question' => 'Quels moyens de paiement sont acceptés ?',
                'reponse' => 'Nous acceptons le paiement en espèces à la livraison ainsi que le Mobile Money (Wave et Orange Money).',
                'categorie' => 'paiement',
                'ordre' => 3,
            ],
            [
                'question' => 'Quel sac offrir à une jeune cadre ?',
                'reponse' => 'Le Joyau de Bla est notre best-seller, particulièrement apprécié comme cadeau pour son design signature et ses finitions de qualité.',
                'categorie' => 'produit',
                'ordre' => 4,
            ],
            [
                'question' => 'Les sacs Blac Joyaux sont-ils fabriqués en Côte d\'Ivoire ?',
                'reponse' => 'Oui, chaque sac est conçu et fabriqué par des artisans ivoiriens, dans une démarche de valorisation de l\'artisanat local.',
                'categorie' => 'marque',
                'ordre' => 5,
            ],
            [
                'question' => 'Livrez-vous en dehors d\'Abidjan ou à l\'international ?',
                'reponse' => 'Pour le moment, nous priorisons la Côte d\'Ivoire avec Abidjan comme zone principale. La diaspora est une perspective future.',
                'categorie' => 'livraison',
                'ordre' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq + ['est_actif' => true]);
        }
    }
}
