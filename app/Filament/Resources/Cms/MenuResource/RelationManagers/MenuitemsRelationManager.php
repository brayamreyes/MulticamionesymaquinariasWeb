<?php

namespace App\Filament\Resources\Cms\MenuResource\RelationManagers;

use App\Concerns\Enums\Types;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Page;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use http\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MenuitemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menuitems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    Forms\Components\Select::make('item_type')
                        ->label('Tipo de elemento')
                        ->options([
                            Types::PRODUCT->value => 'Categoría de productos',
                            Types::PAGE->value => Types::PAGE->value,
                            Types::CUSTOM->value => Types::CUSTOM->value
                        ])->required()->reactive()->columnSpan(4),
                    Forms\Components\Select::make('item_id')
                        ->label('Elemento')->columnSpan(4)
                        ->required()
                        ->options(
                            function(Forms\Get $get, Forms\Set $set) {
                                $type = $get('item_type');
                                if ($type){
                                    if ($type === Types::PRODUCT->value) {
                                        return Category::all()->pluck('name', 'id');
                                    }
                                    if ($type === Types::PAGE->value) {
                                        return Page::all()->pluck('name', 'id');
                                    }
                                    return [];
                                }
                                return [];
                            }
                        )->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set){
                            if ($get('item_type') === Types::PRODUCT->value) {
                                $set('name', Category::find($get('item_id'))->name);
                                $set('url', Category::find($get('item_id'))->slug);
                            }
                            if ($get('item_type') === Types::PAGE->value) {
                                $set('name', Page::find($get('item_id'))->name);
                                $slug = Page::find($get('item_id'))->slug;
                                $set('url',  ($slug === "/" ? '' : $slug));
                            }
                        })->reactive()->hidden(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value),
                    Forms\Components\TextInput::make('name')->label('Nombre')
                        ->columnSpan(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value ? 8 : 4),
                    Forms\Components\TextInput::make('url')->label('URL')->readOnly()
                        ->prefix(config('app.url') . '/')->columnSpanFull()
                        ->hidden(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value),
                    Forms\Components\TextInput::make('url')
                        ->label('URL')
                        ->columnSpanFull()->hidden(fn (Forms\Get $get) => $get('item_type') !== Types::CUSTOM->value)
                ]),

                Forms\Components\Repeater::make('items')
                    ->label('Elementos hijos')
                    ->relationship('items')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            Forms\Components\Select::make('item_type')
                                ->label('Tipo de elemento')
                                ->options([
                                    Types::PRODUCT->value => 'Categoría de productos',
                                    Types::PAGE->value => Types::PAGE->value,
                                    Types::CUSTOM->value => Types::CUSTOM->value
                                ])->required()->reactive()->columnSpan(4),
                            Forms\Components\Select::make('item_id')
                                ->label('Elemento')->required()
                                ->options(
                                    function(Forms\Get $get) {
                                        $type = $get('item_type');
                                        if ($type){
                                            if ($type === Types::PRODUCT->value) {
                                                return Category::all()->pluck('name', 'id');
                                            }
                                            if ($type === Types::PAGE->value) {
                                                return Page::all()->pluck('name', 'id');
                                            }
                                            return [];
                                        }
                                        return [];
                                    }
                                )->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set){
                                    if ($get('item_type') === Types::PRODUCT->value) {
                                        $set('name', Category::find($get('item_id'))->name);
                                        $set('url', Category::find($get('item_id'))->slug);
                                    }
                                    if ($get('item_type') === Types::PAGE->value) {
                                        $set('name', Page::find($get('item_id'))->name);
                                        $slug = Page::find($get('item_id'))->slug;
                                        $set('url',  ($slug === "/" ? '' : $slug));
                                    }
                                })->reactive()->columnSpan(4)->hidden(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value),
                            Forms\Components\TextInput::make('name')->label('Nombre')
                                ->columnSpan(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value ? 8 : 4),
                            Forms\Components\TextInput::make('url')->label('URL')->readOnly()
                                ->prefix(config('app.url') . '/')->columnSpanFull()
                                ->hidden(fn (Forms\Get $get) => $get('item_type') === Types::CUSTOM->value),
                            Forms\Components\TextInput::make('url')
                                ->label('URL')
                                ->columnSpanFull()->hidden(fn (Forms\Get $get) => $get('item_type') !== Types::CUSTOM->value)
                        ])
                    ])->orderColumn('order')->collapsed()->default([])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order'))
            ->reorderable('order')
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
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
