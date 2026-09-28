<?php

namespace App\Filament\Resources\Developers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DeveloperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('logo'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('website')
                    ->url(),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
            ]);
    }
}
