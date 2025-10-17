<?php

namespace EightyNine\Passkeys\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;

class Login extends BaseLogin
{
    /**
     * Get the view for the login page
     */
    public function getView(): string
    {
        return 'filament-passkeys::pages.auth.login';
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/login.form.email.label'))
            ->email()
            ->required()
            ->autocomplete("username webauthn")
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }
}
