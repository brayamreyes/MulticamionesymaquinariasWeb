<?php

namespace App\Livewire\Common;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component {

    public $data;
    public $category_id, $brand_id, $model_id;
    public array $categories = [], $brands = [], $models = [];

    public function mount($data) {
        $this->data = $data;
        $this->categories = Category::all()->toArray();
    }

    public function change_category():void {
        $brand_ids = Product::where('category_id', $this->category_id)->get()->pluck('brand_id')->unique()->toArray();
        $this->brand_id = null;
        $this->model_id = null;
        $this->brands = Brand::whereIn('id', $brand_ids)->get()->toArray();
    }

    public function change_brand():void {
        $this->models = Product::where('brand_id', $this->brand_id)->get()->pluck('model')->unique()->toArray();
        $this->model_id = null;
    }

    public function process() {
        $this->redirect(route('page', [
            'slug' => 'buscar',
            'tipo' => $this->category_id,
            'marca' => $this->brand_id,
            'modelo' => $this->model_id
        ]));
    }

    public function render() {
        return view('livewire.common.product-search');
    }
}
