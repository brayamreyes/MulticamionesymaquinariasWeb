<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Imports\Products;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')->label('Importar')->color('success')
                ->form([
                    FileUpload::make('file')->label('Archivo')
                        ->hint(new HtmlString('<a href="'. asset('formats/products-format.xlsx') .'" target="_blank">Descargar formato</a>'))
                        ->hintColor('primary')
                ])
                ->action(function(array $data): void {
                    Excel::import(new Products(), storage_path("app/public/{$data['file']}"));
                    if(Storage::exists("public/{$data['file']}")) {
                        sleep(2);
                        Storage::delete("public/{$data['file']}");
                    }
                    Artisan::call('queue:work');
                    $this->redirect('/admin/products');
                })
        ];
    }
}
