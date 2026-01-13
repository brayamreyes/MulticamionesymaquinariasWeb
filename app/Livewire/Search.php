<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component {

    use WithPagination;

    #[Url(history: true)]
    public $tipo, $marca, $modelo;

    public function render() {
        $productQuery = Product::query()->published();

        if ($this->tipo) {
            $productQuery->where('category_id', $this->tipo);
        }

        if ($this->marca) {
            $productQuery->where('brand_id', $this->marca);
        }

        if ($this->modelo) {
            $productQuery->where('model', $this->modelo);
        }

        $this->count = Product::count();
        return view('livewire.search', [
            'products' => $productQuery->paginate(12),
        ]);
    }
}
