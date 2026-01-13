<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use function Livewire\on;

class ProductResource extends Resource {

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Productos';
    protected static ?string $breadcrumb = 'Productos';
    protected static ?string $modelLabel = 'producto';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form {
        $settings = new GeneralSetting();
        $igv = $settings->igv;
        $igv = $igv/100;

        $exchange = $settings->exchange;

        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('Información general')->schema([
                        Section::make()->schema([
                            TextInput::make('name')->label('Nombre')->live(onBlur: true)->afterStateUpdated(function ($state, Forms\Set $set){
                                $set('meta.title', $state);
                            })->required()->maxLength(255)->columnSpan(5),
                            TextInput::make('plate')->label('Placa')->maxLength(255)->columnSpan(3),
                            TextInput::make('model')->label('Modelo')->maxLength(255)->columnSpan(4),
                            Select::make('category_id')->label('Categoría')->relationship('category', 'name')->columnSpan(4),
                            Select::make('brand_id')->label('Marca')->relationship('brand', 'name')->columnSpan(4),
                            TextInput::make('type')->label('Tipo')->maxLength(255)->columnSpan(4),
                            Group::make()->schema([
                                TextInput::make('year_manufacture')->label('Año de Fabricación')->integer()->maxLength(255),
                                TextInput::make('mileage')->label('Kilometraje')->maxLength(255),
                                TextInput::make('hours')->label('Horas')->maxLength(255),
                                TextInput::make('power')->label('Potencia')->maxLength(255),
                            ])->columns(4)->columnSpanFull(),
                            Group::make()->schema([
                                Toggle::make('is_published')->label('¿Publicar?')->default(true),
                                Toggle::make('is_featured')->label('¿Destacar?')
                            ])->columns(3)->columnSpanFull(),

                            Section::make('Precio en soles')->schema([
                                TextInput::make('pen_price')->prefix('S/')->readOnly()->label('Valor venta en soles')->numeric(),
                                TextInput::make('pen_igv')->prefix('S/')->readOnly()->label('IGV en soles')->numeric(),
                                TextInput::make('pen_final_price')->prefix('S/')->readOnly()->label('Precio de venta en soles')->numeric()
                            ])->columns(3)->columnSpanFull(),

                            Section::make('Precio en dólares')->schema([
                                TextInput::make('dollar_price')->prefix('$')->readOnly()->label('Valor venta en dólares')->numeric(),
                                TextInput::make('dollar_igv')->prefix('$')->readOnly()->label('IGV en dólares')->numeric(),
                                TextInput::make('dollar_final_price')->prefix('$')->label('Precio de venta en dólares')->numeric()->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) use ($igv, $exchange) {
                                        $igv = $igv + 1;

                                        // Se calculan montos en dólares
                                        $dollar_final_price = floatval($state);
                                        $dollar_price = round($dollar_final_price / $igv);
                                        $dollar_igv = $dollar_final_price - $dollar_price;

                                        $set('dollar_igv', $dollar_igv);
                                        $set('dollar_price', $dollar_price);

                                        // Se calculan montos en soles
                                        $pen_final_price = round($dollar_final_price * $exchange);
                                        $pen_price = round($pen_final_price / $igv);
                                        $pen_igv = $pen_final_price - $pen_price;

                                        $set('pen_igv', $pen_igv);
                                        $set('pen_price', $pen_price);
                                        $set('pen_final_price', $pen_final_price);

                                        Notification::make()->body('Los montos se han calculado exitosamente.')->info()->send();
                                    })
                            ])->columns(3)->columnSpanFull(),
                        ])->columns(12)->columnSpanFull(),
                    ]),
                    Tab::make('Fotos')->schema([
                        FileUpload::make('image_1')->disk('web')->label('Imagen 230x190')->preserveFilenames()->image()->optimize('webp'),
                        FileUpload::make('image_2')->disk('web')->label('Imagen 815x450')->preserveFilenames()->image()->optimize('webp'),
                    ]),
                    Tab::make('Datos adicionales')->schema([
                        Forms\Components\Builder::make('content')->collapsible()->label('Contenido adicional')->schema([
                            Forms\Components\Builder\Block::make('general_specifications')->label('Especificaciones generales')->schema([
                                Tabs::make()->schema([
                                    Tab::make('Encabezado')->schema([
                                        TextInput::make('title')->label('Título')->required()->default('Especificaciones Generales'),
                                        FileUpload::make('icon')->label('Icono')->disk('web')->preserveFilenames()->required()->default('icon-specs.png'),
                                    ])->columnSpanFull(),
                                    Tab::make('General')->schema([
                                        Repeater::make('general_specifications')->label('Especificaciones generales')->schema([
                                            TextInput::make('title')->label('Titulo')->required(),
                                            Repeater::make('items')->label('Elementos')->schema([
                                                Group::make()->schema([
                                                    TextInput::make('Nombre'),
                                                    TextInput::make('Valor'),
                                                ])->columns(2)
                                            ])->deletable()->cloneable()
                                        ])->deletable()->cloneable()->defaultItems(1)
                                    ])
                                ])->columnSpanFull(),
                            ]),
                            Forms\Components\Builder\Block::make('vehicle_status')->label('Estado del vehículo')->schema([
                                Forms\Components\Tabs::make()->schema([
                                    Forms\Components\Tabs\Tab::make('Encabezado')->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Título')->default('Estado del vehículo')
                                            ->required(),
                                        Forms\Components\FileUpload::make('icon')
                                            ->label('Icono')
                                            ->disk('web')->default('icon-status.png')
                                            ->preserveFilenames()
                                            ->required(),
                                    ]),
                                    Forms\Components\Tabs\Tab::make('General')->schema([
                                        Forms\Components\Select::make('status')
                                            ->label('Estado')
                                            ->options([
                                                'nuevo' => 'Nuevo'
                                            ]),
                                        Forms\Components\Textarea::make('detail')
                                            ->label('Detalle')
                                            ->columnSpanFull(),
                                        Forms\Components\Section::make('Video')->schema([
                                            Forms\Components\TextInput::make('link_video')
                                                ->url(),
                                        ])->columnSpanFull()
                                    ])
                                ]),
                            ])->columnSpanFull(),
                            Forms\Components\Builder\Block::make('gallery')->label('Galería')->schema([
                                Forms\Components\Tabs::make()->schema([
                                    Forms\Components\Tabs\Tab::make('Encabezado')->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Título')->default('Galería')
                                            ->required(),
                                        Forms\Components\FileUpload::make('icon')
                                            ->label('Icono')
                                            ->disk('web')->default('icon-gallery.png')
                                            ->preserveFilenames()
                                            ->required(),
                                    ]),
                                    Forms\Components\Tabs\Tab::make('General')->schema([
                                        Forms\Components\Textarea::make('detail')
                                            ->label('Detalle'),
                                        Forms\Components\FileUpload::make('gallery')
                                            ->optimize('webp')
                                            ->label('Galería')
                                            ->disk('web')
                                            ->multiple()
                                            ->preserveFilenames()
                                            ->reorderable()
                                    ])
                                ])->columnSpanFull()
                            ])
                        ])->cloneable()
                    ]),
                ])->columnSpanFull(),
                Forms\Components\Section::make('SEO')->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Title'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description'),
                            Forms\Components\TagsInput::make('focus_keywords')
                                ->label('Keywords'),
                            Forms\Components\FileUpload::make('image_url')
                                ->optimize('webp')
                                ->label('Imagen SEO')
                                ->disk('web')
                                ->preserveFilenames()
                                ->reactive()
                        ])->relationship('meta'),
                ])->collapsed()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plate')
                    ->label('Placa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Marca')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pen_final_price')
                    ->label('Precio soles')
                    ->prefix('S/'),
                Tables\Columns\TextColumn::make('dollar_final_price')
                    ->label('Precio dólares')
                    ->prefix('$'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_featured')->label('Destacado?'),
                Tables\Columns\ToggleColumn::make('is_published')->label('Publicado?'),
            ])
            ->filters([
                Filter::make('is_featured')->label('Destacado')->query(fn(Builder $query): Builder => $query->where('is_featured', true)),
                SelectFilter::make('category_id')->label('Categoría')->multiple()->options(Category::all()->pluck('name', 'id')),
                SelectFilter::make('brand_id')->label('Marca')->multiple()->options(Brand::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
