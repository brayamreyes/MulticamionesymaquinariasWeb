<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Imports\Customers;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')->label('Importar')->color('success')
                ->form([
                    FileUpload::make('file')->label('Archivo')
                        ->hint(new HtmlString('<a href="'. asset('formats/customers-format.xlsx') .'" target="_blank">Descargar formato</a>'))
                        ->hintColor('primary')
                ])
                ->action(function(array $data): void {
                    Excel::import(new Customers(), storage_path("app/public/{$data['file']}"));
                    if(Storage::exists("public/{$data['file']}")) {
                        sleep(2);
                        Storage::delete("public/{$data['file']}");
                    }
                    $this->redirect('/admin/customers');
                })
        ];
    }
}
