<?php

namespace App\Livewire\Common;

use App\Models\Slide;
use Livewire\Component;

class Slider extends Component {

    public Slide $slide;

    public function mount($id) {
        $this->slide = Slide::with('slideItems')->find($id);
    }

    public function render() {
        return view('livewire.common.slider');
    }
}
