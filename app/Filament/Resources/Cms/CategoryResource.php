<?php

namespace App\Filament\Resources\Cms;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\Cms;
use App\Models\Category;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $breadcrumb = 'Categorías';
    protected static ?string $modelLabel = 'categoría';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required()->label('Nombre')->maxLength(255),
                    Textarea::make('description')->label('Descripción'),
                    FileUpload::make('image')->label('Imagen')->image()->preserveFilenames()->disk('web'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('order', 'ASC'))
            ->reorderable('order')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()->before(function (Category $category) {
                        $page = Page::find($category['page_id']);
                        $page->update(['slug' => $page['slug'] . '-' . time()]);
                        $page->delete();
                    })
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
            'index' => Cms\CategoryResource\Pages\ListCategories::route('/'),
            'create' => Cms\CategoryResource\Pages\CreateCategory::route('/create'),
            'edit' => Cms\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
