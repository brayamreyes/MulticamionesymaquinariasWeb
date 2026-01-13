<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class ContactReport extends Page {

    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.contact-report';
    protected static ?string $title = 'Reporte de contactos';
    protected static ?int $navigationSort = 40;
    protected static ?string $navigationGroup = 'Reportes';

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }
}
