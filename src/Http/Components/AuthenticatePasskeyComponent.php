<?php

namespace EightyNine\Passkeys\Http\Components;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class AuthenticatePasskeyComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?string $redirect = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        $loginUrl = route(Filament::getCurrentPanel()->generateRouteName('passkeys.login'));
        $authenticationOptionUrl = route(Filament::getCurrentPanel()->generateRouteName('passkeys.authentication_options'));
        if ($this->redirect) {
            Session::put('passkeys.redirect', $this->redirect);
        }

        return view('filament-passkeys::components.authenticate-passkey-component', [
            'loginUrl' => $loginUrl,
            'authenticationOptionUrl' => $authenticationOptionUrl,
        ]);
    }
}
