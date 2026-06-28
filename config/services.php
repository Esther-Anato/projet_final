<?php

return [

    'whatsapp' => [
        'numero' => env('WHATSAPP_NUMBER', '2250700000000'),
        'message_defaut' => env('WHATSAPP_MESSAGE_DEFAUT', 'Bonjour Blac Joyaux, je suis interessee par un produit.'),
    ],

    'paiement' => [
        'mode' => env('PAYMENT_MODE', 'simulated'),
        'cinetpay' => [
            'api_key' => env('CINETPAY_API_KEY'),
            'site_id' => env('CINETPAY_SITE_ID'),
            'secret_key' => env('CINETPAY_SECRET_KEY'),
        ],
    ],

    'livraison' => [
        'jours_min' => env('LIVRAISON_JOURS_MIN', 1),
        'jours_max' => env('LIVRAISON_JOURS_MAX', 3),
    ],

];
