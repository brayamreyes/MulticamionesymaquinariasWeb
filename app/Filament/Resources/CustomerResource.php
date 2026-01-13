<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Admin;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Clientes';
    protected static ?string $breadcrumb = 'Clientes';
    protected static ?string $modelLabel = 'cliente';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Section::make('Datos del cliente')->compact()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('first_name')->label('Nombre')->required()->columnSpan(4),
                        TextInput::make('last_name')->label('Apellidos')->required()->columnSpan(4),
                        TextInput::make('dni')->label('DNI')->required()->columnSpan(4),
                        TextInput::make('ruc')->unique('customers', 'ruc', ignoreRecord: true, modifyRuleUsing: function (Unique $rule){
                            return $rule->whereNull('deleted_at');
                        })->label('RUC')->required()->columnSpan(4),
                        TextInput::make('business_name')->label('Razón social')->required()->columnSpan(8),
                        TextInput::make('phone')->label('Celular')->required()->columnSpan(4),
                        TextInput::make('email')->label('Email')->email()->required()->columnSpan(8),
                        Select::make('admin_id')->label('Responsable')->options(Admin::all()->pluck('name', 'id'))->columnSpan(4)->hidden(function () {
                            $admin_role = auth()->user()->roles;
                            $show = true;
                            foreach ($admin_role as $role) {
                                if ($role->name === 'Vendedor') {
                                    $show = false;
                                }
                            }
                            return !$show;
                        })
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table {
        $admin_role = auth()->user()->roles;
        $filtered = false;
        foreach ($admin_role as $role) {
            if ($role->name === 'Vendedor') {
                $filtered = true;
            }
        }
        return $table
            ->modifyQueryUsing(function(Builder $query) use ($filtered) {
                if ($filtered) {
                    return $query->where('admin_id', auth()->user()->id);
                } else {
                    return $query->orderBy('created_at');
                }
            })
            ->columns([
                TextColumn::make('ruc')->label('RUC')->searchable()->sortable(),
                TextColumn::make('business_name')->label('Razón social')->searchable()->sortable(),
                TextColumn::make('admin.name')->label('Responsable')->searchable()->sortable(),
                TextColumn::make('first_name')->label('Nombre')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_name')->label('Apellidos')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dni')->label('DNI')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true)
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
