<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Actions\RegisterHubspotContact;
use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord {

    protected static string $resource = CustomerResource::class;

    protected function afterCreate(): void {
        RegisterHubspotContact::run($this->record);
    }

    protected function mutateFormDataBeforeCreate(array $data): array {
        $data['admin_id'] = auth()->id();
        return $data;
    }

}
