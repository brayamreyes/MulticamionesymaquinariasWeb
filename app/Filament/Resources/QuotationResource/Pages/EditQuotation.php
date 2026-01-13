<?php

namespace App\Filament\Resources\QuotationResource\Pages;

use App\Actions\MakeQuotation;
use App\Concerns\Enums\Status;
use App\Filament\Resources\QuotationResource;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuotation extends EditRecord {

    protected static string $resource = QuotationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array {
        $customer = Customer::find($data['customer_id']);
        $product = Product::find($data['product_id']);

        $data['first_name'] = $customer['first_name'] ?? '-';
        $data['last_name'] = $customer['last_name'] ?? '-';
        $data['dni'] = $customer['dni'] ?? '-';
        $data['ruc'] = $customer['ruc'] ?? '-';
        $data['business_name'] = $customer['business_name'] ?? '-';
        $data['phone'] = $customer['phone'] ?? '-';
        $data['email'] = $customer['email'] ?? '-';
        $data['product_name'] = $product['name'] ?? '-';
        return $data;
    }

    protected function getHeaderActions(): array {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('order')
                ->icon('heroicon-o-check-circle')
                ->label('Confirmar')
                ->color('success')->size('md')
                ->action(function (Quotation $quotation) {
                    $number = 1;
                    $last_quotation = Quotation::whereNotNull('number')->where('status', Status::ACCEPTED->value)->get()->last();
                    if ($last_quotation){
                        $number = $last_quotation->number + 1;
                    }
                    if ($quotation['status'] == Status::PENDING->value) {
                        $quotation->update([
                            'code' => 'MM' . "-" . date('Y') . '-' . $number,
                            'number' => $number,
                            'status' => Status::ACCEPTED->value
                        ]);
                    }

                    MakeQuotation::run($quotation);
                }),
        ];
    }
}
