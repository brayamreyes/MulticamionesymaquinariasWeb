<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Actions\MakeDataSheet;
use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord {

    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void {
        MakeDataSheet::run($this->record);
    }

}
