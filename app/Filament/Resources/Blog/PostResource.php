<?php

namespace App\Filament\Resources\Blog;

use App\Concerns\Enums\Status;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Artículos';
    protected static ?string $breadcrumb = 'Artículos';
    protected static ?string $modelLabel = 'articulo';

    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set){
                                $set('meta.title', $state);
                            })
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('content')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                $firstParagraph = substr($state, 0, strpos($state, ".") + 1);
                                $cleanDescription = strip_tags($firstParagraph);
                                $set('meta.description', $cleanDescription);
                            })->label('Contenido')
                    ])->columnSpan(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')->disk('web')
                            ->optimize('webp')
                            ->preserveFilenames()
                            ->reorderable(),
                        Forms\Components\TagsInput::make('tags'),
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                Status::PUBLISHED->value => 'Públicar',
                                Status::DRAFT->value => 'Borrador',
                            ]),
                    ])->columnSpan(1)
                ])->columns(3),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
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
            'index' => PostResource\Pages\ListPosts::route('/'),
            'create' => PostResource\Pages\CreatePost::route('/create'),
            'edit' => PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
