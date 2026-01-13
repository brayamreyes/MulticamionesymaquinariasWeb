<?php

namespace App\Filament\Resources\Cms;

use App\Concerns\Enums\Types;
use App\Filament\Resources\Cms\PageResource\Pages;
use App\Filament\Resources\Cms\PageResource\RelationManagers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Slide;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Get;

class PageResource extends Resource {

    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Páginas';
    protected static ?string $breadcrumb = 'Páginas';
    protected static ?string $modelLabel = 'página';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 3,
                    'xl' => 12,
                    '2xl' => 12
                ])->schema([
                    Section::make('Bloques')->compact()->schema([
                        Builder::make('content')->blockPickerColumns(3)->label('Bloques')
                            ->blocks([
                                Block::make('slider')->label('Slider')->schema([
                                    Select::make('slider')->label('Slider')->options(Slide::all()->pluck('name', 'id'))->columnSpanFull()
                                ]),

                                Block::make('products-search')->label('Buscador de productos')->schema([
                                    ColorPicker::make('background')->label('Color de fondo')->default('#F0F0F0')
                                ]),
                                Block::make('products')->label('Productos')->schema([
                                    Select::make('category_id')->label('Categoría')->options(Category::all()->pluck('name', 'id'))->columnSpan(1),
                                    Select::make('brand_id')->label('Marca')->options(Brand::all()->pluck('name', 'id'))->columnSpan(1),
                                    ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull(),
                                    Toggle::make('show_search')->label('Mostrar buscador')->columnSpanFull(),
                                ])->columns(2),

                                Block::make('search-results')->label('Resultados de búsqueda')->schema([
                                    ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')
                                ]),

                                Block::make('posts')->label('Artículos')->schema([
                                    ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull(),
                                ]),
                                Block::make('title_description')->label('Bloque de título y descripción')->schema([
                                    TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                    Forms\Components\Textarea::make('description')->label('Descripción')->columnSpanFull(),
                                ]),
                                Block::make('block-1')->label('Bloques con íconos')->schema([
                                    ColorPicker::make('background')->label('Color de fondo')->default('#F0F0F0')->columnSpanFull(),
                                    Repeater::make('items')->schema([
                                        Tabs::make()->tabs([
                                            Tab::make('Contenido')->schema([
                                                Grid::make([
                                                    'default' => 1,
                                                    'sm' => 3,
                                                    'xl' => 12,
                                                    '2xl' => 12
                                                ])->schema([
                                                    TextInput::make('text-button')->label('Texto en botón')->required()->columnSpan(4),
                                                    TextInput::make('url')->label('URL')->required()->columnSpan(8),
                                                    TextInput::make('content')->label('Texto complementario')->required()->columnSpanFull(),
                                                ])
                                            ]),
                                            Tab::make('Ícono')->schema([
                                                FileUpload::make('icon')->label('Icono')->disk('web')->required()->columnSpanFull(),
                                            ]),
                                        ])
                                    ])->collapsed()->cloneable()->deletable()->columnSpanFull()
                                ]),

                                Block::make('categories')->label('Categorías de productos')->schema([
                                    ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull()
                                ]),

                                Block::make('featured-products')->label('Productos destacados')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                        ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull(),
                                        TextInput::make('text-button')->label('Texto de botón')->columnSpan(4),
                                        TextInput::make('url')->label('URL de botón')->columnSpan(8),
                                    ])
                                ]),

                                Block::make('news')->label('Bloque de novedades')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                        TextInput::make('text-button')->label('Texto en botón')->required()->columnSpan(4),
                                        TextInput::make('url')->label('URL')->required()->columnSpan(8),
                                        ColorPicker::make('background')->label('Color de fondo')->default('#F0F0F0')->columnSpanFull()
                                    ])
                                ]),

                                Block::make('slogan')->label('Bloque de slogan')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                        TextInput::make('text-button')->label('Texto en botón')->required()->columnSpan(4),
                                        TextInput::make('url')->label('URL')->required()->columnSpan(8),
                                        ColorPicker::make('background')->label('Color de fondo')->default('#326BD6')->columnSpanFull()
                                    ])
                                ]),
                                Block::make('block_steps')->label('Bloque de pasos')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        Tabs::make()->tabs([
                                            Tab::make('Contenido')->schema([
                                                TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                                ColorPicker::make('background')->label('Color de fondo')->default('#FFFFFF')->columnSpanFull(),
                                                Toggle::make('agregar_aviso')->label('¿Añadir aviso?')->live()->columnSpanFull(),
                                                Toggle::make('add_separator')->label('¿Añadir separador?')->live()->columnSpanFull(),
                                                Section::make('Alerta')->schema([
                                                    FileUpload::make('icon')->disk('web')->label('Icono')->required()->columnSpanFull(),
                                                    Forms\Components\Textarea::make('text')->label('Texto')->columnSpanFull(),
                                                ])->hidden(fn (Get $get) => !$get('agregar_aviso')),
                                            ]),
                                            Tab::make('Elementos')->schema([
                                                Repeater::make('items')->schema([
                                                    Grid::make([
                                                        'default' => 1,
                                                        'sm' => 3,
                                                        'xl' => 12,
                                                        '2xl' => 12
                                                    ])->schema([
                                                        FileUpload::make('icon')->disk('web')->label('Icono')->required()->columnSpanFull(),
                                                        TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                                        Forms\Components\Textarea::make('description')->label('Descripción')->columnSpanFull(),
                                                    ]),
                                                ])->collapsed()->cloneable()->deletable()->columnSpanFull()
                                            ]),
                                        ])->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('mision_vision')->label('Bloque de misión y visión')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                       Tabs::make()->tabs([
                                            Tab::make('Contenido')->schema([
                                                TextInput::make('embed')->url()->label('URL de YouTube')->required()->columnSpanFull(),
                                            ]),
                                           Tab::make('Elementos')->schema([
                                               Repeater::make('items')->schema([
                                                   TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                                   Forms\Components\Textarea::make('description')->label('Descripción')->required()->columnSpanFull(),
                                                   FileUpload::make('icono')->disk('web')->preserveFilenames()->label('Icono')->required()->columnSpanFull(),
                                               ])->collapsed()->cloneable()->deletable()->columnSpanFull(),
                                           ]),
                                       ])->columnSpanFull(),
                                    ]),
                                ]),
                                Block::make('banner_accordion')->label('Bloque de imagen con acordeón')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        Tabs::make()->tabs([
                                            Tab::make('Contenido')->schema([
                                                FileUpload::make('image')->disk('web')->label('Imagen')->required()->columnSpanFull(),
                                                TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                                Forms\Components\Textarea::make('text')->label('Texto')->columnSpanFull(),

                                            ]),
                                            Tab::make('Elementos')->schema([
                                                Repeater::make('items')->schema([
                                                    TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                                                    RichEditor::make('content')->label('Contenido')->required()->columnSpanFull(),
                                                ])->collapsed()->cloneable()->deletable()->columnSpanFull(),
                                            ])
                                        ])->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('banner_gremcor')->label('Bloque de gremcor')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        FileUpload::make('image')->disk('web')->label('Imagen')->required()->columnSpanFull(),
                                        Forms\Components\RichEditor::make('text')->label('Texto')->required()->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('banner_interna')->label('Bloque de banner interna')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        Select::make('type_block')->label('Tipo de bloque')->options([
                                            'banner-with-image' => 'Banner interna con imagen',
                                            'banner-interna-with-background' => 'Banner interna con fondo',
                                        ])->columnSpanFull()->live(),
                                        TextInput::make('title')
                                            ->label('Título')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Descripción')
                                            ->columnSpanFull(),
                                        Toggle::make('add_block_gray')->label('¿Añadir bloque gris?')->live()->columnSpanFull(),
                                        Section::make('Bloque gris')->schema([
                                            TextInput::make('title_gray')->label('Título')->columnSpanFull(),
                                            Forms\Components\Textarea::make('text')->label('Texto')->columnSpanFull(),
                                        ])->hidden(fn (Get $get) => !$get('add_block_gray')),
                                        FileUpload::make('image')
                                            ->label('Imagen')
                                            ->disk('web')
                                            ->preserveFilenames()
                                            ->hidden(fn (Get $get) => $get('type_block') !== 'banner-with-image')
                                            ->columnSpanFull(),
                                        FileUpload::make('image_mobile')
                                            ->label('Imagen móvil')
                                            ->disk('web')
                                            ->preserveFilenames()
                                            ->hidden(fn (Get $get) => $get('type_block') !== 'banner-with-image')
                                            ->columnSpanFull(),
                                        ColorPicker::make('background')
                                            ->label('Color de fondo')
                                            ->default('#326BD6')
                                            ->hidden(fn (Get $get) => $get('type_block') !== 'banner-interna-with-background')
                                            ->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('image_with_text_icon')->label('Bloque de imagen con texto e ícono')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        RichEditor::make('text')->label('Texto')->required()->columnSpanFull(),
                                        FileUpload::make('image')->disk('web')->label('Imagen')->columnSpanFull(),
                                        FileUpload::make('icon')->disk('web')->label('Ícono')->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('form')->label('Formulario')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        TextInput::make('title')->label('Título')->required()->columnSpan(8),
                                        Select::make('form_id')->label('Formulario')->required()->options(\App\Models\Form::all()->pluck('name', 'id'))->columnSpan(4),
                                        TextInput::make('sub_title')->label('Subtítulo')->columnSpanFull(),
                                        Toggle::make('in_container')->label('Colocar dentro de contender')->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('form_with_info_of_contact')->label('Formulario con información de contacto')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                            Select::make('form_id')->label('Formulario')->required()->options(\App\Models\Form::all()->pluck('name', 'id'))->columnSpan(4),
                                            TextInput::make('url_jfram_google_maps')->label('URL de Google Maps')->required()->columnSpan(8),
                                            RichEditor::make('text')->label('Texto')->required()->columnSpanFull(),
                                            Toggle::make('in_container')->label('Colocar dentro de contender')->columnSpanFull(),
                                            Toggle::make('add_button_contact')->label('¿Añadir botón de contacto?')->live()->columnSpanFull(),
                                            TextInput::make('button_text')->label('Texto del botón')->required()->hidden(fn (Get $get) => !$get('add_button_contact'))->columnSpanFull(),
                                            TextInput::make('button_url')->label('URL del botón')->required()->hidden(fn (Get $get) => !$get('add_button_contact'))->columnSpanFull(),
                                        ])
                                    ]),
                                Block::make('text')->label('Texto')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        RichEditor::make('text')->label('Texto')->required()->columnSpanFull(),
                                    ])
                                ]),
                                Block::make('image')->label('Imagen')->schema([
                                    Grid::make([
                                        'default' => 1,
                                        'sm' => 3,
                                        'xl' => 12,
                                        '2xl' => 12
                                    ])->schema([
                                        FileUpload::make('image')->disk('web')->label('Imagen')->required()->columnSpanFull(),
                                    ])
                                ]),
                            ])->collapsible()->cloneable()
                    ])->columnSpan(8),
                    Section::make('Ajustes')->schema([
                        TextInput::make('name')->label('Nombre')->required()->columnSpanFull(),
                        Select::make('type')->label('Tipo de página')->required()->options([
                            Types::DEFAULT->value => Types::DEFAULT->value,
                            Types::HOME->value => Types::HOME->value,
                            Types::PRODUCTS->value => Types::PRODUCTS->value
                        ])->columnSpanFull()->default(Types::DEFAULT->value),
                    ])->columnSpan(4)
                ]),
                Section::make('SEO')->schema([
                    Group::make()
                        ->schema([
                            TextInput::make('title')->label('Título'),
                            Forms\Components\Textarea::make('description')->label('Descripción'),
                            Forms\Components\TagsInput::make('focus_keywords')->label('Palabras clave'),
                            Forms\Components\FileUpload::make('image_url')->disk('web')->label('Imagen SEO')->preserveFilenames()->reactive()
                        ])->relationship('meta')
                ])->collapsed()
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
