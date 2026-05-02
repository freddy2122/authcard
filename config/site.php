<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Identité du site (variables de marque)
    |--------------------------------------------------------------------------
    | Définissez SITE_NAME, SITE_NAME_SHORT, etc. dans .env ou utilisez les défauts.
    */

    'name' => env('SITE_NAME', 'Authen'),

    'name_short' => env('SITE_NAME_SHORT', 'Authentify'),

    /** Texte filigrane (formulaires, fonds) */
    'watermark' => env('SITE_WATERMARK', 'Activate MyCard'),

    /** Lien sortant partenaires / tickets */
    'partner_ticket_url' => env('SITE_PARTNER_TICKET_URL', 'https://cartedirecte.fr/cartes-de-paiement/transcash?'),

    /**
     * Langues disponibles : code ISO => libellé natif (interface sélecteur).
     */
    'locales' => [
        'fr' => 'Français',
        'en' => 'English',
        'es' => 'Español',
        'pt' => 'Português',
        'de' => 'Deutsch',
        'nl' => 'Nederlands',
        'it' => 'Italiano',
    ],

    /** Code langue par défaut si aucune session / paramètre */
    'default_locale' => env('SITE_LOCALE', 'fr'),

    /**
     * Adresse de notification interne (formulaires : copie admin).
     * Par défaut : même expéditeur que MAIL_FROM_ADDRESS si MAIL_ADMIN_ADDRESS est vide.
     */
    'admin_email' => env('MAIL_ADMIN_ADDRESS') ?: env('MAIL_FROM_ADDRESS', 'hello@example.com'),

];
