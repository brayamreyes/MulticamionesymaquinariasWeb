<?php

namespace App\Jobs;

use App\Actions\Common\FormatNumeric;
use App\Actions\MakeDataSheet;
use App\Concerns\Enums\Types;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Product;
use Croustibat\FilamentJobsMonitor\Traits\QueueProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterProduct implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, QueueProgress;


    public function __construct(public $data) {
    }

    public function handle(): void
    {
        $exists = Product::where('plate', $this->data[0])->first();
        if (!$exists) {
            $category = Category::where('name', $this->data[2])->first();
            if (!$category) {
                $product_page = Page::where('type', Types::PRODUCTS->value)->get()->last();
                $title = null;
                if ($product_page) {
                    $title = $product_page->name;
                }

                $category = Category::create(['name' => $this->data[2]]);
                $page = Page::create([
                    'name' => $category['name'],
                    'content' => [
                        [
                            'data' => [
                                "text" => null,
                                "image" => [],
                                "title" => ($title ?: $category['name']),
                                "background" => "#326BD6",
                                "title_gray" => $category['name'],
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
                                "category_id" => $category['id'],
                                "show_search" => false
                            ],
                            "type" => "products"
                        ]
                    ],
                    'type' => Types::DEFAULT->value,
                    'category_id' => $category['id']
                ]);
                $category->update(['page_id' => $page->id]);
            }

            $brand = Brand::where('name', $this->data[4])->first();
            if (!$brand) {
                $brand = Brand::create(['name' => $this->data[4]]);
            }


            $product_data = [
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'type' => $this->data[3],
                'plate' => $this->data[0],
                'name' => $this->data[1],
                'model' => $this->data[5],
                'year_model' => $this->data[7],
                'year_manufacture' => $this->data[6],
                'mileage' => (is_numeric($this->data[8]) ? number_format($this->data[8]) : $this->data[8]),
                'hours' => (is_numeric($this->data[9]) ? number_format($this->data[9]) : $this->data[9]),

                'dollar_price' => round($this->data[10]),
                'dollar_igv' => round($this->data[11]),
                'dollar_final_price' => round($this->data[12]),
                'pen_price' => round($this->data[13]),
                'pen_igv' => round($this->data[14]),
                'pen_final_price' => round($this->data[15])
            ];

            $motor = [];
            if ($this->data['motor']) {
                $motor[] = ['Nombre' => 'Marca', 'Valor' => $this->data['motor']];
            }
            if ($this->data[17]) {
                $motor[] = ['Nombre' => 'Modelo', 'Valor' => $this->data[17]];
            }
            if ($this->data[18]) {
                $motor[] = ['Nombre' => 'Potencia (HP)', 'Valor' => $this->data[18]];
            }
            if ($this->data[19]) {
                $motor[] = ['Nombre' => 'Torque', 'Valor' => $this->data[19]];
            }
            if ($this->data[20]) {
                $motor[] = ['Nombre' => 'Cilindrada', 'Valor' => $this->data[20]];
            }
            if ($this->data[21]) {
                $motor[] = ['Nombre' => 'Tipo de inyección', 'Valor' => $this->data[21]];
            }
            if ($this->data[22]) {
                $motor[] = ['Nombre' => 'Nro. Cilindros', 'Valor' => $this->data[22]];
            }

            $transmision = [];
            if ($this->data['transmision_caja_de_cambios']) {
                $transmision[] = ['Nombre' => 'Marca', 'Valor' => $this->data['transmision_caja_de_cambios']];
            }
            if ($this->data[24]) {
                $transmision[] = ['Nombre' => 'Modelo', 'Valor' => $this->data[24]];
            }
            if ($this->data[25]) {
                $transmision[] = ['Nombre' => 'Tipo', 'Valor' => $this->data[25]];
            }
            if ($this->data[26]) {
                $transmision[] = ['Nombre' => 'Número de Marchas', 'Valor' => $this->data[26]];
            }

            $eje_motriz = [];
            if ($this->data['eje_motriz']) {
                $eje_motriz[] = ['Nombre' => 'Formula Rodante', 'Valor' => $this->data['eje_motriz']];
            }
            if ($this->data[28]) {
                $eje_motriz[] = ['Nombre' => 'Relación de Reducción', 'Valor' => $this->data[28]];
            }

            $capacidades_y_dimensiones = [];
            if ($this->data['capacidades_y_dimensiones']) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Peso operativo', 'Valor' => $this->data['capacidades_y_dimensiones']];
            }
            if ($this->data[30]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Capacidad de Carga', 'Valor' => FormatNumeric::run($this->data[30], 1)];
            }
            if ($this->data[31]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Longitud total', 'Valor' => FormatNumeric::run($this->data[31])];
            }
            if ($this->data[32]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Altura total', 'Valor' => FormatNumeric::run($this->data[32])];
            }
            if ($this->data[33]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Anchura total', 'Valor' => FormatNumeric::run($this->data[33])];
            }
            if ($this->data[34]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Distancia entre ejes', 'Valor' => FormatNumeric::run($this->data[34])];
            }
            if ($this->data[35]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Tipo Estructura', 'Valor' => $this->data[35]];
            }
            if ($this->data[36]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Marca Estructura', 'Valor' => $this->data[36]];
            }
            if ($this->data[37]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Capacidad Estructura', 'Valor' => $this->data[37]];
            }
            if ($this->data[38]) {
                $capacidades_y_dimensiones[] = ['Nombre' => 'Capacidad de Cuchara', 'Valor' => $this->data[38]];
            }

            $suspension = [];
            if ($this->data['suspension']) {
                $suspension[] = ['Nombre' => 'Delantera', 'Valor' => $this->data['suspension']];
            }
            if ($this->data[40]) {
                $suspension[] = ['Nombre' => 'Posterior', 'Valor' => $this->data[40]];
            }

            $ruedas_y_neumaticos = [];
            if ($this->data['ruedas_y_neumaticos']) {
                $ruedas_y_neumaticos[] = ['Nombre' => 'Tipo de Neumático', 'Valor' => $this->data['ruedas_y_neumaticos']];
            }
            if ($this->data[42]) {
                $ruedas_y_neumaticos[] = ['Nombre' => 'Medida de Aro', 'Valor' => $this->data[42]];
            }

            $otros = [];
            if ($this->data['otros']) {
                $otros[] = ['Nombre' => 'Dirección', 'Valor' => $this->data['otros']];
            }
            if ($this->data[44]) {
                $otros[] = ['Nombre' => 'Tipo de Combustible', 'Valor' => $this->data[44]];
            }
            if ($this->data[45]) {
                $otros[] = ['Nombre' => 'Emisiones', 'Valor' => $this->data[45]];
            }
            if ($this->data[46]) {
                $otros[] = ['Nombre' => 'Úrea', 'Valor' => $this->data[46]];
            }


            $general_specifications = [];
            if (count($motor) > 0) {
                $general_specifications[] = [
                    'title' => 'Motor',
                    'items' => $motor
                ];
            }

            if (count($transmision) > 0) {
                $general_specifications[] = [
                    'title' => 'Transmisión (Caja de Cambios)',
                    'items' => $transmision
                ];
            }

            if (count($eje_motriz) > 0) {
                $general_specifications[] = [
                    'title' => 'Eje Motriz',
                    'items' => $eje_motriz
                ];
            }

            if (count($capacidades_y_dimensiones) > 0) {
                $general_specifications[] = [
                    'title' => 'Capacidades y Dimensiones',
                    'items' => $capacidades_y_dimensiones
                ];
            }

            if (count($suspension) > 0) {
                $general_specifications[] = [
                    'title' => 'Suspensión',
                    'items' => $suspension
                ];
            }

            if (count($ruedas_y_neumaticos) > 0) {
                $general_specifications[] = [
                    'title' => 'Ruedas y Neumáticos',
                    'items' => $ruedas_y_neumaticos
                ];
            }

            if (count($otros) > 0) {
                $general_specifications[] = [
                    'title' => 'Otros',
                    'items' => $otros
                ];
            }

            $content = null;
            if (count($general_specifications) > 0) {
                $content = [
                    [
                        'data' => [
                            "icon" => 'especificaciones-generales.png',
                            "title" => 'Especificaciones Generales',
                            'general_specifications' => $general_specifications
                        ],
                        "type" => "general_specifications"
                    ]
                ];
            }

            $product_data['content'] = $content;
            $product = Product::create($product_data);
            MakeDataSheet::run($product);

            $meta = new Meta(['title' => $product['name']]);
            $product->meta()->save($meta);
        }
    }
}
