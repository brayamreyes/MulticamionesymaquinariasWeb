<?php

namespace Database\Seeders;

use App\Concerns\Enums\Types;
use App\Models\Menu;
use App\Models\Meta;
use App\Models\Page;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(AdminSeeder::class);

        $home = Page::create([
            'name' => 'Inicio',
            'slug' => '/',
            'content' => [],
            'type' => Types::HOME->value
        ]);
        $meta = new Meta(['title' => 'Multicamiones y Maquinarias']);
        $home->meta()->save($meta);

        Page::create([
            'name' => 'Buscar',
            'slug' => 'buscar',
            'content' => []
        ]);

        Page::create([
            'name' => 'Equipos',
            'slug' => 'equipos',
            'content' => [
                [
                    'data' => [
                        "text" => null,
                        "image" => [],
                        "title" => 'Equipos',
                        "background" => "#326BD6",
                        "title_gray" => null,
                        "type_block" => "banner-interna-with-background",
                        "description" => null,
                        "add_block_gray" => false,
                    ],
                    "type" => "banner_interna"
                ],
                [
                    "data" => [
                        "brand_id" => null,
                        "background" => "#FFFFFF",
                        "category_id" => null,
                    ],
                    "type" => "products"
                ]
            ],
            'type' => Types::PRODUCTS->value,
        ]);

        Menu::create([
            'name' => 'Menú principal',
            'location' => Types::CABECERA->value
        ]);
    }
}
