<?php

namespace App\Filament\Resources\CMS\FormResource\RelationManagers;

use App\Concerns\Enums\Types;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FieldsRelationManager extends RelationManager {

    protected static string $relationship = 'fields';
    protected static ?string $title = 'Campos';

    public function form(Form $form): Form {
        return $form
            ->schema([
                Section::make('Datos del campo')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('name')->label('Nombre')->columnSpanFull()->required(),
                        Select::make('type')->options([
                            Types::TEXT->value => Types::TEXT->value,
                            Types::TEXTAREA->value => Types::TEXTAREA->value,
                            Types::SELECT->value => Types::SELECT->value,
                            Types::PRODUCT_SELECT->value => Types::PRODUCT_SELECT->value,
                            Types::CHECKBOX->value => Types::CHECKBOX->value,
                            Types::EMAIL->value => Types::EMAIL->value,
                            Types::CELLPHONE->value => Types::CELLPHONE->value,
                            Types::COUNTRY->value => Types::COUNTRY->value,
                            Types::FILE->value => Types::FILE->value,
                            Types::DNI->value => Types::DNI->value,
                            Types::RUC->value => Types::RUC->value,
                            Types::DATE->value => Types::DATE->value,
                            Types::SEPARATOR_TITLE->value => Types::SEPARATOR_TITLE->value,
                        ])->label('Tipo')->live()->columnSpan(4)->required(),
                        Select::make('size')->label('Tamaño')->columnSpan(4)->options([
                            3 => "1/3",
                            4 => "1/4",
                            6 => "1/2",
                            12 => "Full",
                        ])->required(),
                        Toggle::make('required')->label('Requerido?')->columnSpan(4)->inline(false),
                        TagsInput::make('options')->label('Opciones')->columnSpanFull()->reorderable()->hidden(fn(Forms\Get $get) => $get('type') !== Types::SELECT->value),
                        Repeater::make('link')->columns(2)->schema([
                            TextInput::make('initial_text')->label('Texto inicial')->columnSpanFull(),
                            TextInput::make('text')->label('Texto de link'),
                            TextInput::make('url')->label('URL'),
                        ])->label('Enlace')
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->columnSpanFull()
                            ->hidden(fn(Forms\Get $get) => $get('type') !== Types::CHECKBOX->value),
                    ])
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->label('Nombre'),
                TextColumn::make('type')->label('Tipo'),
                IconColumn::make('required')->label('Requerido')->boolean(),
                ToggleColumn::make('show')->label('Mostrar')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Crear'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
