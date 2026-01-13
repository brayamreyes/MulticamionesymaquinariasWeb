<?php

namespace App\Filament\Resources\Cms\WidgetResource\Pages;

use App\Filament\Resources\Cms\WidgetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWidgets extends ListRecords
{
    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
