<?php

// config for EightyNine/Passkeys
return [

    /*
    |--------------------------------------------------------------------------
    | Manage Passkeys Page Configuration
    |--------------------------------------------------------------------------
    |
    | These settings control the appearance and behavior of the Manage Passkeys
    | page in Filament.
    |
    */

    'manage_passkeys' => [
        'enabled' => true,
        'label' => 'Manage Passkeys',
        'plural_label' => 'Manage Passkeys',
        'title' => 'Manage Your Passkeys',
        'navigation_icon' => 'heroicon-o-key',
        'navigation_label' => 'Passkeys',
        'navigation_group' => 'Security',
        'navigation_sort' => 10,
        'slug' => 'manage-passkeys',
        'cluster' => null,
        'breadcrumb' => 'Passkeys',
        'can_access' => true,
        'show_in_navigation' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Passkey Settings
    |--------------------------------------------------------------------------
    |
    | General settings for passkey functionality
    |
    */

    'settings' => [
        'enable_registration' => true,
        'enable_authentication' => true,
        'max_passkeys_per_user' => 10,
        'passkey_timeout' => 60000, // milliseconds
        'require_user_verification' => false,
        'authenticator_attachment' => null, // 'platform', 'cross-platform', or null
    ],

    /*
    |--------------------------------------------------------------------------
    | View Configuration
    |--------------------------------------------------------------------------
    |
    | Customize the view and layout settings
    |
    */

    'views' => [
        'manage_passkeys' => 'filament-passkeys::pages.manage-passkeys',
        'layout' => null, // Custom layout if needed
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Configure security-related options
    |
    */

    'security' => [
        'rate_limit' => [
            'attempts' => 5,
            'decay_minutes' => 15,
        ],
        'require_confirmation' => false,
        'log_activities' => true,
    ],

];
