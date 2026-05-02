<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Montants — authentification ticket
    |--------------------------------------------------------------------------
    */
    'ticket_amounts' => [
        '20' => '20 €',
        '50' => '50 €',
        '100' => '100 €',
        '150' => '150 €',
        '200' => '200 €',
        '250' => '250 €',
        '500' => '500 €',
    ],

    /*
    |--------------------------------------------------------------------------
    | Types de carte prépayée (authentification & remboursement)
    |--------------------------------------------------------------------------
    */
    'card_types' => [
        'transcash' => 'Transcash',
        'pcs' => 'PCS',
        'neosurf' => 'Neosurf',
        'apple_card' => 'Apple Card',
        'giftcard' => 'GiftCard',
        'google_play' => 'Google Play',
        'paysafecard' => 'PaySafeCard',
        'neocash' => 'NeoCash',
        'steam' => 'Steam',
        'cash_ticket' => 'Cash Ticket',
        'toneo' => 'Toneo',
        'itunes' => 'iTunes',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pays — formulaire remboursement (liste complète ISO + entrée « Autre »)
    | Fichier généré depuis ICU : php scripts/build_countries.php
    |--------------------------------------------------------------------------
    */
    'countries' => array_merge(
        require __DIR__.'/countries_fr.php',
        [
            'AUTRE' => 'Autre',
        ]
    ),

];
