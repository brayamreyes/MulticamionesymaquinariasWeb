<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGeneral extends SettingsPage {

    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $title = 'Ajustes generales';
    protected static ?int $navigationSort = 41;

    protected static string $settings = GeneralSetting::class;

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }

    public function form(Form $form): Form {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make('General')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            FileUpload::make('logo')->label('Logo para la web')->disk('web')->preserveFilenames()->columnSpan(4),
                            FileUpload::make('favicon')->label('Favicon para la web')->disk('web')->preserveFilenames()->columnSpan(4),
                            FileUpload::make('quotation_logo')->label('Logo para cotizaciones')->disk('web')->preserveFilenames()->columnSpan(4),
                            TextInput::make('ruc')->label('RUC')->columnSpan(4),
                            TextInput::make('business_name')->label('Razón social')->columnSpan(8),
                            TextInput::make('address')->label('Dirección')->columnSpan(6),
                            TextInput::make('exchange')->label('Tipo de cambio')->numeric()->columnSpan(3),
                            TextInput::make('igv')->suffix('%')->label('IGV')->numeric()->columnSpan(3),
                            TextInput::make('whats_app_url')->label('URL de WhatsApp')->url()->columnSpanFull(),

                        ])
                    ]),
                    Tabs\Tab::make('Redes sociales')->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                            'xl' => 12,
                            '2xl' => 12
                        ])->schema([
                            TextInput::make('facebook_url')->label('URL de Facebook')->url()->columnSpanFull(),
                            TextInput::make('instagram_url')->label('URL de Instagram')->url()->columnSpanFull(),
                            TextInput::make('linkedin_url')->label('URL de LinkedIn')->url()->columnSpanFull(),
                            TextInput::make('youtube_url')->label('URL de Youtube')->url()->columnSpanFull(),
                            TextInput::make('tiktok_url')->label('URL de Tiktok')->url()->columnSpanFull()
                        ])
                    ])
                ])->columnSpanFull()
            ]);
    }
}
