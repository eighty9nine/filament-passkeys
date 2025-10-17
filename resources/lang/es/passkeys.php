<?php

// translations for EightyNine/Passkeys
return [
    
    /*
    |--------------------------------------------------------------------------
    | Manage Passkeys Page Translations
    |--------------------------------------------------------------------------
    */
    
    'manage' => [
        'title' => 'Administrar tus Passkeys',
        'label' => 'Administrar Passkeys',
        'navigation_label' => 'Passkeys',
        'breadcrumb' => 'Passkeys',
        'description' => 'Administra tus passkeys para autenticación segura',
    ],

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */
    
    'actions' => [
        'add' => 'Agregar Passkey',
        'remove' => 'Eliminar',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'authenticate' => 'Autenticar',
        'register' => 'Registrar Nuevo Passkey',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */
    
    'messages' => [
        'success' => [
            'created' => 'Passkey creado exitosamente.',
            'updated' => 'Passkey actualizado exitosamente.',
            'deleted' => 'Passkey eliminado exitosamente.',
            'authenticated' => 'Autenticación exitosa.',
        ],
        'error' => [
            'creation_failed' => 'Error al crear el passkey.',
            'authentication_failed' => 'Error de autenticación.',
            'not_supported' => 'Los passkeys no son compatibles con este navegador.',
            'max_limit_reached' => 'Número máximo de passkeys alcanzado.',
        ],
        'confirmation' => [
            'delete' => '¿Estás seguro de que quieres eliminar este passkey?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */
    
    'labels' => [
        'name' => 'Nombre',
        'created_at' => 'Creado',
        'last_used' => 'Último Uso',
        'device' => 'Dispositivo',
        'browser' => 'Navegador',
        'status' => 'Estado',
        'active' => 'Activo',
        'inactive' => 'Inactivo',
    ],

    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */
    
    'columns' => [
        'name' => 'Nombre del Passkey',
        'created_at' => 'Creado el',
        'last_used_at' => 'Último Uso',
        'device_info' => 'Dispositivo',
        'credential_id' => 'ID de Credencial',
    ],

    /*
    |--------------------------------------------------------------------------
    | Placeholders
    |--------------------------------------------------------------------------
    */
    
    'placeholders' => [
        'name' => 'Ingresa un nombre para este passkey',
        'no_passkeys' => 'No se encontraron passkeys. Agrega tu primer passkey para comenzar.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Empty State
    |--------------------------------------------------------------------------
    */
    
    'empty_state' => [
        'heading' => 'No se Encontraron Passkeys',
        'description' => 'Comienza creando tu primer passkey para autenticación segura y sin contraseñas.',
    ],

];
