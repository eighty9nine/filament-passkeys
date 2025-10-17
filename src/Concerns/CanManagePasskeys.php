<?php

namespace EightyNine\Passkeys\Concerns;

use EightyNine\Passkeys\Contracts\HasPasskeys;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\LaravelPasskeys\Support\Config;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelPasskeys\Actions\GeneratePasskeyRegisterOptionsAction;
use Spatie\LaravelPasskeys\Actions\StorePasskeyAction;
use Throwable;

trait CanManagePasskeys
{
    public ?array $passkeyFormData = [];

    public function setPasskeyFormData(array $data): void
    {
        $this->passkeyFormData = $data;
    }

    public function storePasskey(string $passkey): void
    {
        $storePasskeyAction = Config::getAction('store_passkey', StorePasskeyAction::class);

        try {
            $storePasskeyAction->execute(
                $this->currentUser(),
                $passkey,
                $this->previouslyGeneratedPasskeyOptions(),
                request()->getHost(),
                ['name' => $this->passkeyFormData['name'] ?? '']
            );
        } catch (Throwable $e) {
            throw ValidationException::withMessages([
                'name' => __('filament-passkeys::passkeys.messages.error.creation_failed'),
            ])->errorBag('passkeyForm');
        }

        Notification::make()
            ->title(__('filament-passkeys::passkeys.messages.success.created'))
            ->success()
            ->send();
    }

    public function deletePasskey(int $passkeyId): void
    {
        $this->currentUser()->passkeys()->where('id', $passkeyId)->delete();
    }

    public function currentUser(): Authenticatable&HasPasskeys
    {
        /** @var Authenticatable&HasPasskeys $user */
        $user = Filament::getCurrentPanel()->auth()->user();

        return $user;
    }

    public function generatePasskeyOptions(): string
    {
        $generatePassKeyOptionsAction = Config::getAction('generate_passkey_register_options', GeneratePasskeyRegisterOptionsAction::class);

        $options = $generatePassKeyOptionsAction->execute($this->currentUser());

        session()->put('passkey-registration-options', $options);

        return $options;
    }

    public function previouslyGeneratedPasskeyOptions(): ?string
    {
        return session()->pull('passkey-registration-options');
    }
}
