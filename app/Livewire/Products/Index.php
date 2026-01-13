<?php

namespace App\Livewire\Products;

use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
#[Title('Productos')]
class Index extends Component {
    use WithPagination;

    public $category_id = null, $brand_id = null, $data = null, $show_search = false;

    #[Url]
    public $sort = '';

    #[Url]
    public $search = '';

    public $count = 0;

    public function render() {
        $productQuery = Product::query()->published();

        if ($this->sort === 'most_relevant') {
            $productQuery->orderBy('is_featured', 'desc');
        }
        if ($this->sort === 'lower_price') {
            $productQuery->orderBy('dollar_price', 'asc');
        }
        if ($this->sort === 'higher_price') {
            $productQuery->orderBy('dollar_price', 'desc');
        }
        if ($this->sort === 'lower_mileage') {
            $productQuery->orderBy('mileage', 'asc');
        }
        if ($this->sort === 'most_recent_year') {
            $productQuery->orderBy('year_manufacture', 'desc');
        }
        if ($this->category_id) {
            $productQuery->where('category_id', $this->category_id);
        }

        if ($this->brand_id) {
            $productQuery->where('brand_id', $this->brand_id);
        }

        if ($this->sort === 'newest') {
            $productQuery->orderBy('created_at', 'desc');
        }
        if ($this->search) {
            $productQuery->where('name', 'like', '%'.$this->search.'%');
        }
        $this->count = $productQuery->count();

        return view('livewire.products.index', [
            'products' => $productQuery->paginate(12),
        ]);
    }
}

