<?php

namespace App\Filament\Resources\Cms;

use App\Concerns\Enums\Positions;
use App\Filament\Resources\Cms;
use App\Filament\Resources\WidgetResource\Pages;
use App\Filament\Resources\WidgetResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms\Components\Builder;
use App\Models\Widget;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WidgetResource extends Resource
{
    protected static ?string $model = Widget::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 34;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->maxLength(255)->label('Nombre')->columns(1),
                    Select::make('parent_position')->label('Sección')
                        ->options([
                            Positions::FOOTER->value => Positions::FOOTER->value,
                        ])->columns(1),
                    Select::make('position')->label('Posición')
                        ->options([
                            Positions::FOOTER_1->value => Positions::FOOTER_1->value,
                            Positions::FOOTER_2->value => Positions::FOOTER_2->value,
                            Positions::FOOTER_3->value => Positions::FOOTER_3->value,
                        ])->columns(1),
                    Builder::make('content')
                        ->label('Contenido')
                        ->blocks([
                            Builder\Block::make('social_icons')
                                ->label('Redes sociales')
                                ->schema([
                                    TextInput::make('title')->label('Título'),
                                ]),
                            Builder\Block::make('editor_texto')
                                ->label('Editor de Texto')
                                ->schema([
                                    RichEditor::make('content')->label('Contenido'),
                                ]),
                            Builder\Block::make('icono_texto_link')
                                ->label('Texto - Icono - Link')
                                ->schema([
                                    Repeater::make('item')->schema([
                                        TextInput::make('texto')->label('Texto'),
                                        TextInput::make('url')->label('Url'),
                                        FileUpload::make('icono')->preserveFilenames()->disk('web')->label('Icono'),
                                    ])->columns(3)
                                ]),
                            Builder\Block::make('menu')
                                ->label('Menú')
                                ->schema([
                                    Select::make('menu_id')->label('Menú')->options(Menu::pluck('name', 'id'))->required(),
                                ]),
                            Builder\Block::make('image')
                                ->label('Imagen')
                                ->schema([
                                    FileUpload::make('image')->label('Imagen')->multiple()->reorderable()->preserveFilenames(),
                                ]),
                        ])->columnSpanFull()
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent_position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Cms\WidgetResource\Pages\ListWidgets::route('/'),
            'create' => Cms\WidgetResource\Pages\CreateWidget::route('/create'),
            'edit' => Cms\WidgetResource\Pages\EditWidget::route('/{record}/edit'),
        ];
    }
}
