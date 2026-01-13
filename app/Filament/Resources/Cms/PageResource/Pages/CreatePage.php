<?php

namespace App\Filament\Resources\Cms\PageResource\Pages;

use App\Concerns\Enums\Types;
use App\Filament\Resources\Cms\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function afterCreate(): void {
        if ($this->record['type'] === Types::HOME->value) {
            $this->record->update([
                'slug' => '/'
            ]);
        }
    }
}
