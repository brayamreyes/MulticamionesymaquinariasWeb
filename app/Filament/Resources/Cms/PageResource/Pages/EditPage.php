<?php

namespace App\Filament\Resources\Cms\PageResource\Pages;

use App\Concerns\Enums\Types;
use App\Filament\Resources\Cms\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void {
        if ($this->record['type'] === Types::HOME->value) {
            $this->record->update([
                'slug' => '/'
            ]);
        }
    }
}
