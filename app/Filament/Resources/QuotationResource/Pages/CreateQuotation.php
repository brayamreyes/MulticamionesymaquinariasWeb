<?php

namespace App\Filament\Resources\QuotationResource\Pages;

use App\Filament\Resources\QuotationResource;
use App\Models\Customer;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuotation extends CreateRecord {

    protected static string $resource = QuotationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array {
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
        $data['admin_id'] = auth()->id();
        return $data;
    }

}
