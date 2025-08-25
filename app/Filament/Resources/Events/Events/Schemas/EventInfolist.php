<?php

namespace App\Filament\Resources\Events\Events\Schemas;

use Filament\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label(__('Title')),
                TextEntry::make('starts_at')
                    ->label(__('Starts At'))
                    ->dateTime()
                    ->columnStart(1),
                TextEntry::make('ends_at')
                    ->dateTime()
                    ->label(__('Ends At')),
                TextEntry::make('teaser')
                    ->label(__('Teaser'))
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->label(__('Description'))
                    ->html()
                    ->columnSpanFull(),
                RepeatableEntry::make('schedule')
                    ->label(__('Schedule'))
                    ->columns()
                    ->schema([
                        TextEntry::make('time')
                            ->label(__('Time'))
                            ->time('H:i'),
                        TextEntry::make('activity')
                            ->label(__('Activity')),
                    ])
                    ->columnSpanFull(),
                TextEntry::make('location')
                    ->icon('heroicon-o-map-pin')
                    ->label(__('Location')),
                Action::make('register')
                    ->label(fn ($record) => $record->registration_text ?: __('Register Now'))
                    ->url(fn ($record) => $record->registration_url ?: null)
                    ->color('primary')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->visible(fn ($record) => !empty($record->registration_url)),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
