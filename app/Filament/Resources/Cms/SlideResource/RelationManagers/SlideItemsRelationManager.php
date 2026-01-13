<?php

namespace App\Filament\Resources\Cms\SlideResource\RelationManagers;

use App\Models\SlideItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
class SlideItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'slideItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Builder::make('content')
                        ->blocks([
                            Forms\Components\Builder\Block::make('banner')
                                ->schema([
                                    Forms\Components\FileUpload::make('image')
                                        ->label('Imagen')
                                        ->preserveFilenames()
                                        ->disk('web'),
                                    Forms\Components\Toggle::make('add_image_mobile')
                                        ->label('Añadir imagen mobile')
                                        ->live(),
                                    Forms\Components\FileUpload::make('image_mobile')
                                        ->label('Imagen móvil')
                                        ->preserveFilenames()
                                        ->disk('web')
                                        ->hidden(fn (Get $get) => !$get('add_image_mobile')),
                                ]),
                            Forms\Components\Builder\Block::make('heading')
                                ->schema([
                                    Forms\Components\TextInput::make('heading')
                                        ->label('Título')
                                        ->required(),
                                ]),
                            Forms\Components\Builder\Block::make('button')
                                ->schema([
                                    Forms\Components\TextInput::make('text')
                                        ->label('Texto de botón')
                                        ->required(),
                                    Forms\Components\TextInput::make('link')
                                        ->label('Enlace de botón')
                                        ->required(),
                                ])->columns(2),
                        ]),
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Imagen')->width('100%')->disk('web')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
