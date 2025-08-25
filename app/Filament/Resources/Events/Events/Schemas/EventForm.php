<?php

namespace App\Filament\Resources\Events\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required(),
                DateTimePicker::make('starts_at')
                    ->columnStart(1)
                    ->label(__('Starts At'))
                    ->seconds(false)
                    ->required(),
                DateTimePicker::make('ends_at')
                    ->label(__('Ends At'))
                    ->seconds(false)
                    ->required(),
                RichEditor::make('teaser')
                    ->label(__('Teaser'))
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
                Repeater::make('schedule')
                    ->label(__('Schedule'))
                    ->columns()
                    ->schema([
                        TimePicker::make('time')
                            ->label(__('Time'))
                            ->seconds(false)
                            ->required(),
                        TextInput::make('activity')
                            ->label(__('Activity'))
                    ])
                    ->columnSpanFull(),
                TextInput::make('location')
                    ->label(__('Location'))
                    ->placeholder('Address'),
                TextInput::make('registration_url')
                    ->label(__('Registration URL'))
                    ->url(),
                TextInput::make('registration_text')
                    ->label(__('Registration Text'))
                    ->placeholder('Register Now'),
            ]);
    }
}
