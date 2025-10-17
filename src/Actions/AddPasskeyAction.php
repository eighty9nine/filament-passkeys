<?php

namespace EightyNine\Passkeys\Actions;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddPasskeyAction
{
    protected static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label(__('filament-passkeys::passkeys.columns.name'))
                ->required()
                ->maxLength(255)
                ->placeholder(__('filament-passkeys::passkeys.placeholders.name'))
                ->helperText('Give your passkey a memorable name (e.g., "My iPhone", "Work Laptop")'),
        ];
    }

    protected static function getActionLogic(): \Closure
    {
        return function (array $data, $livewire) {
            try {
                $user = Filament::getCurrentPanel()->auth()->user();
                // Now you can access the page instance
                $pageInstance = $livewire;

                if(method_exists($pageInstance, 'setPasskeyFormData')) {
                    $pageInstance->setPasskeyFormData($data);
                }

                // Example: Call a method on the page
                if (method_exists($pageInstance, 'generatePasskeyOptions')) {
                    $passkeyOptions = $pageInstance->generatePasskeyOptions();
                }

                // Check if user already has maximum number of passkeys
                $maxPasskeys = config('filament-passkeys.max_passkeys_per_user', 10);
                if ($user->passkeys()->count() >= $maxPasskeys) {
                    Notification::make()
                        ->title(__('filament-passkeys::passkeys.messages.error.max_limit_reached'))
                        ->danger()
                        ->send();
                    return;
                }

                // Check if name is already used by this user
                if ($user->passkeys()->where('name', $data['name'])->exists()) {
                    Notification::make()
                        ->title(__('filament-passkeys::passkeys.messages.error.duplicate_name'))
                        ->danger()
                        ->send();
                    return;
                }

                $pageInstance->dispatch('passkeyPropertiesValidated', [
                    'passkeyOptions' => json_decode($passkeyOptions),
                ]);
            } catch (\Exception $e) {
                Notification::make()
                    ->title(__('filament-passkeys::passkeys.messages.error.creation_failed'))
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }
        };
    }

    public static function make(): Action
    {
        return Action::make('add_passkey')
            ->label(__('filament-passkeys::passkeys.actions.add'))
            ->icon('heroicon-o-plus')
            ->color('primary')
            ->modalContent(view('filament-passkeys::modals.add-passkey'))
            ->modalSubmitActionLabel(__('filament-passkeys::passkeys.actions.register'))
            ->form(static::getFormSchema())
            ->action(static::getActionLogic());
    }

    public static function table(): TableAction
    {
        return TableAction::make('add_passkey')
            ->label(__('filament-passkeys::passkeys.actions.add'))
            ->icon('heroicon-o-plus')
            ->color('primary')
            ->modalContent(view('filament-passkeys::modals.add-passkey'))
            ->modalSubmitActionLabel(__('filament-passkeys::passkeys.actions.register'))
            ->form(static::getFormSchema())
            ->action(static::getActionLogic());
    }
}
