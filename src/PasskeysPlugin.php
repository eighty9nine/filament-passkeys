<?php

namespace EightyNine\Passkeys;

use EightyNine\Passkeys\Pages\Auth\Login;
use EightyNine\Passkeys\Pages\ManagePasskeys;
use Filament\Contracts\Plugin;
use Filament\Events\ServingFilament;
use Filament\Panel;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class PasskeysPlugin implements Plugin
{
    protected bool $useCustomLogin = false;

    public function getId(): string
    {
        return 'filament-passkeys';
    }

    public function useCustomLogin(bool $condition = true): static
    {
        $this->useCustomLogin = $condition;
        
        return $this;
    }

    public function register(Panel $panel): void
    { 
        Livewire::component('eightynine.passkeys.pages.manage-passkeys', ManagePasskeys::class);
        
        // Register custom login page if enabled
        if ($this->useCustomLogin) {
            $panel->login(Login::class);
        }
        
        if (Passkeys::isManagePageEnabled()) {
            $panel->pages([
                ManagePasskeys::class,
            ]);
        }
        $panel->routes(function () {
            Route::passkeys();
        });

        // Merge this plugin's overrides into Spatie's 'passkeys' config
        $overrides = require __DIR__ . '/../config/filament-passkeys.php';
        if (is_array($overrides) && $overrides !== []) {
            config()->set(
                'passkeys',
                array_replace_recursive(config('passkeys', []), $overrides)
            );
        }
    }

    public function boot(Panel $panel): void
    {            
        Filament::serving(function (ServingFilament $event) {
            $currentPanel = Filament::getCurrentPanel();
            if (! $currentPanel) {
                return;
            }

            // Redirect after login to the current panel's home URL
            config()->set('passkeys.redirect_to_after_login', $currentPanel->getUrl());
            
            // Add component at the end of the login form
            Filament::registerRenderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): string => Blade::render('<x-filament-authenticate-passkey />')
            );
        });
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
