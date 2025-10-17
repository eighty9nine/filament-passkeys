<?php

namespace EightyNine\Passkeys\Concerns;

use EightyNine\Passkeys\Passkeys;

trait HasPasskeysConfig
{
    /**
     * Get manage passkeys configuration
     */
    protected function getManagePasskeysConfig(?string $key = null, mixed $default = null): mixed
    {
        return Passkeys::getManagePasskeysConfig($key, $default);
    }

    /**
     * Get passkey settings
     */
    protected function getPasskeysSettings(?string $key = null, mixed $default = null): mixed
    {
        return Passkeys::getSettings($key, $default);
    }

    /**
     * Get security configuration
     */
    protected function getPasskeysSecurityConfig(?string $key = null, mixed $default = null): mixed
    {
        return Passkeys::getSecurityConfig($key, $default);
    }

    /**
     * Check if manage page is enabled
     */
    protected function isManagePageEnabled(): bool
    {
        return Passkeys::isManagePageEnabled();
    }

    /**
     * Check if registration is enabled
     */
    protected function isRegistrationEnabled(): bool
    {
        return Passkeys::isRegistrationEnabled();
    }

    /**
     * Check if authentication is enabled
     */
    protected function isAuthenticationEnabled(): bool
    {
        return Passkeys::isAuthenticationEnabled();
    }

    /**
     * Get maximum passkeys per user
     */
    protected function getMaxPasskeysPerUser(): int
    {
        return Passkeys::getMaxPasskeysPerUser();
    }

    /**
     * Get passkey timeout
     */
    protected function getPasskeyTimeout(): int
    {
        return Passkeys::getPasskeyTimeout();
    }

    /**
     * Check if user verification is required
     */
    protected function requiresUserVerification(): bool
    {
        return Passkeys::requiresUserVerification();
    }

    /**
     * Get authenticator attachment preference
     */
    protected function getAuthenticatorAttachment(): ?string
    {
        return Passkeys::getAuthenticatorAttachment();
    }
}
