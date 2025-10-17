<?php

namespace EightyNine\Passkeys;

class Passkeys 
{
    /**
     * Get the manage passkeys page configuration
     */
    public static function getManagePasskeysConfig(?string $key = null, mixed $default = null): mixed
    {
        $config = config('filament-passkeys.manage_passkeys', []);
        
        if ($key === null) {
            return $config;
        }
        
        return data_get($config, $key, $default);
    }

    /**
     * Get general passkey settings
     */
    public static function getSettings(?string $key = null, mixed $default = null): mixed
    {
        $settings = config('filament-passkeys.settings', []);
        
        if ($key === null) {
            return $settings;
        }
        
        return data_get($settings, $key, $default);
    }

    /**
     * Get security configuration
     */
    public static function getSecurityConfig(?string $key = null, mixed $default = null): mixed
    {
        $security = config('filament-passkeys.security', []);
        
        if ($key === null) {
            return $security;
        }
        
        return data_get($security, $key, $default);
    }

    /**
     * Check if manage passkeys page is enabled
     */
    public static function isManagePageEnabled(): bool
    {
        return static::getManagePasskeysConfig('enabled', true);
    }

    /**
     * Check if passkey registration is enabled
     */
    public static function isRegistrationEnabled(): bool
    {
        return static::getSettings('enable_registration', true);
    }

    /**
     * Check if passkey authentication is enabled
     */
    public static function isAuthenticationEnabled(): bool
    {
        return static::getSettings('enable_authentication', true);
    }

    /**
     * Get the maximum number of passkeys per user
     */
    public static function getMaxPasskeysPerUser(): int
    {
        $max = static::getSettings('max_passkeys_per_user', 10);
        return max(1, min(50, (int) $max)); // Ensure reasonable limits
    }

    /**
     * Get the passkey timeout in milliseconds
     */
    public static function getPasskeyTimeout(): int
    {
        $timeout = static::getSettings('passkey_timeout', 60000);
        return max(30000, min(300000, (int) $timeout)); // 30s to 5min
    }

    /**
     * Check if user verification is required
     */
    public static function requiresUserVerification(): bool
    {
        return static::getSettings('require_user_verification', false);
    }

    /**
     * Get the authenticator attachment preference
     */
    public static function getAuthenticatorAttachment(): ?string
    {
        $attachment = static::getSettings('authenticator_attachment');
        
        if (!in_array($attachment, ['platform', 'cross-platform', null], true)) {
            return null;
        }
        
        return $attachment;
    }

    /**
     * Validate configuration values
     */
    public static function validateConfiguration(): array
    {
        $errors = [];
        
        // Validate max passkeys
        $maxPasskeys = static::getSettings('max_passkeys_per_user', 10);
        if (!is_int($maxPasskeys) || $maxPasskeys < 1 || $maxPasskeys > 50) {
            $errors[] = 'max_passkeys_per_user must be an integer between 1 and 50';
        }
        
        // Validate timeout
        $timeout = static::getSettings('passkey_timeout', 60000);
        if (!is_int($timeout) || $timeout < 30000 || $timeout > 300000) {
            $errors[] = 'passkey_timeout must be an integer between 30000 and 300000 milliseconds';
        }
        
        // Validate authenticator attachment
        $attachment = static::getSettings('authenticator_attachment');
        if ($attachment !== null && !in_array($attachment, ['platform', 'cross-platform'], true)) {
            $errors[] = 'authenticator_attachment must be null, "platform", or "cross-platform"';
        }
        
        return $errors;
    }

    /**
     * Get all configuration as an array for debugging
     */
    public static function getAllConfig(): array
    {
        return [
            'manage_passkeys' => static::getManagePasskeysConfig(),
            'settings' => static::getSettings(),
            'security' => static::getSecurityConfig(),
            'validation_errors' => static::validateConfiguration(),
        ];
    }
}
