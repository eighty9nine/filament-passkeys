<?php

namespace Eightynine\Passkeys\Pages;

use EightyNine\Passkeys\Concerns\CanManagePasskeys;
use EightyNine\Passkeys\Concerns\HasPageConfig;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use EightyNine\Passkeys\Actions\AddPasskeyAction;
use EightyNine\Passkeys\Actions\DeletePasskeyAction;

class ManagePasskeys extends Page implements HasTable
{
    use InteractsWithTable;
    use HasPageConfig;
    use CanManagePasskeys;

    protected static string $view = 'filament-passkeys::pages.manage-passkeys';

    protected function getHeaderActions(): array
    {
        return [
            AddPasskeyAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn()=>$this->currentUser()->passkeys())
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-passkeys::passkeys.columns.name')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('filament-passkeys::passkeys.columns.created_at')),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeletePasskeyAction::make(),
            ])
            ->bulkActions([
                // ...
            ])
            ->emptyStateHeading(__('filament-passkeys::passkeys.empty_state.heading'))
            ->emptyStateDescription(__('filament-passkeys::passkeys.empty_state.description'))
            ->emptyStateActions([
                AddPasskeyAction::table(),
            ]);
    }
}
