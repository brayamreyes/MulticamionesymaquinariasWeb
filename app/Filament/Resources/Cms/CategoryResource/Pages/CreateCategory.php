<?php

namespace App\Filament\Resources\Cms\CategoryResource\Pages;

use App\Concerns\Enums\Types;
use App\Filament\Resources\Cms\CategoryResource;
use App\Models\Page;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord {

    protected static string $resource = CategoryResource::class;

    protected function afterCreate(): void {
        $product_page = Page::where('type', Types::PRODUCTS->value)->get()->last();
        $title = null;
        if ($product_page) {
            $title = $product_page->name;
        }

        $page = Page::create([
            'name' => $this->record['name'],
            'content' => [
                [
                    'data' => [
                        "text" => $this->record['description'],
                        "image" => [],
                        "title" => ($title ?: $this->record['name']),
                        "background" => "#326BD6",
                        "title_gray" => $this->record['name'],
                        "type_block" => "banner-interna-with-background",
                        "description" => null,
                        "add_block_gray" => (bool)$product_page,
                    ],
                    "type" => "banner_interna"
                ],
                [
                    "data" => [
                        "brand_id" => null,
                        "background" => "#FFFFFF",
                        "category_id" => $this->record['id'],
                        "show_search" => false
                    ],
                    "type" => "products"
                ]
            ],
            'type' => Types::DEFAULT->value,
            'category_id' => $this->record['id']
        ]);

        $this->record->update(['page_id' => $page->id]);
    }
}
