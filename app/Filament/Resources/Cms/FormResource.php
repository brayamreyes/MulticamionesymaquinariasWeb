<?php

namespace App\Filament\Resources\CMS;

use App\Filament\Resources\CMS\FormResource\Pages;
use App\Filament\Resources\CMS\FormResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormResource extends Resource
{
    protected static ?string $model = \App\Models\Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $label = 'Formulario';
    protected static ?string $modelLabel = 'formulario';
    protected static ?int $navigationSort = 33;
    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Section::make('Datos de formulario')->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('name')->label('Nombre')->columnSpan(6)->required(),
                        TextInput::make('text_button')->label('Texto de botón')->columnSpan(6)->required(),
                        Section::make('Mensaje de gracias')->schema([
                            Repeater::make('thanks_message')->columns(12)->schema([
                                TextInput::make('title')->required()->label('Título')->columnSpan(8),
                                TextInput::make('text_button')->required()->label('Texto de botón')->columnSpan(4),
                                RichEditor::make('content')->required()->label('Contenido')->columnSpanFull(),
                            ])->label('Mensaje de gracias')->required()->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->columnSpanFull()
                        ])->collapsed()->collapsible()
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\FieldsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
