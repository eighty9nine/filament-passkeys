<?php

namespace EightyNine\Passkeys\Concerns;

use EightyNine\Passkeys\Passkeys;

trait HasPageConfig
{

    use HasPasskeysConfig;

    public static function getNavigationIcon(): ?string
    {
        return Passkeys::getManagePasskeysConfig('navigation_icon');
    }

    public static function getNavigationLabel(): string
    {
        return Passkeys::getManagePasskeysConfig('navigation_label')
            ?? __('filament-passkeys::passkeys.manage.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Passkeys::getManagePasskeysConfig('navigation_group');
    }

    public static function getNavigationSort(): ?int
    {
        return Passkeys::getManagePasskeysConfig('navigation_sort');
    }

    public static function getSlug(): string
    {
        return Passkeys::getManagePasskeysConfig('slug', 'manage-passkeys');
    }

    public static function getCluster(): ?string
    {
        return Passkeys::getManagePasskeysConfig('cluster');
    }

    public function getTitle(): string
    {
        return $this->getManagePasskeysConfig('title')
            ?? __('filament-passkeys::manage_passkeys.title');
    }

    public function getBreadcrumbs(): array
    {
        return [$this->getManagePasskeysConfig('breadcrumb')]
            ?? [__('filament-passkeys::manage_passkeys.breadcrumb')];
    }

    public static function canAccess(): bool
    {
        $configCanAccess = Passkeys::getManagePasskeysConfig('can_access', true);

        if (is_callable($configCanAccess)) {
            return $configCanAccess();
        }

        return (bool) $configCanAccess;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return Passkeys::isManagePageEnabled()
            && Passkeys::getManagePasskeysConfig('show_in_navigation', true)
            && static::canAccess();
    }

    protected function getViewData(): array
    {
        return [
            'settings' => $this->getPasskeysSettings(),
            'security' => $this->getPasskeysSecurityConfig(),
            'maxPasskeys' => $this->getMaxPasskeysPerUser(),
            'timeout' => $this->getPasskeyTimeout(),
            'requiresVerification' => $this->requiresUserVerification(),
            'authenticatorAttachment' => $this->getAuthenticatorAttachment(),
            'registrationEnabled' => $this->isRegistrationEnabled(),
            'authenticationEnabled' => $this->isAuthenticationEnabled(),
        ];
    }
}
