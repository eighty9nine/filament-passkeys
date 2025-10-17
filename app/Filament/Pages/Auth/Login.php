<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    
    /**
     * Get the view for the login page
     */
    public function getView(): string
    {
        return 'filament.pages.auth.login';
    }
    
    /**
     * Get the heading for the login page
     */
    public function getHeading(): string
    {
        return 'Welcome Back';
    }
    
    /**
     * Get the subheading for the login page
     */
    public function getSubHeading(): string
    {
        return 'Sign in to your account to continue';
    }
}
