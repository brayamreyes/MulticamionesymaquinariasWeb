<?php

namespace App\Filament\Resources\Cms;

use App\Filament\Resources\Cms;
use App\Filament\Resources\SlideResource\Pages;
use App\Filament\Resources\SlideResource\RelationManagers;
use App\Models\Slide;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';
    protected static ?string $navigationLabel = 'Slides';
    protected static ?string $breadcrumb = 'Slides';
    protected static ?string $modelLabel = 'slide';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción'),
                Tables\Columns\TextColumn::make('slideItems')
                    ->label('Items')
                    ->getStateUsing(function (Slide $record) {
                        return $record->slideItems()->count();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->filters([
                //
            ]);

    }

    public static function getRelations(): array
    {
        return [
            Cms\SlideResource\RelationManagers\SlideItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Cms\SlideResource\Pages\ListSlides::route('/'),
            'create' => Cms\SlideResource\Pages\CreateSlide::route('/create'),
            'edit' => Cms\SlideResource\Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
