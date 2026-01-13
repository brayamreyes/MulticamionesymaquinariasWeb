<?php

namespace App\Livewire\Common;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component {

    public $data;
    public array $categories = [];

    public function mount($data) {
        $this->data = $data;
        $this->categories = Category::with('page')->whereHas('page')->ordered()->get()->toArray();
    }

    public function render() {
        return view('livewire.common.categories');
    }
}
