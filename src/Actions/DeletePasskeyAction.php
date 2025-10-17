<?php

namespace EightyNine\Passkeys\Actions;

use Filament\Tables\Actions\DeleteAction;
use Filament\Notifications\Notification;

class DeletePasskeyAction
{
    public static function make(): DeleteAction
    {
        return DeleteAction::make()
            ->label(__('filament-passkeys::passkeys.actions.remove'))
            ->modalHeading(__('filament-passkeys::passkeys.actions.delete'))
            ->modalDescription(__('filament-passkeys::passkeys.messages.confirmation.delete'))
            ->modalSubmitActionLabel(__('filament-passkeys::passkeys.actions.delete'))
            ->requiresConfirmation()
            ->successNotification(
                Notification::make()
                    ->success()
                    ->title(__('filament-passkeys::passkeys.messages.success.deleted'))
            )
            ->failureNotification(
                Notification::make()
                    ->danger()
                    ->title('Failed to delete passkey')
                    ->body('An error occurred while trying to delete the passkey.')
            );
    }
}
