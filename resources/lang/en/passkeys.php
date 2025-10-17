<?php

// translations for EightyNine/Passkeys
return [
    
    /*
    |--------------------------------------------------------------------------
    | Manage Passkeys Page Translations
    |--------------------------------------------------------------------------
    */
    
    'manage' => [
        'title' => 'Manage Your Passkeys',
        'label' => 'Manage Passkeys',
        'navigation_label' => 'Passkeys',
        'breadcrumb' => 'Passkeys',
        'description' => 'Manage your passkeys for secure authentication',
    ],

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */
    
    'actions' => [
        'add' => 'Add Passkey',
        'remove' => 'Delete',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'authenticate' => 'Authenticate',
        'register' => 'Register New Passkey',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'authencticate_using_passkey' => 'Use Passkey'
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */
    
    'messages' => [
        'success' => [
            'created' => 'Passkey created successfully.',
            'updated' => 'Passkey updated successfully.',
            'deleted' => 'Passkey deleted successfully.',
            'authenticated' => 'Authentication successful.',
            'stored' => 'Passkey has been successfully registered and stored.',
        ],
        'error' => [
            'creation_failed' => 'Failed to create passkey.',
            'authentication_failed' => 'Authentication failed.',
            'not_supported' => 'Passkeys are not supported in this browser.',
            'max_limit_reached' => 'Maximum number of passkeys reached.',
            'storage_failed' => 'Failed to store passkey data.',
            'duplicate_name' => 'A passkey with this name already exists.',
            'invalid_data' => 'Invalid passkey data provided.',
        ],
        'confirmation' => [
            'delete' => 'Are you sure you want to delete this passkey?',
        ],
        'info' => [
            'storing_passkey' => 'Storing passkey for user: :user_id',
            'error_storing_passkey' => 'Error storing passkey for user: :user_id',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */
    
    'labels' => [
        'name' => 'Name',
        'created_at' => 'Created',
        'last_used' => 'Last Used',
        'device' => 'Device',
        'browser' => 'Browser',
        'status' => 'Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */
    
    'columns' => [
        'name' => 'Passkey Name',
        'created_at' => 'Created At',
        'last_used_at' => 'Last Used',
        'device_info' => 'Device',
        'credential_id' => 'Credential ID',
    ],

    /*
    |--------------------------------------------------------------------------
    | Placeholders
    |--------------------------------------------------------------------------
    */
    
    'placeholders' => [
        'name' => 'Enter a name for this passkey',
        'no_passkeys' => 'No passkeys found. Add your first passkey to get started.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Empty State
    |--------------------------------------------------------------------------
    */
    
    'empty_state' => [
        'heading' => 'No Passkeys Found',
        'description' => 'Get started by creating your first passkey for secure, passwordless authentication.',
    ],

];
