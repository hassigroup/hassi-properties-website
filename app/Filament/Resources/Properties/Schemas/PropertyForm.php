<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'name'),
                Select::make('community_id')
                    ->relationship('community', 'name'),
                Select::make('developer_id')
                    ->relationship('developer', 'name'),
                Select::make('agent_id')
                    ->relationship('agent', 'name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('listing_type')
                    ->required()
                    ->default('sale'),
                TextInput::make('category')
                    ->required()
                    ->default('ready'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('AED'),
                TextInput::make('bedrooms')
                    ->numeric(),
                TextInput::make('bathrooms')
                    ->numeric(),
                TextInput::make('size_sqft')
                    ->numeric(),
                TextInput::make('floor'),
                TextInput::make('furnishing'),
                TextInput::make('reference_number'),
                TextInput::make('permit_number'),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                Toggle::make('is_featured')
                    ->required(),
                DateTimePicker::make('published_at'),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
            ]);
    }
}
