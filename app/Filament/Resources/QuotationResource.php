<?php

namespace App\Filament\Resources;

use App\Actions\MakeQuotation;
use App\Actions\Quotation\MakeInvoice;
use App\Concerns\Enums\Status;
use App\Concerns\Enums\TEXTS;
use App\Filament\Resources\QuotationResource\Pages;
use App\Filament\Resources\QuotationResource\RelationManagers;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use App\Settings\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class QuotationResource extends Resource {

    protected static ?string $model = Quotation::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Cotizaciones';
    protected static ?string $breadcrumb = 'Cotizaciones';
    protected static ?string $modelLabel = 'cotización';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form {
        $settings = new GeneralSetting();
        $igv = $settings->igv;
        $igv = $igv/100;

        $exchange = $settings->exchange;

        $admin_role = auth()->user()->roles;
        $is_seller = false;
        foreach ($admin_role as $role) {
            if ($role->name === 'Vendedor') {
                $is_seller = true;
            }
        }

        return $form
            ->schema([
                Section::make('Datos de la cotización')->compact()->schema([
                    Grid::make([
                        'default' => 1,
                        'sm' => 3,
                        'xl' => 12,
                        '2xl' => 12
                    ])->schema([
                        TextInput::make('code')->label('Código')->disabled()->columnSpan(2),
                        Select::make('customer_id')->label('RUC')
                            ->searchable(['ruc'])->required()
                            ->columnSpan(function () use ($is_seller) {
                                return ($is_seller ? 10 : 6);
                            })->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $customer = Customer::find($state);
                                $set('business_name', $customer['business_name']);
                                $set('contact_name', $customer['first_name'] . ' ' . $customer['last_name']);
                            })
                            ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->ruc}")
                            ->relationship(
                                name: 'customer',
                                modifyQueryUsing: fn(Builder $query) => $query->orderBy('ruc')
                            ),
                        Select::make('admin_id')->label('Responsable')->options(Admin::all()->pluck('name', 'id'))->columnSpan(4)
                            ->hidden(function () use ($is_seller) {
                                return $is_seller;
                            })->columnSpan(4),
                        Section::make()->compact()->schema([
                            Grid::make([
                                'default' => 1,
                                'sm' => 3,
                                'xl' => 12,
                                '2xl' => 12
                            ])->schema([
                                TextInput::make('business_name')->label('Razón social')->readOnly()->columnSpan(6),
                                TextInput::make('contact_name')->label('Contacto')->readOnly()->columnSpan(6),
                            ])
                        ])->columnSpanFull(),
                        Select::make('product_id')->label('Vehículo')->reactive()->required()
                            ->relationship(
                                name: 'product',
                                modifyQueryUsing: fn(Builder $query) => $query->orderBy('name')
                            )
                            ->searchable(['name', 'plate'])->preload()
                            ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} - {$record->plate}")
                            ->columnSpan(8)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set){
                                $product = Product::find($get('product_id'));
                                $set('dollar_price',  $product['dollar_price']);
                                $set('dollar_igv',  $product['dollar_igv']);
                                $set('dollar_final_price',  $product['dollar_final_price']);

                                $set('pen_price',  $product['pen_price']);
                                $set('pen_igv',  $product['pen_igv']);
                                $set('pen_final_price',  $product['pen_final_price']);
                            }),
                        TextInput::make('exchange')->label('Tipo de cambio')->readOnly()->default($exchange)->numeric()->columnSpan(4),


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
                    ])
                ])->collapsible(),

                Section::make('Términos y condiciones')->compact()->schema([
                    RichEditor::make('terms_conditions')->label('Términos y condiciones')->default(TEXTS::TERMS_CONDITIONS->value)->columnSpanFull(),
                ])->collapsible()->collapsed(),

                Section::make('Forma de pago')->compact()->schema([
                    RichEditor::make('way_to_pay')->label('Forma de pago')->default(TEXTS::WAY_TO_PAY->value)->columnSpanFull(),
                ])->collapsible()->collapsed(),

                Section::make('Plazos de entrega')->compact()->schema([
                    RichEditor::make('delivery_term')->label('Plazos de entrega')->default(TEXTS::DELIVERY_TERM->value)->columnSpanFull(),
                ])->collapsible()->collapsed(),
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
                TextColumn::make('code')->label('Código')->searchable()->sortable(),
                TextColumn::make('ruc')->label('RUC')->searchable()->sortable(),
                TextColumn::make('business_name')->label('Razón social')->searchable()->sortable(),
                TextColumn::make('admin.name')->label('Responsable')->searchable()->sortable(),

                TextColumn::make('created_at')->label('Fecha de registro')->date('d/m/Y'),
                TextColumn::make('product_name')->label('Producto'),
                TextColumn::make('status')->label('Estado')->badge()->color(fn (string $state): string => match ($state) {
                    Status::ACCEPTED->value => 'success',
                    Status::PENDING->value => 'warning',
                    Status::CANCELLED->value => 'danger',
                    default => 'primary'
                }),

                TextColumn::make('first_name')->label('Nombre')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_name')->label('Apellidos')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dni')->label('DNI')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->tooltip('Editar'),
                Action::make('order')
                    ->icon('heroicon-o-check-circle')
                    ->label('')
                    ->tooltip('Confirmar')
                    ->color('success')->size('md')
                    ->action(function ($record) {
                        $number = 1;
                        $last_quotation = Quotation::whereNotNull('number')->where('status', Status::ACCEPTED->value)->get()->last();
                        if ($last_quotation){
                            $number = $last_quotation->number + 1;
                        }
                        if ($record['status'] == Status::PENDING->value) {
                            $record->update([
                                'code' => 'MM' . "-" . date('Y') . '-' . $number,
                                'number' => $number,
                                'status' => Status::ACCEPTED->value
                            ]);
                        }

                        MakeQuotation::run($record);
                        Notification::make()->icon('heroicon-m-check-circle')->title('Cotización generada')->body('La cotización ha sido generada con éxito y se encuentra disponible para descargarla')->send();
                    }),
                Action::make('pdf')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->label('')
                    ->tooltip('Descargar PDF')
                    ->color('gray')->size('md')
                    ->action(function ($record) {
                        if($record['code']) {
                            if (Storage::disk('public')->exists('quotations/' . $record['code'] . '.pdf')) {
                                return Storage::disk('public')->download('quotations/' . $record['code'] . '.pdf');
                            }
                        }
                        return null;
                    })->visible(fn(Quotation $quotation): bool => $quotation['status'] === Status::ACCEPTED->value),
                Tables\Actions\DeleteAction::make()->label('')->tooltip('Eliminar'),
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
            'index' => Pages\ListQuotations::route('/'),
            'create' => Pages\CreateQuotation::route('/create'),
            'edit' => Pages\EditQuotation::route('/{record}/edit'),
        ];
    }
}
