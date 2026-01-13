<?php

namespace App\Livewire\Common;

use App\Models\Product;
use Livewire\Component;

class FeaturedProducts extends Component {

    public $products = [];
    public $data = null;

    public function mount($data) {
        $this->products = Product::with('category')->where('is_featured', true)->ordered()->get();
        $this->data = $data;
    }
    public function render() {
        return view('livewire.common.featured-products');
    }
}
